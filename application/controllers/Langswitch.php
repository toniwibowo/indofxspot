<?php
class LangSwitch extends MX_Controller
{
     public function __construct(){
         parent::__construct();
     
        $this->load->helper('url');
    }
 
    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "en";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }

    function tes()
    {
    	echo 'tes';
    }

    
}