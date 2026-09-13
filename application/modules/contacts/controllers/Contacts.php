    <?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Contacts extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function index()
    {
        $data['title'] = "Bhandari Packers and Movers | Trusted Relocation & Shifting Services in India";
        $data['description'] = "Bhandari Packers and Movers offers reliable, affordable, and safe relocation services across India. We specialize in household shifting, office moving, vehicle transport, and packing services with complete customer satisfaction.";
        $data['module'] = "contacts";
        $data['view_file'] = "contacts";
        echo Modules::run('template/layout2', $data);
    }


    function booking()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim', array(
            'required' => 'Please enter your full name.'
        ));
        $this->form_validation->set_rules('phone', 'Mobile', 'required|trim|numeric|exact_length[10]', array(
            'required'     => 'Please enter a valid 10-digit phone number.',
            'numeric'      => 'Please enter a valid 10-digit phone number.',
            'exact_length' => 'Please enter a valid 10-digit phone number.'
        ));
        $this->form_validation->set_rules('mfrom', 'Pickup Location', 'required|trim', array(
            'required' => 'Please enter pickup location.'
        ));
        $this->form_validation->set_rules('mto', 'Drop Location', 'required|trim', array(
            'required' => 'Please enter drop location.'
        ));
        $this->form_validation->set_rules('date', 'Shifting Date', 'required|trim', array(
            'required' => 'Please select shifting date.'
        ));
        $this->form_validation->set_rules('shifting_time', 'Shifting Time', 'trim');
        if ($this->form_validation->run() == true) {
            $mfrom = $this->input->post('mfrom');
            if (!empty($mfrom)) {
                $mfrom_lower = strtolower($mfrom);
                $this->load->model('contacts_mdl');
                $loc_service_settings = $this->contacts_mdl->get_location_service_settings();
                $raw_allowed_str = !empty($loc_service_settings['allowed_pickup_cities']) ? $loc_service_settings['allowed_pickup_cities'] : 'Delhi, Noida, Greater Noida, Gurugram, Gurgaon, Ghaziabad, Faridabad';
                $allowed_keywords = array_filter(array_map('trim', explode(',', strtolower($raw_allowed_str))));
                
                $extra_keywords = array();
                foreach ($allowed_keywords as $kw) {
                    if ($kw === 'gurugram' || $kw === 'gurgaon') {
                        $extra_keywords[] = 'gurugram';
                        $extra_keywords[] = 'gurgaon';
                    } elseif ($kw === 'delhi' || $kw === 'new delhi') {
                        $extra_keywords[] = 'delhi';
                        $extra_keywords[] = 'new delhi';
                        $extra_keywords[] = 'ncr';
                    } elseif ($kw === 'noida' || $kw === 'greater noida') {
                        $extra_keywords[] = 'noida';
                        $extra_keywords[] = 'greater noida';
                        $extra_keywords[] = 'gautam buddh';
                        $extra_keywords[] = 'gautam budh';
                    }
                }
                $allowed_keywords = array_unique(array_merge($allowed_keywords, $extra_keywords));

                $is_allowed = false;
                foreach ($allowed_keywords as $keyword) {
                    if ($keyword !== '' && strpos($mfrom_lower, $keyword) !== false) {
                        $is_allowed = true;
                        break;
                    }
                }
                if (!$is_allowed) {
                    echo "<div class='alert alert-danger mb-0'><i class='bi bi-exclamation-triangle-fill me-1'></i> We apologize! Currently, our pickup relocation services operate exclusively from <b>" . htmlspecialchars($raw_allowed_str) . "</b>. Service is unavailable for your selected pickup location.</div>";
                    return;
                }
            }
            $this->session->set_userdata('last_quote_data', array(
                'mfrom'         => $this->input->post('mfrom'),
                'mto'           => $this->input->post('mto'),
                'phone'         => $this->input->post('phone'),
                'date'          => $this->input->post('date'),
                'shifting_time' => $this->input->post('shifting_time'),
                'name'          => $this->input->post('name'),
                'email'         => $this->input->post('email'),
            ));
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->bookings();
            if ($check == true) {
                echo "1";
            }
        } else {
            echo "<div class='alert alert-danger mb-0'>" . validation_errors() . "</div>";
        }
    }

    function faq()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Mobile', 'required|trim|numeric|exact_length[10]');
        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->faq();
            if ($check == true) {
                echo "1";
            }
        } else {
            echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
        }
    }
    function contact()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', "Email Address", 'required|trim|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->contact();
            if ($check == true) {
                echo "1";
            }
        } else {
            echo "<div class='alert alert-danger mb-0'>" . validation_errors() . "</div>";
        }
    }

    function newsletter()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        if ($this->form_validation->run() == true) {
            $this->load->model('contacts_mdl');
            $check = $this->contacts_mdl->newsletter();
            if ($check == true) {
                echo "1";
            }
        } else {
            echo "<div style='background: #FC5D09 !important;'>" . validation_errors() . "</div>";
        }
    }

    public function online_booking()
    {
        // Fetch active items and addons from admin database
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);

            // Get categories for base fares (with vehicle name via JOIN)
            $admin_db->reset_query();
            $query = $admin_db->select('categories.*, vehicles.vehicle_name')
                                   ->join('vehicles', 'vehicles.id = categories.vehicle_id', 'left')
                                   ->where('categories.status', 'active')
                                   ->order_by('categories.min_score', 'asc')
                                   ->get('categories');
            $categories = ($query && is_object($query)) ? $query->result() : [];

            // Get item sizes with active items
            $query = $admin_db->where('status', 'active')->get('item_sizes');
            $item_sizes = ($query && is_object($query)) ? $query->result() : [];
            foreach ($item_sizes as &$size) {
                $item_query = $admin_db->where('item_size_id', $size->id)
                                        ->where('status', 'active')
                                        ->get('items');
                $size->items = ($item_query && is_object($item_query)) ? $item_query->result() : [];
            }

            // Get addon categories with active addons
            $query = $admin_db->where('status', 'active')->get('add_on_categories');
            $addon_categories = ($query && is_object($query)) ? $query->result() : [];
            foreach ($addon_categories as &$cat) {
                $addon_query = $admin_db->where('addon_category_id', $cat->id)
                                        ->where('status', 'active')
                                        ->get('add_ons');
                $cat->addons = ($addon_query && is_object($addon_query)) ? $addon_query->result() : [];
            }

            // Get category-specific addon prices
            $query = $admin_db->get('add_on_category_prices');
            $addon_category_prices = ($query && is_object($query)) ? $query->result() : [];

            // Fetch booking if edit parameter is provided
            $edit_id = $this->input->get('edit');
            $edit_booking = null;
            if (!empty($edit_id)) {
                $admin_db->reset_query();
                if (is_numeric($edit_id)) {
                    $query = $admin_db->where('id', intval($edit_id))->get('bookings');
                    $edit_booking = ($query && is_object($query)) ? $query->row() : null;
                }
                if (!$edit_booking) {
                    $admin_db->reset_query();
                    $query = $admin_db->where('booking_number', trim($edit_id))->get('bookings');
                    $edit_booking = ($query && is_object($query)) ? $query->row() : null;
                }
                if ($edit_booking) {
                    if ($edit_booking->vendor_acceptance_status === 'accepted') {
                        $this->session->set_flashdata('error_msg', 'This booking cannot be edited as the assigned vendor has already accepted the request.');
                        redirect('contacts/my_bookings');
                    }
                    $admin_db->reset_query();
                    $items_query = $admin_db->where('booking_id', $edit_booking->id)->get('booking_items');
                    $edit_booking->items = ($items_query && is_object($items_query)) ? $items_query->result() : [];

                    $admin_db->reset_query();
                    $addons_query = $admin_db->where('booking_id', $edit_booking->id)->get('booking_add_ons');
                    $edit_booking->addons = ($addons_query && is_object($addons_query)) ? $addons_query->result() : [];
                }
            }
        } catch (\Exception $e) {
            $categories = [];
            $item_sizes = [];
            $addon_categories = [];
            $addon_category_prices = [];
            $edit_booking = null;
        } catch (\Throwable $e) {
            $categories = [];
            $item_sizes = [];
            $addon_categories = [];
            $addon_category_prices = [];
            $edit_booking = null;
        }

        $data['categories'] = $categories;
        $data['item_sizes'] = $item_sizes;
        $data['addon_categories'] = $addon_categories;
        $data['addon_category_prices'] = $addon_category_prices;
        $data['edit_booking'] = $edit_booking;
        $data['default_reg_fee'] = $this->_get_registration_fee_val(isset($admin_db) ? $admin_db : NULL);
        $data['last_quote_data'] = $this->session->userdata('last_quote_data') ?: [];

        // Fetch pricing settings from admin DB (matching PricingEngine defaults)
        $pricingSettings = [
            'per_km_rate'                => 20,
            'base_distance_km'           => 5,
            'per_floor_charge'           => 150,
            'weekend_surge_percentage'   => 10,
            'month_end_surge_percentage' => 15,
            'peak_time_surge_percentage' => 0,
            'peak_time_enabled'          => 1,
            'peak_time_start'            => '',
            'peak_time_end'              => '',
            'peak_time_start_date'       => '',
            'peak_time_end_date'         => '',
        ];
        try {
            if (isset($admin_db) && is_object($admin_db)) {
                $admin_db->reset_query();
                $query = $admin_db->get('pricing_settings');
                $psRows = ($query && is_object($query)) ? $query->result() : [];
                foreach ($psRows as $ps) {
                    if ($ps->key === 'peak_time_surge_percentage') {
                        $pricingSettings['peak_time_surge_percentage'] = (float) $ps->value;
                        $pricingSettings['peak_time_enabled'] = (int) $ps->is_enabled;
                    } elseif (array_key_exists($ps->key, $pricingSettings)) {
                        if (in_array($ps->key, ['peak_time_start', 'peak_time_end', 'peak_time_start_date', 'peak_time_end_date'])) {
                            $pricingSettings[$ps->key] = (string) $ps->value;
                        } else {
                            $pricingSettings[$ps->key] = (float) $ps->value;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
        } catch (\Throwable $e) {
        }
        $this->load->model('contacts_mdl');
        $data['loc_settings'] = $this->contacts_mdl->get_location_service_settings();
        $data['pricing_settings'] = $pricingSettings;

        $data['title'] = "Online Booking & Live Shifting Quote | Bhandari Packers and Movers";
        $data['description'] = "Estimate your shifting cost dynamically and book your relocation online.";
        $data['module'] = "contacts";
        $data['view_file'] = "online_booking";

        echo Modules::run('template/layout2', $data);
    }

    public function submit_online_booking()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pickup_location', 'Pickup Address', 'required|trim');
        $this->form_validation->set_rules('drop_location', 'Drop Address', 'required|trim');
        $this->form_validation->set_rules('shifting_date', 'Shifting Date', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|numeric|exact_length[10]');
        $this->form_validation->set_rules('estimated_amount', 'Estimated Amount', 'required|trim');

        if ($this->form_validation->run() == true) {
            $pickup_location  = $this->input->post('pickup_location');
            $drop_location    = $this->input->post('drop_location');
            $shifting_date    = $this->input->post('shifting_date');
            $shifting_time    = $this->input->post('shifting_time');
            $phone_number     = preg_replace('/\D+/', '', (string) $this->input->post('phone_number'));
            $estimated_amount = floatval($this->input->post('estimated_amount'));
            $distance_km      = floatval($this->input->post('distance_km') ?: ($this->input->post('total_distance') ?: 10));
            $remarks          = trim($this->input->post('remarks', TRUE) ?: ($this->input->post('additional_comment', TRUE) ?: ''));
            
            $pickup_floor     = intval($this->input->post('pickup_floor') ?: 0);
            $drop_floor       = intval($this->input->post('drop_floor') ?: 0);
            $pickup_lift      = intval($this->input->post('pickup_lift') ?: 0);
            $drop_lift        = intval($this->input->post('drop_lift') ?: 0);

            $effective_floors = 0;
            if (!$pickup_lift && $pickup_floor > 0) {
                $effective_floors += $pickup_floor;
            }
            if (!$drop_lift && $drop_floor > 0) {
                $effective_floors += $drop_floor;
            }

            // A booking must always belong to the number that completed OTP
            // verification.  Never trust a changed browser form value or a
            // local website-session id as the ServiceHub customer id.
            $verified_user = $this->session->userdata('web_user');
            $verified_mobile = preg_replace('/\D+/', '', (string) ($verified_user['mobile'] ?? ''));
            if (!$verified_user || strlen($verified_mobile) !== 10 || $phone_number !== $verified_mobile) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => false,
                    'message' => 'Please verify the same mobile number with OTP before placing your booking.'
                ]);
                return;
            }

            // Check if updating existing booking
            $editing_booking_id = intval($this->input->post('editing_booking_id'));
            if ($editing_booking_id > 0) {
                try {
                    $admin_db = $this->load->database('admin_hub', TRUE);
                    $existing_booking = $admin_db->where('id', $editing_booking_id)->get('bookings')->row();
                    if ($existing_booking) {
                        $total_volume_score = 0;
                        $items = json_decode($this->input->post('items_json'), TRUE);
                        if ($items && is_array($items)) {
                            foreach ($items as $itemId => $itemData) {
                                $qty = intval($itemData['qty'] ?? 0);
                                $weight = floatval($itemData['weight'] ?? 0);
                                if ($qty > 0) {
                                    $total_volume_score += ($qty * $weight);
                                }
                            }
                        }

                        $category = $admin_db->where('min_score <=', $total_volume_score)
                                             ->where('max_score >=', $total_volume_score)
                                             ->where('status', 'active')
                                             ->get('categories')
                                             ->row();
                        $category_id = $category ? $category->id : NULL;
                        $vehicle_id  = $category ? $category->vehicle_id : NULL;

                        $bookingUpdateData = array(
                            'pickup_location'    => $pickup_location,
                            'drop_location'      => $drop_location,
                            'shifting_date'      => $shifting_date,
                            'shifting_time'      => $shifting_time ? date('H:i:s', strtotime($shifting_time)) : null,
                            'total_distance'     => $distance_km,
                            'floors'             => $effective_floors,
                            'total_volume_score' => $total_volume_score,
                            'category_id'        => $category_id,
                            'vehicle_id'         => $vehicle_id,
                            'amount'             => $estimated_amount,
                            'remaining_amount'   => max(0, $estimated_amount - floatval(($existing_booking->registration_charge > 0) ? $existing_booking->registration_charge : $this->_get_registration_fee_val($admin_db))),
                            'updated_at'         => date('Y-m-d H:i:s'),
                        );

                        if ($this->_admin_table_has_column($admin_db, 'bookings', 'remarks')) {
                            $bookingUpdateData['remarks'] = $remarks ?: NULL;
                        }

                        if ($this->_admin_table_has_column($admin_db, 'bookings', 'pickup_floor')) {
                            $bookingUpdateData['pickup_floor'] = $pickup_floor;
                        }
                        if ($this->_admin_table_has_column($admin_db, 'bookings', 'drop_floor')) {
                            $bookingUpdateData['drop_floor'] = $drop_floor;
                        }
                        if ($this->_admin_table_has_column($admin_db, 'bookings', 'pickup_lift')) {
                            $bookingUpdateData['pickup_lift'] = $pickup_lift;
                        }
                        if ($this->_admin_table_has_column($admin_db, 'bookings', 'drop_lift')) {
                            $bookingUpdateData['drop_lift'] = $drop_lift;
                        }

                        $admin_db->where('id', $editing_booking_id)->update('bookings', $bookingUpdateData);

                        $admin_db->where('booking_id', $editing_booking_id)->delete('booking_items');
                        if ($items && is_array($items)) {
                            foreach ($items as $itemId => $itemData) {
                                $qty = intval($itemData['qty'] ?? 0);
                                $weight = floatval($itemData['weight'] ?? 0);
                                if ($qty > 0) {
                                    $admin_db->insert('booking_items', array(
                                        'booking_id'              => $editing_booking_id,
                                        'item_id'                 => $itemId,
                                        'quantity'                => $qty,
                                        'calculated_volume_score' => $qty * $weight,
                                        'created_at'              => date('Y-m-d H:i:s'),
                                        'updated_at'              => date('Y-m-d H:i:s')
                                    ));
                                }
                            }
                        }

                        $admin_db->where('booking_id', $editing_booking_id)->delete('booking_add_ons');
                        $addons = json_decode($this->input->post('addons_json'), TRUE);
                        if ($addons && is_array($addons)) {
                            foreach ($addons as $addonData) {
                                $addonId = is_array($addonData) ? ($addonData['id'] ?? null) : $addonData;
                                $qty = is_array($addonData) ? ($addonData['qty'] ?? 1) : 1;
                                if (!$addonId) continue;

                                $addon = $admin_db->where('id', $addonId)->get('add_ons')->row();
                                $price = $addon ? floatval($addon->price) : 0.00;
                                if ($addon && $category_id) {
                                    $catPrice = $admin_db->where('add_on_id', $addon->id)
                                                         ->where('category_id', $category_id)
                                                         ->get('add_on_category_prices')
                                                         ->row();
                                    if ($catPrice && $catPrice->price !== null && $catPrice->price !== '') {
                                        $price = floatval($catPrice->price);
                                    }
                                }

                                $calculatedPrice = $price * $qty;

                                $admin_db->insert('booking_add_ons', array(
                                    'booking_id' => $editing_booking_id,
                                    'add_on_id'  => $addonId,
                                    'price'      => $calculatedPrice,
                                    'quantity'   => $qty,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                ));
                            }
                        }

                        echo json_encode(['status' => true, 'is_update' => true, 'message' => 'Booking updated successfully!']);
                        return;
                    }
                } catch (\Exception $e) {
                    echo json_encode(['status' => false, 'message' => 'Failed to update booking: ' . $e->getMessage()]);
                    return;
                } catch (\Throwable $e) {
                    echo json_encode(['status' => false, 'message' => 'Failed to update booking: ' . $e->getMessage()]);
                    return;
                }
            }

            // 1. Insert to website bookings table (local DB) - Optional
            try {
                // Ensure phone column is VARCHAR(20) to prevent integer overflow
                try {
                    $this->db->query("ALTER TABLE `bookings` MODIFY COLUMN `phone` VARCHAR(20) DEFAULT NULL");
                } catch (\Throwable $e) {
                    // Ignore
                }

                $this->db->insert('bookings', array(
                    "phone"  => $phone_number,
                    "mfrom"  => $pickup_location,
                    "mto"    => $drop_location,
                ));
            } catch (\Throwable $e) {
                // Local website bookings table is optional now; ignore errors if table does not exist
            }

            // 2. Insert to admin database (service_hub)
            $booking_id = 0;
            $reg_fee_val = 500.00;
            $admin_insert_error = null;
            try {
                $admin_db = $this->load->database('admin_hub', TRUE);
                $customer_id = $this->_resolve_customer_id($admin_db, $phone_number, $verified_user);
                if (!$customer_id) {
                    throw new \RuntimeException('Unable to link the OTP-verified customer mobile to ServiceHub.');
                }

                $bookingRequestData = array(
                    'customer_id'      => $customer_id,
                    'phone_number'     => $phone_number,
                    'pickup_location'  => $pickup_location,
                    'drop_location'    => $drop_location,
                    'shifting_date'    => $shifting_date,
                    'shifting_time'    => $shifting_time ? date('H:i:s', strtotime($shifting_time)) : null,
                    'total_distance'   => $distance_km,
                    'estimated_amount' => $estimated_amount,
                    'status'           => 'pending', // unpaid starts as pending
                    'created_at'       => date('Y-m-d H:i:s'),
                    'updated_at'       => date('Y-m-d H:i:s'),
                    'registration_payment_status' => 'pending',
                    'registration_payment_id'     => null,
                    'registration_order_id'       => null,
                    'source'                      => 'website',
                );

                if ($this->_admin_table_has_column($admin_db, 'booking_requests', 'remarks')) {
                    $bookingRequestData['remarks'] = $remarks ?: NULL;
                }

                $admin_db->insert('booking_requests', $bookingRequestData);
                $booking_request_id = $admin_db->insert_id();

                // Calculate volume score
                $total_volume_score = 0;
                $items = json_decode($this->input->post('items_json'), TRUE);
                if ($items && is_array($items)) {
                    foreach ($items as $itemId => $itemData) {
                        $qty = intval($itemData['qty'] ?? 0);
                        $weight = floatval($itemData['weight'] ?? 0);
                        if ($qty > 0) {
                            $total_volume_score += ($qty * $weight);
                        }
                    }
                }

                // Get matched category and vehicle from DB
                $category = $admin_db->where('min_score <=', $total_volume_score)
                                     ->where('max_score >=', $total_volume_score)
                                     ->where('status', 'active')
                                     ->get('categories')
                                     ->row();
                $category_id = $category ? $category->id : NULL;
                $vehicle_id = $category ? $category->vehicle_id : NULL;

                // Generate unique booking number (Series: BPM-000001)
                $last_booking = $admin_db->like('booking_number', 'BPM-', 'after')
                                         ->order_by('id', 'DESC')
                                         ->limit(1)
                                         ->get('bookings')
                                         ->row();
                $next_number = 1;
                if ($last_booking && preg_match('/BPM-(\d+)/i', $last_booking->booking_number, $matches)) {
                    $next_number = intval($matches[1]) + 1;
                }
                do {
                    $booking_number = 'BPM-' . str_pad($next_number, 6, '0', STR_PAD_LEFT);
                    $exists = $admin_db->where('booking_number', $booking_number)->get('bookings')->num_rows() > 0;
                    if ($exists) {
                        $next_number++;
                    }
                } while ($exists);

                $reg_fee_val = $this->_get_registration_fee_val($admin_db);

                $bookingInsertData = array(
                    'booking_number'              => $booking_number,
                    'customer_id'                 => $customer_id,
                    'booking_request_id'          => $booking_request_id,
                    'pickup_location'             => $pickup_location,
                    'drop_location'               => $drop_location,
                    'shifting_date'               => $shifting_date,
                    'shifting_time'               => $shifting_time ? date('H:i:s', strtotime($shifting_time)) : null,
                    'total_distance'              => $distance_km,
                    'floors'                      => $effective_floors,
                    'total_volume_score'          => $total_volume_score,
                    'category_id'                 => $category_id,
                    'vehicle_id'                  => $vehicle_id,
                    'amount'                      => $estimated_amount,
                    'registration_charge'         => $reg_fee_val,
                    'registration_payment_status' => 'pending',
                    'registration_payment_id'     => null,
                    'registration_order_id'       => null,
                    'advance_amount'              => 0.00,
                    'remaining_amount'            => max(0, $estimated_amount - $reg_fee_val),
                    'status'                      => 'pending',
                    'tracking_status'             => 'pending',
                    'source'                      => 'website',
                    'created_at'                  => date('Y-m-d H:i:s'),
                    'updated_at'                  => date('Y-m-d H:i:s'),
                );

                // Some ServiceHub installations have this column while older
                // ones keep the number only in booking_requests. Store it when
                // available so the verified recipient remains explicit.
                if ($this->_admin_table_has_column($admin_db, 'bookings', 'phone_number')) {
                    $bookingInsertData['phone_number'] = $phone_number;
                }

                if ($this->_admin_table_has_column($admin_db, 'bookings', 'remarks')) {
                    $bookingInsertData['remarks'] = $remarks ?: NULL;
                }

                if ($this->_admin_table_has_column($admin_db, 'bookings', 'pickup_floor')) {
                    $bookingInsertData['pickup_floor'] = $pickup_floor;
                }
                if ($this->_admin_table_has_column($admin_db, 'bookings', 'drop_floor')) {
                    $bookingInsertData['drop_floor'] = $drop_floor;
                }
                if ($this->_admin_table_has_column($admin_db, 'bookings', 'pickup_lift')) {
                    $bookingInsertData['pickup_lift'] = $pickup_lift;
                }
                if ($this->_admin_table_has_column($admin_db, 'bookings', 'drop_lift')) {
                    $bookingInsertData['drop_lift'] = $drop_lift;
                }

                $admin_db->insert('bookings', $bookingInsertData);
                $booking_id = $admin_db->insert_id();

                // Save items
                if ($items && is_array($items)) {
                    foreach ($items as $itemId => $itemData) {
                        $qty = intval($itemData['qty'] ?? 0);
                        $weight = intval($itemData['weight'] ?? 0);
                        if ($qty > 0) {
                            $admin_db->insert('booking_items', array(
                                'booking_id'              => $booking_id,
                                'item_id'                 => $itemId,
                                'quantity'                => $qty,
                                'calculated_volume_score' => $qty * $weight,
                                'created_at'              => date('Y-m-d H:i:s'),
                                'updated_at'              => date('Y-m-d H:i:s')
                            ));
                        }
                    }
                }

                // Save addons
                $addons = json_decode($this->input->post('addons_json'), TRUE);
                if ($addons && is_array($addons)) {
                    foreach ($addons as $addonData) {
                        $addonId = is_array($addonData) ? ($addonData['id'] ?? null) : $addonData;
                        $qty = is_array($addonData) ? ($addonData['qty'] ?? 1) : 1;
                        if (!$addonId) continue;

                        $addon = $admin_db->where('id', $addonId)->get('add_ons')->row();
                        $price = $addon ? floatval($addon->price) : 0.00;
                        
                        if ($addon && $category_id) {
                            $catPrice = $admin_db->where('add_on_id', $addon->id)
                                                 ->where('category_id', $category_id)
                                                 ->get('add_on_category_prices')
                                                 ->row();
                            if ($catPrice && $catPrice->price !== null && $catPrice->price !== '') {
                                $price = floatval($catPrice->price);
                            }
                        }

                        $calculatedPrice = $price * $qty;

                        $admin_db->insert('booking_add_ons', array(
                            'booking_id' => $booking_id,
                            'add_on_id'  => $addonId,
                            'price'      => $calculatedPrice,
                            'quantity'   => $qty,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ));
                    }
                }

                // Save tracking status
                $admin_db->insert('order_trackings', array(
                    'booking_id' => $booking_id,
                    'status'     => 'pending',
                    'notes'      => 'Booking request submitted. Registration payment pending.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ));
            } catch (\Throwable $e) {
                $admin_insert_error = $e->getMessage();
                log_message('error', 'Admin DB online booking insert failed: ' . $admin_insert_error);
            }

            if (!$booking_id) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => false,
                    'message' => 'Could not save shifting details to admin panel. Please try again.'
                ]);
                return;
            }

            // 3. Send professional responsive email notice to Admin
            $this->load->model('contacts_mdl');
            try {
                $submission_time = date('D, d M Y \a\t h:i A');
                $safe_pickup = htmlspecialchars($pickup_location, ENT_QUOTES, 'UTF-8');
                $safe_drop   = htmlspecialchars($drop_location,   ENT_QUOTES, 'UTF-8');
                $safe_phone  = htmlspecialchars($phone_number,    ENT_QUOTES, 'UTF-8');
                $safe_date   = !empty($shifting_date) ? htmlspecialchars(date('d M Y', strtotime($shifting_date)), ENT_QUOTES, 'UTF-8') : 'Not specified';
                $safe_time   = !empty($shifting_time) ? htmlspecialchars(date('h:i A', strtotime($shifting_time)), ENT_QUOTES, 'UTF-8') : 'Not specified';
                $formatted_amount = number_format($estimated_amount, 2);
                $formatted_distance = number_format($distance_km, 1);

                $adminMessage = "
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>New Online Shifting Booking</title>
</head>
<body style='margin:0;padding:0;background-color:#f4f6f9;font-family:Segoe UI,Arial,sans-serif;'>
  <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:#f4f6f9;'>
    <tr>
      <td align='center' style='padding:30px 15px;'>
        <table width='600' cellpadding='0' cellspacing='0' border='0' style='max-width:600px;width:100%;background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);'>

          <!-- Header -->
          <tr>
            <td style='background:linear-gradient(135deg,#FC5D09,#DD3802);padding:30px 35px;text-align:center;'>
              <h1 style='margin:0;color:#ffffff;font-size:22px;font-weight:700;letter-spacing:0.5px;'>
                &#128666; New Online Booking Created!
              </h1>
              <p style='margin:8px 0 0;color:rgba(255,255,255,0.85);font-size:14px;'>
                Bhandari Packers and Movers &mdash; Detailed Shifting Booking
              </p>
            </td>
          </tr>

          <!-- Alert bar -->
          <tr>
            <td style='background:#fff8f5;border-left:4px solid #FC5D09;padding:12px 35px;'>
              <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                <tr>
                  <td>
                    <p style='margin:0;font-size:13px;color:#555;'>
                      &#128197; Received on: <strong style='color:#FC5D09;'>{$submission_time}</strong>
                    </p>
                  </td>
                  <td align='right'>
                    <span style='display:inline-block;background:#e6f4ea;color:#137333;font-size:12px;font-weight:700;padding:4px 12px;border-radius:12px;'>&#10004; Verified Mobile</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style='padding:30px 35px;'>

              <!-- Customer Phone -->
              <h2 style='margin:0 0 15px;font-size:15px;color:#0b2356;text-transform:uppercase;letter-spacing:1px;border-bottom:2px solid #f0f0f0;padding-bottom:8px;'>
                Customer Contact
              </h2>

              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:22px;'>
                <tr>
                  <td width='40' style='vertical-align:top;padding-top:2px;'>
                    <div style='width:36px;height:36px;background:#fff3ee;border-radius:50%;text-align:center;line-height:36px;font-size:17px;'>&#128222;</div>
                  </td>
                  <td style='padding-left:12px;'>
                    <p style='margin:0;font-size:11px;color:#999;text-transform:uppercase;letter-spacing:0.8px;'>Verified Phone Number</p>
                    <p style='margin:3px 0 0;font-size:16px;font-weight:600;color:#1a1a2e;'>
                      <a href='tel:{$safe_phone}' style='color:#FC5D09;text-decoration:none;'>{$safe_phone}</a>
                    </p>
                  </td>
                </tr>
              </table>

              <!-- Booking & Route Details -->
              <h2 style='margin:0 0 15px;font-size:15px;color:#0b2356;text-transform:uppercase;letter-spacing:1px;border-bottom:2px solid #f0f0f0;padding-bottom:8px;'>
                Booking &amp; Route Details
              </h2>

              <div style='background:#f8f9fc;border-radius:8px;padding:20px;border-left:4px solid #FC5D09;margin-bottom:20px;'>
                <!-- Pickup -->
                <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:14px;'>
                  <tr>
                    <td width='30' style='vertical-align:top;padding-top:2px;'>
                      <span style='font-size:18px;'>&#128205;</span>
                    </td>
                    <td>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Pickup Location (From)</p>
                      <p style='margin:3px 0 0;font-size:15px;font-weight:600;color:#222;'>{$safe_pickup}</p>
                    </td>
                  </tr>
                </table>

                <!-- Drop -->
                <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:14px;'>
                  <tr>
                    <td width='30' style='vertical-align:top;padding-top:2px;'>
                      <span style='font-size:18px;'>&#127919;</span>
                    </td>
                    <td>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Drop Location (To)</p>
                      <p style='margin:3px 0 0;font-size:15px;font-weight:600;color:#222;'>{$safe_drop}</p>
                    </td>
                  </tr>
                </table>

                <!-- Distance, Date, Time & Amount Grid -->
                <table width='100%' cellpadding='0' cellspacing='0' border='0' style='border-top:1px dashed #e0e0e0;padding-top:14px;margin-top:10px;'>
                  <tr>
                    <td width='50%' style='vertical-align:top;padding-bottom:12px;'>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Route Distance</p>
                      <p style='margin:3px 0 0;font-size:14px;font-weight:600;color:#1a1a2e;'>&#128739; {$formatted_distance} KM</p>
                    </td>
                    <td width='50%' style='vertical-align:top;padding-bottom:12px;'>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Shifting Date</p>
                      <p style='margin:3px 0 0;font-size:14px;font-weight:600;color:#FC5D09;'>&#128197; {$safe_date}</p>
                    </td>
                  </tr>
                  <tr>
                    <td width='50%' style='vertical-align:top;'>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Shifting Time</p>
                      <p style='margin:3px 0 0;font-size:14px;font-weight:600;color:#0b2356;'>&#9200; {$safe_time}</p>
                    </td>
                    <td width='50%' style='vertical-align:top;'>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Estimated Fare</p>
                      <p style='margin:3px 0 0;font-size:16px;font-weight:700;color:#2e7d32;'>&#8377;{$formatted_amount}</p>
                    </td>
                  </tr>
                </table>
              </div>

              <!-- CTA Buttons -->
              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-top:25px;'>
                <tr>
                  <td style='padding-bottom:10px;'>
                    <a href='tel:{$safe_phone}'
                       style='display:block;width:100%;box-sizing:border-box;background:#FC5D09;color:#ffffff;padding:14px 20px;border-radius:8px;text-decoration:none;font-weight:700;font-size:15px;text-align:center;letter-spacing:0.3px;'>
                      &#128222;&nbsp;&nbsp;Call Customer Now ({$safe_phone})
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style='background:#f8f9fc;border-top:1px solid #eee;padding:20px 35px;text-align:center;'>
              <p style='margin:0;font-size:12px;color:#999;'>
                This email was generated automatically by the online booking system on
                <a href='https://bhandaripackersandmovers.in' style='color:#FC5D09;text-decoration:none;'>bhandaripackersandmovers.in</a>
              </p>
              <p style='margin:6px 0 0;font-size:12px;color:#bbb;'>
                &copy; " . date('Y') . " Bhandari Packers and Movers. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>";

                $this->contacts_mdl->send_mail($adminMessage, 'New Online Booking Received - Rs. ' . $formatted_amount);
            } catch (\Throwable $e) {
                log_message('error', 'Online booking email notice failed: ' . $e->getMessage());
            }

            // Do not send a second “request created” WhatsApp here. The single
            // booking-confirmation message is sent only after the registration
            // payment succeeds, to the OTP-verified mobile number.

            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'booking_id' => $booking_id,
                'registration_fee' => $reg_fee_val,
                'message' => 'Shifting request created in admin! Proceeding to payment...'
            ]);
        } else {
            echo "<div class='alert alert-danger mb-0'>" . validation_errors() . "</div>";
        }
    }

    public function update_registration_payment()
    {
        header('Content-Type: application/json');
        
        $booking_id = intval($this->input->post('booking_id'));
        $status = $this->input->post('status'); // 'paid' or 'failed'
        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $razorpay_order_id = $this->input->post('razorpay_order_id');
        
        if (!$booking_id || !in_array($status, ['paid', 'failed'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid request parameters.']);
            return;
        }
        
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            
            // Check if booking exists
            $booking = $admin_db->where('id', $booking_id)->get('bookings')->row();
            if (!$booking) {
                echo json_encode(['success' => false, 'message' => 'Booking not found.']);
                return;
            }

            // Do not allow a payment callback for a booking owned by another
            // OTP-verified mobile number. This also prevents notifications
            // from being sent to an unrelated customer.
            $verified_user = $this->session->userdata('web_user');
            $verified_mobile = preg_replace('/\D+/', '', (string) ($verified_user['mobile'] ?? ''));
            $booking_mobile = $this->_get_booking_verified_mobile($admin_db, $booking);
            if (!$verified_user || strlen($verified_mobile) !== 10 || $booking_mobile !== $verified_mobile) {
                echo json_encode(['success' => false, 'message' => 'This booking does not belong to the OTP-verified mobile number.']);
                return;
            }

            // Razorpay/browser callbacks may be retried. Do not send the
            // confirmation message again after a successful first payment.
            if ($status === 'paid' && $booking->registration_payment_status === 'paid') {
                echo json_encode(['success' => true, 'message' => 'Payment was already verified.']);
                return;
            }
            
            // Update booking details
            $updateData = array(
                'registration_payment_status' => $status,
                'updated_at'                  => date('Y-m-d H:i:s')
            );
            
            if ($status === 'paid') {
                $updateData['registration_payment_id'] = $razorpay_payment_id;
                $updateData['registration_order_id']   = $razorpay_order_id;
                $updateData['status']                  = 'confirmed';
                $updateData['tracking_status']         = 'confirmed';

                // Auto-assign active vendors and dispatch in-app + FCM push notifications
                try {
                    $this->load->model('contacts_mdl');
                    $this->contacts_mdl->notify_vendors_for_booking($booking_id, $booking->booking_number, $admin_db);
                } catch (\Throwable $ve) {
                    log_message('error', 'Auto-assign vendors on paid failed: ' . $ve->getMessage());
                }
            }
            
            $admin_db->where('id', $booking_id)->update('bookings', $updateData);
            
            // Also update booking request status
            if ($booking->booking_request_id) {
                $reqUpdate = array(
                    'registration_payment_status' => $status,
                    'updated_at'                  => date('Y-m-d H:i:s')
                );
                if ($status === 'paid') {
                    $reqUpdate['registration_payment_id'] = $razorpay_payment_id;
                    $reqUpdate['registration_order_id']   = $razorpay_order_id;
                    $reqUpdate['status']                  = 'approved';
                }
                $admin_db->where('id', $booking->booking_request_id)->update('booking_requests', $reqUpdate);
            }
            
            // Log in order trackings
            $admin_db->insert('order_trackings', array(
                'booking_id' => $booking_id,
                'status'     => ($status === 'paid') ? 'confirmed' : 'pending',
                'notes'      => ($status === 'paid') 
                                ? 'Registration payment of Rs. ' . number_format($booking->registration_charge, 2) . ' verified. Booking confirmed.' 
                                : 'Registration payment failed.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));

            $whatsapp_sent = false;

            // Send the Meta-approved template. Free-text messages cannot be
            // delivered to a customer outside the 24-hour WhatsApp window.
            if ($status === 'paid') {
                // Clear any stored quote session data since booking is now completed/paid
                $this->session->unset_userdata('last_quote_data');

                try {
                    $customer = $admin_db->where('id', $booking->customer_id)->get('users')->row();
                    // The booking phone is locked to the OTP-verified session
                    // when it is created. It is the only valid WhatsApp recipient.
                    $phone_number = $booking_mobile;
                    
                    if ($phone_number) {
                        $customerName = !empty($verified_user['name']) ? $verified_user['name'] : ($customer ? $customer->name : 'Customer');
                        $bookingNumber = $booking->booking_number;
                        $shiftingDate = date('d M Y', strtotime($booking->shifting_date));
                        $shiftingTime = $booking->shifting_time ? date('h:i A', strtotime($booking->shifting_time)) : 'Not Specified';
                        $totalAmount = number_format($booking->amount, 2);
                        $advanceAmount = number_format($booking->registration_charge, 2);
                        $invoiceUrl = 'https://bhandaripackersandmovers.in/admin/public/booking/' . $booking_id . '/booking-details';
                        $this->load->model('contacts_mdl');
                        $whatsapp_sent = $this->contacts_mdl->send_booking_confirmation_template(
                            $phone_number,
                            $customerName,
                            $bookingNumber,
                            $shiftingDate,
                            $shiftingTime,
                            $booking->pickup_location,
                            $booking->drop_location,
                            $totalAmount,
                            $advanceAmount,
                            $invoiceUrl
                        );
                    }
                } catch (\Throwable $we) {
                    log_message('error', 'WhatsApp notify on paid failed: ' . $we->getMessage());
                }
            }
            
            echo json_encode([
                'success' => true,
                'whatsapp_sent' => $whatsapp_sent,
                'message' => $whatsapp_sent
                    ? 'Payment verified and WhatsApp confirmation sent.'
                    : 'Payment verified, but the WhatsApp confirmation could not be sent. Please contact support.'
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function clear_quote_session()
    {
        $this->session->unset_userdata('last_quote_data');
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    public function get_registration_fee()
    {
        header('Content-Type: application/json');
        $fee = $this->_get_registration_fee_val();
        echo json_encode(['registration_fee' => $fee]);
    }

    private function _get_registration_fee_val($admin_db = NULL)
    {
        try {
            if (!$admin_db) {
                $admin_db = $this->load->database('admin_hub', TRUE);
            }
            $reg_setting = $admin_db->where('key', 'registration_fee')->get('pricing_settings')->row();
            if ($reg_setting && isset($reg_setting->value) && is_numeric($reg_setting->value)) {
                return floatval($reg_setting->value);
            }
        } catch (Exception $e) {}
        return 500.00;
    }

    private function _resolve_customer_id($admin_db, $phone_number = null, $session_user = null)
    {
        try {
            $clean_phone = preg_replace('/\D+/', '', (string) ($phone_number ?? ''));
            if (strlen($clean_phone) !== 10) {
                return null;
            }

            // The mobile is the identity shared by the public site and
            // ServiceHub. Never fall back to an arbitrary user (which used to
            // make the owner receive a customer's WhatsApp booking message).
            $user = $admin_db->group_start()
                             ->where('mobile', $clean_phone)
                             ->or_where('phone', $clean_phone)
                             ->group_end()
                             ->get('users')
                             ->row();
            if ($user) {
                return (int) $user->id;
            }

            // This normally cannot happen because OTP verification creates the
            // ServiceHub user first. Retain a safe recovery path tied to this
            // exact verified mobile; do not attach the booking to another user.
            $guest_name = !empty($session_user['name']) ? $session_user['name'] : 'Website Customer';
            $guest_email = 'guest_' . time() . '_' . mt_rand(1000, 9999) . '@bhandari.local';

            $admin_db->insert('users', array(
                'name' => $guest_name,
                'email' => $guest_email,
                'mobile' => $clean_phone,
                'phone' => $clean_phone,
                'password' => password_hash('guest@123', PASSWORD_DEFAULT),
                'status' => 'active',
                'registered_from' => 'website',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));

            $new_user_id = $admin_db->insert_id();
            if ($new_user_id) {
                $user_role = $admin_db->where('name', 'User')->get('roles')->row();
                if (!$user_role) {
                    $user_role = $admin_db->where('name', 'Customer')->get('roles')->row();
                }
                $role_id = $user_role ? $user_role->id : 12;

                $admin_db->insert('model_has_roles', array(
                    'role_id'    => $role_id,
                    'model_type' => 'App\\Models\\User',
                    'model_id'   => $new_user_id,
                ));
                return (int) $new_user_id;
            }
        } catch (Exception $e) {
            log_message('error', 'Could not resolve guest customer id: ' . $e->getMessage());
        } catch (Throwable $e) {
            log_message('error', 'Could not resolve guest customer id: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * The booking request is the canonical phone source on older ServiceHub
     * databases, whose bookings table does not have a phone_number column.
     */
    private function _get_booking_verified_mobile($admin_db, $booking)
    {
        $mobile = preg_replace('/\D+/', '', (string) ($booking->phone_number ?? ''));
        if (strlen($mobile) === 10) {
            return $mobile;
        }

        if (!empty($booking->booking_request_id)) {
            $request = $admin_db->select('phone_number')
                                ->where('id', $booking->booking_request_id)
                                ->get('booking_requests')
                                ->row();
            $mobile = preg_replace('/\D+/', '', (string) ($request->phone_number ?? ''));
            if (strlen($mobile) === 10) {
                return $mobile;
            }
        }

        return '';
    }

    private function _admin_table_has_column($admin_db, $table, $column)
    {
        try {
            if (!$admin_db || !$table || !$column) {
                return false;
            }
            $fields = $admin_db->field_data($table);
            if (!is_array($fields)) {
                return false;
            }
            foreach ($fields as $field) {
                if (isset($field->name) && strtolower($field->name) === strtolower($column)) {
                    return true;
                }
            }
        } catch (Exception $e) {
            log_message('error', 'Table column check failed for ' . $table . '.' . $column . ': ' . $e->getMessage());
        } catch (Throwable $e) {
            log_message('error', 'Table column check failed for ' . $table . '.' . $column . ': ' . $e->getMessage());
        }
        return false;
    }

    private function _ensure_refund_table_exists($admin_db)
    {
        if (!$admin_db->table_exists('refund_requests')) {
            $sql = "CREATE TABLE IF NOT EXISTS `refund_requests` (
              `id` INT AUTO_INCREMENT PRIMARY KEY,
              `booking_id` INT NOT NULL,
              `customer_id` INT NOT NULL,
              `payment_type` ENUM('advance', 'final', 'full') DEFAULT 'advance',
              `total_paid_amount` DECIMAL(10,2) NOT NULL,
              `requested_refund_amount` DECIMAL(10,2) NOT NULL,
              `approved_refund_amount` DECIMAL(10,2) DEFAULT 0.00,
              `cancellation_reason` VARCHAR(255) NOT NULL,
              `reason_details` TEXT,
              `refund_method` ENUM('original_source', 'upi', 'bank_transfer') DEFAULT 'original_source',
              `upi_id` VARCHAR(100) NULL,
              `bank_account_no` VARCHAR(50) NULL,
              `bank_ifsc` VARCHAR(20) NULL,
              `status` ENUM('pending', 'approved', 'processing', 'refunded', 'rejected') DEFAULT 'pending',
              `gateway_payment_id` VARCHAR(100) NULL,
              `gateway_refund_id` VARCHAR(100) NULL,
              `admin_remarks` TEXT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME NOT NULL,
              KEY `idx_booking` (`booking_id`),
              KEY `idx_customer` (`customer_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            $admin_db->query($sql);
        }
    }

    public function my_bookings()
    {
        $web_user = $this->session->userdata('web_user');
        if (!$web_user) {
            $this->session->set_flashdata('error_msg', 'Please login first to view your bookings.');
            redirect('');
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            $this->_ensure_refund_table_exists($admin_db);

            $bookings = $admin_db->where('customer_id', $web_user['id'])
                                 ->order_by('created_at', 'desc')
                                 ->get('bookings')
                                 ->result();

            foreach ($bookings as &$b) {
                $b->refund_request = $admin_db->where('booking_id', $b->id)
                                              ->order_by('id', 'desc')
                                              ->get('refund_requests')
                                              ->row();

                $b->items = $admin_db->where('booking_id', $b->id)
                                     ->get('booking_items')
                                     ->result();
            }

            // Get active categories for pricing calculations
            $categories = $admin_db->where('status', 'active')
                                   ->order_by('min_score', 'asc')
                                   ->get('categories')
                                   ->result();

            // Get item sizes with active items for rendering edit forms
            $item_sizes = $admin_db->where('status', 'active')->get('item_sizes')->result();
            foreach ($item_sizes as &$size) {
                $size->items = $admin_db->where('item_size_id', $size->id)
                                        ->where('status', 'active')
                                        ->get('items')
                                        ->result();
            }
        } catch (Exception $e) {
            $bookings = [];
            $categories = [];
            $item_sizes = [];
        }

        $data['bookings'] = $bookings;
        $data['categories'] = $categories;
        $data['item_sizes'] = $item_sizes;
        $data['default_reg_fee'] = isset($admin_db) ? $this->_get_registration_fee_val($admin_db) : 500.00;
        $data['title'] = "My Bookings | Bhandari Packers and Movers";
        $data['description'] = "Track and manage your bookings, payments, and refund status.";
        $data['module'] = "contacts";
        $data['view_file'] = "my_bookings";

        echo Modules::run('template/layout2', $data);
    }

    public function save_edited_booking_items()
    {
        header('Content-Type: application/json');
        $web_user = $this->session->userdata('web_user');
        if (!$web_user) {
            echo json_encode(['success' => false, 'message' => 'Please login first.']);
            return;
        }

        $booking_id = intval($this->input->post('booking_id'));
        $items_json = $this->input->post('items_json');

        if (!$booking_id || !$items_json) {
            echo json_encode(['success' => false, 'message' => 'Booking ID and items data are required.']);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);

            // Fetch booking
            $booking = $admin_db->where('id', $booking_id)
                                 ->where('customer_id', $web_user['id'])
                                 ->get('bookings')
                                 ->row();

            if (!$booking) {
                echo json_encode(['success' => false, 'message' => 'Booking not found.']);
                return;
            }

            // Check if vendor has accepted
            if ($booking->vendor_acceptance_status === 'accepted') {
                echo json_encode(['success' => false, 'message' => 'This booking cannot be edited as the assigned vendor has already accepted the request.']);
                return;
            }

            if ($booking->status === 'cancelled') {
                echo json_encode(['success' => false, 'message' => 'Cancelled bookings cannot be edited.']);
                return;
            }

            // Decode items
            $submitted_items = json_decode($items_json, TRUE);
            if (!is_array($submitted_items)) {
                echo json_encode(['success' => false, 'message' => 'Invalid items data format.']);
                return;
            }

            // Calculate new volume score
            $total_volume_score = 0;
            $items_to_save = [];

            // Fetch all items from DB to prevent tampering
            $db_items = $admin_db->get('items')->result();
            $db_items_map = [];
            foreach ($db_items as $itm) {
                $db_items_map[$itm->id] = $itm;
            }

            // Fetch item sizes for fallback weights
            $db_sizes = $admin_db->get('item_sizes')->result();
            $db_sizes_map = [];
            foreach ($db_sizes as $sz) {
                $db_sizes_map[$sz->id] = $sz;
            }

            foreach ($submitted_items as $itemId => $qty) {
                $qty = intval($qty);
                if ($qty <= 0) continue;

                $itemId = intval($itemId);
                if (!isset($db_items_map[$itemId])) continue;

                $item = $db_items_map[$itemId];
                $size_id = $item->item_size_id;
                $size = $db_sizes_map[$size_id] ?? null;

                $scoreVal = isset($item->score_point) ? floatval($item->score_point) : ($size ? floatval($size->volume_score) : 0.00);
                $total_volume_score += ($qty * $scoreVal);

                $items_to_save[] = [
                    'item_id' => $itemId,
                    'quantity' => $qty,
                    'score_point' => $scoreVal
                ];
            }

            // Threshold validation
            if ($total_volume_score > 310) {
                echo json_encode(['success' => false, 'message' => 'Total items list score exceeds limits. Booking update requires manual survey. Please contact support.']);
                return;
            }

            // Get categories
            $categories = $admin_db->where('status', 'active')
                                   ->order_by('min_score', 'asc')
                                   ->get('categories')
                                   ->result();

            $matched_category = null;
            foreach ($categories as $cat) {
                if ($total_volume_score >= floatval($cat->min_score) && $total_volume_score <= floatval($cat->max_score)) {
                    $matched_category = $cat;
                    break;
                }
            }

            if (!$matched_category && count($categories) > 0) {
                $matched_category = $categories[0];
            }

            if (!$matched_category) {
                echo json_encode(['success' => false, 'message' => 'Could not match shifting category.']);
                return;
            }

            $category_id = $matched_category->id;
            $vehicle_id = $matched_category->vehicle_id;

            $base_fare = floatval($matched_category->base_fare);
            $price_per_point = floatval($matched_category->price_per_point);
            $point_based_fare = $total_volume_score * $price_per_point;

            // Original values
            $distance_charges = floatval($booking->distance_charges);
            $floor_charges    = floatval($booking->floor_charges);
            $addon_charges    = floatval($booking->addon_charges);

            // Fetch surcharge percentages config matching global settings or defaults
            $weekend_pct = 10.0;
            $month_end_pct = 15.0;
            $peak_pct = 0.0;
            $peak_enabled = 1;
            $peak_start = '';
            $peak_end = '';
            $peak_start_date = '';
            $peak_end_date = '';

            try {
                $ps_weekend = $admin_db->where('key', 'weekend_surge_percentage')->where('is_enabled', 1)->get('pricing_settings')->row();
                if ($ps_weekend) $weekend_pct = floatval($ps_weekend->value);
                $ps_monthend = $admin_db->where('key', 'month_end_surge_percentage')->where('is_enabled', 1)->get('pricing_settings')->row();
                if ($ps_monthend) $month_end_pct = floatval($ps_monthend->value);

                $ps_peak = $admin_db->where('key', 'peak_time_surge_percentage')->get('pricing_settings')->row();
                if ($ps_peak) {
                    $peak_pct = floatval($ps_peak->value);
                    $peak_enabled = intval($ps_peak->is_enabled);
                }
                $ps_peak_start = $admin_db->where('key', 'peak_time_start')->get('pricing_settings')->row();
                if ($ps_peak_start) $peak_start = (string) $ps_peak_start->value;
                $ps_peak_end = $admin_db->where('key', 'peak_time_end')->get('pricing_settings')->row();
                if ($ps_peak_end) $peak_end = (string) $ps_peak_end->value;
                $ps_peak_start_date = $admin_db->where('key', 'peak_time_start_date')->get('pricing_settings')->row();
                if ($ps_peak_start_date) $peak_start_date = (string) $ps_peak_start_date->value;
                $ps_peak_end_date = $admin_db->where('key', 'peak_time_end_date')->get('pricing_settings')->row();
                if ($ps_peak_end_date) $peak_end_date = (string) $ps_peak_end_date->value;
            } catch (Exception $e) {}

            $weekendSurchargePct = (floatval($matched_category->weekend_surcharge_percent) > 0)
                ? floatval($matched_category->weekend_surcharge_percent) / 100
                : $weekend_pct / 100;
            $monthEndSurchargePct = (floatval($matched_category->month_end_surcharge_percent) > 0)
                ? floatval($matched_category->month_end_surcharge_percent) / 100
                : $month_end_pct / 100;

            $catPeakPercent = floatval($matched_category->peak_time_surcharge_percent ?? 0);
            $catPeakStart = $matched_category->peak_time_start ?? '';
            $catPeakEnd = $matched_category->peak_time_end ?? '';

            $finalPeakPercent = ($catPeakPercent != 0) ? $catPeakPercent : $peak_pct;
            $finalPeakStart = !empty($catPeakStart) ? $catPeakStart : $peak_start;
            $finalPeakEnd = !empty($catPeakEnd) ? $catPeakEnd : $peak_end;
            $isPeakEnabled = ($catPeakPercent != 0) || ($peak_enabled && $finalPeakPercent != 0);

            // Surges
            $weekend_charges = 0;
            $month_end_charges = 0;
            $peak_time_charges = 0;
            $surchargeBase = $base_fare + $distance_charges;

            if ($booking->shifting_date) {
                $timestamp = strtotime($booking->shifting_date);
                $day = date('w', $timestamp);
                if ($day == 0 || $day == 6) {
                    $weekend_charges = $surchargeBase * $weekendSurchargePct;
                }

                $day_of_month = intval(date('j', $timestamp));
                $last_day_of_month = intval(date('t', $timestamp));
                if ($day_of_month >= ($last_day_of_month - 2) || $day_of_month <= 2) {
                    $month_end_charges = $surchargeBase * $monthEndSurchargePct;
                }
            }

            if ($isPeakEnabled) {
                $dateMatch = true;
                if (!empty($peak_start_date) && !empty($peak_end_date) && !empty($booking->shifting_date)) {
                    $shiftDate = date('Y-m-d', strtotime($booking->shifting_date));
                    $dateMatch = ($shiftDate >= $peak_start_date && $shiftDate <= $peak_end_date);
                }

                $timeMatch = true;
                if (!empty($finalPeakStart) && !empty($finalPeakEnd) && !empty($booking->shifting_time)) {
                    $shiftTime = date('H:i', strtotime($booking->shifting_time));
                    $timeMatch = $this->_is_time_between($shiftTime, $finalPeakStart, $finalPeakEnd);
                }

                if ($dateMatch && $timeMatch) {
                    $peak_time_charges = $surchargeBase * ($finalPeakPercent / 100);
                }
            }

            $new_amount = $base_fare + $point_based_fare + $distance_charges + $addon_charges + $floor_charges + $weekend_charges + $month_end_charges + $peak_time_charges;
            $reg_fee = floatval(($booking->registration_charge > 0) ? $booking->registration_charge : $this->_get_registration_fee_val($admin_db));
            $new_remaining = max(0, $new_amount - $reg_fee);

            // Start transaction
            $admin_db->trans_start();

            // Delete old items
            $admin_db->where('booking_id', $booking_id)->delete('booking_items');

            // Insert new items
            foreach ($items_to_save as $item) {
                $admin_db->insert('booking_items', array(
                    'booking_id'              => $booking_id,
                    'item_id'                 => $item['item_id'],
                    'quantity'                => $item['quantity'],
                    'calculated_volume_score' => $item['quantity'] * $item['score_point'],
                    'created_at'              => date('Y-m-d H:i:s'),
                    'updated_at'              => date('Y-m-d H:i:s')
                ));
            }

            // Update bookings
            $admin_db->where('id', $booking_id)->update('bookings', array(
                'total_volume_score' => $total_volume_score,
                'category_id'        => $category_id,
                'vehicle_id'         => $vehicle_id,
                'amount'             => $new_amount,
                'base_fare'          => $base_fare,
                'point_based_fare'   => $point_based_fare,
                'weekend_charges'    => $weekend_charges,
                'month_end_charges'  => $month_end_charges,
                'remaining_amount'   => $new_remaining,
                'updated_at'         => date('Y-m-d H:i:s')
            ));

            // Update booking_requests
            if ($booking->booking_request_id) {
                $admin_db->where('id', $booking->booking_request_id)->update('booking_requests', array(
                    'estimated_amount' => $new_amount,
                    'updated_at'       => date('Y-m-d H:i:s')
                ));
            }

            // Insert tracking note
            $admin_db->insert('order_trackings', array(
                'booking_id' => $booking_id,
                'status'     => $booking->tracking_status,
                'notes'      => 'Booking items updated by customer. New Volume Score: ' . number_format($total_volume_score, 2) . ', New Estimated Amount: Rs. ' . number_format($new_amount, 2),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));

            $admin_db->trans_complete();

            if ($admin_db->trans_status() === FALSE) {
                echo json_encode(['success' => false, 'message' => 'Transaction failed. Please try again.']);
            } else {
                echo json_encode(['success' => true, 'message' => 'Booking items updated successfully. New Amount: ₹' . number_format($new_amount, 2)]);
            }

        } catch (Exception $e) {
            log_message('error', 'save_edited_booking_items database exception: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Database exception: ' . $e->getMessage()]);
        }
    }


    public function request_cancellation_refund()
    {
        header('Content-Type: application/json');
        $web_user = $this->session->userdata('web_user');
        if (!$web_user) {
            echo json_encode(['success' => false, 'message' => 'Please login first.']);
            return;
        }

        $booking_id          = intval($this->input->post('booking_id'));
        $payment_type        = $this->input->post('payment_type', TRUE) ?: 'advance';
        $cancellation_reason = $this->input->post('cancellation_reason', TRUE);
        $reason_details      = $this->input->post('reason_details', TRUE);
        $refund_method       = $this->input->post('refund_method', TRUE) ?: 'original_source';
        $upi_id              = $this->input->post('upi_id', TRUE);
        $bank_account_no     = $this->input->post('bank_account_no', TRUE);
        $bank_ifsc           = $this->input->post('bank_ifsc', TRUE);

        if (!$booking_id || !$cancellation_reason) {
            echo json_encode(['success' => false, 'message' => 'Booking ID and cancellation reason are required.']);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            $this->_ensure_refund_table_exists($admin_db);

            $booking = $admin_db->where('id', $booking_id)
                                ->where('customer_id', $web_user['id'])
                                ->get('bookings')
                                ->row();

            if (!$booking) {
                echo json_encode(['success' => false, 'message' => 'Booking record not found.']);
                return;
            }

            if ($booking->vendor_acceptance_status === 'accepted') {
                echo json_encode(['success' => false, 'message' => 'This booking cannot be cancelled as the assigned vendor has already accepted the request.']);
                return;
            }

            $existing = $admin_db->where('booking_id', $booking_id)
                                 ->where_in('status', ['pending', 'approved', 'processing', 'refunded'])
                                 ->get('refund_requests')
                                 ->row();

            if ($existing) {
                echo json_encode(['success' => false, 'message' => 'A refund request for this booking already exists with status: ' . strtoupper($existing->status)]);
                return;
            }

            $reg_fee = floatval(($booking->registration_charge > 0) ? $booking->registration_charge : $this->_get_registration_fee_val($admin_db));
            $remaining_amount = floatval($booking->remaining_amount);
            $total_paid = 0;

            if ($booking->registration_payment_status === 'paid') {
                $total_paid += $reg_fee;
            }
            if ($booking->remaining_payment_status === 'paid') {
                $total_paid += $remaining_amount;
            }

            if ($total_paid <= 0) {
                $total_paid = floatval($booking->amount);
            }

            $gateway_payment_id = ($payment_type === 'final' && !empty($booking->remaining_payment_id))
                ? $booking->remaining_payment_id
                : $booking->registration_payment_id;

            $admin_db->insert('refund_requests', array(
                'booking_id'              => $booking_id,
                'customer_id'             => $web_user['id'],
                'payment_type'            => $payment_type,
                'total_paid_amount'       => $total_paid,
                'requested_refund_amount' => $total_paid,
                'approved_refund_amount' => 0.00,
                'cancellation_reason'     => $cancellation_reason,
                'reason_details'          => $reason_details,
                'refund_method'           => $refund_method,
                'upi_id'                  => $upi_id,
                'bank_account_no'         => $bank_account_no,
                'bank_ifsc'               => $bank_ifsc,
                'status'                  => 'pending',
                'gateway_payment_id'      => $gateway_payment_id,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s')
            ));

            $admin_db->where('id', $booking_id)->update('bookings', array(
                'status'          => 'cancellation_requested',
                'tracking_status' => 'cancellation_requested',
                'updated_at'      => date('Y-m-d H:i:s')
            ));

            $admin_db->insert('order_trackings', array(
                'booking_id' => $booking_id,
                'status'     => 'cancellation_requested',
                'notes'      => 'Cancellation & refund requested by customer. Reason: ' . $cancellation_reason,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));

            echo json_encode(['success' => true, 'message' => 'Cancellation & Refund request submitted successfully. Admin will review within 24-48 hours.']);
        } catch (Exception $e) {
            log_message('error', 'request_cancellation_refund error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Database operation failed: ' . $e->getMessage()]);
        }
    }

    public function get_refund_status()
    {
        header('Content-Type: application/json');
        $booking_id = intval($this->input->get_post('booking_id'));

        if (!$booking_id) {
            echo json_encode(['success' => false, 'message' => 'booking_id is required']);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            $this->_ensure_refund_table_exists($admin_db);

            $refund = $admin_db->where('booking_id', $booking_id)
                               ->order_by('id', 'desc')
                               ->get('refund_requests')
                               ->row();

            if ($refund) {
                echo json_encode(['success' => true, 'data' => $refund]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No refund request found for this booking']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function admin_process_refund()
    {
        header('Content-Type: application/json');

        $refund_request_id = intval($this->input->post('refund_request_id'));
        $action            = $this->input->post('action', TRUE);
        $approved_amount   = floatval($this->input->post('approved_amount'));
        $admin_remarks     = $this->input->post('admin_remarks', TRUE);
        $gateway_refund_id = $this->input->post('gateway_refund_id', TRUE);

        if (!$refund_request_id || !in_array($action, ['approve', 'reject', 'refund'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid parameters. Action must be approve, reject or refund.']);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            $this->_ensure_refund_table_exists($admin_db);

            $refund = $admin_db->where('id', $refund_request_id)->get('refund_requests')->row();
            if (!$refund) {
                echo json_encode(['success' => false, 'message' => 'Refund request not found.']);
                return;
            }

            if ($action === 'reject') {
                $admin_db->where('id', $refund_request_id)->update('refund_requests', [
                    'status'        => 'rejected',
                    'admin_remarks' => $admin_remarks ?: 'Refund request rejected by admin.',
                    'updated_at'    => date('Y-m-d H:i:s')
                ]);

                $admin_db->where('id', $refund->booking_id)->update('bookings', [
                    'status'          => 'confirmed',
                    'tracking_status' => 'confirmed',
                    'updated_at'      => date('Y-m-d H:i:s')
                ]);

                $admin_db->insert('order_trackings', [
                    'booking_id' => $refund->booking_id,
                    'status'     => 'confirmed',
                    'notes'      => 'Refund request rejected by admin. Remarks: ' . ($admin_remarks ?: 'N/A'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                echo json_encode(['success' => true, 'message' => 'Refund request marked as Rejected.']);
                return;
            }

            if ($action === 'approve') {
                $final_amt = $approved_amount > 0 ? $approved_amount : $refund->requested_refund_amount;
                $admin_db->where('id', $refund_request_id)->update('refund_requests', [
                    'approved_refund_amount' => $final_amt,
                    'status'                 => 'approved',
                    'admin_remarks'          => $admin_remarks ?: 'Approved by admin.',
                    'updated_at'             => date('Y-m-d H:i:s')
                ]);

                $admin_db->where('id', $refund->booking_id)->update('bookings', [
                    'status'          => 'cancelled',
                    'tracking_status' => 'cancelled',
                    'updated_at'      => date('Y-m-d H:i:s')
                ]);

                $admin_db->insert('order_trackings', [
                    'booking_id' => $refund->booking_id,
                    'status'     => 'cancelled',
                    'notes'      => 'Booking cancelled and refund approved for Rs. ' . number_format($final_amt, 2),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                echo json_encode(['success' => true, 'message' => 'Refund approved successfully.']);
                return;
            }

            if ($action === 'refund') {
                $ref_id = $gateway_refund_id ?: ('rfnd_manual_' . time());
                $final_amount = $approved_amount > 0 ? $approved_amount : $refund->requested_refund_amount;

                $admin_db->where('id', $refund_request_id)->update('refund_requests', [
                    'approved_refund_amount' => $final_amount,
                    'status'                 => 'refunded',
                    'gateway_refund_id'      => $ref_id,
                    'admin_remarks'          => $admin_remarks ?: 'Refund processed.',
                    'updated_at'             => date('Y-m-d H:i:s')
                ]);

                $admin_db->where('id', $refund->booking_id)->update('bookings', [
                    'status'          => 'cancelled',
                    'tracking_status' => 'cancelled',
                    'updated_at'      => date('Y-m-d H:i:s')
                ]);

                $admin_db->insert('order_trackings', [
                    'booking_id' => $refund->booking_id,
                    'status'     => 'cancelled',
                    'notes'      => 'Refund of Rs. ' . number_format($final_amount, 2) . ' processed. Refund Ref ID: ' . $ref_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                echo json_encode(['success' => true, 'message' => 'Refund status updated to Refunded successfully.']);
                return;
            }

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // ─── Mobile App REST APIs ──────────────────────────────────────────────────

    public function api_request_refund()
    {
        header('Content-Type: application/json');
        
        $customer_id         = intval($this->input->get_post('customer_id'));
        $booking_id          = intval($this->input->get_post('booking_id'));
        $payment_type        = $this->input->get_post('payment_type', TRUE) ?: 'advance';
        $cancellation_reason = $this->input->get_post('cancellation_reason', TRUE);
        $reason_details      = $this->input->get_post('reason_details', TRUE);
        $refund_method       = $this->input->get_post('refund_method', TRUE) ?: 'original_source';
        $upi_id              = $this->input->get_post('upi_id', TRUE);
        $bank_account_no     = $this->input->get_post('bank_account_no', TRUE);
        $bank_ifsc           = $this->input->get_post('bank_ifsc', TRUE);

        if (!$customer_id || !$booking_id || !$cancellation_reason) {
            echo json_encode([
                'status'  => false,
                'code'    => 400,
                'message' => 'customer_id, booking_id, and cancellation_reason are required parameters.'
            ]);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            $this->_ensure_refund_table_exists($admin_db);

            $booking = $admin_db->where('id', $booking_id)
                                ->where('customer_id', $customer_id)
                                ->get('bookings')
                                ->row();

            if (!$booking) {
                echo json_encode(['status' => false, 'code' => 404, 'message' => 'Booking not found for this customer.']);
                return;
            }

            $existing = $admin_db->where('booking_id', $booking_id)
                                 ->where_in('status', ['pending', 'approved', 'processing', 'refunded'])
                                 ->get('refund_requests')
                                 ->row();

            if ($existing) {
                echo json_encode(['status' => false, 'code' => 409, 'message' => 'Refund request already exists with status: ' . strtoupper($existing->status)]);
                return;
            }

            $reg_fee = floatval(($booking->registration_charge > 0) ? $booking->registration_charge : $this->_get_registration_fee_val($admin_db));
            $remaining_amount = floatval($booking->remaining_amount);
            $total_paid = 0;

            if ($booking->registration_payment_status === 'paid') $total_paid += $reg_fee;
            if ($booking->remaining_payment_status === 'paid') $total_paid += $remaining_amount;
            if ($total_paid <= 0) $total_paid = floatval($booking->amount);

            $gateway_payment_id = ($payment_type === 'final' && !empty($booking->remaining_payment_id))
                ? $booking->remaining_payment_id
                : $booking->registration_payment_id;

            $insert_data = array(
                'booking_id'              => $booking_id,
                'customer_id'             => $customer_id,
                'payment_type'            => $payment_type,
                'total_paid_amount'       => $total_paid,
                'requested_refund_amount' => $total_paid,
                'approved_refund_amount' => 0.00,
                'cancellation_reason'     => $cancellation_reason,
                'reason_details'          => $reason_details,
                'refund_method'           => $refund_method,
                'upi_id'                  => $upi_id,
                'bank_account_no'         => $bank_account_no,
                'bank_ifsc'               => $bank_ifsc,
                'status'                  => 'pending',
                'gateway_payment_id'      => $gateway_payment_id,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s')
            );

            $admin_db->insert('refund_requests', $insert_data);
            $refund_id = $admin_db->insert_id();

            $admin_db->where('id', $booking_id)->update('bookings', array(
                'status'          => 'cancellation_requested',
                'tracking_status' => 'cancellation_requested',
                'updated_at'      => date('Y-m-d H:i:s')
            ));

            echo json_encode([
                'status'  => true,
                'code'    => 200,
                'message' => 'Refund request submitted successfully.',
                'data'    => array_merge(['id' => $refund_id], $insert_data)
            ]);

        } catch (Exception $e) {
            echo json_encode(['status' => false, 'code' => 500, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }

    public function api_get_refund_status()
    {
        header('Content-Type: application/json');
        
        $customer_id = intval($this->input->get_post('customer_id'));
        $booking_id  = intval($this->input->get_post('booking_id'));

        if (!$customer_id || !$booking_id) {
            echo json_encode(['status' => false, 'code' => 400, 'message' => 'customer_id and booking_id are required.']);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            $this->_ensure_refund_table_exists($admin_db);

            $refund = $admin_db->where('booking_id', $booking_id)
                               ->where('customer_id', $customer_id)
                               ->order_by('id', 'desc')
                               ->get('refund_requests')
                               ->row();

            if ($refund) {
                echo json_encode(['status' => true, 'code' => 200, 'data' => $refund]);
            } else {
                echo json_encode(['status' => false, 'code' => 404, 'message' => 'No refund request record found.']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'code' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function api_my_bookings()
    {
        header('Content-Type: application/json');
        
        $customer_id = intval($this->input->get_post('customer_id'));
        if (!$customer_id) {
            echo json_encode(['status' => false, 'code' => 400, 'message' => 'customer_id parameter is required.']);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            $this->_ensure_refund_table_exists($admin_db);

            $bookings = $admin_db->where('customer_id', $customer_id)
                                 ->order_by('created_at', 'desc')
                                 ->get('bookings')
                                 ->result();

            foreach ($bookings as &$b) {
                $b->refund_request = $admin_db->where('booking_id', $b->id)
                                              ->order_by('id', 'desc')
                                              ->get('refund_requests')
                                              ->row();
            }

            echo json_encode([
                'status' => true,
                'code'   => 200,
                'count'  => count($bookings),
                'data'   => $bookings
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'code' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function verify_remaining_payment()
    {
        header('Content-Type: application/json');
        $web_user = $this->session->userdata('web_user');
        if (!$web_user) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized session. Please login again.']);
            return;
        }

        $booking_id = intval($this->input->post('booking_id'));
        $payment_id = $this->input->post('razorpay_payment_id', TRUE);
        $order_id   = $this->input->post('razorpay_order_id', TRUE) ?: 'order_' . time();

        if (!$booking_id || !$payment_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid request parameters.']);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if (!$admin_db || !is_object($admin_db)) {
                echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
                return;
            }
            $admin_db->initialize();
            
            // Fetch booking
            $booking = $admin_db->where('id', $booking_id)
                                 ->where('customer_id', $web_user['id'])
                                 ->get('bookings')
                                 ->row();

            if (!$booking) {
                echo json_encode(['success' => false, 'message' => 'Booking not found.']);
                return;
            }

            // Calculate auto remaining amount (Total Amount - Registration Fee Paid)
            $amount    = floatval($booking->amount);
            $reg_fee   = floatval(($booking->registration_charge > 0) ? $booking->registration_charge : $this->_get_registration_fee_val($admin_db));
            $remaining = max(0, $amount - $reg_fee);

            // Update remaining payment details
            $updateData = array(
                'remaining_amount'         => $remaining,
                'remaining_payment_status' => 'paid',
                'remaining_payment_id'     => $payment_id,
                'updated_at'               => date('Y-m-d H:i:s'),
            );

            if ($admin_db->field_exists('remaining_order_id', 'bookings')) {
                $updateData['remaining_order_id'] = $order_id;
            }

            $admin_db->where('id', $booking_id)->update('bookings', $updateData);

            // Log tracking note
            $admin_db->insert('order_trackings', array(
                'booking_id' => $booking_id,
                'status'     => 'completed',
                'notes'      => 'Remaining payment of Rs. ' . number_format($remaining, 2) . ' paid online via Website. Payment ID: ' . $payment_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));

            // Send WhatsApp notification (Final Tax Invoice PDF link)
            try {
                $customer = $admin_db->where('id', $booking->customer_id)->get('users')->row();
                // Use the booking's OTP-verified mobile, never a contact field
                // or an unrelated user record.
                $phone_number = $this->_get_booking_verified_mobile($admin_db, $booking);

                if ($phone_number) {
                    $customerName  = !empty($web_user['name']) ? $web_user['name'] : ($customer ? $customer->name : 'Customer');
                    $bookingNumber = $booking->booking_number;

                    $laravel_url = "https://bhandaripackersandmovers.in/admin";
                    if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
                        $laravel_url = "http://127.0.0.1:8000";
                    }

                    $invoiceUrl = $laravel_url . "/public/booking/" . $booking_id . "/tax-invoice";

                    $text = "Hello " . $customerName . ",\n\n"
                          . "Your final payment for Booking No: *{$bookingNumber}* has been successfully verified. ✅\n\n"
                          . "You can view and download your complete full Shifting Tax Invoice PDF using the link below:\n"
                          . "{$invoiceUrl}\n\n"
                          . "Thank you for shifting with us! We hope you had a great experience with Bhandari Packers and Movers. 🚚\n\n"
                          . "Best regards,\n"
                          . "Bhandari Packers and Movers Team";

                    $this->load->model('contacts_mdl');
                    $this->contacts_mdl->send_whatsapp($phone_number, $text);
                }
            } catch (\Throwable $we) {
                log_message('error', 'WhatsApp notify on remaining paid failed: ' . $we->getMessage());
            }

            echo json_encode(['success' => true, 'message' => 'Remaining payment of ₹' . number_format($remaining, 2) . ' verified and marked as Paid.']);
        } catch (Exception $e) {
            log_message('error', 'CI verify_remaining_payment DB error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Database update failed: ' . $e->getMessage()]);
        }
    }

    private function _is_time_between($time, $start, $end)
    {
        $timeVal = strtotime($time);
        $startVal = strtotime($start);
        $endVal = strtotime($end);

        if ($startVal === false || $endVal === false || $timeVal === false) return false;

        if ($startVal <= $endVal) {
            return ($timeVal >= $startVal && $timeVal <= $endVal);
        }
        return ($timeVal >= $startVal || $timeVal <= $endVal);
    }
}
