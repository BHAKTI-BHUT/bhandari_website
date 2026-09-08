<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_contact');
    }
    function index()
    {
        $this->load->view('data');
    }
    function booking()
    {
    	$this->load->view('booking');
    }

    function view_data()
    {
    	$where=null;
    	if (isset($_GET['id']))
    		$where['id']=$_GET['id'];
    		
    		if (isset($_GET['met']))
    			$where['message']=$_GET['met'];
    			
    			if (isset($_GET['data']))
    				$select=$_GET['data'];
    				else $select="*";
    				
    				$return=$this->mdl_contact->view_data($where,$select);
    				$this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    function view_booking()
    {
        $where=null;
        if (isset($_GET['id']))
	         $where['id']=$_GET['id'];
        
        if (isset($_GET['data']))
	        $select=$_GET['data'];
	    else $select="*";
	    
	    $return=$this->mdl_contact->view_book($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id'])
        {
            $where['id']=$_GET['id'];
            $object=json_encode($this->mdl_contact->view_data($where,"*")->result());
            $data_title= "Booking Delete";
            
            $this->load->module("logs");
            if ($this->logs->add_data($data_title,$object)) {
                echo $this->mdl_contact->delete_data($where);
            }
        }
    }
}
?>