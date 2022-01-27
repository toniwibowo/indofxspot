<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Infoprogramguru extends MX_Controller {

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


        $this->load->model("M_infoprogram");
    }
  
  function view()
  {
    $data = $this->M_infoprogram->view();
    $this->load->view('infoprogram',$data);
  }
  
  function detail($news_id,$link)
  {
    $data['query'] = $this->db->query("select * from infoprogram_guru where infoprogram_guru_id = '$news_id'");
    //$data['query2'] =$this->db->query("select * from imageinfoprogram where infoprogram_guru_id = '$news_id'");
    //echo 'te4';
    $this->load->view('infoprogram-detail',$data);
  }
}
?>