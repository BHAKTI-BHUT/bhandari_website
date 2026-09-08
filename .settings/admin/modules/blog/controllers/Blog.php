<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Blog extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_blog');
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
        $this->form_validation->set_rules("category", "Category", "required|trim");
        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_rules("url", "URL", "required|trim|alpha_numeric_spaces");
        $this->form_validation->set_rules("description", "Description", "required|trim");
        $this->form_validation->set_rules("blogDetails", "Blog Details", "required|trim");
        $this->form_validation->set_rules("date", "Date", "required|trim");
        $this->form_validation->set_rules("time", "Time", "required|trim");
        $this->form_validation->set_rules("author", "Author", "trim");
        $this->form_validation->set_rules("tags", "Tags", "trim");

        if ($this->form_validation->run() == TRUE) {
            $data['category'] = $_POST['category'];
            $data['title'] = $_POST['title'];
            $data['description'] = $_POST['description'];
            $data['blogDetails'] = $_POST['blogDetails'];
            $data['author'] = $_POST['author'];
            $data['date'] = $_POST['date'];
            $data['time'] = $_POST['time'];
            $data['tags'] = $_POST['tags'];
            $data['url'] = str_replace(' ', '-', strtolower($_POST['url']));


            if (!empty($_FILES['image']['name'])) {
                // $data['url_type']=0;
                $data['image'] = $this->image_upload($data['title']);
                if ($_POST['old_image']) {
                    $this->remove_image($_POST['old_image']);
                }
            } else if ($this->input->post('image_url')) {
                // $data['url_type']=1;
                $data['image'] = $this->input->post('image_url');
                if ($_POST['old_image']) {
                    $this->remove_image($_POST['old_image']);
                }
            }

            if (isset($_POST['b_id']) && $_POST['b_id'])//update
            {
                $where['b_id'] = $_POST['b_id'];
                echo $this->mdl_blog->update_data($where, $data);
            } else //add
            {
                echo $this->mdl_blog->add_data($data);
            }
        } else {
            echo validation_errors();
        }
    }

    function view_data()
    {
        $where = null;
        if (isset($_GET['b_id']))
            $where['b_id'] = $_GET['b_id'];

        if (isset($_GET['data']))
            $select = $_GET['data'];
        else
            $select = "*";

        $return = $this->mdl_blog->view_data($where, $select);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }

    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id']) {

            $this->db->where('b_id', $_GET['id']);
            foreach ($this->db->get("blog")->result() as $row) {
                $image_delete_path1 = "./assets/uploads/blog/$row->image";
                $image_delete_path2 = "./assets/uploads/blog/thumb/$row->image";
            }
            unlink($image_delete_path1);
            unlink($image_delete_path2);

            $where['b_id'] = $_GET['id'];
            echo $this->mdl_blog->delete_data($where);
        } else
            echo "Not Deleted";
    }
    function image_upload($title)
    {
        $folder = "blog";
        // upload coder starts here
        $config['upload_path'] = './assets/temp';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['new_image'] = "./assets/uploads/$folder/";
        $config['min_width'] = 100;

        $rand_number = mt_rand(0, 85);
        $timestamp = time();
        //             $title = str_replace(" ", "_", $title);
        $config['file_name'] = $rand_number . $timestamp;

        $config['overwrite'] = false;
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            echo $this->upload->display_errors();
            die();
        } else {
            $image = $this->upload->data();
            if ($this->input->post('width')) {
                $config['width'] = $this->input->post('width');
            } else {
                if ($image['image_width'] > 720)
                    $config['width'] = 720;
            }
            // image manipulation resizing 1
            $config['source_image'] = './assets/temp/' . $image['file_name'];
            $config['maintain_ratio'] = TRUE;

            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);

            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
                die();
            }

            $this->image_lib->clear();
            // image manipulation resizing 2
            $config['source_image'] = './assets/temp/' . $image['file_name'];
            $config['new_image'] = "./assets/uploads/$folder/thumb/";
            $config['file_name'] = $rand_number . $timestamp;
            $config['maintain_ratio'] = TRUE;
            if ($image['image_width'] > 100) {
                $config['width'] = 100;
            }
            $config['overwrite'] = FALSE;
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
                die();
            } else {
                unlink($config['source_image']);
                return $image['file_name'];
            }
        }
    }

    function remove_image($title)
    {
        if (substr($title, 0, 4) != "http") {
            $path1 = "./assets/uploads/blog/" . $title;
            unlink($path1);
            $path2 = "./assets/uploads/blog/thumb/" . $title;
            unlink($path2);
        }

    }


}
?>