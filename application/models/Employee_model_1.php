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

	public function employee_save(){
		$employee_data['card_no']            = $this->input->post('card_no');
		$employee_data['name']               = $this->input->post('employee_name');
		$employee_data['designation']        = $this->input->post('designation');
		$employee_data['commission_name']    = $this->input->post('commission');
		$employee_data['last_salary']        = $this->input->post('last_sallary');
		$employee_data['file_no']            = $this->input->post('file_no');
		$employee_data['date_of_birth']      = date('Y-m-d',strtotime($this->input->post('date_of_birth')));
		$employee_data['death']              = date('Y-m-d',strtotime($this->input->post('death_accident_date')));
		$employee_data['sonalibank_branch']  = $this->input->post('sonalibank_branch');

		$this->db->insert('employee', $employee_data);

		$employee_id = $this->db->insert_id();

		#nominee_info

		$nominee_name      = $this->input->post('name');
		$relation          = $this->input->post('relation');
		$address           = $this->input->post('address');
		$amount_at_a_time  = $this->input->post('amount_at_a_time');
		$amount_per_month  = $this->input->post('amount_per_month');
		$pay_time_starts   = $this->input->post('pay_time_starts');
		$pay_time_ends     = $this->input->post('pay_time_ends');


		for($i = 0; $i < count($nominee_name); $i++){
			$nominee_data['name']              = $nominee_name[$i];
			$nominee_data['employee_id']       = $employee_id;
			$nominee_data['relation']          = $relation[$i];
			$nominee_data['address']           = $address[$i];
			$nominee_data['amount_at_a_time']  = $amount_at_a_time[$i];
			$nominee_data['amount_per_month']  = $amount_per_month[$i];
			$nominee_data['pay_time_starts']   = date('Y-m-d',strtotime($pay_time_starts[$i]));
			$nominee_data['pay_time_ends']     = date('Y-m-d',strtotime($pay_time_ends[$i]));
			$this->db->insert('nominee', $nominee_data);
		}
	}

	public function report($param = ''){

		$this->db->select('e.card_no,
					e.name,
					e.componentId employee_id');
		$this->db->from('employee e');
		$this->db->join('nominee n', 'e.componentId = n.employee_id', 'inner');

		if(!isset($param['card_no']) || $param['card_no'] == 'all_cards'){
			$card_no = '';
		}else{
			$card_no = $param['card_no'];
		}

		$this->db->like('e.card_no', $card_no);

		if(!isset($param['start_date']) || $param['start_date'] == 'all_start_date'){
			$start_date = date('Y-m-d',strtotime("-365 days"));
		}else{
			$start_date = $param['start_date'];
		}

		if(!isset($param['end_date']) || $param['end_date'] == 'all_end_date'){
			$end_date = date('Y-m-d',strtotime("+365 days"));
		}else{
			$end_date = $param['end_date'];
		}

		$this->db->where('n.pay_time_starts >= ',$start_date);
		$this->db->where('n.pay_time_starts < ',$end_date);

		if(isset($param['limit']) && !isset($param['offset'])){
			$limit = $param['limit'];
			$this->db->limit($limit);

		}else if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$limit  = $param['limit'];
			$offset = $limit * ($offset-1);
			$this->db->limit($limit, $offset);
		}

		$this->db->order_by('e.name');
		$this->db->group_by('e.componentId');
		//echo $this->db->get_compiled_select();
		$report = $this->db->get()->result_array();

		return $report;
	}

	public function nominees($employee_id){
		$this->db->select('n.componentId nominee_id,
					n.name nominee_name,
					n.amount_at_a_time,
					n.amount_per_month,
					n.pay_time_starts,
					n.pay_time_ends');
		$this->db->from('nominee n');
		$this->db->where('n.employee_id', $employee_id);
		return $this->db->get()->result_array();
	}
}