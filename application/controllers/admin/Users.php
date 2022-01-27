<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Name : Sketsa.cms base controller.
 *
 * @version 3.8.2
 *
 * @author : Arief Budiyono
 */
class Users extends MX_Controller
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
        //$this->youtubeanak_template = $template['youtubeanak_template'];

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

        //echo $this->uri->segment(3);
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



    function test()
    {
        $old = 'password';
        $new = 'sketsa88';
        $identity = 'admin@admin.com';

        //print_r(expression)

       // if($this->ion_auth->change_password($identity, $old, $new))
       // {
       //  echo 'Ganti Password berhasil';
       // }else{

       //  echo 'Ganti Password Gagal';
       // }

        print_r($this->ion_auth->change_password($identity, $old, $new));

    }

}
