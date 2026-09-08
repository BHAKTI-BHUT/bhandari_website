<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Slimcity extends MX_Controller
{
    function home_shifting($city='',$state="")
    {
    	$this->load->helper('text');
    	$state=str_replace("_", " ", $state);
    	$state=ucwords(str_replace("-", " ", $state));
    	$city=str_replace("_", " ", $city);
    	$city=ucwords(str_replace("-", " ", $city));
    	
    	$data['city']=$city;
    	$data['state']=$state;
//     	$data['img']=base_url('assets')."/img/umbrella.jpg";
    	$data['title'] = "Home Shifting service in $city | 7303257332";
    	$data['description']="We provide fast, secure, and affordable home shifting services in $city. With a trained team that understands $city's unique relocation needs, we ensure a smooth, stress-free, and well-organized moving experience for every household.";
		$data['keywords']="Home Relocation service in $city";
    	$data['module'] = "slimcity";
    	$data['view_file'] = "home";
    	echo Modules::run('template/layout2', $data);
    }
    
}