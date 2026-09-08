<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends MX_Controller
{
    public function index()
    {
        $data['title'] = "Professional Shifting & Relocation Services";
        $data['description'] = "Explore our premium, IBA recognized packing, moving, storage, and cargo shifting services by Bhandari Packers and Movers.";
        $data['module'] = "services";
        $data['view_file'] = "index";

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('our_services')) {
                $data['services'] = $admin_db->where('status', 1)->order_by('sort_order', 'asc')->get('our_services')->result();
            } else {
                $data['services'] = [];
            }
        } catch (Exception $e) {
            $data['services'] = [];
            log_message('error', 'Services list fetch error: ' . $e->getMessage());
        }

        echo Modules::run('template/layout2', $data);
    }

    public function detail($slug)
    {
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('our_services')) {
                $service = $admin_db->where('slug', $slug)->where('status', 1)->get('our_services')->row();
                if ($service) {
                    $data['title'] = $service->service_name . " Services";
                    $data['description'] = $service->short_description;
                    $data['service'] = $service;
                    $data['module'] = "services";
                    $data['view_file'] = "detail";
                    echo Modules::run('template/layout2', $data);
                    return;
                }
            }
        } catch (Exception $e) {
            log_message('error', 'Service detail fetch error: ' . $e->getMessage());
        }

        // Show 404 if not found
        show_404();
    }
}