<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Name : Sketsa.cms base controller.
 * 
 * @version 1.0.0
 *
 * @author : Arief Budiyono
 */
class Subcategory2product extends MX_Controller
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
        $this->config->load('sketsanet');
        $this->load->library('output_view');

        // Site
        $site = $this->config->item('site');
        $this->title = $site['title'];
        $this->logo = $site['logo'];

        // Template
        $template = $this->config->item('template');
        $this->admin_template = $template['backend_template'];
        $this->front_template = $template['front_template'];
        $this->auth_template = $template['auth_template'];
       // $this->youtubeanak_template = $template['youtubeanak_template'];

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
    }

   public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            if ($this->default_page == '') {
                $this->login();
            } else {
               $this->page($this->default_page);
                //echo $this->default_page;
            }
        } else {
           

              /*==============tampilan grucery crud====================================================*/
        $table_name = 'subcategory2_product';
        $this->db->where('table_name', $table_name);
        $table = $this->db->get('table')->row();
        //echo $table->action.'';

         $this->load->library('Grocery_CRUD');
        $this->load->library('Grocery_CRUD_Multiuploader');
        //$crud = new grocery_CRUD();
        $crud = new Grocery_CRUD_Multiuploader(); 

        $crud->set_table($table_name);
        $crud->set_subject($table->subject);

        // Required field       
        if ($table->required != '') {
            $crud->required_fields(json_decode($table->required));
        }
        // Columns view
        if ($table->columns != '') {
            $crud->columns(json_decode($table->columns));
        }
        // Field view
        if ($table->field != '') {
            $crud->fields(json_decode($table->field));
        }
        // Field upload
        if ($table->uploads != '') {
            $fields_upload = json_decode($table->uploads);
            foreach ($fields_upload as $field_upload) {
                $crud->set_field_upload($field_upload, 'assets/uploads/files');
            }
        }
		
		$crud->field_type('date', 'hidden', date('Y-m-d H:i:s'));

         //============TAMBAHAN MULTIUPLOAD =================================================

         // Field upload
        if ($table->multiuploads != '') {

            $config = array(

        /* Destination directory */
        "path_to_directory"       =>'assets/uploads/files/',

        /* Allowed upload type */
        "allowed_types"           =>'gif|jpeg|jpg|png',

        /* Show allowed file types while editing ? */
        "show_allowed_types"      => true,
    
        /* No file text */
        "no_file_text"            =>'No Pictures',

        /* enable full path or not for anchor during list state */
        "enable_full_path"        => false,

        /* Download button will appear during read state */
        "enable_download_button"  => true,

        /* One can restrict this button for specific types...*/
        "download_allowed"        => 'jpg'      
     );


            $fields_multiupload = json_decode($table->multiuploads);
            foreach ($fields_multiupload as $field_upload) {
                //$crud->set_field_upload($field_upload, 'assets/uploads/files');
                $crud->new_multi_upload($field_upload,$config);
            }
        }


        //============END TAMBAHAN MULTIUPLOAD =================================================

        
        // Relation 1-n
        if ($table->relation_1 != 'null') {
            $fields_relation = json_decode($table->relation_1);
            foreach ($fields_relation as $field_relation) {
                $crud->set_relation($field_relation->field, $field_relation->table_name, $field_relation->field_view);
            }
        }


         /*======================DEPENDING DROPDOWN=============================================*/
        /*http://www.grocerycrud.com/forums/topic/1087-updated-24112012-dependent-dropdown-library/*/
        $this->load->library('gc_dependent_select');
// settings

$fields = array(

// first field:
'category_product_id' => array( // first dropdown name
'table_name' => 'category_product', // table of country
'title' => 'category_product_name', // country title
'relate' => null // the first dropdown hasn't a relation
),
// second field
'subcategory_product_id' => array( // second dropdown name
'table_name' => 'subcategory_product', // table of state
'title' => 'name', // state title
'id_field' => 'subcategory_product_id', // table of state: primary key
'relate' => 'subcategory_product_id', // table of state:
'data-placeholder' => 'select Subcategory', //dropdown's data-placeholder:
'segment_name' =>'get_items' // It's an optional parameter. by default "get_items"
),

);

$config = array(
'main_table' => 'subcategory2_product',
'main_table_primary' => 'subcategory2_product_id',
//"url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/',
  "url" => site_url() . 'admin/subcategory2product/index/',
'ajax_loader' => base_url() . 'ajax-loader.gif', // path to ajax-loader image. It's an optional parameter
//'segment_name' =>'Your_segment_name' // It's an optional parameter. by default "get_items"
);
$categories = new gc_dependent_select($crud, $fields, $config);
$js = $categories->get_js();
        
        
        /*==================END DEPENDING DROPDOWN==============================================*/



        // Unset action
        if ($table->action != '') {
            $action = json_decode($table->action);
            if (!in_array('Create', $action)) {
                $crud->unset_add();
            }
            if (!in_array('Read', $action)) {
                $crud->unset_read();
            }
            if (!in_array('Update', $action)) {
                $crud->unset_edit();
            }
            if (!in_array('Delete', $action)) {
                $crud->unset_delete();
            }
        }

        $crud->set_theme('flexigrid');
        $data = (array) $crud->render();
        if ($table->breadcrumb != 'null') {
            $crumbs = json_decode($table->breadcrumb);
            foreach ($crumbs as $value) {
                $add_crumb[$value->label] = $value->link;
            }
        } else {
            $add_crumb['table'] = '';
        }

        $this->output_view->set_wrapper('page', 'grocery', $data, false);
        $this->output_view->auth();

        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];
        $template_data['js_dependent'] = $js;

        $template_data['judul'] = $table->title;
        $template_data['crumb'] = $add_crumb;
        $template = $this->admin_template;

        //print_r($template_data);
		$this->output_view->output($template, $template_data);


              /*===============end tampilan grocery crud================================================*/



        }
    }




}