<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Example Controller.
 */
class Example extends MX_Controller
{
    private $title;
    private $front_template;
    private $admin_template;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('output_view'); // Magic library

        $this->title = 'Hello World'; // Set title page
        $this->front_template = 'template/front_template'; // Set frontend template
        $this->admin_template = 'template/admin_template'; // Set backend template
    }


    
    /**
     * Frontend Hello World page.
     */
    public function index()
    {
        $this->load->model('bookModel'); // Load smart model
        $data['book'] = $this->bookModel->search(); // Search model
        $data['helloWorld'] = 'Hello World'; // Data send to wrapper

        $this->output_view->set_title($this->title);
        $this->output_view->set_wrapper('page', 'hello_world', $data);
        $this->output_view->output($this->front_template);
    }

    /**
     * Backend Hello World page.
     */
    public function backend()
    {
        $this->output_view->auth(); // Login required

        $this->load->model('bookModel');
        $data['book'] = $this->bookModel->search();
        $data['helloWorld'] = 'Hello World';

        $template_data['judul'] = 'Hellow World'; // Data send to template
        $template_data['crumb'] = [
            'Hellow World' => '',
        ];

        $this->output_view->set_wrapper('page', 'hello_world', $data); // Set wrapper page
        $this->output_view->output($this->admin_template, $template_data); // Output
    }

    /**
     * Backend CRUD Book Page.
     */
    public function crud()
    {
        $this->output_view->auth(); // Login required

        $crud = new grocery_CRUD(); // Load library grocery CRUD

        $crud->set_table('book');
        $crud->set_subject('book');

        $data = (array) $crud->render();

        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];
        $template_data['judul'] = 'CRUD';
        $template_data['crumb'] = [
            'CRUD' => '',
        ];

        $this->output_view->set_wrapper('page', 'grocery', $data, false);
        $this->output_view->output($this->admin_template, $template_data);
    }
}

/* End of file example.php */
/* Location: ./application/example/controllers/example.php */
