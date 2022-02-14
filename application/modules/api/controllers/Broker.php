<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Broker extends REST_Controller{

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
        $data['account_type_id'] = $this->post('account_type_id');
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

    public function getBroker_get()
    {
        $getDataBroker = $this->db->where('customer_id', $this->session->userdata('custId'))->order_by('broker_id','DESC')->from('admin_broker')->join('admin_account_type', 'admin_account_type.account_type_id = admin_broker.account_type_id')->get();

        $response['status'] = 'Success';
        $response['message'] = 'Broker data has been succesfully loaded';
        $response['data'] = $getDataBroker->result();

        $this->response($response, 200);
    }

    public function getAccountType_get()
    {
        $getDataAccountType = $this->db->get('admin_account_type');

        $response['status']     = 'Success';
        $response['message']    = 'Account type data has been succesfully loaded';
        $response['data']       = $getDataAccountType->result();

        $this->response($response, 200);
    }

    public function delAccBroker_post()
    {
        $id = $this->post('broker_id');

        $checkData = $this->db->where('broker_id', $id)->where('dt_status','Unvalidated')->get('admin_broker');
        
        if ($checkData->num_rows() > 0) {
            $deleteItem = $this->db->where('broker_id', $id)->where('dt_status','Unvalidated')->delete('admin_broker');
            $response['status']     = 'Success';
            $response['message']    = 'Broker account has been succesfully deleted';
            $response['broker_id']  = $id;

            $this->response($response, 200);
        }else{
            $response['status']     = 'Failed';
            $response['message']    = 'Broker account has been failed to delete';
            $response['broker_id']  = $id;

            $this->response($response, 200);
        }
    }

}