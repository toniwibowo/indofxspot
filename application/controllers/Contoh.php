<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Name : Sketsa.cms base controller.
 * 
 * @version 3.8.2
 *
 * @author : Arief Budiyono
 */
class Contoh extends CI_Controller 
{


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
       
    }


     /**
     * Default page.
     *
     * @return HTML
     **/
    public function index()
    {
        

         header('Location: http://www.example.com/');
        echo CI_VERSION;


    }



     /**
     * Custom page backend.
     *
     * @return HTML
     **/
    public function page($slug)
    {
       
    }





}