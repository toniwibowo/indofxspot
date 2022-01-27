<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Announcement extends REST_Controller{

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

    public function getData_get()
    {   

        if ($this->get('id')) {
            $query = $this->db->where('annc_id', $this->get('id'))->where('start_date <=', date('Y-m-d'))->where('end_date >=', date('Y-m-d'))->get('announcement');

            $response['status'] = 'Success';
            $response['message'] = 'Announcement is loaded';
            $response['data'] = $query->num_rows() > 0 ? $query->row() : (object)array();

            $this->response($response, 200);

        }else{

            $query = $this->db->order_by('annc_id', 'DESC')->where('start_date <=', date('Y-m-d'))->where('end_date >=', date('Y-m-d'))->get('announcement');

            $response['status'] = 'Success';
            $response['message'] = 'All announcement is loaded';
            $response['data'] = $query->result();

            $this->response($response, 200);
        }        
    }

}