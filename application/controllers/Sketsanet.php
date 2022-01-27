<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sketsanet extends MX_Controller
{
    // Site
    private $title;
    private $logo;

    // Template
    private $admin_template;
    private $front_template;
    private $auth_template;
    private $plugkreasi_home_template;

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
        $this->home = $template['home'];

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

    /**
     * Default page.
     *
     * @return HTML
     **/
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
            if ($this->default_page == '') {
                redirect($this->login_success);
            } else {
                redirect($this->login_success);
            }
        }
    }

    /**
     * Main dashboard page.
     *
     * @return HTML
     **/
    public function dashboard()
    {
        $data['database'] = $this->db->database;

        $this->output_view->set_wrapper('page', 'dashboard', $data);
        $this->output_view->auth();
        $template_data['judul'] = 'Dashboard';
        $template_data['crumb'] = [
            'Dashboard' => '',
        ];
        $template = $this->admin_template;
        $this->output_view->output($template, $template_data);
    }

    /**
     * Profile page.
     *
     * @return HTML
     **/
    public function profile()
    {
        $this->output_view->set_wrapper('page', 'profile');
        $this->output_view->auth();

        $template_data['judul'] = 'User Profile';
        $template_data['crumb'] = [
            'User Profile' => '',
        ];
        $template = $this->admin_template;
        $this->output_view->output($template, $template_data);
    }

    /**
     * Register page.
     *
     * @return HTML
     **/
    public function register()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('');
        }
        if ($this->input->post('email')) {
            $fullname = $this->input->post('fullname');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            if ($this->input->post('additional')) {
                $additional = json_encode($this->input->post('additional'));
            } else {
                $additional = '';
            }

            $fullnameEx = explode(' ', $fullname);
            $this->db->order_by('id', 'desc');
            $id_user = $this->db->get('users')->row()->id;
            $username = strtolower($fullnameEx[0]).'-'.$id_user;

            $additional_data = [
                'full_name' => $fullname,
                'additional' => $additional,
            ];

            $register = $this->ion_auth->register($username, $password, $email, $additional_data);

            if ($register) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->login($email, $password);
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('register');
            }
        } else {
            $data['name'] = $this->title;
            $data['logo'] = $this->logo;
            $data['message'] = $this->session->flashdata('message');
            $this->output_view->set_wrapper('page', $this->register_view, $data);
            $template = $this->auth_template;

            $this->output_view->output($template);
        }
    }

    /**
     * Login page.
     *
     * @return HTML
     **/
    public function login($identity = null, $password = null)
    {
        if ($this->ion_auth->logged_in()) {
            redirect('');
        }

        if ($this->input->post('identity') || $identity != null) {
            if ($identity == null) {
                $identity = $this->input->post('identity');
                $password = $this->input->post('password');
                $remember = (bool) $this->input->post('remember');
            } else {
                $remember = false;
            }

            if ($this->ion_auth->login($identity, $password, $remember)) {
                redirect($this->login_success);
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login');
            }
        } else {
            $data['name'] = $this->title;
            $data['logo'] = $this->logo;
            $data['message'] = $this->session->flashdata('message');
            $this->output_view->set_wrapper('page', $this->login_view, $data);
            $template = $this->auth_template;

            //echo $template;
           $this->output_view->output($template);
        }
    }

    /**
     * Activate.
     **/
    public function activate($id, $code = false)
    {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } elseif ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('login');
        } else {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('forgot-password');
        }
    }

    /**
     * Forgot Password.
     **/
    public function forgot_password()
    {
        if ($this->input->post('identity')) {
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $this->db->where('username', $this->input->post('identity'));
                $object = ['forgotten_password_code' => null, 'forgotten_password_time' => null];
                $this->db->update('users', $object);
                $identity = $this->ion_auth->where('username', strtolower($this->input->post('identity')))->users()->row();
            } else {
                $this->db->where('email', $this->input->post('identity'));
                $object = ['forgotten_password_code' => null, 'forgotten_password_time' => null];
                $this->db->update('users', $object);
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('identity')))->users()->row();
            }

            if (empty($identity)) {
                if ($this->config->item('identity', 'ion_auth') == 'username') {
                    $this->ion_auth->set_message('forgot_password_username_not_found');
                } else {
                    $this->ion_auth->set_message('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('forgot-password');
            }

            // Run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                // If there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('login'); // we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('forgot-password');
            }
        } else {
            $data['name'] = $this->title;
            $data['logo'] = $this->logo;
            $data['message'] = $this->session->flashdata('message');
            $this->output_view->set_wrapper('page', $this->forgot_password_view, $data);
            $template = $this->auth_template;

            $this->output_view->output($template);
        }
    }

    /**
     * Final Forgot Password.
     *
     * @return Redirect
     **/
    public function reset_password($code = null)
    {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            if ($this->input->post('password')) {
                $identity = $user->{$this->config->item('identity', 'ion_auth')};
                $change = $this->ion_auth->reset_password($identity, $this->input->post('password'));

                if ($change) {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    $this->logout();
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('reset-password/'.$code);
                }
            } else {
                $data['name'] = $this->title;
                $data['logo'] = $this->logo;
                $data['code'] = $code;
                $data['user_id'] = $user->id;
                $data['message'] = $this->session->flashdata('message');
                $this->output_view->set_wrapper('page', $this->reset_password_view, $data);
                $template = $this->auth_template;

                $this->output_view->output($template);
            }
        } else {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('forgot-password');
        }
    }

    /**
     * Logout.
     *
     * @return Redirect
     **/
    public function logout()
    {
        session_destroy();
        // $logout = $this->ion_auth->logout();
        redirect('login');
    }

    /**
     * Page builder.
     *
     * @return HTML
     **/
    public function page_builder()
    {
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('page');
        $crud->set_subject('Page');

        // Views Base sketsanet
        $dir = './application/views/page';
        $files = scandir($dir);
        $view_list['default'] = 'default';
        foreach ($files as $key => $value) {
            if ($key != 0 && $key != 1) {
                if (strpos($value, '.php')) {
                    $view_page = str_replace('.php', '', $value);
                    $view_list[$view_page] = $view_page;
                }
            }
        }

        $crud->field_type('view', 'dropdown', $view_list);
        $crud->callback_field('breadcrumb', array($this, 'breadcrumb_callback'));
        $crud->callback_field('template', array($this, 'template_page'));
        $crud->callback_before_insert(array($this, 'slug_page_check'));
        $crud->callback_before_update(array($this, 'slug_page_check'));
        $crud->callback_column('slug', array($this, 'slug_page_link'));
        $crud->callback_column('export_Method', array($this, 'export_php_callback'));
        $crud->set_field_upload('featured_image', 'assets/uploads/thumbnail');
        $crud->callback_after_upload(array($this, 'featured_upload'));

        // Misc
        $crud->columns('title', 'template', 'export_Method', 'slug');
        $crud->required_fields('title', 'slug', 'view');
        $crud->display_as('slug', 'Link');
        $crud->unset_texteditor('description', 'full_text');
        $crud->unset_export();
        $crud->unset_print();
        $crud->unset_read();
        $crud->add_action('View', 'fa fa-eye', '', '', array($this, 'link_view_page'));

        $crud->set_theme('flexigrid');
        $data = (array) $crud->render();

        $this->output_view->set_privilege(1);
        $this->output_view->set_wrapper('page', 'grocery_builder', $data, false);
        $this->output_view->auth();

        // CSS and JS plugins
        $template_data['css_plugins'] = [
            base_url('assets/plugins/iCheck/skins/square/blue.css'),
        ];
        $template_data['js_plugins'] = [
            base_url('assets/plugins/iCheck/icheck.min.js'),
            base_url('assets/js/builder.js?v=1'),
        ];
        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];
        $template_data['judul'] = 'Page Builder';
        $template_data['crumb'] = [
            'Page Builder' => '',
        ];
        $template = $this->admin_template;
        $this->output_view->output($template, $template_data);
    }

    /**
     * Featured image upload compress.
     *
     * @return Image
     **/
    public function featured_upload($uploader_response, $field_info, $files_to_upload)
    {
        $this->load->library('image_moo');
        $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name;

        $this->image_moo->load($file_uploaded)->resize_crop(350, 200)->save($file_uploaded, true);

        return true;
    }

    /**
     * Link view generated page.
     *
     * @return string
     **/
    public function link_view_page($primary_key, $row)
    {
        $this->db->where('id_page', $primary_key);
        $get_slug = $this->db->get('page')->row()->slug;

        return site_url('page').'/'.$get_slug;
    }

    /**
     * Callback input radio Template Frontend or Backend.
     *
     * @return HTML
     **/
    public function template_page($value = '', $primary_key = null)
    {
        $checked['front'] = '';
        $checked['back'] = '';
        if ($value != '') {
            switch ($value) {
                case 'frontend':
                    $checked['front'] = 'checked="checked"';
                    break;
                case 'backend':
                    $checked['back'] = 'checked="checked"';
                    break;
            }
        } else {
            $checked['front'] = 'checked="checked"';
        }
        $front = '<label><input type="radio" name="template" value="frontend" '.$checked['front'].' class="check"> Frontend</label>';
        $back = '<label><input type="radio" name="template" value="backend" '.$checked['back'].' class="check"> Backend</label>';

        return '<div class="radio">'.$front.$back.'</div>';
    }

    /**
     * Callback Slug if exist.
     *
     * @return array
     **/
    public function slug_page_check($post_array, $primary_key)
    {
        $slug = $post_array['slug'];
        $lower = strtolower($slug);
        $slug = str_replace(' ', '-', $lower);

        $this->db->where('slug', $slug);
        $get = $this->db->get('page');
        if ($get->num_rows() != 0) {
            if ($get->row()->id_page != $primary_key) {
                $slug = $slug.$get->num_rows();
            }
        }
        $post_array['slug'] = $slug;

        // Option breadcrumb link
        foreach ($post_array['label'] as $key => $value) {
            if ($value != '') {
                $link = $post_array['link'][$key] != '' ? $post_array['link'][$key] : '';
                $crumbArray[] = ['label' => $value, 'link' => $link];
            }
        }
        $post_array['breadcrumb'] = json_encode($crumbArray);

        return $post_array;
    }

    /**
     * Link slug use in menu.
     *
     * @return string
     **/
    public function slug_page_link($value, $row)
    {
        return $this->template_link('page/'.$value);
    }

    /**
     * Template link.
     *
     * @return HTML
     **/
    public function template_link($link)
    {
        return '<div class="link"><a class="copy-link"><i class="fa fa-copy"></i></a> <input type="text" class="form-link" value="'.$link.'" ></div>';
    }

    /**
     * Custom page backend.
     *
     * @return HTML
     **/
    public function page($slug)
    {
        $this->db->where('slug', $slug);
        $data['content'] = $this->db->get('page')->row();

        if ($data['content']) {
            $template_data['judul'] = $data['content']->title;
            if ($data['content']->breadcrumb != 'null') {
                $crumbs = json_decode($data['content']->breadcrumb);
                foreach ($crumbs as $value) {
                    $add_crumb[$value->label] = $value->link;
                }
            } else {
                $add_crumb['page'] = '';
            }
            $template_data['crumb'] = $add_crumb;

            // Set meta tags
            if ($data['content']->title != '') {
                $this->output_view->set_title($data['content']->title);
            }
            if ($data['content']->keyword != '') {
                $this->output_view->set_meta_tags('keyword', $data['content']->keyword);
            }
            if ($data['content']->description != '') {
                $this->output_view->set_meta_tags('description', $data['content']->description);
            }

            // Set schema
            $this->output_view->set_schema('og:site_name', $this->title);
            $this->output_view->set_schema('og:title', $data['content']->title);
            $image = $data['content']->featured_image != '' ? base_url('assets/uploads/thumbnail/'.$data['content']->featured_image) : base_url($this->logo);
            $this->output_view->set_schema('og:image', $image);
            if ($data['content']->description != '') {
                $this->output_view->set_schema('og:description', $data['content']->description);
            }

            // Template
            if ($data['content']->template == 'backend') {
                $template = $this->admin_template;
                $this->output_view->auth();
            } else {
                //$template = $this->front_template;
                //$template = $this->admin_template;
                $template = $this->youtubeanak_template;
            }

            // View wrapper
            if ($data['content']->view == 'default') {
                $this->output_view->set_wrapper('page', 'page', $data);
            } else {
                $this->output_view->set_wrapper('page', 'page/'.$data['content']->view, $data);
            }

            $this->output_view->output($template, $template_data);
        } else {
            show_404();
        }
    }

    /**
     * CRUD Builder.
     *
     * @return HTML
     **/
    public function crud_builder()
    {
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('table');
        $crud->set_subject('Table');
        $crud->required_fields('table_name', 'subject', 'title');

        // All callback
        $crud->callback_field('breadcrumb', array($this, 'breadcrumb_callback'));
        $crud->callback_field('required', array($this, 'required_callback'));
        $crud->callback_field('columns', array($this, 'columns_callback'));
        $crud->callback_field('field', array($this, 'field_callback'));
        $crud->callback_field('uploads', array($this, 'upload_callback'));
        $crud->callback_field('multiuploads', array($this, 'multiupload_callback'));
        $crud->callback_field('relation_1', array($this, 'relation_1_callback'));
        $crud->callback_field('action', array($this, 'action_callback'));
        $crud->callback_column('export_Method', array($this, 'export_php_callback'));

        // Trigger save
        $crud->callback_before_insert(array($this, 'table_options_save'));
        $crud->callback_before_update(array($this, 'table_options_save'));

        // Misc
        $crud->callback_column('link', array($this, 'link_table'));
        $crud->unset_read();
        $crud->unset_export();
        $crud->unset_print();
        $crud->columns('title', 'table_name', 'export_Method', 'link');
        $crud->add_action('View', 'fa fa-eye', '', '', array($this, 'link_view_table'));
        $crud->display_as('relation_1', 'Relation 1-n');

        $get_tables = $this->db->list_tables();
        $tables = array_diff($get_tables, ['table', 'menu', 'groups', 'groups_menu', 'login_attempts', 'users', 'users_groups', 'page']);
        foreach ($tables as $value) {
            $list_tables[$value] = $value;
        }
        $crud->field_type('table_name', 'dropdown', $list_tables);

        $crud->set_theme('flexigrid');
        $data = (array) $crud->render();

        // CSS and JS plugins
        $template_data['css_plugins'] = [base_url('assets/plugins/iCheck/skins/square/blue.css')];
        $template_data['js_plugins'] = [
            base_url('assets/plugins/iCheck/icheck.min.js'),
            base_url('assets/js/builder.js?v=1'),
        ];

        $this->output_view->set_privilege(1);
        $this->output_view->set_wrapper('page', 'grocery_builder', $data, false);
        $this->output_view->auth();

        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];
        $template_data['judul'] = 'CRUD Builder';
        $template_data['crumb'] = [
            'CRUD Builder' => '',
        ];
        $template = $this->admin_template;
        $this->output_view->output($template, $template_data);
    }

    /**
     * List tables in select option.
     *
     * @return HTML
     **/
    public function list_fields($value = '', $primary_key = '')
    {
        $selectedCol = '';
        if ($primary_key != '') {
            $this->db->where('id_table', $primary_key);
            $table_name = $this->db->get('table')->row()->table_name;
            $columns = $value != '' ? json_decode($value) : [];
            if ($table_name) {
                $list_tables = $this->db->list_fields($table_name);
                $selected = '';
                foreach ($list_tables as $value) {
                    $selected = in_array($value, $columns) ? 'selected="selected"' : '';
                    $selectedCol .= '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                }
            }
        }

        return $selectedCol;
    }

    /**
     * Ajax list table.
     *
     * @return HTML
     **/
    public function get_list_fields($table)
    {
        echo '<option></option>';
        $list_tables = $this->db->list_fields($table);
        foreach ($list_tables as $value) {
            echo '<option value="'.$value.'">'.$value.'</option>';
        }
    }

    /**
     * Form select multiple required to view.
     *
     * @return HTML
     **/
    public function required_callback($value = '', $primary_key = null)
    {
        return '<select name="required[]" data-placeholder="Select required field" class="listTables chosen-select" multiple="multiple">'.$this->list_fields($value, $primary_key).'</select>';
    }

    /**
     * Form select multiple field.
     *
     * @return HTML
     **/
    public function field_callback($value = '', $primary_key = null)
    {
        return '<select name="field[]" data-placeholder="Select field" class="listTables chosen-select" multiple="multiple">'.$this->list_fields($value, $primary_key).'</select>';
    }

    /**
     * Form select multiple column to view.
     *
     * @return HTML
     **/
    public function columns_callback($value = '', $primary_key = null)
    {
        return '<select name="columns[]" data-placeholder="Select columns" class="listTables chosen-select" multiple="multiple">'.$this->list_fields($value, $primary_key).'</select>';
    }

    /**
     * Form select multiple field upload.
     *
     * @return HTML
     **/
    public function upload_callback($value = '', $primary_key = null)
    {
        return '<select name="uploads[]" data-placeholder="Select upload field" class="listTables chosen-select" multiple="multiple">'.$this->list_fields($value, $primary_key).'</select>';
    }


    /**
     * Form select multiple field upload.
     *
     * @return HTML
     **/
    public function multiupload_callback($value = '', $primary_key = null)
    {
        return '<select name="multiuploads[]" data-placeholder="Select upload field" class="listTables chosen-select" multiple="multiple">'.$this->list_fields($value, $primary_key).'</select>';
    }

    /**
     * Form select field relation 1-n.
     *
     * @return HTML
     **/
    public function relation_1_callback($value = '', $primary_key = null)
    {
        if ($value != 'null' && $value != '') {
            $list_form = json_decode($value);

            foreach ($list_form as $form) {
                $list_form_view[] = ['field' => $form->field, 'table_name' => $form->table_name, 'field_view' => $form->field_view];
            }
        } else {
            $list_form_view[] = ['field' => '', 'table_name' => '', 'field_view' => ''];
        }

        $include = '';
        foreach ($list_form_view as $form_field) {
            $field = '<div class="col-xs-4"><input type="text" name="relation_1_field[]" value="'.$form_field['field'].'" placeholder="Field" class="form-control"><br></div>';
            $table_name = '<div class="col-xs-3"><input type="text" name="relation_1_table_name[]" value="'.$form_field['table_name'].'" placeholder="Related table" class="form-control"><br></div>';
            $field_view = '<div class="col-xs-3"><input type="text" name="relation_1_field_view[]" value="'.$form_field['field_view'].'" placeholder="Related view field" class="form-control"><br></div>';
            $remove_btn = '<div class="col-xs-2"><button type="button" class="remove-relation-1 btn btn-danger btn-flat btn-block"><i class="fa fa-times-circle"></i></button><br></div>';
            $include .= '<div class="row form-relation1">'.$field.$table_name.$field_view.$remove_btn.'</div>';
        }
        $add_btn = '<button type="button" class="btn btn-default btn-sm btn-block btn-flat" id="addRelation1"><i class="fa fa-plus-circle"></i> Add Relation</button>';

        return $include.$add_btn;
    }

    /**
     * Action table.
     *
     * @return HTML
     **/
    public function action_callback($value = '', $primary_key = null)
    {
        if ($value != '') {
            $check = json_decode($value);
        }

        $crud = ['Create', 'Read', 'Update', 'Delete'];
        $form = '';
        $form .= '<input type="text" name="action[]" value="Action" class="hidden">';
        foreach ($crud as $action) {
            if (isset($check)) {
                if (in_array($action, $check)) {
                    $checked = 'checked="checked"';
                } else {
                    $checked = '';
                }
            } else {
                $checked = 'checked="checked"';
            }
            $form .= '<label><input type="checkbox" name="action[]" value="'.$action.'" '.$checked.' class="check"> '.$action.'</label>';
        }

        return '<div class="checkbox">'.$form.'</div>';
    }

    /**
     * Return form.
     *
     * @return HTML
     **/
    public function breadcrumb_callback($value = '', $primary_key = null)
    {
        $crumbContent = '<div class="breadcrumb-content">';
        $listCrumb = '';
        $endCrumbContent = '</div><button type="button" class="btn btn-default btn-sm btn-block btn-flat" id="addBreadcrumb"><i class="fa fa-plus-circle"></i> Add Breadcrumb</button>';

        if ($value != 'NULL' && $value != '') {
            $decodeCrumb = json_decode($value);
            if ($decodeCrumb) {
                foreach ($decodeCrumb as $value) {
                    $listCrumb .= $this->breadcrumb_form($value->label, $value->link);
                }
            } else {
                $listCrumb = $this->breadcrumb_form('', '');
            }
        } else {
            $listCrumb .= $this->breadcrumb_form();
        }

        return $crumbContent.$listCrumb.$endCrumbContent;
    }

    /**
     * Return input breadcrumb.
     *
     * @return HTML
     **/
    public function breadcrumb_form($val_label = '', $val_link = '')
    {
        $crumbItem = '<div class="row form-breadcrumb">
						<div class="col-xs-4">						
							<input type="text" name="label[]" value="'.$val_label.'" id="inputLabel" class="form-control" placeholder="Label">
							<br>
						</div>
						<div class="col-xs-6">
							<input type="text" name="link[]" value="'.$val_link.'" id="inputLabel" class="form-control" placeholder="Link">
							<br>
						</div>
						<div class="col-xs-2">
							<button type="button" class="remove-crumb btn btn-danger btn-flat btn-block"><i class="fa fa-times-circle"></i></button>
							<br>
						</div>
					</div>';

        return $crumbItem;
    }

    /**
     * Save custom option table.
     *
     * @return json
     **/
    public function table_options_save($post_array)
    {
        // Field return JSON
        $fields_json = ['columns', 'field', 'required', 'uploads', 'multiuploads','relation_1', 'action'];
        foreach ($fields_json as $field) {
            if (isset($post_array[$field])) {
                foreach ($post_array[$field] as $key => $value) {
                    $fields[] = $value;
                }
                $post_array[$field] = json_encode($fields);
            } else {
                $post_array[$field] = '';
            }
            unset($fields);
        }

        // Option breadcrumb link
        foreach ($post_array['label'] as $key => $value) {
            if ($value != '') {
                $link = $post_array['link'][$key] != '' ? $post_array['link'][$key] : '';
                $crumbArray[] = ['label' => $value, 'link' => $link];
            }
        }
        $post_array['breadcrumb'] = json_encode($crumbArray);

        // Option Relation 1-n
        foreach ($post_array['relation_1_field'] as $key => $value) {
            if ($value != '') {
                $relation1Array[] = ['field' => $value, 'table_name' => $post_array['relation_1_table_name'][$key], 'field_view' => $post_array['relation_1_field_view'][$key]];
            }
        }
        $post_array['relation_1'] = json_encode($relation1Array);

        return $post_array;
    }

    /**
     * Link view generated table.
     *
     * @return string
     **/
    public function link_view_table($primary_key, $row)
    {
        return site_url('sketsanet/table').'/'.$row->table_name;
    }

    /**
     * Column link.
     *
     * @return string
     **/
    public function link_table($value, $row)
    {
        return $this->template_link('sketsanet/table/'.$row->table_name);
    }

    /**
     * Modal Export to PHP.
     *
     * @return string
     **/
    public function export_php_callback($value, $row)
    {
        if (isset($row->id_table)) {
            $id = $row->id_table;
            $builder = 'table';
        } else {
            $id = $row->id_page;
            $builder = 'page';
        }

        return '<a href="#exportPHP" data-id="'.$id.'" data-builder="'.$builder.'" data-toggle="modal" class="btn-php btn btn-success btn-xs"><i class="fa fa-code"></i> PHP</a>';
    }

    /**
     * Ajax get PHP Code from CRUD Builder.
     *
     * @return HTML
     **/
    public function export_php($id, $builder)
    {
        $data['admin_template'] = $this->admin_template;
        $data['front_template'] = $this->front_template;
        if ($builder == 'table') {
            $this->db->where('id_table', $id);
            $data['table'] = $this->db->get('table')->row();
            echo $this->load->view('export_php', $data, true);
        } else {
            $this->db->where('id_page', $id);
            $data['page'] = $this->db->get('page')->row();
            echo $this->load->view('export_php_page', $data, true);
        }
    }

    /**
     * View table generated.
     *
     * @return HTML
     **/
    public function table($table_name = null)
    {
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

        $this->output_view->set_wrapper('page', 'grocery', $data, false);
        $this->output_view->auth();

        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];

        $template_data['judul'] = $table->title;
        $template_data['crumb'] = $add_crumb;
        $template = $this->admin_template;

        //print_r($template_data);
       $this->output_view->output($template, $template_data);
    }

    /**
     * Modules management.
     *
     * @return HTML
     **/
    public function modules()
    {
        $dir = '.'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'modules';
        $data['modules'] = scandir($dir);

        $template_data['judul'] = 'Module Extensions';
        $template_data['crumb'] = array('Module Extensions' => '');

        $this->output_view->set_privilege(1);
        $template = $this->admin_template;
        $this->output_view->set_wrapper('page', 'modules', $data);
        $this->output_view->auth();
        $this->output_view->output($template, $template_data);
    }

    /**
     * Install module.
     **/
    public function module_install()
    {
        $config['upload_path'] = './assets/uploads/module/';
        $config['allowed_types'] = 'zip';
        $config['max_size'] = '';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('module')) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];
        } else {
            $data = array('upload_data' => $this->upload->data());
            $zip = new ZipArchive();
            $file = $data['upload_data']['full_path'];
            chmod($file, 0777);
            if ($zip->open($file) === true) {
                $zip->extractTo('./application/modules/');
                $zip->close();
                unlink('./assets/uploads/module/'.$data['upload_data']['file_name']);
                redirect('sketsanet/modules');
            } else {
                echo 'failed';
            }
        }
    }

    /**
     * Module detail.
     *
     * @return HTML
     **/
    public function module_detail($path)
    {
        //echo $path;
        if ($this->load->module($path)) {
            $module = modules::run($path.'/module');
            $data['module'] = $module;
        }

        $template = $this->admin_template;
        $this->output_view->set_wrapper('page', 'module_detail', $data);
        $this->output_view->auth();

        $template_data['judul'] = 'Module Detail';
        $template_data['crumb'] = [
            'Module Extensions' => 'sketsanet/modules',
            'Module Detail' => '',
        ];
        $this->output_view->output($template, $template_data);
    }

    /**
     * Delete modules directory and files.
     **/
    public function module_delete($path)
    {
        $dir = '.'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$path;
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
        redirect('sketsanet/modules');
    }

    /**
     * Crud user management.
     *
     * @return HTML
     **/
    public function users()
    {
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('users');
        $crud->set_subject('Users');

        $this->load->config('grocery_crud');
        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');

        $crud->columns('username', 'email', 'groups', 'active');
        if ($this->uri->segment(3) !== 'read') {
            $crud->add_fields('username', 'photo', 'full_name', 'email', 'groups', 'password', 'password_confirm');
            $admin_group = $this->config->item('admin_group', 'ion_auth');
            if ($this->ion_auth->in_group($admin_group)) {
                $crud->edit_fields('username', 'photo', 'full_name', 'email', 'groups', 'last_login', 'old_password', 'new_password');
                $crud->set_relation_n_n('groups', 'users_groups', 'groups', 'user_id', 'group_id', 'name');
            } else {
                $crud->edit_fields('username', 'photo', 'full_name', 'email', 'last_login', 'old_password', 'new_password');
            }
        } else {
            $crud->set_read_fields('username', 'photo', 'full_name', 'email', 'last_login');
        }
        $crud->callback_column('groups', array($this, 'groups_users'));

        // Validation
        $crud->required_fields('us ername', 'full_name', 'email', 'password', 'password_confirm');
        $crud->set_rules('email', 'E-mail', 'required|valid_email');
        $crud->set_rules('password', 'Password', 'required|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']|matches[password_confirm]');
        $crud->set_rules('new_password', 'New password', 'min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']');

        // Field types
        $crud->change_field_type('last_login', 'readonly');
        $crud->change_field_type('password', 'password');
        $crud->change_field_type('password_confirm', 'password');
        $crud->change_field_type('old_password', 'password');
        $crud->change_field_type('new_password', 'password');
        $crud->set_field_upload('photo', 'assets/uploads/image');

        // Callbacks
        $crud->callback_insert(array($this, 'create_user_callback'));
        $crud->callback_update(array($this, 'edit_user_callback'));
        $crud->callback_field('last_login', array($this, 'last_login_callback'));
        $crud->callback_column('active', array($this, 'active_callback'));
        $crud->callback_after_upload(array($this, 'avatar_upload'));

        if ($this->uri->segment(3) == 'profile') {
            $crud->unset_back_to_list();
        }
        $crud->set_theme('flexigrid');

        $data = (array) $crud->render();
        if ($this->uri->segment(4) != 'edit' || $this->uri->segment(5) != $this->ion_auth->user()->row()->id) {
            $this->output_view->set_privilege(1);
        }
        $template = $this->admin_template;
        $this->output_view->set_wrapper('page', 'grocery', $data, false);
        $this->output_view->auth();

        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];

        $template_data['judul'] = 'Users';
        $template_data['crumb'] = [
            'Users' => '',
        ];
        $this->output_view->output($template, $template_data);
    }

    /**
     * Call back groups.
     *
     * @param string $value
     * @param string $row
     *
     * @return Groups
     */
    public function groups_users($value, $row)
    {
        $this->db->where('user_id', $row->id);
        $users_groups = $this->db->get('users_groups')->result();
        foreach ($users_groups as $value) {
            $id_groups[] = $value->group_id;
        }
        $this->db->where('id in('.implode(',', $id_groups).')');
        $groups = $this->db->get('groups')->result();
        foreach ($groups as $value) {
            $groups_name[] = $value->name;
        }

        return implode(', ', $groups_name);
    }

    /**
     * Avatar upload compress.
     *
     * @return Image
     **/
    public function avatar_upload($uploader_response, $field_info, $files_to_upload)
    {
        $this->load->library('image_moo');
        $file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name;

        $this->image_moo->load($file_uploaded)->resize_crop(160, 160)->save($file_uploaded, true);

        return true;
    }

    /**
     * Crud users group.
     *
     * @return HTML
     **/
    public function groups()
    {
        $this->load->library('Grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('groups');
        $crud->set_subject('Groups');
        $crud->set_theme('flexigrid');

        $data = (array) $crud->render();

        $this->output_view->set_privilege(1);
        $template = $this->admin_template;
        $this->output_view->set_wrapper('page', 'grocery', $data, false);
        $this->output_view->auth();

        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];

        $template_data['judul'] = 'Groups';
        $template_data['crumb'] = [
            'Groups' => '',
        ];
        $this->output_view->output($template, $template_data);
    }

    /**
     * Callback active or inactive user.
     *
     * @return HTML
     **/
    public function active_callback($value, $row)
    {
        if ($value == 1) {
            $val = 'active';
        } else {
            $val = 'inactive';
        }

        return "<a href='".site_url('sketsanet/manual_activate/'.$row->id.'/'.$value)."'>$val</a>";
    }

    /**
     * Redirect link after trigger active or deactive user.
     *
     * @return Rerirect
     **/
    public function manual_activate($id, $value)
    {
        if ($value == 1) {
            $this->ion_auth->deactivate($id);
        } else {
            $this->ion_auth->activate($id);
        }

        redirect('sketsanet/users');
    }

    /**
     * Callback date & time last login user.
     *
     * @return string
     **/
    public function last_login_callback($value = '', $primary_key = null)
    {
        $value = date('l Y/m/d H:i', $value);

        return $value;
    }

    /**
     * Delete user.
     *
     * @return bool
     **/
    public function delete_user($primary_key)
    {
        if ($this->ion_auth_model->delete_user($primary_key)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Callback manual edit user.
     *
     * @return bool
     **/
    public function edit_user_callback($post_array, $primary_key)
    {
        $identity = $post_array[$this->config->item('identity', 'ion_auth')];
        $groups = $post_array['groups'];
        $old = $post_array['old_password'];
        $new = $post_array['new_password'];
        $data = array(
            'username' => $post_array['username'],
            'email' => $post_array['email'],
            'full_name' => $post_array['full_name'],
            'photo' => $post_array['photo'],
        );
        if ($old != '') {
            $change = $this->ion_auth->update($primary_key, $data) && $this->ion_auth->change_password($identity, $old, $new) && $this->ion_auth->remove_from_group('', $primary_key);
        } else {
            $change = $this->ion_auth->update($primary_key, $data) && $this->ion_auth->remove_from_group('', $primary_key);
        }

        $this->addGroups($groups, $primary_key);

        if ($change) {
            return true;
        } else {
            return false;
        }
    }

    public function addGroups($groups, $primary_key)
    {
        if ($groups) {
            foreach ($groups as $value) {
                $this->ion_auth->add_to_group($value, $primary_key);
            }
        }
    }

    /**
     * Callback manual add user.
     *
     * @return bool
     **/
    public function create_user_callback($post_array, $primary_key = null)
    {
        $username = $post_array['username'];
        $password = $post_array['password'];
        $email = $post_array['email'];
        $group = $post_array['groups'];
        $data = array(
                    'full_name' => $post_array['full_name'],
                    'photo' => $post_array['photo'],
                );

        return $this->ion_auth->register($username, $password, $email, $data, $group);
    }

    /**
     * Form route load first page.
     *
     * @return HTML
     **/
    public function route_index($value = '', $primary_key = null)
    {
        $checked_page = '';
        $checked_login = '';
        $val = json_decode($value);
        foreach ($val as $key => $value) {
            switch ($key) {
                case 'page':
                    $checked_page = 'checked="checked"';
                    $val_page = $value;
                    break;
                case 'login':
                    $checked_login = 'checked="checked"';
                    break;
                default:
                    $checked_login = 'checked="checked"';
                    break;
            }
        }
        $page = '<label><input type="radio" id="page" name="option_index" value="page" '.$checked_page.' class="check"> Page</label>';
        $login = '<label><input type="radio" name="option_index" value="login" '.$checked_login.' class="check"> Login</label>';

        if ($checked_page != '') {
            return '<div class="radio">'.$page.$login.'</div><br><div id="formPage">'.$this->ajax_form_page($val_page).'</div>';
        } else {
            return '<div class="radio">'.$page.$login.'</div><br><div id="formPage"></div>';
        }
    }

    /**
     * Ajax load form list of page.
     *
     * @return HTML
     **/
    public function ajax_form_page($return = null)
    {
        $page = $this->db->get('page')->result();
        $option = '<option></option>';
        foreach ($page as $value) {
            if ($return != null) {
                if ($value->slug == $return) {
                    $option .= '<option value="'.$value->slug.'" selected="selected">'.$value->title.'</option>';
                } else {
                    $option .= '<option value="'.$value->slug.'">'.$value->title.'</option>';
                }
            } else {
                $option .= '<option value="'.$value->slug.'">'.$value->title.'</option>';
            }
        }
        if ($return != null) {
            return '<br><select name="page" data-placeholder="Select page" class="listPages chosen-select">'.$option.'</select>';
        } else {
            echo '<br><select name="page" data-placeholder="Select page" class="listPages chosen-select">'.$option.'</select>';
        }
    }

    /**
     * Save setting route.
     *
     * @return JSON
     **/
    public function save_route($post_array)
    {
        $option = $post_array['option_index'];
        if ($option == 'page') {
            $page = $post_array['page'];
            $json[$option] = $page;
        } else {
            $json[$option] = 'null';
        }

        $post_array['route'] = json_encode($json);

        return $post_array;
    }

    /**
     * Crud menu type.
     *
     * @return HTML
     **/
    public function menu_type()
    {
        if ($this->uri->segment(4) == 'delete') {
            $id_menu_type = $this->uri->segment(5);
            $this->db->where('id_menu_type', $id_menu_type);
            $this->db->delete('menu_type');

            $this->db->where('id_menu_type', $id_menu_type);
            $menus = $this->db->get('menu')->result();
            foreach ($menus as $menu) {
                $this->db->where('id_menu', $menu->id_menu);
                $this->db->delete('groups_menu');
            }

            $this->db->where('id_menu_type', $id_menu_type);
            $this->db->delete('menu');

            $this->sort_menu_callback(0, $id_menu_type);
            redirect('sketsanet/menu/'.$this->uri->segment(3));
        } else {
            $crud = new grocery_CRUD();

            $crud->set_table('menu_type');
            $crud->set_subject('Menu Type');

            $data = (array) $crud->render();
            if ($this->uri->segment(4) != 'add' && $this->uri->segment(4) != 'edit') {
                redirect('sketsanet/menu/'.$this->uri->segment(3));
            }

            $template = $this->admin_template;
            $this->output_view->set_wrapper('page', 'grocery', $data, false);
            $this->output_view->auth();

            $template_data['grocery_css'] = $data['css_files'];
            $template_data['grocery_js'] = $data['js_files'];

            $template_data['judul'] = 'Menu';
            $template_data['crumb'] = [
                'Menu' => 'sketsanet/menu',
                'Menu Type' => '',
            ];
            $this->output_view->output($template, $template_data);
        }
    }

    /**
     * Crud multy level menu.
     *
     * @return HTML
     **/
    public function crud_menu()
    {
        if ($this->uri->segment(4) == 'delete') {
            $id_menu = $this->uri->segment(5);
            $this->db->where('id_menu', $id_menu);
            $this->db->delete('menu');

            $this->db->where('id_menu', $id_menu);
            $this->db->delete('groups_menu');

            // Delete Children
            $this->db->where('parent_id', $id_menu);
            $get_groups = $this->db->get('menu')->result();
            foreach ($get_groups as $menu) {
                $this->db->where('id_menu', $menu->id_menu);
                $this->db->delete('menu');
            }

            $this->db->where('parent_id', $id_menu);
            $this->db->delete('menu');

            $this->sort_menu_callback(0, $id_menu);
            redirect('sketsanet/menu/'.$this->uri->segment(3));
        } else {
            $this->load->library('Grocery_CRUD');
            $crud = new grocery_CRUD();

            $crud->set_table('menu');
            $crud->unset_fields('sort');
            $crud->display_as('parent_id', 'Parent')
                 ->display_as('id', 'ID');

            $crud->field_type('label', 'icon', 'link', 'parent_id', 'id');
            $crud->callback_before_insert(array($this, 'auto_level_menu'));
            $crud->callback_before_update(array($this, 'auto_level_menu'));
            $crud->callback_after_insert(array($this, 'sort_menu_callback'));
            $crud->callback_after_update(array($this, 'sort_menu_callback'));
            $crud->change_field_type('level', 'invisible');
            $crud->change_field_type('id_menu_type', 'invisible');
            $type = urldecode(str_replace('-', ' ', $this->uri->segment(3)));
            $this->db->where('type', $type);
            $get_id = $this->db->get('menu_type', $type)->row();
            if ($get_id) {
                $id_menu_type = $get_id->id_menu_type;
            } else {
                $id_menu_type = 1;
            }

            $crud->set_subject('Admin menu');
            $crud->set_relation_n_n('Privilage', 'groups_menu', 'groups', 'id_menu', 'id_groups', 'name');

            $this->db->order_by('sort', 'asc');
            $this->db->where('id_menu_type', $id_menu_type);
            $label_side_menu = $this->db->get('menu')->result();
            if ($label_side_menu) {
                foreach ($label_side_menu as $nav) {
                    $label[$nav->id_menu] = $nav->label;
                }
            } else {
                $label[] = '';
            }

            $crud->field_type('parent_id', 'dropdown', $label);

            $data = (array) $crud->render();
            if ($this->uri->segment(4) != 'add' && $this->uri->segment(4) != 'edit') {
                redirect('sketsanet/menu/'.$this->uri->segment(3));
            }

            $template = $this->admin_template;
            $this->output_view->set_wrapper('page', 'grocery', $data, false);
            $this->output_view->auth();

            $template_data['grocery_css'] = $data['css_files'];
            $template_data['grocery_js'] = $data['js_files'];
            $template_data['judul'] = 'Menu';
            $template_data['crumb'] = ['Menu' => ''];

            $this->output_view->output($template, $template_data);
        }
    }

    /**
     * Resort menu.
     *
     * @return bool
     **/
    public function sort_menu_callback($post_array, $primary_key)
    {
        $this->db->where('id_menu', $primary_key);
        $id_menu_type = $this->db->get('menu')->row()->id_menu_type;
        $menu_json = json_encode($this->menu_re_sort($id_menu_type));
        $this->update_menu($menu_json, false);

        return true;
    }

    /**
     * Callback Auto fill level menu.
     *
     * @return array
     **/
    public function auto_level_menu($post_array)
    {
        $type = urldecode(str_replace('-', ' ', $this->uri->segment(3)));
        $this->db->where('type', $type);
        $get_type = $this->db->get('menu_type')->row();
        if ($get_type) {
            $id_menu_type = $get_type->id_menu_type;
        } else {
            $id_menu_type = 1;
        }
        $post_array['id_menu_type'] = $id_menu_type;
        $level = 0;
        if (!$post_array['parent_id']) {
            $post_array['parent_id'] = 0;
            $post_array['level'] = $level;
        } else {
            $this->db->where('id_menu', $post_array['parent_id']);
            $get_level = $this->db->get('menu')->row()->level;

            $post_array['level'] = $get_level + 1;
        }

        return $post_array;
    }

    /**
     * Nestable drag & drop menu level & sort.
     *
     * @return HTML
     **/
    public function menu($type = 'side menu')
    {
        $data['menu_type'] = $this->db->get('menu_type')->result();
        $type = urldecode(str_replace('-', ' ', $type));
        $data['admin_menu'] = $this->get_menu($type);

        $template_data['css_plugins'] = [base_url('assets/plugins/jquery-nestable/jquery.nestable.css')];
        $template_data['js_plugins'] = [base_url('assets/plugins/jquery-nestable/jquery.nestable.js')];

        $this->output_view->set_privilege(1);
        $template = $this->admin_template;
        $this->output_view->set_wrapper('page', 'menu', $data);
        $this->output_view->auth();

        $template_data['judul'] = 'Menu';
        $template_data['crumb'] = [
            'Menu' => '',
        ];
        $this->output_view->output($template, $template_data);
    }

    /**
     * Get db menu nestable.
     *
     * @return string
     **/
    public function get_menu($type)
    {
        $this->db->where('type = "'.$type.'"');
        $this->db->join('menu_type', 'menu_type.id_menu_type = menu.id_menu_type', 'left');
        $this->db->order_by('sort', 'ASC');
        $menus = $this->db->get('menu')->result_array();

        return $this->get_nestable_menu($menus);
    }

    /**
     * Show list nestable menu.
     *
     * @return string
     **/
    public function get_nestable_menu($menus, $parent_id = 0)
    {
        $list_menu = '';
        foreach ($menus as $menu) {
            if ($parent_id == $menu['parent_id']) {
                $type = urldecode(str_replace(' ', '-', strtolower($menu['type'])));
                $list_menu .= '<li class="dd-item" data-id="'.$menu['id_menu'].'">
					<div class="dd-handle bg-light-blue"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i></div><p>'.$menu['label'].'
					<span class="dd-action">
						<a href="'.site_url('sketsanet/crud_menu/'.$type.'/edit/'.$menu['id_menu']).'" title="edit"><i class="fa fa-pencil"></i></a>
						<a href="'.site_url('sketsanet/crud_menu/'.$type.'/delete/'.$menu['id_menu']).'" title="Delete" class="delete-confirm"><i class="fa fa-trash"></i></a>
					</span></p>';
                $list_menu .= $this->get_nestable_menu($menus, $menu['id_menu']);
                $list_menu .= '</li>';
            }
        }

        if ($list_menu != '') {
            return '<ol class="dd-list">'.$list_menu.'</ol>';
        } else {
            return;
        }
    }

    /**
     * Re order SORT menu DB.
     *
     * @return array
     **/
    public function menu_re_sort($id_menu_type)
    {
        $this->db->where('id_menu_type = "'.$id_menu_type.'"');
        $this->db->order_by('sort', 'ASC');
        $menus = $this->db->get('menu')->result_array();

        return $this->get_re_sort($menus);
    }

    /**
     * Re order SORT menu.
     *
     * @return array
     **/
    public function get_re_sort($menus, $parent_id = 0)
    {
        $menu_array = null;
        foreach ($menus as $menu) {
            if ($parent_id == $menu['parent_id']) {
                $children = $this->get_re_sort($menus, $menu['id_menu']);
                if ($children) {
                    $menu_array[] = ['id' => $menu['id_menu'], 'children' => $children];
                } else {
                    $menu_array[] = ['id' => $menu['id_menu']];
                }
            }
        }

        return $menu_array;
    }

    /**
     * Update menu.
     *
     * @return redirect
     **/
    public function update_menu($menu = null, $return = true)
    {
        if ($menu == null) {
            $type = $this->input->post('type');
            $menu = $this->input->post('json_menu');
        }
        $decode = json_decode($menu);

        $this->decode_menu($decode);
        if ($return == true) {
            redirect('sketsanet/menu/'.$type);
        }
    }

    /**
     * Save menu into database.
     *
     * @return array
     **/
    public function decode_menu($menu, $parent_id = null, $level = null, $sort = null)
    {
        if ($parent_id == null && $level == null) {
            $parent_id = 0;
            if ($this->uri->segment(3) == 'side_menu') {
                $level = 0;
            } else {
                $level = 1;
            }
        }

        if ($sort == null) {
            $sort = 0;
        }
        foreach ($menu as $value) {
            $update_menu = ['sort' => $sort, 'id_menu' => $value->id, 'level' => $level, 'parent_id' => $parent_id];

            $this->db->where('id_menu', $value->id);
            $this->db->update('menu', $update_menu);
            ++$sort;

            if (isset($value->children)) {
                $sort = $this->decode_menu($value->children, $value->id, $level + 1, $sort);
            }
        }

        return $sort;
    }

    /**
     * Error 404.
     *
     * @return HTML
     **/
    public function page_404()
    {
        $this->output->set_status_header('404');
        $this->output_view->set_wrapper('page', 'error_page/error_404');

        $template = $this->front_template;
        $this->output_view->output($template);
    }


    public function tes()
    {


        $youtube = new Youtube(array('key' => 'AIzaSyDtO-MWa6qGOlPC3cXKkYfOcJiKSUQHMtk'));

      
        $channelQuery = $this->db->query('select * from channel');
       
      
        if($channelQuery->num_rows()>0)
        {

            foreach($channelQuery->result_array() as $row)
            {
                
                $dataChannelId = $row['channel_id'];
            
                $playlistsByChannel = $youtube->getPlaylistsByChannelId($dataChannelId);

      
       $youtubeVideoId = array();
        //$data['database'] = $this->db->database;

        //Pertama cari channel untuk dapatkan playlist_id
        foreach ($playlistsByChannel as $row) 
        {
            # code...
            $playlistID = $row->id;

            //Kedua lalu cari playlistitem untuk dapatkan video id
            //echo $playlistID.'</br>';
            $playlistItems = $youtube->getPlaylistItemsByPlaylistId($playlistID,10);
            //print_r($playlistItems);
            if(count($playlistItems)>0)
            {
                
                foreach ($playlistItems as $pl) {
                    
                    //Ini ambil gambar dulu aja, kalu di klik baru detail video
                    //$id =  $pl->contentDetails->videoId.'</br>';
                    $url = $pl->snippet->thumbnails->high->url;
                        
                           $video = $youtube->getVideoInfo($pl->contentDetails->videoId);
                         //print_r($video);
                    //array_push($youtubeVideoId, $url);

                           //insert video ke database
                           $videoId         = $video->id;
                           $channelId       = $video->snippet->channelId;
                           $title           = $video->snippet->title;
                           $channelTitle    = $video->snippet->channelTitle;
                           $description     = $video->snippet->description;


                      //Sebelum insert video ke database cek dulu apakah videoid itu sudah di insert ke database apa belum
                      
                      $cekVideoQuery = $this->db->query("select * from video where videoId = '".$videoId."' ");


                      if($cekVideoQuery->num_rows()==0)
                      {

                        $data = array(
                                'videoId' => $videoId,
                                'title' =>$title,
                                'channelId' => $channelId,
                                'channelTitle' => $channelTitle,
                                'description' => $description,
                                'image'=>$url
                            );

                    $this->db->insert('video', $data);


                      }
                    
                           
                }
                
                
            }

        } // end playlistbyChannel




            } //End Foreach channel query


        }// Check channel query num

       


        //print_r($youtubeVideoId);
           

           //echo $vid;
      
       // $data['urlImages'] = $youtubeVideoId;


        
        /*
       
        $this->output_view->set_wrapper('page', 'home_video', $data);

       $template = $this->youtubeanak_template;
        $this->output_view->output($template);

    */
        
        


    }



    //Untuk cari tau channel id youtube 
    public function tes2()
    {

         $youtube = new Youtube(array('key' => 'AIzaSyDtO-MWa6qGOlPC3cXKkYfOcJiKSUQHMtk'));

       
         $pl = $youtube->getChannelById('UCFxgOx-hpiKpEn5LLyBac9A');


         print_r($pl);
       
       


    }
}

/* End of file Crud.php */
/* Location: ./application/controllers/Crud.php */
