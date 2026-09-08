<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Offers extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_offers');
    }
    function index()
    {
        $this->load->view('form');
    }
    function save_data()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("title","offers Title","required|trim");
        $this->form_validation->set_rules("date","Publishing Date","required|trim");
        $this->form_validation->set_rules("end_date","offers Date","required|trim");
        $this->form_validation->set_rules("details","Description","trim");

        if ($this->form_validation->run()==TRUE)
        {
            $data['title']=$_POST['title'];
            $data['date']=$_POST['date'];
            $data['code']=$_POST['code'];
            $data['end_date']=$_POST['end_date'];
            $data['details']=$_POST['details'];

            if (!empty($_FILES['image']['name'])) {
                $data['image']=$this->image_upload($data['title']);
                if ($_POST['old_image'])
                    $this->remove_image($_POST['old_image']);
            }
            if (isset($_POST['id']) && $_POST['id'])//update
            {
                $where['id']=$_POST['id'];
                echo $this->mdl_offers->update_data($where,$data);
            }
            else //add
            {
//             	print_r($data);die();
                echo $this->mdl_offers->add_data($data);
            }
        }
        else
            echo validation_errors();
    }

    function view_data()
    {
        $where=null;
        if (isset($_GET['id']))
            $where['id']=$_GET['id'];

            if(isset($_GET['data']))
                $select=$_GET['data'];

            else $select="*";

        $return=$this->mdl_offers->view_data($where,$select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id'])
        {
            $where['id']=$_GET['id'];
            $object=json_encode($this->mdl_offers->view_data($where,"*")->result());
            $data_title= "offers  Deleted Successfully";

            $this->load->module("logs");
            if ($this->logs->add_data($data_title,$object)) {
                echo $this->mdl_offers->delete_data($where);
            }
        }
    }


    function image_upload($name)
    {
        $folder="offers";
        // upload coder starts here
        $config['upload_path'] = './assets/temp';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
//         $config['new_image'] = "./assets/website/uploads/$folder/";
        $config['min_width']=100;

        $rand_number = mt_rand(0, 805);
        $timestamp = time();
        $name = str_replace(" ", "_", $name);
        $config['file_name'] = $name . "_" . $rand_number . $timestamp;

        $config['overwrite'] = false;
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);
        if (! $this->upload->do_upload('image'))
        {
            echo $this->upload->display_errors();
            die();
        }
        else
        {
            $image = $this->upload->data();
//             print_r($image);die();
            if ($this->input->post('width'))
            {
                $config['width'] = $this->input->post('width');
            }else{
                if ($image['image_width']>720)
                    $config['width'] =720;
            }
//      image manipulation resizing 1
            $config['source_image'] = './assets/temp/' . $image['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['new_image'] = "./assets/uploads/$folder/";

            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);

            if (! $this->image_lib->resize())
            {
                echo $this->image_lib->display_errors();die();
            }

            $this->image_lib->clear();
            // image manipulation resizing 2
            $config['source_image'] = './assets/temp/' . $image['file_name'];
            $config['new_image'] = "./assets/uploads/$folder/thumb/";
            $config['file_name'] = $name . "_" . $rand_number . $timestamp;
            $config['maintain_ratio'] = TRUE;
            if ($image['image_width']>100){
                $config['width'] = 100;
            }
            $config['overwrite'] = FALSE;
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            if (! $this->image_lib->resize())
            {
                echo $this->image_lib->display_errors();die();
            }
            else
            {
                unlink($config['source_image']);
                return $image['file_name'];
            }
        }
    }

    function remove_image($name)
    {
        if (substr($name, 0,4)!="http"){
            $path1="./assets/uploads/offers/".$name;
            unlink($path1);
            $path2="./assets/uploads/offers/thumb/".$name;
            unlink($path2);
        }
    }
}
?>