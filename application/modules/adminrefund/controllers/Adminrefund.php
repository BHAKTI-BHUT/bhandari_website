<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Refund Management Controller
 * Handles listing, approving, rejecting and processing refunds for booking cancellations.
 * Uses the 'admin_hub' database connection defined in application/config/database.php.
 */
class Adminrefund extends CI_Controller {
    private $admin_db;

    public function __construct() {
        parent::__construct();
        // Load admin hub DB (service_hub) – used by the admin panel.
        $this->admin_db = $this->load->database('admin_hub', TRUE);
        // Load URL helper for redirects
        $this->load->helper('url');
    }

    /**
     * List all refund requests.
     */
    public function list_requests() {
        $query = $this->admin_db->select('r.*, b.status as booking_status, b.customer_id, b.total_amount')
            ->from('refund_requests r')
            ->join('booking_requests b', 'b.id = r.booking_id', 'left')
            ->order_by('r.created_at', 'DESC')
            ->get();
        $data['refunds'] = $query->result();
        $this->load->view('adminrefund/list_requests', $data);
    }

    /**
     * Approve a refund request (sets status to "approved").
     * @param int $id Refund request ID
     */
    public function approve($id) {
        $this->admin_db->where('id', $id)->update('refund_requests', [
            'status' => 'approved',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $this->session->set_flashdata('msg', 'Refund request approved.');
        redirect($_SERVER['HTTP_REFERER'] ?? site_url('admin/refund-requests'));
    }

    /**
     * Reject a refund request (sets status to "rejected").
     * @param int $id Refund request ID
     */
    public function reject($id) {
        $this->admin_db->where('id', $id)->update('refund_requests', [
            'status' => 'rejected',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $this->session->set_flashdata('msg', 'Refund request rejected.');
        redirect($_SERVER['HTTP_REFERER'] ?? site_url('admin/refund-requests'));
    }

    /**
     * Process the actual money transfer (mock implementation).
     * In production you would call Razorpay/Stripe SDK here.
     * @param int $id Refund request ID
     */
    public function refund($id) {
        // For demo we simply mark as refunded and store a placeholder reference.
        $this->admin_db->where('id', $id)->update('refund_requests', [
            'status' => 'refunded',
            'admin_remark' => 'Refund processed via gateway, ref XYZ',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $this->session->set_flashdata('msg', 'Refund processed and marked as refunded.');
        redirect($_SERVER['HTTP_REFERER'] ?? site_url('admin/refund-requests'));
    }
}
?>
