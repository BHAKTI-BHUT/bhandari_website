<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ship_tracking extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_ship_tracking');
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
        $this->form_validation->set_rules("sh_id","Shipment ID","required|trim");
        $this->form_validation->set_rules("type","Shipment Type","trim");
        $this->form_validation->set_rules("date","Date","trim");
        $this->form_validation->set_rules("time","Time","trim");
        $this->form_validation->set_rules("place","Place","trim");
        $this->form_validation->set_rules("remarks","Remarks","trim"); 
        
        if ($this->form_validation->run()==TRUE)
        {
            $data['sh_id']=ucfirst($_POST['sh_id']);
            $data['type']=$_POST['type'];
            $data['date']=$_POST['date'];
            $data['time']=$_POST['time'];
            $data['place']=Ucfirst($_POST['place']);
             $data['remarks']=$_POST['remarks'];
            // print_r($data);die();

          
            if (isset($_POST['id']) && $_POST['id'])//update
            {
                $where['id']=$_POST['id'];
                echo $this->mdl_ship_tracking->update_data($where,$data);
            }
            else //add
            {
                echo $this->mdl_ship_tracking->add_data($data);
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
        
        // if (isset($_GET['data']))
	    //     $select=$_GET['data'];
	    // else $select="*";
		$this->db->join("ship_main","ship_main.id=ship_tracking.sh_id","left");
	   
		$return=$this->mdl_ship_tracking->view_data($where,"ship_tracking.*,c_name,ship_main.id as s_id,vendor_no,driver_no,gr_no");
        // $return=$this->mdl_ship_tracking->view_data($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    
    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id'])
        {        
            $this->db->where('id', $_GET['id']);      
            $where['id']=$_GET['id'];
            echo $this->mdl_ship_tracking->delete_data($where);
        }else echo "Not Deleted";
    }        
}
