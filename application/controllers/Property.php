<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Property  extends MX_Controller {

  // function News()
  // {
  //   parent::Controller();
    
  //   session_start();
  // }


  // Site
    private $title;
    private $logo;

    // Template
    private $admin_template;
    private $front_template;
    private $auth_template;
    private $youtubeanak_template;

    // Auth view
    private $login_view;
    private $register_view;
    private $forgot_password_view;
    private $reset_password_view;

    // Default page
    private $default_page;
    private $login_success;

    public function __construct()
    {
        parent::__construct();
        $this->config->load('sketsanet');
        $this->load->library('output_view');
        $this->load->library('pagination');


        // Site
        $site = $this->config->item('site');
        $this->title = $site['title'];
        $this->logo = $site['logo'];

        // Template
        $template = $this->config->item('template');
        $this->admin_template = $template['backend_template'];
        $this->front_template = $template['front_template'];
        $this->auth_template = $template['auth_template'];
        $this->plugkreasi_home_template = $template['home'];

        // Auth view
        $view = $this->config->item('view');
        $this->login_view = $view['login'];
        $this->register_view = $view['register'];
        $this->forgot_password_view = $view['forgot_password'];
        $this->reset_password_view = $view['reset_password'];

        // Default page
        $route = $this->config->item('route');
        $this->default_page = $route['default_page'];
        $this->login_success = $route['login_success'];

         $this->load->model("M_listing");
        
    }


  
  function index(){
    $data = $this->M_listing->view();
    $this->load->view('property',$data);
  }

   function category($cat){
    $data = $this->M_listing->category($cat);
    $categoryQuery = $this->db->query("select * from category_property where category_property_id = ".$cat);
    $category = $categoryQuery->row_array();
    $category_name = $category['category_title'];

    $data['category_name'] = $category_name;
    //echo $data['sql'];
    $this->load->view('property',$data);
	}


  


  
  function detail($key)
  {
  	$data['string_query'] = "select * from product,agent join agent_product where agent.agent_id = agent_product.agent_id AND product.product_id = agent_product.product_id AND  product.product_id = '$key'";

    $data['query'] = $this->db->query("select * from product where  product.product_id = '$key'");
    //$data['query2'] =$this->db->query("select * from imagenews where news_id = '$news_id'");

    

    //echo 'te4';
    $this->load->view('property-detail',$data);
  }


	public function log($id_article){
      
		$ip_address = $_SERVER["REMOTE_ADDR"];
		$log_file = file(base_url().'ip/news/'.'log.txt');
		$found_log = false;
		$log_current = $_SERVER["REMOTE_ADDR"].'/'.date('Y-m-d').'/'.$id_article;
      
       foreach($log_file as $l) {
        // echo trim ($l).'===='.$log_current.'</br>'; // -- for debugging purposes
           
        $log_item = trim($l);
			// echo $ip_item;
			//Jika ada history di log 
			if ($log_current==$log_item) {
				$found_log = true;
				break;
            }
         
                   
		}
      
      
      if($found_log==false){
          
          $filename = './ip/news/log.txt';
          //echo $filename;
          $handle = fopen($filename, 'a');
          //$data = fgets($handle);
          //echo $data;        //  $current = fread($handle, filesize($filename));
          //echo $current; // for debugging - current value in counter
          //fclose($handle);
          $ip = $_SERVER["REMOTE_ADDR"].'/'.date('Y-m-d').'/'.$id_article."\n";
          //$handle = fopen($filename, 'w');
          fwrite($handle, $ip);
          fclose($handle);
          
          //update Log lagi
         
          
      }
      
      return $found_log;
      
	}
  
}
?>