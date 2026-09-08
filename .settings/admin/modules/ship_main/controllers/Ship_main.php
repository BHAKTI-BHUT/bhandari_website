<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ship_main extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_ship_main');
    }
   
    function index()
    {
        $this->load->view('form');
    }
    
    function save_data()
    {
//         print_r($_FILES); die();
//         echo "swdsds";die();
        $this->load->library('form_validation');
        $this->form_validation->set_rules("gr_no","G.R. No.","required|trim");
        $this->form_validation->set_rules("c_name","Customer Name","trim");
        $this->form_validation->set_rules("ship_from","Shipment From","trim");
        $this->form_validation->set_rules("ship_to","Shipment To","trim");
        $this->form_validation->set_rules("driver_no","Driver No.","trim");
        $this->form_validation->set_rules("vendor_no","Vendor No ","trim");
        $this->form_validation->set_rules("date","Date","trim");
        
        if ($this->form_validation->run()==TRUE)
        {
            $data['gr_no']=ucfirst($_POST['gr_no']);
            $data['c_name']=$_POST['c_name'];
            $data['ship_from']=$_POST['ship_from'];
            $data['ship_to']=$_POST['ship_to'];
            $data['driver_no']=$_POST['driver_no'];
            $data['vendor_no']=$_POST['vendor_no'];
            $data['date']=Ucfirst($_POST['date']);
            // print_r($data);die();

          

            
            if (isset($_POST['id']) && $_POST['id'])//update
            {
                $where['id']=$_POST['id'];
                echo $this->mdl_ship_main->update_data($where,$data);
            }
            else //add
            {
                echo $this->mdl_ship_main->add_data($data);
            }
        }
        else
        {
            echo validation_errors();
        }
    }
    
    function view_data()
    {
        $where=null;
        if (isset($_GET['id']))
	         $where['id']=$_GET['id'];
        
        if (isset($_GET['data']))
	        $select=$_GET['data'];
	    else $select="*";
	    
        $return=$this->mdl_ship_main->view_data($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    
    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id'])
        {
            
            $this->db->where('id', $_GET['id']);
            $where['id']=$_GET['id'];
            echo $this->mdl_ship_main->delete_data($where);
        }else echo "Not Deleted";
    }        
}
?>