<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Documentation extends MX_Controller
{
    private $title;
    private $front_template;
    private $admin_template;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('output_view');

        $this->title = 'Documentation';
        $this->front_template = 'template/front_template';
        $this->admin_template = 'template/admin_template';
    }


     /**
     * Modules instalation.
     *
     * @return JSON
     **/
    public function module()
    {
        $module = [
            'name' => 'Documentation',
            'menu_link' => ['documentation/index' => 'View welcome page'],
            'table' => '',
            'description' => 'Example default welcome page Codeigniter',
        ];

        return $module;
    }

    public function index()
    {
        $template_data['css_plugins'] = [base_url('assets/plugins/highlightjs/styles/default.css')];
        $template_data['js_plugins'] = [base_url('assets/plugins/highlightjs/highlight.pack.js')];

        $this->output_view->set_title($this->title . ' - Quick Start');
        $this->output_view->set_wrapper('page', 'start');
        $this->output_view->output($this->front_template, $template_data);
    }

    public function welcome()
    {
        $this->output_view->auth();

        $template_data['css_plugins'] = [base_url('assets/plugins/highlightjs/styles/default.css')];
        $template_data['js_plugins'] = [base_url('assets/plugins/highlightjs/highlight.pack.js')];

        $template_data['judul'] = 'Documentation';
        $template_data['crumb'] = [
            'Documentation' => ''
        ];

        $this->output_view->set_title($this->title);
        $this->output_view->set_wrapper('page', 'welcome');
        $this->output_view->output($this->admin_template, $template_data);
    }
}

/* End of file documentation.php */
/* Location: ./application/controllers/documentation.php */
