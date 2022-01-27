<?php

/**
 *
 */
class Reference extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function view(){
    $this->load->view('include/header');
    $this->load->view('reference');
    $this->load->view('include/footer');
  }
}
