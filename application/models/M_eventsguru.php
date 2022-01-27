<?php

class M_eventsguru extends CI_Model  {

	function __construct()
    {
        parent::__construct();
    }
	
	function view()
	{
		$sekarangL = date("Y-n-d");
		$string_query       = "select * from events order by posting_date desc";
	  	$query          	  = $this->db->query($string_query);              
	  	$config['base_url']     = base_url().'index.php/guru/events';  
	  	$config['total_rows']   = $query->num_rows();  
	  	$config['per_page']     = '9';
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
}
?>