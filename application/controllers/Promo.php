<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Promo  extends MX_Controller {

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
       


        $this->load->model("M_promo");
    }


  
  function view()
  {
    $data = $this->M_promo->view();
    $this->load->view('promo',$data);
  }
  
  function detail($news_id,$link)
  {
    $data['query'] = $this->db->query("select * from promo where promo_id = '$news_id'");
    //$data['query2'] =$this->db->query("select * from imagenews where news_id = '$news_id'");

     

    //echo 'te4';
    $this->load->view('promo-detail',$data);
  }


  public function log($id_article)
{
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
      
      
      if($found_log==false)
      {
          
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