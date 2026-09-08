<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Packers_movers extends MX_Controller
{
    function index()
    {
        $this->state();
    }

    function state()
    {
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id) {
                $data['branch_states'] = $admin_db->where('status', 1)
                    ->order_by('sort_order', 'asc')
                    ->get('branch_states')->result();
            }
        } catch (\Exception $e) {
            log_message('error', 'Packers_movers state DB error: ' . $e->getMessage());
        }

        $data['title'] = "All India Service " . $this->comp['company3'];
        $data['description'] = $this->comp['company3'] . " is best packers and movers service provider.";
        $data['module'] = "packers_movers";
        $data['view_file'] = "states";
        echo Modules::run('template/layout2', $data);
    }

    function state_services($state)
    {
        $this->load->module('home');
        $this->home->oldurl_to_newurl();
        $this->load->helper('text');

        $state_slug = strtolower(str_replace(" ", "-", $state));
        $formatted_state = str_replace("_", " ", ucwords($state));

        $cities_list = array();
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id) {
                $branch_state = $admin_db->where('slug', $state_slug)->get('branch_states')->row();
                if ($branch_state) {
                    $formatted_state = $branch_state->name;
                    $db_cities = $admin_db->where('branch_state_id', $branch_state->id)
                        ->where('status', 1)
                        ->order_by('sort_order', 'asc')
                        ->get('branch_cities')->result();
                    foreach ($db_cities as $c) {
                        $cities_list[] = array(
                            'nm' => $c->name,
                            'slug' => $c->slug,
                            'lat' => $c->latitude,
                            'lon' => $c->longitude,
                            'sc' => $c->state_code
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Packers_movers state_services DB error: ' . $e->getMessage());
        }

        $data = array(
            "state" => $formatted_state,
            "state_slug" => $state_slug,
            "cities" => $cities_list,
            "title" => $this->comp['company3'] . " in $formatted_state",
            "description" => $this->comp['company3'] . " in $formatted_state",
            "keywords" => "$formatted_state " . $this->comp['company3'] . " in $formatted_state",
            "module" => "packers_movers",
            "view_file" => "city_list",
        );
        echo Modules::run('template/layout2', $data);
    }

    function get_title($city, $state)
    {
        return array(
            'title' => "Best packers and movers in $city | Call Now 7303257332",
            "desc" => "Bhandari Packers and Movers offers reliable packing and moving services in $city. We ensure safe home shifting, office relocation, and vehicle transport with on-time delivery."
        );
    }

    function city($state = 'Bihar', $city = 'Patna')
    {
        $this->load->helper('text');
        $state_clean = str_replace("_", " ", $state);
        $state_clean = ucwords(str_replace("-", " ", $state_clean));
        $city_clean = str_replace("_", " ", $city);
        $city_clean = urldecode(ucwords(str_replace("-", " ", $city_clean)));

        $city_slug = strtolower(str_replace(" ", "-", $city_clean));
        $lat = '';
        $lon = '';
        $custom_content = '';

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id) {
                $c = $admin_db->where('slug', $city_slug)->or_where('name', $city_clean)->get('branch_cities')->row();
                if ($c) {
                    $lat = $c->latitude;
                    $lon = $c->longitude;
                    $custom_content = $c->custom_content;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Packers_movers city DB error: ' . $e->getMessage());
        }

        $this->load->model('home/home_mdl');
        $faqs = $this->home_mdl->get_faqs();

        $seo = $this->get_title($city_clean, $state_clean);
        $data = array(
            "city" => $city_clean,
            "state" => $state_clean,
            "lat" => $lat,
            "lon" => $lon,
            "custom_content" => $custom_content,
            "faqs" => $faqs,
            'img' => base_url('assets') . "/images/logo/logo.jpg",
            "title" => $seo['title'],
            "description" => $seo['desc'],
            "keywords" => "movers and packers in $city_clean, Movers Packers $city_clean, Packers and movers in $city_clean",
            "module" => "packers_movers",
            "view_file" => "view_service",
        );
        echo Modules::run('template/layout2', $data);
    }

    function from_to($from = '', $to = '')
    {
        if (@$from && @$to) {
            $from = str_replace("_", " ", $from);
            $from = ucwords(str_replace("-", " ", $from));
            $data['from'] = $from;
            $data['to'] = $to;
            $data['city'] = ucwords($from);
            $data['title'] = "Packers and Movers from "  . ucwords($from) . " to " . ucwords($to) . ", Call Now 7303257332";
            $data['company'] = "Bhandari Packers and Movers";
            $data['description'] = "Best packers and movers services from $from to $to, offering safe packing, reliable handling, and on-time delivery for every relocation need.";
            $data['img'] = base_url('assets') . "/images/logo/logo.jpg";
            $data['module'] = "packers_movers";
            $data['view_file'] = "from_city_to_city";
            echo Modules::run('template/layout2', $data);
        } else {
            redirect("home/error");
        }
    }
}
