<?php

class Rebates_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRebateBalance($cstID)
    {
        $queryRebate = $this->db->where('customer_id', $cstID)->get('rebate');

        return $queryRebate;
    }

    public function getKurs()
    {
        $queryKurs = $this->db->order_by('kurs_id', 'desc')->get('admin_kurs');

        return $queryKurs;
    }
}