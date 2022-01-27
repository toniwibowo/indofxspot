<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Payment extends REST_Controller{

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

    public function submit_post()
    {
        $data['customer_id'] = $this->session->userdata('custId');
        $data['dt_broker'] = $this->post('dt_broker');
        $data['dt_accName'] = $this->post('dt_accName');
        $data['dt_accNumber'] = $this->post('dt_accNumber');
        $data['dt_accType'] = $this->post('dt_accType');
        $data['dt_comment'] = $this->post('dt_comment');
        $data['dt_createDate'] = date('Y-m-d H:i:s');

        $checkAccNumber = $this->db->where('dt_accNumber', $data['dt_accNumber'])->get('admin_broker');

        if ($checkAccNumber->num_rows() > 0) {
            $response['status'] = 'Failed';
            $response['message'] = 'Account number already exist';

            $this->response($response, 200);
        }else{
            $insert = $this->db->insert('admin_broker', $data);

            if ($insert) {
                $response['status'] = 'Success';
                $response['message'] = 'Broker account has been succesfully submit';

                $this->response($response, 200);
            }else{
                $response['status'] = 'Failed';
                $response['message'] = 'Broker account has been failed submit';

                $this->response($response, 200);
            }
        }        
    }

    public function paymentMethod_get()
    {
        $getPaymentMethod = $this->db->order_by('name','ASC')->get('payment_method');

        $response['status']     = 'Success';
        $response['message']    = 'Payment has been succesfully loaded';
        $response['data']       = $getPaymentMethod->result();

        $this->response($response, 200);
    }

    public function addListPayment_post()
    {
        $customerId             = $this->session->userdata('custId');
        $data['payment_id']     = $this->post('payment_id');
        $data['bank_name']      = $this->post('bank_name');
        $data['bank_account']   = $this->post('bank_account');
        $data['holder_name']    = $this->post('holder_name');

        // CHECK PAYMENT ID EXIST
        $checkPaymentID = $this->db->where('customer_id', $customerId)->where('payment_id', $data['payment_id'])->get('customer_payment_system');

        if ($checkPaymentID->num_rows() === 0) {
            $this->db->insert('customer_payment_system', array('customer_id' => $data['customer_id'], 'payment_id' => $data['payment_id']));
        }

        // CHECK DOUBLE ACCOUNT
        $checkDoubleAccount = $this->db->where('bank_account', $data['bank_account'])->where('payment_id', $data['payment_id'])->get('payment_list');

        if ($checkDoubleAccount->num_rows() > 0) {
            $response['status']     = 'Failed';
            $response['message']    = 'Your payment bank account has been exist';

            $this->response($response, 200);
        }else{
            $insert = $this->db->insert('payment_list', $data);

            if ($insert) {
                $response['status']     = 'Success';
                $response['message']    = 'Payment method has been successfully inserted';

                $this->response($response, 200);
            }else{
                $response['status']     = 'Failed';
                $response['message']    = 'Payment method has been failed insert';

                $this->response($response, 422);
            }
        }
    }

    public function getListPayment_get()
    {
        if ($this->get('id')) {
            $getCustPaymentMethod = $this->db->where('customer_id', $this->get('id'))->get('customer_payment_system');
            if ($getCustPaymentMethod->num_rows() > 0) {
                $dataListingPayment = array();
                foreach ($getCustPaymentMethod->result_array() as $key => $value) {
                    $getListPayment = $this->db->where('payment_id', $value['payment_id'])->get('payment_list');
                    if ($getListPayment->num_rows() > 0) {
                        $dataListingPayment[] = $getListPayment->result(); 
                    }
                }

                $response['status']     = 'Success';
                $response['message']    = 'Payment list has been successfully loaded';
                $response['data']       = $dataListingPayment;

                $this->response($response, 200);
            }else{
                $response['status']     = 'Success';
                $response['message']    = 'Payment list has been successfully loaded';
                $response['data']       = [];

                $this->response($response, 200);
            }
        }
    }

    public function getPaymentNotes_get()
    {
        $getPaymentNotes = $this->db->where('pages_id', 6)->get('pages');

        if ($getPaymentNotes->num_rows() > 0) {
            $response['status']     = 'Success';
            $response['message']    = 'Page note list has been successfully loaded';
            $response['data']       = $getPaymentNotes->row();

            $this->response($response, 200);
        }else{
            $response['status']     = 'Success';
            $response['message']    = 'Page note list has been successfully loaded';
            $response['data']       = (object)[];

            $this->response($response, 200);
        }
    }

}