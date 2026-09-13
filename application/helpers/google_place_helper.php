<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Fetch Google Place Details & Reviews using API Key and Place ID with caching
 */
if (!function_exists('get_google_place_details')) {
    function get_google_place_details($forceRefresh = false)
    {
        $apiKey  = defined('GOOGLE_PLACE_API_KEY') ? GOOGLE_PLACE_API_KEY : getenv('GOOGLE_PLACE_API_KEY');
        $placeId = defined('GOOGLE_PLACE_ID')      ? GOOGLE_PLACE_ID      : getenv('GOOGLE_PLACE_ID');

        if (empty($apiKey))  $apiKey  = 'AIzaSyBkG4TBQoURnRXy7szzEQP2LqvlEEVfYDM';
        if (empty($placeId)) $placeId = 'ChIJGyPsT1nlDDkRbUZcqWEUHZ0';

        $cacheDir  = APPPATH . 'cache';
        $cacheFile = $cacheDir . '/google_place_details.json';
        $cacheTime = 86400; // Cache for 24 hours (86400 seconds)

        // Return cached data if fresh
        if (!$forceRefresh && file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
            $json = file_get_contents($cacheFile);
            $decoded = json_decode($json, true);
            if (!empty($decoded) && !empty($decoded['result'])) {
                return $decoded['result'];
            }
        }

        // Make API request to Google Places Details API
        $fields = 'name,rating,user_ratings_total,reviews,formatted_address,geometry,url,address_components,international_phone_number';
        $apiUrl = 'https://maps.googleapis.com/maps/api/place/details/json?place_id=' . urlencode($placeId) . '&fields=' . urlencode($fields) . '&key=' . urlencode($apiKey);

        $resultData = null;
        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 5,
                    'user_agent' => 'BhandariPackersWebsite/1.0'
                ]
            ]);
            $response = @file_get_contents($apiUrl, false, $context);
            if ($response) {
                $decoded = json_decode($response, true);
                if (isset($decoded['status']) && $decoded['status'] === 'OK' && !empty($decoded['result'])) {
                    $resultData = $decoded['result'];
                    if (!is_dir($cacheDir)) {
                        @mkdir($cacheDir, 0755, true);
                    }
                    @file_put_contents($cacheFile, json_encode($decoded, JSON_PRETTY_PRINT));
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Google Places API Error: ' . $e->getMessage());
        }

        // Fallback default data if API call fails
        if (!$resultData) {
            $resultData = [
                'name' => 'Bhandari Packers And Movers',
                'rating' => 4.9,
                'user_ratings_total' => 18,
                'formatted_address' => 'Office No. 504, Baba Arcade, Harola, Sector 5, Noida, Uttar Pradesh 201301, India',
                'geometry' => [
                    'location' => [
                        'lat' => 28.5878278,
                        'lng' => 77.3188016
                    ]
                ],
                'url' => 'https://maps.google.com/?cid=11321227447965075053',
                'reviews' => [
                    [
                        'author_name' => 'Aman Yadav',
                        'profile_photo_url' => 'https://lh3.googleusercontent.com/a/ACg8ocJSlP24xEGrCOGIVIsy3zRsvGWhw7JEFvid8MWKGu0xRHhG6Q=s128-c0x00000000-cc-rp-mo',
                        'rating' => 5,
                        'relative_time_description' => 'in the last week',
                        'text' => 'Very nice service and experienced workers. Boys did a great job, quick shifting.'
                    ],
                    [
                        'author_name' => 'Himanshu Sardana',
                        'profile_photo_url' => 'https://lh3.googleusercontent.com/a/ACg8ocLXPH-fE5-0XDiJ3BqOQ9dKKSs17cIeDbvImO9CgZmTrlJpHg=s128-c0x00000000-cc-rp-mo',
                        'rating' => 5,
                        'relative_time_description' => 'in the last week',
                        'text' => 'Best packing and moving services, will book again.'
                    ],
                    [
                        'author_name' => 'Aayushi Aggarwal',
                        'profile_photo_url' => 'https://lh3.googleusercontent.com/a-/ALV-UjWQPPR4d_6I0fkZitK1J6-9TCkYeapPFtMhRosKOYX6OVLh3VTh=s128-c0x00000000-cc-rp-mo',
                        'rating' => 5,
                        'relative_time_description' => 'a week ago',
                        'text' => 'Great experience, very helpful with everything, helped a lot with shifting.'
                    ],
                    [
                        'author_name' => 'AMAN KUMAR',
                        'profile_photo_url' => 'https://lh3.googleusercontent.com/a/ACg8ocJEC1_70Pu7uv696YvLebQdu-gL1pPWrUOQDfQQmyqp5V1NgK4=s128-c0x00000000-cc-rp-mo',
                        'rating' => 5,
                        'relative_time_description' => 'a week ago',
                        'text' => 'Good service and professional team.'
                    ],
                    [
                        'author_name' => 'Ajay Mahi',
                        'profile_photo_url' => 'https://lh3.googleusercontent.com/a-/ALV-UjWNjpygxy0HFngEdPQWmOz9D40cuxqGier2Cmu0Cb0jt9-seCY5=s128-c0x00000000-cc-rp-mo',
                        'rating' => 5,
                        'relative_time_description' => 'a week ago',
                        'text' => 'Good experience with Bhandari Packers and Movers.'
                    ]
                ]
            ];
        }

        return $resultData;
    }
}

/**
 * Get Admin DB Instance (service_hub DB where customer_reviews and seo_settings live)
 */
if (!function_exists('get_admin_db_instance')) {
    function get_admin_db_instance()
    {
        $CI =& get_instance();
        try {
            $db = $CI->load->database('admin_hub', TRUE);
            if ($db && $db->conn_id) {
                return $db;
            }
        } catch (\Throwable $e) {
            log_message('error', 'Failed loading admin_hub database: ' . $e->getMessage());
        }

        if (!isset($CI->db)) {
            try {
                $CI->load->database();
            } catch (\Throwable $e2) {}
        }
        return isset($CI->db) ? $CI->db : null;
    }
}

/**
 * Fetch all approved customer reviews (Database Approved + Google Places API)
 */
if (!function_exists('get_all_approved_reviews')) {
    function get_all_approved_reviews()
    {
        $allReviews   = [];
        $existingKeys = [];
        $dbStatusMap  = [];
        $hasDbRecords = false;

        // 1. Fetch all reviews from Admin Database (customer_reviews table)
        try {
            $db = get_admin_db_instance();
            if ($db && $db->conn_id) {
                $dbAllQuery = $db->order_by('id', 'DESC')->get('customer_reviews');
                if ($dbAllQuery && $dbAllQuery->num_rows() > 0) {
                    $hasDbRecords = true;
                    foreach ($dbAllQuery->result_array() as $row) {
                        $key = strtolower(trim($row['customer_name'] . '|' . $row['review_text']));
                        $status = strtolower(trim($row['status']));
                        $dbStatusMap[$key] = $status;

                        // Only add approved reviews to the displayed list
                        if ($status === 'approved') {
                            $allReviews[] = [
                                'author_name' => $row['customer_name'],
                                'profile_photo_url' => $row['profile_image'],
                                'rating' => intval($row['rating']),
                                'relative_time_description' => !empty($row['created_at']) ? date('d M Y', strtotime($row['created_at'])) : 'Verified Client',
                                'text' => $row['review_text'],
                                'source' => !empty($row['source']) ? $row['source'] : 'Website'
                            ];
                            $existingKeys[$key] = true;
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Error fetching DB customer_reviews: ' . $e->getMessage());
        }

        // 2. Fetch Google Place API reviews IF DB returned no approved reviews
        if (empty($allReviews)) {
            $googleData = get_google_place_details();
            if (!empty($googleData['reviews'])) {
                foreach ($googleData['reviews'] as $gRev) {
                    $gName = isset($gRev['author_name']) ? $gRev['author_name'] : '';
                    $gText = isset($gRev['text']) ? $gRev['text'] : '';
                    $key   = strtolower(trim($gName . '|' . $gText));

                    if (!isset($existingKeys[$key])) {
                        $allReviews[] = [
                            'author_name' => $gName,
                            'profile_photo_url' => isset($gRev['profile_photo_url']) ? $gRev['profile_photo_url'] : '',
                            'rating' => isset($gRev['rating']) ? intval($gRev['rating']) : 5,
                            'relative_time_description' => isset($gRev['relative_time_description']) ? $gRev['relative_time_description'] : 'Google Review',
                            'text' => $gText,
                            'source' => 'Google'
                        ];
                        $existingKeys[$key] = true;
                    }
                }
            }
        }

        return $allReviews;
    }
}

/**
 * Fetch dynamic SEO settings from Database (seo_settings table)
 */
if (!function_exists('get_seo_setting')) {
    function get_seo_setting($pageName = 'home', $location = null)
    {
        try {
            $db = get_admin_db_instance();
            if ($db && $db->conn_id) {
                $db->where('page_name', $pageName);
                if (!empty($location)) {
                    $db->where('LOWER(location)', strtolower(trim($location)));
                } else {
                    $db->group_start();
                    $db->where('location', null);
                    $db->or_where('location', '');
                    $db->group_end();
                }
                $res = $db->get('seo_settings')->row_array();
                if (!empty($res)) {
                    return $res;
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Error fetching SEO settings: ' . $e->getMessage());
        }
        return null;
    }
}

