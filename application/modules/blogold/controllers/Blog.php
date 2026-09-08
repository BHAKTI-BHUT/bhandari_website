<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Blog extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function index()
	{
		redirect('blog/view', 301);
	}
	function view()
	{
		$this->load->library('pagination');
		$this->load->helper('text');//to wrap text

		$config['base_url'] = site_url('blog/view');
		// 	    $this->db->where($this->data);
		$config['total_rows'] = $this->db->get('blog')->num_rows();
		$config['per_page'] = 6;
		$config['num_links'] = 4;
		//
		$config['full_tag_open'] = '<ul class="styled-pagination clearfix text-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#" class="active rc_first_hr color_dark">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		//

		$this->pagination->initialize($config);
		$this->db->order_by("b_id", "desc");
		$data['query'] = $this->db->get('blog', $config['per_page'], $this->uri->segment(3));
		$data['total'] = $config['total_rows'];

		$data['title'] = "Official Blog of " . $this->comp['name'];
		$data['description'] = "Latest blog of " . $this->comp['name'];
		$data['keywords'] = "packers and movers";
		$data['module'] = "blog";
		$data['view_file'] = "blog";
		echo Modules::run('template/layout2', $data);
	}


	function read($title = '', $bid = '')
	{
		$this->load->helper('text');
		$blg = $this->db->where('b_id', $bid)->get('blog');
		$b = $blg->result();
		$data['query'] = $b;
		// 	    print_r($blg->result());
		if ($blg->num_rows() > 0) {
			$blg = $blg->result();
			$data['title'] = ucfirst($blg[0]->title);
			$data['description'] = word_limiter(strip_tags($blg[0]->description), 200);
			$data['img'] = base_url('assets/uploads/blog/' . $blg[0]->image);
			$data['module'] = "blog";
			$data['view_file'] = "view";
			echo Modules::run('template/layout2', $data);
		} else {
			echo "Invalid blog url";
		}
	}

	public function blogDetails($title)
	{
		$blogTitle = ucwords(str_replace('-', ' ', strtolower($title)));
		$data['title'] = $blogTitle;
		$data['description'] = "";
		$data['module'] = "blog";
		$data['view_file'] = "view";
		echo Modules::run('template/layout2', $data);
	}

}