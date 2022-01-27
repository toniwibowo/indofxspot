<?php

class M_gallery extends CI_Model  {

	function __construct()
    {
        parent::__construct();
    }
	
	function view()
	{
		$sekarangL = date("Y-n-d");
		$string_query       = "select * from gallery order by gallery_id desc";
	  	$query          	  = $this->db->query($string_query);              
	  	$config['base_url']     = base_url().'index.php/gallery/view';  
	  	$config['total_rows']   = $query->num_rows();  
	  	$config['per_page']     = '12';   
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



	function view_category($category)
	{
		$sekarangL = date("Y-n-d");
		$string_query       = "select * from gallery where category_photo_id = ".$category." order by posting_date desc";
	  	$query          	  = $this->db->query($string_query);              
	  	$config['base_url']     = base_url().'index.php/gallery/view';  
	  	$config['total_rows']   = $query->num_rows();  
	  	$config['per_page']     = '12';   
	  	$num            = $config['per_page'];
		$config['uri_segment'] = 4;
	  	$offset         = $this->uri->segment(4);  
	  	$offset         = ( ! is_numeric($offset) || $offset < 1) ? 0 : $offset;  
	  	if(empty($offset))  
	  	{  
	  	$offset=0;  
	  	}  
	  	$this->pagination->initialize($config);       
	  	$data['query']      = $this->db->query($string_query." limit $offset,$num");
	  	$data['string_query']     = $string_query;
	  	$data['base']       = $this->config->item('base_url');
		$data['jlh'] = $query->num_rows();
	  	return $data;  
	}
}
?>