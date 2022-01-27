<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Pages extends REST_Controller
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

    public function item_get()
    {
        if ($this->get('id')) {

            $getItemPage = $this->db->where('pages_id', $this->get('id'))->get('pages');

            if ($getItemPage->row_array() > 0) {
                $response['status'] = 'Success';
                $response['message'] = 'Get page data';
                $response['data'] = $getItemPage->row_array();

                $this->response($response, 200);
            }else {
                $response['status'] = 'Success';
                $response['message'] = 'No page found';
                $response['data'] = (object)[];

                $this->response($response, 200);
            }

            
        }else {
            
            $getPages = $this->db->where('pages_id', $this->get('id'))->get('pages');

            if ($getPages->num_rows() > 0) {
                $response['status'] = 'Success';
                $response['message'] = 'Get page data';
                $response['data'] = $getItemPage->result_array();

                $this->response($response, 200);
            }else {
                $response['status'] = 'Success';
                $response['message'] = 'No pages found';
                $response['data'] = [];

                $this->response($response, 200);
            }

            
        }
    }
}