<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Rebates extends REST_Controller{

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

    public function getDataRebates_get()
    {

        if ($this->get('id')) {
            $query = $this->db->where('rebate_id', $this->get('id'))->get('wallet');
            $response['status'] = 'Success';
            $response['message'] = 'Get data rebates by id';
            $response['data'] = $query->num_rows() > 0 ? $query->row() : (object)array();

            $this->response($response, 200);
        }elseif ($this->get('limit')) {

            $query = $this->db->where('wallet.is_counting', 0)->where('customer.customer_id', $this->session->userdata('custId'))->where('admin_broker.dt_status','Validated')->where('customer.status','active')->order_by('date_order', 'DESC')->limit($this->get('limit'))->from('wallet')->join('admin_broker','admin_broker.dt_accNumber = wallet.account_number')->join('admin_account_type','admin_broker.account_type_id = admin_account_type.account_type_id')->join('customer','customer.customer_id = admin_broker.customer_id')->get();
            $response['status'] = 'Success';
            $response['message'] = 'Get data rebates by limit';
            $response['data'] = $query->result();

            $this->response($response, 200);
        } else{
            $query = $this->db->where('wallet.is_counting', 0)->where('customer.customer_id', $this->session->userdata('custId'))->where('admin_broker.dt_status','Validated')->where('customer.status','active')->order_by('date_order', 'DESC')->from('wallet')->join('admin_broker','admin_broker.dt_accNumber = wallet.account_number')->join('admin_account_type','admin_broker.account_type_id = admin_account_type.account_type_id')->join('customer','customer.customer_id = admin_broker.customer_id')->get();
            $response['status'] = 'Success';
            $response['message'] = 'Get all data rebates';
            $response['data'] = $query->result();

            $this->response($response, 200);    
        }        
    }

    public function rebateBalance_post(Type $var = null)
    {
        $this->load->model('Rebates_model','rebate');
        
        $data['customer_id']    = $this->post('customer_id');
        $data['rbt_balance']    = $this->post('rbt_balance');
        $data['rbt_date']       = $this->post('rbt_date');

        $getRbtBalance = $this->rebate->getRebateBalance($customerID);

        if ($getRbtBalance->num_rows() > 0) {

            $row = $getRbtBalance->row_array();
            $data['rbt_balance'] += $row['rbt_balance'];

            $entryData = $this->db->where('customer_id', $data['customer_id'])->set($data)->update('rebate');
            
        }else{

            $entryData = $this->db->insert('rebate', $data);

        }

        if ($entryData) {
            # code...
            $response['status'] = 'Success';
            $response['message'] = 'Counting rebate balance customer id '.$data['customer_id'].' update success';
            $this->response($response, 200);
        }else{
            $response['status'] = 'Failed';
            $response['message'] = 'Counting rebate balance customer id '.$data['customer_id'].' update success';
            $this->response($response, 201);
        }

    }

    public function countingUpdate_post(Type $var = null)
    {
        $walletId = $this->post('wallet_id');

        if (!empty($walletId)) {
            $data['is_counting'] = 1; //true
        }else{
            $data['is_counting'] = 0; //false
        }

        $update = $this->db->where('wallet_id', $walletId)->set($data)->update('wallet');

        if ($update) {
            # code...
            $response['status'] = 'Success';
            $response['message'] = 'Counting wallet id '.$walletId.' update status success';
            $this->response($response, 200);
        }else{
            $response['status'] = 'Failed';
            $response['message'] = 'Counting wallet id '.$walletId.' update status failed';
            $this->response($response, 201);
        }

    }

    public function getRebatesByDate_get()
    {
        if ($this->get('startDate') && $this->get('endDate')) {

            $query = $this->db->where('wallet.date_order >=', $this->get('startDate'))->where('wallet.date_order <=', $this->get('endDate'))->order_by('date_order', 'DESC')->limit($this->get('limit'))->from('wallet')->join('admin_broker','admin_broker.dt_accNumber = wallet.account_number')->join('customer','customer.customer_id = admin_broker.customer_id')->get();
            $response['status'] = 'Success';
            $response['message'] = 'Get data rebate by date';
            $response['data'] = $query->result();

            $this->response($response, 200);
        }
    }

    public function getRebateBalance_get()
    {
        
        $query = $this->db->where('customer_id', $this->session->userdata('custId'))->get('rebate');
        $response['status'] = 'Success';
        $response['message'] = 'Get rebate balance is succes';
        $response['data'] = $query->num_rows() > 0 ? $query->row() : (object)array();

        $this->response($response, 200);
        
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
        $data['customer_id'] = $this->session->userdata('custId');
        $data['payment_id'] = $this->post('payment_id');

        // CHECK PAYMENT ID EXIST
        $checkPaymentID = $this->db->where('customer_id', $data['customer_id'])->where('payment_id', $data['payment_id'])->get('customer_payment_system');

        if ($checkPaymentID->num_rows() > 0) {
            $response['status']     = 'Failed';
            $response['message']    = 'Payment id has been exist in data customer payment system';

            $this->response($response, 200);
        }else{
            $insert = $this->db->insert('customer_payment_system', $data);

            if ($insert) {
                $response['status']     = 'Success';
                $response['message']    = 'Payment id has been successfully inserted in data customer payment system';

                $this->response($response, 200);
            }else{
                $response['status']     = 'Failed';
                $response['message']    = 'Payment id has been failed insert to data customer payment system';

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

    public function withdrawal_post()
    {
        $this->load->model('Rebates_model','rebate');

        $payment = explode(',', $this->post('cst_wdw_paylist'));
        $data['cst_id']             = $this->post('cst_id');
        $data['cst_wdw_payment_id'] = $payment[0];
        $data['cst_wdw_paylist_id'] = $payment[1];
        $data['cst_wdw_amount']     = $this->post('cst_wdw_amount');
        $data['cst_wdw_desc']       = $this->post('cst_wdw_desc');
        $data['cst_wdw_date']       = date('Y-m-d H:i:s');

        //Check Amount
        $rebate = $this->rebate->getRebateBalance($this->post('cst_id'));

        if ($rebate->num_rows() > 0) {
            $row = $rebate->row_array();
            if ($data['cst_wdw_amount'] > $row['rbt_balance']) {
                $response['status']     = 'Failed';
                $response['message']    = 'Your request amount is biger than your rebate balance';

                $this->response($response, 200);
            }else{
                $insert = $this->db->insert('customer_withdrawal', $data);

                if ($insert) {
                    $response['status']     = 'Success';
                    $response['message']    = 'Your withdrawal request is successed';

                    $this->response($response, 200);
                }else{
                    $response['status']     = 'Failed';
                    $response['message']    = 'Your withdrawal request is failed, there is something wrong!';

                    $this->response($response, 200);
                }
            }
        }else{
            $response['status']     = 'Failed';
            $response['message']    = 'Your request amount is not available';
            $response['data']       = (object)[];

            $this->response($response, 404);
        }
    }

}