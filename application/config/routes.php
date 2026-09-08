<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error';
$route['search'] = 'home';
$route["photo-gallery"]="gallery/photo_gallery";
$route["video-gallery"]="gallery/video_gallery";
$route["(:any).htm"]="home/error";
$route["infrastructure"]="about/infrastructure";
$route["why-choose-us"]="about/choose";
$route["term-and-condition"]="about/termCondition";
$route["privacy-policy"]="about/privacy";
$route["faq"]="about/faq";

$route["blogs"] = "blog/view";
$route["blogs/(:any)"] = "blog/view";
$route["blog/(:any)"] = "blog/read/$1";

$route["services"] = "services/services/index";
$route["services/(:any)"] = "services/services/detail/$1";

$route["home-relocation"]="services/services/detail/home-relocation";
$route["courier-and-cargo"]="services/services/detail/courier-and-cargo";
$route["luggage-delivery"]="services/services/detail/luggage-delivery";
$route["goods-insurance"]="services/services/detail/goods-insurance";
$route["office-relocation"]="services/services/detail/office-relocation";
$route["packing-unpacking"]="services/services/detail/packing-unpacking";
$route["loading-unloading"]="services/services/detail/loading-unloading";
$route["car-transportation-service"]="services/services/detail/car-transportation-service";
$route["warehousing-services"]="services/services/detail/warehousing-services";
$route["our-branches"]="packers_movers/state";
$route["packers-movers-(:any)-india"]="packers_movers/state_services/$1";
$route["(:any)-packers-movers-(:any)"]="packers_movers/city/$2/$1";

// Dynamic Branch / State Routes fetched from admin_hub database
try {
    $db_file = APPPATH . 'config/database.php';
    if (file_exists($db_file)) {
        require $db_file;
        if (isset($db['admin_hub'])) {
            $dbc = $db['admin_hub'];
            $conn = @new mysqli($dbc['hostname'], $dbc['username'], $dbc['password'], $dbc['database']);
            if ($conn && !$conn->connect_error) {
                $res = $conn->query("SELECT slug FROM branch_states WHERE status = 1");
                if ($res) {
                    while ($row = $res->fetch_assoc()) {
                        $s = trim($row['slug']);
                        if (!empty($s)) {
                            $route[$s] = "packers_movers/state_services/" . $s;
                        }
                    }
                }
                $conn->close();
            }
        }
    }
} catch (\Throwable $e) {
    // Fallback static routes
    $route["bihar"]="packers_movers/state_services/bihar";
    $route["maharashtra"]="packers_movers/state_services/maharashtra";
    $route["delhi"]="packers_movers/state_services/delhi";
    $route["uttar-pradesh"]="packers_movers/state_services/uttar-pradesh";
    $route["greater-noida"]="packers_movers/state_services/greater-noida";
    $route["punjab"]="packers_movers/state_services/punjab";
    $route["noida"]="packers_movers/state_services/noida";
    $route["haryana"]="packers_movers/state_services/haryana";
    $route["gurgaon"]="packers_movers/state_services/gurgaon";
}

$route["branches"]="packers_movers/state";
$route["testimonials"]="about/testimonials";
$route['cancellation-refund'] = 'about/cancellation_refund';
$route['cancellation-and-refund'] = 'about/cancellation_refund';
$route["privacy"]="about/privacy";
$route["tips-and-suggestion"]="about/tips_and_suggestion";
$route["home-shifting-in-(:any)"] = "slimcity/home_shifting/$1";

$route["packers-movers-from-(:any)-to-(:any)"]="packers_movers/from_to/$1/$2";

// ─── User Auth (OTP Login) Routes ────────────────────────────────────────────
$route['user-auth/send-otp']     = 'contacts/user_auth/send_otp';
$route['user-auth/prepare-otp']  = 'contacts/user_auth/prepare_otp';
$route['user-auth/verify-otp']   = 'contacts/user_auth/verify_otp';
$route['user-auth/check-login']  = 'contacts/user_auth/check_login';
$route['user-auth/check-mobile'] = 'contacts/user_auth/check_mobile';
$route['user-auth/logout']       = 'contacts/user_auth/logout';
$route['user-auth/test-db']      = 'contacts/user_auth/test_db';

// Refund Management (Admin)
$route['admin/refund-requests'] = 'adminrefund/list_requests';
$route['admin/refund-approve/(:num)'] = 'adminrefund/approve/$1';
$route['admin/refund-reject/(:num)'] = 'adminrefund/reject/$1';
$route['admin/refund-process/(:num)'] = 'adminrefund/refund/$1';
$route['online-booking'] = 'contacts/online_booking';
$route['contacts/submit-online-booking'] = 'contacts/submit_online_booking';
$route['contacts/get-registration-fee'] = 'contacts/get_registration_fee';
$route['contacts/update-registration-payment'] = 'contacts/update_registration_payment';
$route['my-bookings'] = 'contacts/my_bookings';
$route['contacts/verify-remaining-payment'] = 'contacts/verify_remaining_payment';

// ─── Refund & Cancellation Routes (Web & Mobile App APIs) ───────────────────
$route['contacts/request-cancellation-refund'] = 'contacts/request_cancellation_refund';
$route['contacts/get-refund-status']           = 'contacts/get_refund_status';
$route['contacts/admin-process-refund']         = 'contacts/admin_process_refund';

// Mobile App REST API Routes
$route['api/request-refund']                   = 'contacts/api_request_refund';
$route['api/get-refund-status']                = 'contacts/api_get_refund_status';
$route['api/my-bookings']                      = 'contacts/api_my_bookings';
$route['api/vendor/send-otp']                  = 'contacts/vendor_auth/send_otp';
$route['api/vendor/verify-otp']                = 'contacts/vendor_auth/verify_otp';

$route['translate_uri_dashes'] = TRUE;