<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Employee_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function sonalibank_branches(){
		return $this->db->get('sonali_bank_branches')->result_array();
	}

	public function relations(){
		return $this->db->get('relation')->result_array();
	}

	public function designations(){
		return $this->db->get('designation')->result_array();
	}

	public function commissions(){
		return $this->db->get('commissions')->result_array();
	}

	public function credential_ok(){
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		$is_mail_exists = $this->db->get_where('admin', array('email'=>$email))->result_array();

		if(count($is_mail_exists) > 0){
			$db_password = $this->db->get_where('admin', array('email'=>$email))->row()->password;

			if(password_verify($password, $db_password)){
				$admin_name = $this->db->get_where('admin', array('email'=>$email))->row()->name;
				$userdata = [
					'is_logged_in' => 1,
					'name' => $admin_name
				];

				$this->session->set_userdata($userdata);
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}