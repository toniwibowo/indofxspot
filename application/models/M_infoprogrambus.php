<?php

class M_infoprogrambus extends CI_Model  {

	function __construct()
    {
        parent::__construct();
    }
	
	function view()
	{
		$sekarangL = date("Y-n-d");
		//$string_query       = "select * from infoprogram where type ='Bis Sosial' order by posting_date desc";

		$string_query       = "select * from infoprogram_bus ";
	  	$query          	  = $this->db->query($string_query);              
	  	$config['base_url']     = base_url().'index.php/infoprogrambus/view';  
	  	$config['total_rows']   = $query->num_rows();  
	  	$config['per_page']     = '9';   
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
	  	$data['string_query'] = $string_query;
		$data['jlh'] = $query->num_rows();
	  	return $data;  
	}



	function viewiga()
	{
		$sekarangL = date("Y-n-d");
		$string_query       = "select * from infoprogram_iga ";
	  	$query          	  = $this->db->query($string_query);              
	  	$config['base_url']     = base_url().'index.php/iga/program/view';  
	  	$config['total_rows']   = $query->num_rows();  
	  	$config['per_page']     = '9';   
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