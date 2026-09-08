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
		redirect('blogs', 301);
	}

	function view()
	{
		$this->load->library('pagination');
		$this->load->helper('text');

		$config['base_url'] = site_url('blogs');
		$config['total_rows'] = $this->db->get('blog')->num_rows();
		$config['per_page'] = 10;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<ul class="styled-pagination clearfix text-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#" class=" rc_first_hr color_dark">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';

		$this->pagination->initialize($config);
		$this->db->order_by("b_id", "desc");
		$query = $this->db->get('blog', $config['per_page'], $this->uri->segment(2));
		$data['blogs'] = $query->result_array();
		$data['total'] = $config['total_rows'];

		$data['title'] = "Official Blog of " . $this->comp['company3'];
		$data['description'] = "Latest blog of " . $this->comp['company3'];
		$data['keywords'] = "packers and movers";
		$data['module'] = "blog";
		$data['view_file'] = "bolg";
		echo Modules::run('template/layout2', $data);
	}


	function read($title = '')
	{
		$title = str_replace("_", "-", ucwords(string: $title));
		$this->load->helper('text');
		$blg = $this->db->where('url', $title)->get('blog');
		$b = $blg->result_array();

		$all_blogs = $this->db
			->order_by('b_id', 'DESC')
			->get('blog')
			->result_array();


		$data['blog_details'] = $b;
		$data['blogs'] = $all_blogs;


		// $reviews = $this->db->select('*')
		// 	->from('reviews')
		// 	->where('b_id', $b[0]['b_id'])
		// 	->where('status', 1)
		// 	->order_by('id', 'DESC')
		// 	->get()
		// 	->result_array();
		/* echo ($this->db->last_query());
		die(); */
		// $data['reviews'] = $reviews;

		if ($blg->num_rows() > 0) {
			$blg = $blg->result();
			$data['title'] = ucfirst($blg[0]->title);
			$data['description'] = $blg[0]->description;
			$data['keywords'] = $blg[0]->tags;
			$data['img'] = base_url('assets/uploads/blog/' . $blg[0]->image);
			$data['module'] = "blog";
			$data['view_file'] = "view";
			echo Modules::run('template/layout2', $data);
		} else {
			echo "Invalid blog url";
		}
	}



}