<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Home extends MX_Controller
{
    function error()
    {
        $this->oldurl_to_newurl();

        $segment1 = strtolower($this->uri->segment(1));
        if (!empty($segment1)) {
            try {
                $admin_db = $this->load->database('admin_hub', TRUE);
                if ($admin_db && $admin_db->conn_id) {
                    $branchState = $admin_db->where('slug', $segment1)->get('branch_states')->row();
                    if ($branchState) {
                        $this->load->module('packers_movers');
                        $this->packers_movers->state_services($segment1);
                        return;
                    }
                }
            } catch (\Throwable $e) {
                // Continue to 404 error page
            }
        }

        if (!headers_sent()) {
            header("HTTP/1.1 404 Not Found");
        }
        $this->output->set_status_header('404');
        $data['title'] = "Page Not Found - Error 404";
        $data['description'] = "The page you requested could not be found.";
        $data['noindex'] = true;
        $data['module'] = "home";
        $data['view_file'] = "error";
        echo Modules::run('template/layout2', $data);
    }
    function index()
    {
        // 1. Redirect /home to root / (301) except for API methods
        $seg1 = strtolower($this->uri->segment(1) ?? '');
        $seg2 = strtolower($this->uri->segment(2) ?? '');
        if ($seg1 === 'home' && $seg2 !== 'submit_quick_inquiry') {
            redirect(base_url(), 'location', 301);
            exit();
        }

        // 2. Redirect WordPress ?page_id=... to clean root / (301)
        if (isset($_GET['page_id']) || !empty($this->input->get('page_id'))) {
            redirect(base_url(), 'location', 301);
            exit();
        }

        $this->load->model('home_mdl');
        $data['faqs'] = $this->home_mdl->get_faqs();
        $data['services'] = $this->home_mdl->get_services();
        $data['about_setting'] = $this->home_mdl->get_about_setting();
        $data['why_choose_setting'] = $this->home_mdl->get_why_choose_setting();
        $data['why_choose_items'] = $this->home_mdl->get_why_choose_items();
        $data['why_choose_cards'] = $this->home_mdl->get_why_choose_cards();
        $data['quote_section'] = $this->home_mdl->get_quote_section();
        $data['calculator_data'] = $this->home_mdl->get_calculator_data();
        $data['verified_movers_setting'] = $this->home_mdl->get_verified_movers_setting();
        $data['homepage_sections'] = $this->home_mdl->get_homepage_sections();

        $data['title'] = "Packers and Movers in Noida & Greater Noida | Bhandari Packers | +91 7303257332";
        $data['description'] = "Bhandari Packers and Movers — trusted home shifting, office relocation, packing, loading, and vehicle transport services in Noida and Greater Noida. Govt. registered, ISO 9001:2015 certified. Call +91 7303257332 for a free quote.";
        $data['keywords'] = "Packers and Movers Noida, Home Shifting Noida, Greater Noida Packers Movers, House Shifting Noida, Bhandari Packers and Movers, Office Relocation Noida, Local Shifting Noida";
        $data['module'] = "home";
        $data['view_file'] = "home";
        echo Modules::run('template/layout1', $data);
    }

    public function oldurl_to_newurl()
    {
        // ─── Exact 301 Redirect Map ────────────────────────────────────────────────
        $redirects = [
            // Privacy / Terms
            'privacy-policy'                       => 'privacy',
            'terms-and-conditions'                 => 'term-and-condition',
            'our-insurance-terms-and-conditions'   => 'goods-insurance',

            // About variants
            'about-bhandari-packers-and-movers'    => 'about',
            'about-us'                             => 'about',
            'tag/bhandari-packers-and-movers'      => 'about',

            // WP / legacy junk pages → homepage
            'page'                                 => '',
            'page/'                                => '',
            'index.html'                           => '',

            // Contacts / Booking
            'request-estimate'                     => 'contacts',
            'contacts/booking'                     => 'contacts',

            // Blog / articles (old WP posts → blogs)
            'our-blogs'                                                                             => 'blogs',
            'blog-posts'                                                                            => 'blogs',
            'top-5-questions-before-hiring-movers'                                                  => 'blogs',
            'top-5-questions-before-hiring-movers/feed'                                             => 'blogs',
            'top-5-packers-and-movers-companies-making-waves-in-india'                              => 'blogs',
            'prepare-for-a-smooth-move'                                                             => 'blogs',
            '5-essential-tips-for-a-stress-free-move-insights-from-bhandari-packers-and-movers'    => 'blogs',
            'essential-tips-for-moving-window-ac-and-split-ac-during-home-shifting'                 => 'blogs',
            'essential-guide-for-choosing-packers-and-movers-in-noida'                              => 'blogs',
            'relocation-made-easy-why-bhandari-packers-and-movers-are-the-best-choice-in-greater-noida' => 'blogs',
            'common-home-shifting-problems-how-to-solve-them'                                       => 'blogs',

            // Home Relocation variants
            'home-relocation-services-in-noida'    => 'home-relocation',
            'home-shifting-services-noida'         => 'home-relocation',
            'household-shifting-services-in-noida' => 'home-relocation',
            'house-shifting-services-in-noida'     => 'home-relocation',
            'house-shifting-services-in-greater-noida' => 'home-relocation',
            'house-shifting-services-in-gaur-city-2' => 'home-relocation',
            'expert-house-shifting-services-in-noida-your-ultimate-guide-to-a-stress-free-move' => 'home-relocation',
            'expert-household-shifting-in-noida-your-ultimate-guide-to-a-smooth-move' => 'home-relocation',

            // Moving cost articles → Noida page
            '1bhk-moving-service-cost-in-noida'               => 'noida-packers-movers-uttar-pradesh',
            '3bhk-moving-service-cost-in-noida'               => 'noida-packers-movers-uttar-pradesh',
            '4bhk-moving-service-cost-in-noida'               => 'noida-packers-movers-uttar-pradesh',
            '4bhk-moving-services-cost-with-bhandari-packers-movers' => 'noida-packers-movers-uttar-pradesh',
            'noida-to-noida-within-20km-1-bhk-with-tata-ace'  => 'noida-packers-movers-uttar-pradesh',
            'packers-movers-in-noida'                          => 'noida-packers-movers-uttar-pradesh',
            'packers-movers-in-noida-sector-137'               => 'sector-137-noida-packers-movers-uttar-pradesh',
            'the-ultimate-guide-to-local-shifting-in-noida-tips-for-a-hassle-free-move' => 'noida-packers-movers-uttar-pradesh',

            // Old "packers-movers-in-{city}" format URLs (WP era)
            'packers-movers-in-ghaziabad'                      => 'ghaziabad-packers-movers-uttar-pradesh',
            'packers-movers-in-delhi'                          => 'delhi-packers-movers-delhi',
            'packers-movers-in-gurugram'                       => 'gurgaon',
            'packers-movers-in-gurgaon'                        => 'gurgaon',
            'packers-movers-in-greater-noida'                  => 'greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-ghaziabad'                  => 'ghaziabad-packers-movers-uttar-pradesh',

            // Greater Noida
            'packers-and-movers-in-greater-noida'              => 'greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-sector-11-and-12-greater-noida' => 'greater-noida-packers-movers-uttar-pradesh',
            'tag/packers-and-movers-in-greater-noida'          => 'greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-greater-noida-west'         => 'greater-noida-west-packers-movers-uttar-pradesh',
            'packers-and-movers-in-beta-2-greater-noida'       => 'beta-2-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-beta-1-greater-noida'       => 'beta-1-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-pari-chowk-greater-noida'   => 'pari-chowk-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-jewar-town-area-greater-noida' => 'jewar-town-area-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-gamma-1-2-greater-noida'    => 'gamma-1-2-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-gaur-city-1-greater-noida'  => 'gaur-city-1-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-zeta-1-and-2-greater-noida' => 'zeta-1-and-2-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-omicron-1-2-3-greater-noida' => 'omicron-1-2-3-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-delta-1-2-3-4-greater-noida' => 'delta-1-2-3-4-greater-noida-packers-movers-uttar-pradesh',

            // Ghaziabad / Delhi
            'tag/packers-and-movers-in-indrapuram-ghaziabad'   => 'ghaziabad-packers-movers-uttar-pradesh',
            'tag/packers-and-movers-in-ghaziabad'              => 'ghaziabad-packers-movers-uttar-pradesh',
            'packers-and-movers-in-crossing-republik'          => 'ghaziabad-packers-movers-uttar-pradesh',
            'moving-to-vasundhara-ghaziabad-heres-why-you-should-choose-bhandari-packers-and-movers' => 'ghaziabad-packers-movers-uttar-pradesh',
            'tag/packers-and-movers-in-delhi'                  => 'delhi-packers-movers-delhi',
            'tag/packers-and-movers-in-sector-34-greater-noida' => 'sector-34-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-sector-34-greater-noida'    => 'sector-34-greater-noida-packers-movers-uttar-pradesh',

            // Vaishali
            'tag/movers-and-packers-in-vaishali'               => 'ghaziabad-packers-movers-uttar-pradesh',

            // Vasant Kunj
            'packers-movers-in-vasant-kunj'                    => 'vasant-kunj-packers-movers-delhi',
            'tag/packers-and-movers-in-vasant-kunj'            => 'vasant-kunj-packers-movers-delhi',

            // Branches / other cities
            'packers-and-movers-in-faridabad'                  => 'our-branches',
            'packers-and-movers-in-gurugram'                   => 'gurgaon',
            'packers-and-movers-in-gurgaon'                    => 'gurgaon',

            // Tags / Category → blogs
            'tag/moving-tips'                                  => 'blogs',
            'category/uncategorized'                           => 'blogs',
        ];

        // Build the URI to check (use actual REQUEST_URI for accuracy)
        $request_path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
        $clean_path   = trim($request_path ?? '', '/');
        $ci_uri       = trim($this->uri->uri_string(), '/');

        // Check both CI uri and raw request path (they can differ)
        $check_uris = array_unique(array_filter([$clean_path, $ci_uri]));

        foreach ($check_uris as $uri) {

            // 1. Exact match
            if (isset($redirects[$uri])) {
                redirect(base_url($redirects[$uri]), 'location', 301);
                exit();
            }

            // 2. WordPress admin/core/plugin URLs → homepage
            if (preg_match('#^(wp-admin|wp-includes|wp-json|wp-content|wp-login|xmlrpc)#i', $uri)) {
                redirect(base_url(), 'location', 301);
                exit();
            }

            // 3. Old WordPress tag/category archives → blogs
            if (preg_match('#^(tag|category)/#i', $uri)) {
                redirect(base_url('blogs'), 'location', 301);
                exit();
            }

            // 4. RSS feeds → blogs
            if (substr($uri, -5) === '/feed' || substr($uri, -5) === '/feed/') {
                redirect(base_url('blogs'), 'location', 301);
                exit();
            }

            // 5. Furniture exchange / YourURL junk
            if (stripos($uri, 'YourURL') !== false || stripos($uri, 'yoururl') !== false || stripos($uri, 'furniture-exchange') !== false) {
                redirect(base_url('home-relocation'), 'location', 301);
                exit();
            }

            // 6. Moving cost/service articles → Noida page
            if (preg_match('#(moving-service|moving-services|service-cost|bhk-moving)#i', $uri)) {
                redirect(base_url('noida-packers-movers-uttar-pradesh'), 'location', 301);
                exit();
            }

            // 7. Home relocation / shifting keywords → home-relocation
            if (preg_match('#(home-relocation|home-shifting|house-shifting|household-shifting)#i', $uri)) {
                redirect(base_url('home-relocation'), 'location', 301);
                exit();
            }

            // 8. Faridabad → branches
            if (stripos($uri, 'faridabad') !== false) {
                redirect(base_url('our-branches'), 'location', 301);
                exit();
            }

            // 9. Gurugram / Gurgaon → gurgaon page
            if (stripos($uri, 'gurugram') !== false || stripos($uri, 'gurgaon') !== false) {
                redirect(base_url('gurgaon'), 'location', 301);
                exit();
            }

            // 10. Old blog post slugs (any long article-looking URL not matched above) → blogs
            if (preg_match('#^(top-|essential-|prepare-|relocation-|5-essential|common-home|our-blogs|blog-posts)#i', $uri)) {
                redirect(base_url('blogs'), 'location', 301);
                exit();
            }
        }
    }

    public function submit_quick_inquiry()
    {
        header('Content-Type: application/json');

        $phone = trim($this->input->post('phone', true));
        $service_type = trim($this->input->post('service_type', true));
        $source_page = trim($this->input->post('source_page', true));

        if (empty($phone) || strlen(preg_replace('/[^0-9]/', '', $phone)) < 10) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Please enter a valid 10-digit phone number.'
            ]);
            return;
        }

        $clean_phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($clean_phone) > 10) {
            $clean_phone = substr($clean_phone, -10);
        }

        $data = [
            'phone'        => $clean_phone,
            'service_type' => !empty($service_type) ? $service_type : 'Instant Shifting Quote',
            'source_page'  => !empty($source_page) ? $source_page : 'Homepage Calculator',
            'status'       => 'pending'
        ];

        $inserted = $this->home_mdl->insert_quick_inquiry($data);

        if ($inserted) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Thank you! Our relocation manager will call you back on +91 ' . $clean_phone . ' within 5 minutes.'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Failed to record inquiry. Please call us directly.'
            ]);
        }
    }
}
