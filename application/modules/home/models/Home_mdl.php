<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_mdl extends CI_Model{
	  
	public function get_faqs()
	{
	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id) {
	            return $admin_db->where('status', 1)
	                ->order_by('sort_order', 'asc')
	                ->order_by('id', 'asc')
	                ->get('faqs')
	                ->result();
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_faqs DB error: ' . $e->getMessage());
	    }
	    return [];
	}

	public function get_services()
	{
	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('our_services')) {
	            return $admin_db->where('status', 1)
	                ->order_by('sort_order', 'asc')
	                ->order_by('id', 'asc')
	                ->get('our_services')
	                ->result();
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_services DB error: ' . $e->getMessage());
	    }
	    return [];
	}

	public function get_about_setting()
	{
	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('about_us_settings')) {
	            return $admin_db->get('about_us_settings')->row();
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_about_setting DB error: ' . $e->getMessage());
	    }
	    return null;
	}

	public function get_why_choose_setting()
	{
	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('why_choose_us_settings')) {
	            return $admin_db->get('why_choose_us_settings')->row();
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_why_choose_setting DB error: ' . $e->getMessage());
	    }
	    return null;
	}

	public function get_why_choose_items()
	{
	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('why_choose_us_items')) {
	            return $admin_db->where('section_type', 'hero_feature')
	                ->where('status', 1)
	                ->order_by('sort_order', 'asc')
	                ->order_by('id', 'asc')
	                ->get('why_choose_us_items')
	                ->result();
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_why_choose_items DB error: ' . $e->getMessage());
	    }
	    return [];
	}

	public function get_why_choose_cards()
	{
	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('why_choose_us_items')) {
	            return $admin_db->where('section_type', 'value_card')
	                ->where('status', 1)
	                ->order_by('sort_order', 'asc')
	                ->order_by('id', 'asc')
	                ->get('why_choose_us_items')
	                ->result();
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_why_choose_cards DB error: ' . $e->getMessage());
	    }
	    return [];
	}

	public function get_quote_section()
	{
	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('home_quote_section')) {
	            $row = $admin_db->where('is_active', 1)->order_by('id', 'desc')->get('home_quote_section')->row();
	            if ($row) {
	                return $row;
	            }
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_quote_section DB error: ' . $e->getMessage());
	    }

	    return (object)[
	        'badge_text' => 'Limited Time Offer: Flat 20% OFF on Advance Booking',
	        'headline' => 'Get Your Instant Free Moving Quote',
	        'subheadline' => 'Guaranteed Best Price & 100% Safe Shifting Across Noida & Greater Noida. Trusted by 15,000+ Happy Families!',
	        'offer_tag' => 'Flat 20% OFF',
	        'feature_1_title' => 'Zero Hidden Charges',
	        'feature_1_desc' => 'Transparent all-inclusive pricing with complete breakdown upfront',
	        'feature_1_icon' => 'bi bi-shield-fill-check',
	        'feature_2_title' => 'Free Pre-Move Survey',
	        'feature_2_desc' => 'Doorstep or video survey by relocation expert at zero cost',
	        'feature_2_icon' => 'bi bi-camera-video-fill',
	        'feature_3_title' => '₹5 Lakh Transit Insurance',
	        'feature_3_desc' => 'Complete coverage for household goods against any damage',
	        'feature_3_icon' => 'bi bi-shield-lock-fill',
	        'feature_4_title' => 'GPS Live Tracking',
	        'feature_4_desc' => 'Real-time vehicle tracking directly on your mobile device',
	        'feature_4_icon' => 'bi bi-geo-alt-fill',
	        'cta_button_text' => 'Get Free Quote Now',
	        'phone_number' => '+91 7303257332',
	        'whatsapp_number' => '917303257332',
	        'is_offer_active' => 1,
	        'is_active' => 1
	    ];
	}

	public function get_calculator_data()
	{
	    $default_settings = (object)[
	        'badge_tag'       => 'Cost Guide',
	        'title'           => 'Instant Shifting Charges Calculator',
	        'disclaimer_text' => '*Approximate charges for local shifting within Noida/Greater Noida. Final quotation based on inventory volume & distance.',
	        'phone_number'    => '+91 7303257332',
	        'whatsapp_number' => '917303257332',
	        'is_active'       => 1
	    ];

	    $default_items = [
	        (object)[
	            'id'            => 1,
	            'tab_key'       => '1bhk',
	            'tab_title'     => '1 BHK / 1 Room',
	            'badge_text'    => 'Ideal for Singles & Small Setup',
	            'badge_type'    => 'success',
	            'duration_text' => '3-5 Hours Total Move Time',
	            'title'         => '1 BHK Home Shifting in Noida & Greater Noida',
	            'description'   => 'Complete packing of bedroom, living essentials, kitchen items, and standard appliances with dedicated mini-truck transport.',
	            'feature_1'     => '2-3 Professional Packers',
	            'feature_2'     => 'Dedicated Tata Ace / Pickup Truck',
	            'feature_3'     => '3-Layer Protective Packing Material',
	            'feature_4'     => 'Doorstep Loading & Unloading',
	            'price_from'    => '₹3,500',
	            'price_to'      => 'to ₹6,500*',
	            'price_prefix'  => 'Estimated Starting Rate',
	            'btn_text'      => 'Book 1 BHK Shifting',
	            'sort_order'    => 1,
	            'is_active'     => 1
	        ],
	        (object)[
	            'id'            => 2,
	            'tab_key'       => '2bhk',
	            'tab_title'     => '2 BHK Shifting',
	            'badge_text'    => 'Most Popular Choice in Noida',
	            'badge_type'    => 'danger',
	            'duration_text' => '5-7 Hours Total Move Time',
	            'title'         => '2 BHK Home Relocation Service',
	            'description'   => 'End-to-end safe shifting of 2 bedrooms, hall, kitchen, heavy furniture (beds, wardrobes, sofa, fridge, TV, washing machine).',
	            'feature_1'     => '3-4 Trained Relocation Experts',
	            'feature_2'     => '14ft Covered Weatherproof Truck',
	            'feature_3'     => '5-Layer Corrugated + Bubble Wrap',
	            'feature_4'     => 'Furniture Dismantling & Reassembly',
	            'price_from'    => '₹5,500',
	            'price_to'      => 'to ₹9,800*',
	            'price_prefix'  => 'Estimated Starting Rate',
	            'btn_text'      => 'Book 2 BHK Shifting',
	            'sort_order'    => 2,
	            'is_active'     => 1
	        ],
	        (object)[
	            'id'            => 3,
	            'tab_key'       => '3bhk',
	            'tab_title'     => '3 BHK Shifting',
	            'badge_text'    => 'Full Family Relocation',
	            'badge_type'    => 'primary',
	            'duration_text' => 'Same Day Completion',
	            'title'         => '3 BHK Household Moving in Noida & NCR',
	            'description'   => 'Complete premium packing for large homes, including delicate chinaware, multiple air conditioners, modular beds, and electronics.',
	            'feature_1'     => '4-6 Certified Packers + Supervisor',
	            'feature_2'     => '17ft/19ft Containerized Vehicle',
	            'feature_3'     => 'Premium Foam, Bubble & Edge Guards',
	            'feature_4'     => 'Full Unpacking & Basic Placement',
	            'price_from'    => '₹8,500',
	            'price_to'      => 'to ₹15,000*',
	            'price_prefix'  => 'Estimated Starting Rate',
	            'btn_text'      => 'Book 3 BHK Shifting',
	            'sort_order'    => 3,
	            'is_active'     => 1
	        ],
	        (object)[
	            'id'            => 4,
	            'tab_key'       => '4bhk',
	            'tab_title'     => '4 BHK / Villa',
	            'badge_text'    => 'Luxury & Villa Shifting',
	            'badge_type'    => 'dark',
	            'duration_text' => 'Dedicated Move Manager',
	            'title'         => '4 BHK / Penthouse / Villa Relocation',
	            'description'   => 'White-glove moving experience with customized wooden crating for artworks, chandeliers, heavy safes, and premium appliances.',
	            'feature_1'     => '6-8 Senior Handlers + Onsite Manager',
	            'feature_2'     => '22ft/24ft Multi-Axle Container',
	            'feature_3'     => 'Heavy-Duty Crating & Anti-Static Wrap',
	            'feature_4'     => '₹5 Lakh Included Transit Insurance',
	            'price_from'    => '₹14,000',
	            'price_to'      => 'to ₹24,000*',
	            'price_prefix'  => 'Estimated Starting Rate',
	            'btn_text'      => 'Book Villa Shifting',
	            'sort_order'    => 4,
	            'is_active'     => 1
	        ],
	        (object)[
	            'id'            => 5,
	            'tab_key'       => 'vehicle',
	            'tab_title'     => 'Vehicle Transport',
	            'badge_text'    => 'Car & Bike Safe Carrier',
	            'badge_type'    => 'info',
	            'duration_text' => 'Scratch-Free Guarantee',
	            'title'         => 'Vehicle Transport Service from Noida',
	            'description'   => 'Enclosed hydraulic car trailers and dedicated two-wheeler bubble-packed transport with doorstep pickup & delivery across India.',
	            'feature_1'     => 'Two-Wheeler / Bike: ₹2,200 - ₹4,500*',
	            'feature_2'     => 'Hatchback / Sedan: ₹4,500 - ₹9,500*',
	            'feature_3'     => 'SUV / Luxury Car: ₹6,500 - ₹14,000*',
	            'feature_4'     => 'GPS Tracking & Transit Insurance',
	            'price_from'    => '₹2,500',
	            'price_to'      => 'onwards*',
	            'price_prefix'  => 'Estimated Starting Rate',
	            'btn_text'      => 'Book Vehicle Transport',
	            'sort_order'    => 5,
	            'is_active'     => 1
	        ],
	    ];

	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id) {
	            $settings = $default_settings;
	            if ($admin_db->table_exists('home_calculator_settings')) {
	                $row = $admin_db->where('is_active', 1)->order_by('id', 'desc')->get('home_calculator_settings')->row();
	                if ($row) {
	                    $settings = $row;
	                }
	            }

	            $items = $default_items;
	            if ($admin_db->table_exists('home_calculator_items')) {
	                $db_items = $admin_db->where('is_active', 1)->order_by('sort_order', 'asc')->get('home_calculator_items')->result();
	                if (!empty($db_items)) {
	                    $items = $db_items;
	                }
	            }

	            return [
	                'settings' => $settings,
	                'items'    => $items
	            ];
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_calculator_data DB error: ' . $e->getMessage());
	    }

	    return [
	        'settings' => $default_settings,
	        'items'    => $default_items
	    ];
	}

	public function get_verified_movers_setting()
	{
	    $default = (object)[
	        'badge_tag'       => 'Google #1 Verified Movers',
	        'main_heading'    => 'Local Shifting Coverage Across All Sectors in Noida & Greater Noida',
	        'description'     => 'Bhandari Packers and Movers is the government registered, ISO 9001:2015 certified relocation service operating across Noida, Greater Noida, Greater Noida West (Noida Extension), and Delhi-NCR. We provide 24x7 local house shifting, office relocation, vehicle shifting, and secure warehousing services.',
	        'sector_chips'    => 'Sector 15, Sector 18, Sector 25, Sector 34, Sector 50, Sector 52, Sector 62, Sector 74, Sector 75, Sector 76, Sector 78, Sector 93, Sector 100, Sector 104, Sector 110, Sector 121, Sector 137, Sector 143, Sector 150, Noida Expressway, Gaur City 1 & 2, Pari Chowk, Alpha & Beta, Delta & Gamma, Knowledge Park, Yamuna Expressway',
	        'box_title'       => 'Why Bhandari Packers is Ranked #1 in Noida:',
	        'card_1_title'    => '15,000+ Moves',
	        'card_1_subtitle' => '14+ Years in Noida & NCR',
	        'card_1_icon'     => 'bi bi-truck',
	        'card_2_title'    => 'Zero Damage Guarantee',
	        'card_2_subtitle' => 'Multi-layer bubble packing',
	        'card_2_icon'     => 'bi bi-shield-lock-fill',
	        'card_3_title'    => 'Fixed Price Guarantee',
	        'card_3_subtitle' => 'No hidden delivery charges',
	        'card_3_icon'     => 'bi bi-cash-coin',
	        'card_4_title'    => '24x7 Customer Help',
	        'card_4_subtitle' => 'Live move tracking on call',
	        'card_4_icon'     => 'bi bi-headset',
	        'cta_text'        => 'Need an immediate shifting estimate?',
	        'cta_btn_text'    => 'Fill Form Above',
	        'is_active'       => 1
	    ];

	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('home_verified_movers_settings')) {
	            $row = $admin_db->where('is_active', 1)->order_by('id', 'desc')->get('home_verified_movers_settings')->row();
	            if ($row) {
	                return $row;
	            }
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_verified_movers_setting DB error: ' . $e->getMessage());
	    }

	    return $default;
	}

	public function get_homepage_sections()
	{
	    $defaults = [
	        'quote_form'       => 1,
	        'trust_strip'      => 1,
	        'about'            => 1,
	        'services'         => 1,
	        'shifting'         => 1,
	        'quote_showcase'   => 1,
	        'quote_calculator' => 1,
	        'verified_movers'  => 1,
	        'achievements'     => 0,
	        'badges'           => 0,
	        'customer_videos'  => 1,
	        'reviews'          => 1,
	        'faq'              => 1,
	        'contact_cta'      => 1,
	        'service_areas'    => 0,
	        'state_widget'     => 1,
	    ];

	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('homepage_sections')) {
	            $rows = $admin_db->order_by('display_order', 'asc')->get('homepage_sections')->result();
	            if (!empty($rows)) {
	                $status = [];
	                foreach ($rows as $r) {
	                    $status[$r->section_key] = (int)$r->is_active;
	                }
	                return array_merge($defaults, $status);
	            }
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::get_homepage_sections DB error: ' . $e->getMessage());
	    }

	    return $defaults;
	}

	public function message()
	{
	    
	        $this->load->library('email');
	        $this->email->set_mailtype("html");
	
	        $client_email=$_POST['requestemail'];
	        $client_phone=$_POST['requestphone'];
	        $client_message=$_POST['requestmessage'];
	
	        $message="Urgent Quotation Required !!! <br><font color='red'>Email : $client_email </font><br><br><h3>Phone Number: $client_phone</h3>Message: <b> $client_message</b>";
	
	        //clients mail
	        $admin_email="niram@gmail.com";
	        $this->email->to($client_email);
	        $this->email->from($admin_email);
	        $this->email->subject('Thanks for requesting a Quotation');
	        $this->email->message("Hi $client_email,<br> Thanks for requesting a Quotation from Niram Paint  <i>(https://www.niram.com/)</i>. We will get back to you soon.<br><br><br>Regards,<br>Niram Paint ($admin_email)<br>
	            <img src='".base_url()."assets/logo.png' height='120px'>");
	        $this->email->send();
	
	        //admin mail
	        $this->email->to($admin_email);
	        $this->email->from($client_email);
	        $this->email->subject("New Quotation Required");
	        $this->email->message($message);
	        $this->email->send();
	
	        return true;
	    }

	public function insert_quick_inquiry($data)
	{
	    try {
	        $admin_db = $this->load->database('admin_hub', TRUE);
	        if ($admin_db && $admin_db->conn_id) {
	            $data['created_at'] = date('Y-m-d H:i:s');
	            $data['updated_at'] = date('Y-m-d H:i:s');
	            return $admin_db->insert('quick_inquiries', $data);
	        }
	    } catch (\Throwable $e) {
	        log_message('error', 'Home_mdl::insert_quick_inquiry DB error: ' . $e->getMessage());
	    }

	    $data['created_at'] = date('Y-m-d H:i:s');
	    $data['updated_at'] = date('Y-m-d H:i:s');
	    return $this->db->insert('quick_inquiries', $data);
	}

}