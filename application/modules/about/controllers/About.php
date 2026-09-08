<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class About extends MX_Controller
{

  function index()
{
    try {
        $admin_db = $this->load->database('admin_hub', TRUE);
        if ($admin_db && $admin_db->conn_id) {
            $data['page_setting'] = $admin_db->get('about_us_settings')->row();
        }
    } catch (\Exception $e) {
        log_message('error', 'About index DB load error: ' . $e->getMessage());
    }

    $data['title'] = "About Us";
    $data['description'] = "Bhandari Packers and Movers is a leading relocation company offering safe, reliable, and affordable packing and moving services across India. Learn more about our mission and values.";
    $data['module'] = "about";
    $data['view_file'] = "about";
    echo Modules::run('template/layout2', $data);
}

function choose()
{
    try {
        $admin_db = $this->load->database('admin_hub', TRUE);
        if ($admin_db && $admin_db->conn_id) {
            $data['page_setting'] = $admin_db->get('why_choose_us_settings')->row();
            $data['hero_features'] = $admin_db->where('section_type', 'hero_feature')
                ->where('status', 1)
                ->order_by('sort_order', 'asc')
                ->get('why_choose_us_items')->result();
            $data['value_cards'] = $admin_db->where('section_type', 'value_card')
                ->where('status', 1)
                ->order_by('sort_order', 'asc')
                ->get('why_choose_us_items')->result();
        }
    } catch (\Exception $e) {
        log_message('error', 'About choose DB load error: ' . $e->getMessage());
    }

    $data['title'] = (isset($data['page_setting']) && !empty($data['page_setting']->title)) ? $data['page_setting']->title : "Why Choose Us";
    $data['description'] = "Choose Bhandari Packers and Movers for expert relocation solutions. We ensure secure transportation, timely delivery, and customer satisfaction with every move.";
    $data['module'] = "about";
    $data['view_file'] = "choose";
    echo Modules::run('template/layout2', $data);
}

function testimonials()
{
    $data['title'] = "Client Testimonials";
    $data['description'] = "See what our customers say about Bhandari Packers and Movers. Read genuine reviews and testimonials about our professional relocation and moving services.";
    $data['module'] = "about";
    $data['view_file'] = "testimonial";
    echo Modules::run('template/layout2', $data);
}

function privacy()
{
    $data['title'] = "Privacy policy";
    $data['description'] = "Privacy policy of bhandari packers and movers.";
    $data['module'] = "about";
    $data['view_file'] = "privacy";
    echo Modules::run('template/layout2', $data);
}
function tips_and_suggestion()
{
    $data['title']       = "Moving Tips & Suggestions - Bhandari Packers and Movers";
    $data['description'] = "Get expert moving tips, packing suggestions, and relocation checklists from Bhandari Packers and Movers to ensure a safe and stress-free move.";
    $data['module']      = "about";
    $data['view_file']   = "tips-and-suggestion";

    $moving_tips = [];
    try {
        $admin_db = $this->load->database('admin_hub', TRUE);
        if ($admin_db && $admin_db->conn_id) {
            $query = $admin_db->select('id, category, type, title, content, icon_class, sort_order')
                              ->where('status', 1)
                              ->order_by('sort_order', 'ASC')
                              ->order_by('id', 'ASC')
                              ->get('moving_tips');
            if ($query && $query->num_rows() > 0) {
                $moving_tips = $query->result_array();
            }
        }
    } catch (Exception $e) {
        log_message('error', 'Moving Tips DB fetch error: ' . $e->getMessage());
    }

    $data['moving_tips'] = $moving_tips;
    echo Modules::run('template/layout2', $data);
}
function termCondition()
{
    $data['title'] = "Terms and Conditions";
    $data['description'] = "Terms and Conditions of bhandari packers and movers.";
    $data['module'] = "about";
    $data['view_file'] = "term_condition";
    echo Modules::run('template/layout2', $data);
}
function faq()
{
    $this->load->model('home/home_mdl');
    $data['faqs'] = $this->home_mdl->get_faqs();
    $data['title'] = "Frequently Asked Questions";
    $data['description'] = "FAQ's of bhandari packers and movers.";
    $data['module'] = "about";
    $data['view_file'] = "faq";
    echo Modules::run('template/layout2', $data);
}
    function cancellation_refund()
    {
        $data['title'] = "Cancellation & Refund Policy";
        $data['description'] = "Cancellation and Refund Policy of Bhandari Packers and Movers.";
        $data['module'] = "about";
        $data['view_file'] = "cancellation_refund";
        echo Modules::run('template/layout2', $data);
    }
}

