<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{
		if ($this->session->userdata('isLogedIn')) {
			redirect('member/dashboard');
		}

		$data['getWhatsappContact'] = $this->db->order_by('wa_id','DESC')->get('whatsapp')->row()->wa_number;

		$this->config->load('indofxspot');
		$key = $this->config->item('passKey');
		$sid = session_id();

        $data['passKey'] = $key;
		$data['sid'] = $sid;

		$this->theme->view('theme','home', $data);
	}
}