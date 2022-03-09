<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Users extends REST_Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'OPTIONS') {
            die();
        }
        parent::__construct();

        
    }

    public function register_post()
    {
        $this->config->load('indofxspot');
        $pwd_peppered = hash_hmac("sha256", $this->post('dt_password'), $this->config->item('passKey'));
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_DEFAULT);

        $data['dt_fname']      = $this->post('dt_fname');
        $data['dt_lname']      = $this->post('dt_lname');
        // $data['dt_username']   = $this->post('dt_username');
        $data['dt_password']   = $pwd_hashed;
        $data['dt_email']      = $this->post('dt_email');
        // $data['dt_phone']      = $this->post('dt_phone');
        // $data['dt_country']    = $this->post('dt_country');
        // $data['dt_city']       = $this->post('dt_city');
        $data['dt_address']    = $this->post('dt_address');
        // $data['dt_dob']        = $this->post('dt_dob');
        $data['dt_joinDate']   = date('Ymd');

        //CHECK USERNAME
        // $getUsername = $this->db->where('dt_username', $data['dt_username'])->get('customer')->num_rows();
        $getEmail = $this->db->where('dt_email', $data['dt_email'])->get('customer')->num_rows();

        if ($getEmail > 0) {
            $response['status'] = 'Failed';
            $response['message'] = 'Your email already exist';

            $this->response($response, 200);
        }
        else{
            $insert = $this->db->insert('customer', $data);

            if ($insert) {
                $response['status'] = 'Success';
                $response['message'] = 'Registration is successed';

                $this->response($response, 200);
            }else{
                $response['status'] = 'Failed';
                $response['message'] = 'Registration is failed, data failed to insert';

                $this->response($response, 200);
            }
        }
    }

    public function login_post()
    {
        $this->config->load('indofxspot');

        $data['dt_email']       = $this->post('dt_email');
        $data['dt_password']    = $this->post('dt_password');

        $cekUser = $this->db->where('dt_email', $data['dt_email'])->get('customer');

        if ($cekUser->num_rows() > 0) {

            $pwd_peppered = hash_hmac("sha256", $this->post('dt_password'), $this->config->item('passKey'));

            $row = $cekUser->row_array();

            if (password_verify($pwd_peppered, $row['dt_password'])) {
                $row['isLogedIn'] = true;
                $this->session->set_userdata('isLogedIn', true);
                $this->session->set_userdata('custId', $row['customer_id']);
                $this->session->set_userdata('firstName', $row['dt_fname']);
                $this->session->set_userdata('lastName', $row['dt_lname']);
                $this->session->set_userdata('custEmail', $row['dt_email']);
                unset($row['dt_password']);
                
                $loginLog = array(
                    'customer_id' => $row['customer_id'],
                    'ip_address' => $this->input->ip_address(),
                    'login' => session_id(),
                    'login_date' => date('Y-m-d H:i:s')
                );
                
                $this->db->insert('login_attempts', $loginLog);
            }

            $response['status'] = 'Success';
            $response['message'] = 'Member found';
            $response['data'] = $row;

            $this->response($response, 200);
        }else {
            $response['status'] = 'Failed';
            $response['message'] = 'No Data member found by this username';

            $this->response($response, 200);
        }
    }

    public function deposit_post()
    {
        $data['dt_fullname']    = $this->post('dt_fullname');
        $data['dt_email']       = $this->post('dt_email');
        $data['dt_noWallet']     = $this->post('dt_noWallet');
        $data['dt_bank']        = $this->post('dt_bank');
        $data['dt_noRekening']  = $this->post('dt_noRekening');
        $data['dt_depositIdr']  = $this->post('dt_depositIdr');
        $data['dt_depositUsd']  = $this->post('dt_depositUsd');
        $data['dt_depositDate'] = date('Y-m-d H:i:s');

        $insert = $this->db->insert('deposit', $data);

        if($insert) {
            $response['status'] = 'Success';
            $response['message'] = 'Deposit is successfully insert';

            $this->response($response, 200);
        }else{
            $response['status'] = 'Failed';
            $response['message'] = 'Deposit is failed to insert';

            $this->response($response, 200);
        }
    }

    public function withdraw_post()
    {

        $data['dt_withdrawal'] = $this->post('dt_withdrawal');
        $data['dt_noWallet']   = $this->post('dt_noWallet');
        $data['dt_namaKtp']    = $this->post('dt_namaKtp');
        $data['dt_email']      = $this->post('dt_email');
        $data['dt_bank']        = $this->post('dt_bank');
        $data['dt_noRekening']  = $this->post('dt_noRekening');
        $data['dt_withdrawDate'] = date('Y-m-d H:i:s');

        $insert = $this->db->insert('withdrawal', $data);

        if($insert) {
            $response['status'] = 'Success';
            $response['message'] = 'Deposit is successfully insert';

            $this->response($response, 200);
        }else{
            $response['status'] = 'Failed';
            $response['message'] = 'Deposit is failed to insert';

            $this->response($response, 200);
        }
    }

    /**
     * Table Name : api
     * GET, POST, PUT, DELETE.
     **/
    public function user_get()
    {
        if (!$this->get('id')) {
            $usersAll = $this->db->get('customer')->result();

            $response['status'] = 'Success';
            $response['message'] = 'Get data users';
            $response['data'] = $usersAll;

            $this->response($response, 200);

        } elseif ($this->get('id')) {

            $this->db->where('customer.customer_id', $this->get('id'));
            $user = $this->db->get('customer')->row();

            $loginAttempts = $this->db->where('customer_id', $user->customer_id)->order_by('login_date', 'DESC')->get('login_attempts', 1, 1)->row();

            $response['status'] = 'Success';
            $response['message'] = 'Get data user';
            $response['data'] = $user;
            $response['loginAttempts'] = $loginAttempts;

            $this->response($response, 200);

        } else {

            $this->response(['error' => 'Api could not be found'], 404);

        }
    }

    public function updateProfile_post()
    {

        if (!empty($_FILES['dt_avatar']['name'])) {

            $config['upload_path']      = './assets/images/';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = 2048;
            $config['file_name']        = random_string('alnum',6).$_FILES['dt_avatar']['name'];

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('dt_avatar'))
            {
                $response['status'] = 'Failed';
                $response['message'] = 'Update avatar user is failed';
                $response['error'] = array('error' => $this->upload->display_errors());
            }    
            else
            {
                $response['status'] = 'Success';
                $response['message'] = 'Update avatar user is successfully';
                $response['file'] = array('upload_data' => $this->upload->data());

                $this->db->where('customer_id', $this->post('customer_id'))->set(array('dt_avatar' => $config['file_name']))->update('customer');
            }

            $this->response($response, 200);

        }else{

            $customer_id           = $this->post('customer_id');
            $data['dt_phone']      = $this->post('dt_phone');
            $data['dt_country']    = $this->post('dt_country');
            $data['dt_city']       = $this->post('dt_city');
            $data['dt_address']    = $this->post('dt_address');
            $data['dt_dob']        = $this->post('dt_dob');

            $updateUser = $this->db->where('customer_id', $customer_id)->set($data)->update('customer');

            if ($updateUser) {

                $response['status'] = 'Success';
                $response['message'] = 'Update data user';

                $this->response($response, 200);

            }else{

                $response['status'] = 'Failed';
                $response['message'] = 'Update data user is failed';

                $this->response($response, 200);    
            }
        }
        
    }

    public function updatePassword_post()
    {
        $this->config->load('indofxspot');
        $pwd_peppered = hash_hmac("sha256", $this->post('dt_password'), $this->config->item('passKey'));
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_DEFAULT);
        
        $customer_id            = $this->post('customer_id');
        $data['dt_password']    = $pwd_hashed;

        $update = $this->db->where('customer_id', $customer_id)->set($data)->update('customer');

        if ($update) {
            $response['status'] = 'Success';
            $response['message'] = 'Update password user is successfully';
        }else{
            $response['status'] = 'Failed';
            $response['message'] = 'Update password user is failed';
        }
        
        $this->response($response, 200);
    }

    public function kurs_get()
    {
        $currentDate = date('Y-m-d');

        $getKurs = $this->db->where('start_date <=', $currentDate)->where('end_date >=', $currentDate)->get('admin_kurs');

        if ($getKurs->num_rows() > 0) {
            $response['status'] = 'Success';
            $response['message'] = 'Get data kurs';
            $response['data'] = $getKurs->row_array();

            $this->response($response, 200);
        }else {
            $response['status'] = 'Success';
            $response['message'] = 'Get data kurs';
            $response['data'] = (object)[];

            $this->response($response, 200);
        }
    }

    public function logout_get()
    {
        session_destroy();

        $response['status'] = 'Success';
        $response['message'] = 'You have been loging out';

        $this->response($response, 200);
    }

    public function user_put()
    {
        $api = array(
                        'name' => $this->put('name'),
                        'email' => $this->put('email'),
                    );

        if ($this->get('id')) {
            $this->db->where('id_api', $this->get('id'));
            $this->db->update('api', $api);
            $this->response(['message' => 'Success PUT'], 201);
        } else {
            $this->response(['error' => 'Api could not be found'], 404);
        }
    }

    public function user_delete()
    {
        if ($this->get('id')) {
            $this->db->where('id_api', $this->get('id'));
            $this->db->delete('api');
            $this->response(['message' => 'Success DELETE'], 201);
        } else {
            $this->response(['error' => 'Api could not be found'], 404);
        }
    }

    public function testEmail_get()
    {
        $this->load->model('Users_model', 'user');

        $email = $this->user->email($mailTo = 'toniewibowo@gmail.com', $subject='Test Email', $message = 'Test Email Isi', $mailFrom='admin@dripsweet.com', $mailName='No-reply');
        
        echo $email;
        // if ($email) {
        //     echo 'Terkirim';
        // }else{
        //     echo 'Tidak Terkirim';
        // }
    }
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
