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
        $this->load->model('home_mdl');
        $data['faqs'] = $this->home_mdl->get_faqs();
        $data['title'] = "Packers and Movers in Noida & Greater Noida | Bhandari Packers | +91 7303257332";
        $data['description'] = "Bhandari Packers and Movers — trusted home shifting, office relocation, packing, loading, and vehicle transport services in Noida and Greater Noida. Govt. registered, ISO 9001:2015 certified. Call +91 7303257332 for a free quote.";
        $data['keywords'] = "Packers and Movers Noida, Home Shifting Noida, Greater Noida Packers Movers, House Shifting Noida, Bhandari Packers and Movers, Office Relocation Noida, Local Shifting Noida";
        $data['module'] = "home";
        $data['view_file'] = "home";
        echo Modules::run('template/layout1', $data);
    }

    public function oldurl_to_newurl()
    {
        $redirects = [
            'privacy-policy' => 'privacy',
            'common-home-shifting-problems-how-to-solve-them' => 'home-relocation',
            'tag/bhandari-packers-and-movers' => 'about',
            //category/blog-post/
            'request-estimate' => 'contacts',
            'terms-and-conditions' => 'term-and-condition',


            'household-shifting-services-in-noida' => 'home-relocation',
            'house-shifting-services-in-noida' => 'home-relocation',
            'house-shifting-services-in-greater-noida' => 'home-relocation',
            'house-shifting-services-in-gaur-city-2' => 'home-relocation',
            'expert-house-shifting-services-in-noida-your-ultimate-guide-to-a-stress-free-move' => 'home-relocation',
            'expert-household-shifting-in-noida-your-ultimate-guide-to-a-smooth-move' => 'home-relocation',
            'packers-movers-in-noida' => 'noida-packers-movers-uttar-pradesh',
            'packers-movers-in-noida-sector-137' => 'sector-137-noida-packers-movers-uttar-pradesh',
            'the-ultimate-guide-to-local-shifting-in-noida-tips-for-a-hassle-free-move' => 'noida-packers-movers-uttar-pradesh',
            'tag/packers-and-movers-in-delhi' => 'delhi-packers-movers-delhi',
            'packers-and-movers-in-greater-noida' => 'greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-sector-11-and-12-greater-noida' => 'greater-noida-packers-movers-uttar-pradesh',
            'tag/packers-and-movers-in-indrapuram-ghaziabad' => 'ghaziabad-packers-movers-uttar-pradesh',
            'packers-and-movers-in-crossing-republik' => 'ghaziabad-packers-movers-uttar-pradesh',
            'packers-movers-in-vasant-kunj' => 'vasant-kunj-packers-movers-delhi',
            'tag/packers-and-movers-in-vasant-kunj' => 'vasant-kunj-packers-movers-delhi',
            'packers-and-movers-in-sector-34-greater-noida' => 'sector-34-grater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-greater-noida-west' => 'greater-noida-west-packers-movers-uttar-pradesh',
            'packers-and-movers-in-beta-2-greater-noida' => 'beta-2-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-beta-1-greater-noida' => 'beta-1-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-pari-chowk-greater-noida' => 'pari-chowk-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-jewar-town-area-greater-noida' => 'jewar-town-area-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-gamma-1-2-greater-noida' => 'gamma-1-2-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-gaur-city-1-greater-noida' => 'gaur-city-1-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-zeta-1-and-2-greater-noida' => 'zeta-1-and-2-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-omicron-1-2-3-greater-noida' => 'omicron-1-2-3-greater-noida-packers-movers-uttar-pradesh',
            'packers-and-movers-in-delta-1-2-3-4-greater-noida' => 'delta-1-2-3-4-greater-noida-packers-movers-uttar-pradesh',
            'moving-to-vasundhara-ghaziabad-heres-why-you-should-choose-bhandari-packers-and-movers' => 'ghaziabad-packers-movers-uttar-pradesh',
            '3bhk-moving-service-cost-in-noida' => 'noida-packers-movers-uttar-pradesh',

            //'packers-and-movers-noida-to-lucknow'=>'',
        ];

        $uri = parse_url($this->uri->uri_string(), PHP_URL_PATH);

        if (isset($redirects[$uri])) {
            redirect(base_url($redirects[$uri]), 'location', 301);
            exit();
        }
    }
}
