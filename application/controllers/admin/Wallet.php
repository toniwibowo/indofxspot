<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Name : Sketsa.cms base controller.
 * 
 * @version 1.0.0
 *
 * @author : Arief Budiyono
 */
class Wallet extends MX_Controller
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
            redirect('login');
        } else {
           

        /*==============tampilan grucery crud====================================================*/
        $table_name = 'wallet';
        $this->db->where('table_name', $table_name);
        $table = $this->db->get('table')->row();
        //echo $table->action.'';

        $this->load->library('Grocery_CRUD');
        $this->load->library('Grocery_CRUD_Multiuploader');
        //$crud = new grocery_CRUD();
        $crud = new Grocery_CRUD_Multiuploader(); 

        $crud->set_table($table_name);
        $crud->set_subject($table->subject);
        $crud->unset_add();

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

        $this->output_view->set_wrapper('page', 'grocery-wallet', $data, false);
        $this->output_view->auth();

        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];

        $template_data['judul'] = $table->title;
        $template_data['crumb'] = $add_crumb;
        $template = $this->admin_template;

        //print_r($template_data);
       $this->output_view->output($template, $template_data);


              /*===============end tampilan grocery crud================================================*/



        }
    }

    public function update_id()
    {
      $query = $this->db->select('card_id')->order_by('member_id','asc')->get('members');

      $no = 0;

      if ($query->num_rows() > 0) {
        foreach ($query->result() as $key => $value) {

          $update = array(
            'card_id' => $value->card_id
          );

          $this->db->where('member_id >', 4046)->where('card_id',$value->card_id)->set($update)->update('members');
        }
      }

      echo 'Sukses';
    }

    public function get_member_by_id($id)
    {
        return $this->db->where('account_number', $id)->get('wallet');
    }

	public function upload_csv()
	{

        ini_set('max_execution_time', 0);
  		ini_set('memory_limit','2048M');

	    if (isset($_POST['submit-csv'])) {

            $filename = $_FILES['csv-file']['tmp_name'];

            if ($filename) {

                $fileHandle = fopen($filename, 'r');

                $no = 0;
                $null = 0;

                print_r(fgetcsv($fileHandle));

                while ($data = fgetcsv($fileHandle)) {

                    $dataUpdate[] = array(
                        'account_number' => $data[0],
                        'category' => $data[1],
                        'date_order' => $data[2],
                        'currency' => $data[3],
                        'amount' => $data[4]
                    );

                    if ($this->get_member_by_id($data[0])->num_rows() > 0) {

                        //$this->db->where('card_id', $data[0])->set($dataUpdate)->update('members');
                        $this->session->set_flashdata('update-wallet', 'Upload failed, System found same account number');

                        redirect('admin/wallet');

                    }

                }

	            fclose($fileHandle);

                $this->db->insert_batch('wallet',$dataUpdate);

			    $this->session->set_flashdata('update-wallet', 'Wallet data updated successfully.');

	        }

	        redirect('admin/wallet');

	    }

	}

    public function clear_all()
    {
      $deleteAllData = $this->db->empty_table('wallet');

      if ($deleteAllData) {

        $this->db->query('ALTER TABLE wallet AUTO_INCREMENT = 1');

        redirect('admin/wallet');
      }
    }


}