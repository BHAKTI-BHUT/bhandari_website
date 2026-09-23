<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Blog extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		try {
			$this->load->database();
		} catch (\Throwable $e) {
			log_message('error', 'Blog DB load error: ' . $e->getMessage());
		}
	}
	function index()
	{
		redirect('blogs', 301);
	}

	function view()
	{
		$this->load->library('pagination');
		$this->load->helper('text');

		$data['blogs'] = [];
		$data['total']  = 0;

		try {
			$config['base_url']    = site_url('blogs');
			$config['total_rows']  = $this->db->get('blog')->num_rows();
			$config['per_page']    = 10;
			$config['num_links']   = 3;
			$config['full_tag_open']   = '<ul class="styled-pagination clearfix text-center">';
			$config['full_tag_close']  = '</ul></nav>';
			$config['prev_link']       = '&laquo;';
			$config['prev_tag_open']   = '<li>';
			$config['prev_tag_close']  = '</li>';
			$config['next_link']       = '&raquo;';
			$config['next_tag_open']   = '<li>';
			$config['next_tag_close']  = '</li>';
			$config['cur_tag_open']    = '<li><a href="#" class=" rc_first_hr color_dark">';
			$config['cur_tag_close']   = '</a></li>';
			$config['num_tag_open']    = '<li>';
			$config['num_tag_close']   = '</li>';
			$config['last_tag_open']   = '<li>';
			$config['last_tag_close']  = '</li>';
			$config['last_link']       = 'Last';
			$config['first_tag_open']  = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['first_link']      = 'First';

			$this->pagination->initialize($config);
			$this->db->order_by("b_id", "desc");
			$query          = $this->db->get('blog', $config['per_page'], $this->uri->segment(2));
			$data['blogs']  = $query->result_array();
			$data['total']  = $config['total_rows'];
		} catch (\Throwable $e) {
			log_message('error', 'Blog::view DB error: ' . $e->getMessage());
		}

		$data['title']       = "Packing & Moving Tips — Blog | Bhandari Packers and Movers";
		$data['description'] = "Read expert tips on home shifting, packing, and relocation from Bhandari Packers and Movers.";
		$data['keywords']    = "packers and movers blog, moving tips, home shifting tips";
		$data['module']      = "blog";
		$data['view_file']   = "bolg";
		echo Modules::run('template/layout2', $data);
	}


	function read($title = '')
	{
		$this->load->helper('text');
		$title = str_replace("_", "-", ucwords($title));

		try {
			$blg       = $this->db->where('url', $title)->get('blog');
			$all_blogs = $this->db->order_by('b_id', 'DESC')->get('blog')->result_array();

			$data['blog_details'] = $blg->result_array();
			$data['blogs']        = $all_blogs;

			if ($blg->num_rows() > 0) {
				$blg_result          = $blg->result();
				$data['title']       = ucfirst($blg_result[0]->title);
				$data['description'] = $blg_result[0]->description;
				$data['keywords']    = $blg_result[0]->tags;
				$data['img']         = base_url('assets/uploads/blog/' . $blg_result[0]->image);
				$data['module']      = "blog";
				$data['view_file']   = "view";
				echo Modules::run('template/layout2', $data);
			} else {
				// Blog not found — redirect to blogs listing
				redirect(site_url('blogs'), 'location', 301);
			}
		} catch (\Throwable $e) {
			log_message('error', 'Blog::read DB error: ' . $e->getMessage());
			redirect(site_url('blogs'), 'location', 302);
		}
	}



}