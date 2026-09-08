<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewMdl extends CI_Model
{
    //ADD REVIEWS
    public function insert_reviews($data)
    {
        // 1. Insert to the local website database (reviews table)
        $inserted = $this->db->insert('reviews', $data);

        // 2. Insert to the admin panel database (feedback table)
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            
            // Check if connection actually succeeded
            if (!$admin_db || !$admin_db->conn_id) {
                log_message('error', 'ReviewMdl: Admin DB connection failed. conn_id is empty.');
                return $inserted;
            }

            // ---- Find or Create Customer ----
            $customer_id = null;

            // Try by email first
            if (!empty($data['email'])) {
                $user = $admin_db->select('id')->from('users')->where('email', $data['email'])->get()->row();
                if ($user) {
                    $customer_id = $user->id;
                }
            }

            // Try by name if email didn't match
            if (!$customer_id && !empty($data['name'])) {
                $user_by_name = $admin_db->select('id')->from('users')->where('name', $data['name'])->get()->row();
                if ($user_by_name) {
                    $customer_id = $user_by_name->id;
                }
            }

            // If still no user found, create a new customer record in admin users table
            if (!$customer_id) {
                $reviewer_email = isset($data['email']) ? $data['email'] : 'review_' . time() . '@website.com';
                $new_user = array(
                    'name'            => isset($data['name']) ? $data['name'] : 'Website Reviewer',
                    'email'           => $reviewer_email,
                    'password'        => password_hash('website_review_user_' . time(), PASSWORD_DEFAULT),
                    'status'          => 'active',
                    'registered_from' => 'website',
                    'created_at'      => date('Y-m-d H:i:s'),
                    'updated_at'      => date('Y-m-d H:i:s')
                );
                
                $user_inserted = $admin_db->insert('users', $new_user);
                if ($user_inserted) {
                    $customer_id = $admin_db->insert_id();
                    log_message('info', 'ReviewMdl: Created new user in admin DB with id=' . $customer_id . ' for email=' . $reviewer_email);
                } else {
                    $db_error = $admin_db->error();
                    log_message('error', 'ReviewMdl: Failed to create user in admin DB. Error: ' . json_encode($db_error));
                    return $inserted;
                }
            }

            // ---- Find Booking ----
            $booking_id = null;

            // Try to find booking for this customer
            $booking = $admin_db->select('id')->from('bookings')->where('customer_id', $customer_id)->order_by('id', 'desc')->limit(1)->get()->row();
            if ($booking) {
                $booking_id = $booking->id;
            }

            // If no booking for this customer, try any latest booking in system
            if (!$booking_id) {
                $any_booking = $admin_db->select('id')->from('bookings')->order_by('id', 'desc')->limit(1)->get()->row();
                if ($any_booking) {
                    $booking_id = $any_booking->id;
                }
            }

            // If absolutely no bookings exist, create a minimal placeholder booking
            if (!$booking_id) {
                $placeholder_booking = array(
                    'booking_number'  => 'REV-' . date('YmdHis') . '-' . rand(100, 999),
                    'customer_id'     => $customer_id,
                    'pickup_location' => 'Website Review (No Booking)',
                    'drop_location'   => 'N/A',
                    'shifting_date'   => date('Y-m-d'),
                    'status'          => 'completed',
                    'source'          => 'website',
                    'created_at'      => date('Y-m-d H:i:s'),
                    'updated_at'      => date('Y-m-d H:i:s')
                );
                $booking_inserted = $admin_db->insert('bookings', $placeholder_booking);
                if ($booking_inserted) {
                    $booking_id = $admin_db->insert_id();
                    log_message('info', 'ReviewMdl: Created placeholder booking in admin DB with id=' . $booking_id);
                } else {
                    $db_error = $admin_db->error();
                    log_message('error', 'ReviewMdl: Failed to create placeholder booking. Error: ' . json_encode($db_error));
                    return $inserted;
                }
            }

            // ---- Insert Feedback ----
            $feedback_data = array(
                'booking_id'  => $booking_id,
                'customer_id' => $customer_id,
                'rating'      => isset($data['stars']) ? intval($data['stars']) : 5,
                'review'      => isset($data['r_desc']) ? $data['r_desc'] : (isset($data['r_title']) ? $data['r_title'] : ''),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            );
            
            $feedback_inserted = $admin_db->insert('feedback', $feedback_data);
            
            if (!$feedback_inserted) {
                $db_error = $admin_db->error();
                log_message('error', 'ReviewMdl: Failed to insert feedback. Error: ' . json_encode($db_error) . ' | Data: ' . json_encode($feedback_data));
            } else {
                log_message('info', 'ReviewMdl: Feedback inserted successfully in admin DB. booking_id=' . $booking_id . ', customer_id=' . $customer_id);
            }

        } catch (\Throwable $e) {
            log_message('error', 'ReviewMdl: Exception inserting feedback to admin DB: ' . $e->getMessage() . ' | File: ' . $e->getFile() . ':' . $e->getLine());
        }

        return $inserted;
    }
    
}
