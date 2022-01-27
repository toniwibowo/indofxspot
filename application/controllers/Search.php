<?php



class Search extends CI_Controller {



	function __construct()
      {
            parent::__construct();
    
		
		$this->load->model("M_searchhome");

		//session_start();

      }

	

	

	function view()

	{

		//print_r($_POST);
		
		$data = $this->M_searchhome->view();
		  //$data['query2'] = $this->db->query("select * from article  order by posting_date limit 3 " );
		//$data['query2'] = $this->db->query("select * from articles   order by posting_date desc limit 3 " );
		  //$data['s'] = $_GET['key'];
		//echo $data['string_query'];
		$this->load->view('search',$data);

	}

}

?>