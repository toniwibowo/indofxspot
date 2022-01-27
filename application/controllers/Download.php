<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends MX_Controller
{

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
        $this->plugkreasi_home_template = $template['plugkreasi_home_template'];

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

        $this->load->model("M_download");
    }

    
      
   

    function index()
      {
          //print_r($_POST);
          $data = $this->M_download->index();
             
            


          //$data['query2'] = $this->db->query("select * from article where approve='y' order by posting_date limit 3 " );

          $this->load->view('download',$data);
      }
   
      


  function detail($promo_id,$link)

  {

    $data['query'] = $this->db->query("select * from promo where promo_id = '$promo_id'");
    $data['queryImage'] = $this->db->query("select * from imagepromo where promo_id = '$promo_id'");
    $data['query2'] = $this->db->query("select * from article  order by posting_date limit 3 " );

    $this->load->view('promo-detail',$data);

  }
    
}

