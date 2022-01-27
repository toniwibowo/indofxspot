<?php

class M_product extends CI_Model  {

	function __construct()
    {
        parent::__construct();
    }

	function view()
	{
		$sekarangL = date("Y-n-d");
		$string_query       = "select * from product order by rand()";
	  	$query          	  = $this->db->query($string_query);
	  	$config['base_url']     = base_url().'product/index';
	  	$config['total_rows']   = $query->num_rows();
	  	$config['per_page']     = '12';
			$config['full_tag_open'] = '<ul class=pagination>';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#" ><b>';
			$config['cur_tag_close'] = '</b></a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['attributes'] = array('class' => 'page-link');
	  	$num            = $config['per_page'];
		$config['uri_segment'] = 3;
	  	$offset         = $this->uri->segment(3);
	  	$offset         = ( ! is_numeric($offset) || $offset < 1) ? 0 : $offset;
	  	if(empty($offset))
	  	{
	  	$offset=0;
	  	}
	  	$this->pagination->initialize($config);
	  	$data['query']      = $this->db->query($string_query." limit $offset,$num");
	  	$data['base']       = $this->config->item('base_url');
			$data['jlh'] = $query->num_rows();
	  	return $data;
	}


function category($cat=2,$title)
	{
		$sekarangL = date("Y-n-d");
		$string_query       = "select * from product where category_product_id = ".$cat." order by rand()";
	  	$query          	  = $this->db->query($string_query);
	  	$config['base_url']     = base_url().'product/category/'.$cat.'/'.$title;
	  	$config['total_rows']   = $query->num_rows();
	  	$config['per_page']     = '12';
			$config['full_tag_open'] = '<ul class=pagination>';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#" ><b>';
			$config['cur_tag_close'] = '</b></a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['attributes'] = array('class' => 'page-link');
	  	$num            = $config['per_page'];
		$config['uri_segment'] = 5;
	  	$offset         = $this->uri->segment(5);
	  	$offset         = ( ! is_numeric($offset) || $offset < 1) ? 0 : $offset;
	  	if(empty($offset))
	  	{
	  	$offset=0;
	  	}
	  	$this->pagination->initialize($config);
	  	$data['query']      = $this->db->query($string_query." limit $offset,$num");
	  	$data['base']       = $this->config->item('base_url');
		$data['jlh'] = $query->num_rows();
		$data['sql'] = $string_query;
	  	return $data;
	}


	function subcategory($cat=2,$sub,$title)
	{
		$sekarangL = date("Y-n-d");
		$string_query       = "select * from product where category_product_id = ".$cat.' and subcategory_product_id = '.$sub." order by rand()";
	  	$query          	  = $this->db->query($string_query);
	  	$config['base_url']     = base_url().'product/subcategory/'.$cat.'/'.$sub.'/'.$title;
	  	$config['total_rows']   = $query->num_rows();
	  	$config['per_page']     = '12';
			$config['full_tag_open'] = '<ul class=pagination>';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#" ><b>';
			$config['cur_tag_close'] = '</b></a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$config['attributes'] = array('class' => 'page-link');
	  	$num            = $config['per_page'];
		$config['uri_segment'] = 6;
	  	$offset         = $this->uri->segment(6);
	  	$offset         = ( ! is_numeric($offset) || $offset < 1) ? 0 : $offset;
	  	if(empty($offset))
	  	{
	  	$offset=0;
	  	}
	  	$this->pagination->initialize($config);
	  	$data['query']      = $this->db->query($string_query." limit $offset,$num");
	  	$data['base']       = $this->config->item('base_url');
		$data['jlh'] = $query->num_rows();
		$data['sql'] = $string_query;
	  	return $data;
	}


		function subcategory2($cat=2,$sub,$sub2)
	{
		$sekarangL = date("Y-n-d");
		$string_query       = "select * from product where category_product_id = ".$cat.' and subcategory_product_id = '.$sub.' and subcategory2_product_id = '.$sub2." order by rand()";
	  	$query          	  = $this->db->query($string_query);
	  	$config['base_url']     = base_url().'property/category/';
	  	$config['total_rows']   = $query->num_rows();
	  	$config['per_page']     = '10';
			$config['full_tag_open'] = '<ol class=pagination>';
			$config['full_tag_close'] = '</ol>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li><a href="#" ><b>';
			$config['cur_tag_close'] = '</b></a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	  	$num            = $config['per_page'];
		$config['uri_segment'] = 5;
	  	$offset         = $this->uri->segment(5);
	  	$offset         = ( ! is_numeric($offset) || $offset < 1) ? 0 : $offset;
	  	if(empty($offset))
	  	{
	  	$offset=0;
	  	}
	  	$this->pagination->initialize($config);
	  	$data['query']      = $this->db->query($string_query." limit $offset,$num");
	  	$data['base']       = $this->config->item('base_url');
		$data['jlh'] = $query->num_rows();
		$data['sql'] = $string_query;
	  	return $data;
	}


}
?>
