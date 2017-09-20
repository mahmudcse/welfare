<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Employee extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Employee_model');
	}

	public function index(){
		if(!$this->session->userdata('is_logged_in')){
			$this->load->view('login/index');
		}else{
			redirect('employee/dashboard');
		}
		
	}

	public function dashboard(){
		if(!$this->session->userdata('is_logged_in'))
			redirect('employee');
		$this->load->view('dashboard/index');
	}

	public function loginValidation(){
		
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_credential_ok');

		if ($this->form_validation->run() == TRUE) {
			redirect('employee/dashboard');
		} else {
			$this->load->view('login/index');
		}
	}

	public function credential_ok(){
		$is_ok = $this->Employee_model->credential_ok();

		if($is_ok){
			return TRUE;
		}else{
			$this->form_validation->set_message('credential_ok', 'Invalid Combination');
			return FALSE;
		}
	}

	public function add(){
		$data['active'] = 'add';

		$data['designations'] = $this->Employee_model->designations();
		$data['commissions'] = $this->Employee_model->commissions();

		$data['sonalibank_branches'] = $this->Employee_model->sonalibank_branches();
		$data['relations'] = $this->Employee_model->relations();
		$this->load->view('dashboard/index', $data);
	}

	public function report(){
		$data['active'] = 'report';

		$this->load->view('dashboard/index', $data);
	}
}