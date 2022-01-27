<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * Sketsa.net basic config
 *
 * Author : Arief Budiyono
 * Email : ariefbudiyono@yahoo.com
 */

// Site
$config['site'] = [
    'title' => 'Sketsa.net CMS', // Default Title entire page
    'favicon' => 'assets/img/favicon-96x96.png', // Default Favicon
    'logo' => 'assets/img/logo/myIgniter.png' // Default Logo
];

// Template
$config['template'] = [
    'front_template' => 'template/front_template', // Default front template
    'backend_template' => 'template/admin_template', // Default backend template
    'backend_template_maps' => 'template/admin_template_maps', // Default backend template
    'auth_template' => 'template/auth_template', // Default auth template

    'home'=>'template/home', // 
];

// Auth view
$config['view'] = [
    'login' => 'auth/login', // Default login view template
    'register' => 'auth/register', // Defaul register view template
    'forgot_password' => 'auth/forgot_password', // Default forgot password view template
    'reset_password' => 'auth/reset_password' // Default reset password view template
];

// Route
$config['route'] = [
    'default_page' => 'home', // Default first page route
    'login_success' => 'sketsanet/dashboard' // Default redirect after success logedin
];

// Email Configuration
$config['email_config'] = [ 
    'protocol' => 'smtp',
    'smtp_host' => '',
    'smtp_user' => '',
    'smtp_pass' => '',
    'smtp_port' => 587,
    'mailtype' => 'html',
    'charset' => 'iso-8859-1'
];

// Debugbar
$config['debugbar'] = false; // True show debugbar