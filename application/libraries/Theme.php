<?php

/**
 *
 */
class Theme
{

  private $CI;
  private $template_data = array();

  public function __construct()
  {
    // parent::__construct();
    $this->CI = &get_instance();
  }
		
	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

  function view($template = '', $view = '' , $view_data = array(), $return = FALSE)
  {
    $this->CI =& get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
		return $this->CI->load->view($template, $this->template_data, $return);

  }

  function package($package,$contract)
  {

  }

}
