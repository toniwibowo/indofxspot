<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	
	public function dashboard()
	{
		if ($this->session->userdata('isLogedIn')) {
			$this->config->load('indofxspot');
			$key = $this->config->item('passKey');

			$data['isLogedIn'] = $this->session->userdata('isLogedIn');
			$data['custId'] = $this->session->userdata('custId');

			$this->theme->view('theme-dashboard','member-dashboard', $data);
		}else {
			redirect('/');
		}
		
	}

	public function profile()
	{
		if ($this->session->userdata('isLogedIn')) {

			$data['isLogedIn'] = $this->session->userdata('isLogedIn');
			$data['custId'] = $this->session->userdata('custId');

			$this->theme->view('theme-dashboard','member-profile', $data);
		}else {
			redirect('/');
		}	
		
	}

	public function broker()
	{
		if ($this->session->userdata('isLogedIn')) {

			$data['isLogedIn'] = $this->session->userdata('isLogedIn');
			$data['custId'] = $this->session->userdata('custId');
			
			$this->theme->view('theme-dashboard','member-broker', $data);
		}else {
			redirect('/');
		}	
		
	}

	public function rebates()
	{
		if ($this->session->userdata('isLogedIn')) {

			$data['isLogedIn'] = $this->session->userdata('isLogedIn');
			$data['custId'] = $this->session->userdata('custId');
			
			$this->theme->view('theme-dashboard','member-rebates', $data);
		}else {
			redirect('/');
		}	
		
	}

	public function payment()
	{
		if ($this->session->userdata('isLogedIn')) {

			$data['isLogedIn'] = $this->session->userdata('isLogedIn');
			$data['custId'] = $this->session->userdata('custId');
			
			$this->theme->view('theme-dashboard','member-payment', $data);
		}else {
			redirect('/');
		}	
		
	}
	
	public function announcement()
	{
		if ($this->session->userdata('isLogedIn')) {

			$data['isLogedIn'] = $this->session->userdata('isLogedIn');
			$data['custId'] = $this->session->userdata('custId');
			
			$this->theme->view('theme-dashboard','member-announcement', $data);
		}else {
			redirect('/');
		}	
		
	}
}