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
		//return $this->db->get('sonali_bank_branches')->result_array();

		$this->db->select('*');
		$this->db->from('sonali_bank_branches');
		$this->db->order_by('branch_name');
		return $this->db->get()->result_array();
	}

	public function divisions(){
		$this->db->select('distinct(division)');
		$this->db->from('divisionData');
		$this->db->order_by('division');
		return $this->db->get()->result_array();
	}

	public function districts(){
		$this->db->select('br.distCode,
							br.distName,
							dd.division');
		$this->db->from('branchdata br');
		$this->db->join('divisiondata dd', 'upper(br.distName) = upper(dd.districtName)', 'inner');
		$this->db->group_by('br.distName');
		$this->db->order_by('br.distName');

			// echo "<pre>";
			// print_r($this->db->get_compiled_select());
			// echo "</pre>";
			// exit();

		return $this->db->get()->result_array();
	}

	public function branches(){
		$this->db->select('distinct(br.branchName)');
		$this->db->from('branchdata br');
		$this->db->group_by('br.branchName');
		$this->db->order_by('br.branchName');

			// echo "<pre>";
			// print_r($this->db->get_compiled_select());
			// echo "</pre>";
			// exit();

		return $this->db->get()->result_array();
	}

	public function fetchDistrict($divisionName = null){
		$this->db->select('bd.distName');
		$this->db->from('branchdata bd');
		$this->db->join('divisiondata dd', 'upper(dd.districtName) = upper(bd.distName)', 'inner');
		$condition = "upper(dd.division) = upper('$divisionName')";
		$this->db->where($condition);
		$this->db->group_by('bd.distName');
		$this->db->order_by('bd.distName');
		return $this->db->get()->result_array();
	}

	public function fetchBranch($districtName = null){
		$this->db->select('bd.branchName');
		$this->db->from('branchdata bd');
		$condition = "upper(bd.distName) = upper('$districtName')";
		$this->db->where($condition);
		return $this->db->get()->result_array();
	}

	public function relations(){
		//return $this->db->get('relation')->result_array();
		$this->db->select('*');
		$this->db->from('relation');
		$this->db->order_by('relation_name');
		return $this->db->get()->result_array();
	}

	public function designations(){
		//return $this->db->get('designation')->result_array();
		$this->db->select('*');
		$this->db->from('designation');
		$this->db->order_by('name');
		return $this->db->get()->result_array();
	}

	public function commissions(){
		//return $this->db->get('commissions')->result_array();
		$this->db->select('*');
		$this->db->from('commissions');
		$this->db->order_by('commission_name');
		return $this->db->get()->result_array();
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
		//$employee_data['card_no']            = $this->input->post('card_no');
		$employee_data['name']               = $this->input->post('employee_name');
		$employee_data['designation']        = $this->input->post('designation');
		$employee_data['division_chamber']   = $this->input->post('division_chamber');
		$employee_data['district_chamber']   = $this->input->post('district_chamber');
		$employee_data['chamber']            = $this->input->post('chamber');
		$employee_data['last_salary']        = $this->input->post('last_sallary');
		$employee_data['file_no']            = $this->input->post('file_no');
		$employee_data['date_of_birth']      = date('Y-m-d',strtotime($this->input->post('date_of_birth')));
		$employee_data['death']              = date('Y-m-d',strtotime($this->input->post('death_accident_date')));
		$employee_data['division_bank']      = $this->input->post('division_bank');
		$employee_data['district_bank']      = $this->input->post('district_bank');
		$employee_data['bank']               = $this->input->post('bank');

		$this->db->insert('employee', $employee_data);
			
		$employee_id = $this->db->insert_id();

		#nominee_info

		$nominee_name      = $this->input->post('name');
		$card_no           = $this->input->post('card_no');
		$relation          = $this->input->post('relation');
		$address           = $this->input->post('address');
		$amount_at_a_time  = $this->input->post('amount_at_a_time');
		$amount_per_month  = $this->input->post('amount_per_month');
		$pay_time_starts   = $this->input->post('pay_time_starts');
		$pay_time_ends     = $this->input->post('pay_time_ends');


		for($i = 0; $i < count($nominee_name); $i++){

			if(!$nominee_name[$i])
				continue;

			$nominee_data['name']              = $nominee_name[$i];
			$nominee_data['card_no']           = $card_no[$i];
			$nominee_data['employee_id']       = $employee_id;
			$nominee_data['relation']          = $relation[$i];
			$nominee_data['address']           = $address[$i];
			$nominee_data['amount_at_a_time']  = $amount_at_a_time[$i];
			$nominee_data['amount_per_month']  = $amount_per_month[$i];
			$nominee_data['pay_time_starts']   = date('Y-m-d',strtotime($pay_time_starts[$i]));
			$nominee_data['pay_time_ends']     = date('Y-m-d',strtotime($pay_time_ends[$i]));

			$date1 = $nominee_data['pay_time_starts'];
			$date2 = date('d-m-Y');

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
			$total_given_time = $diff + 1;

			$total_amount = $nominee_data['amount_per_month'] * $total_given_time;
			//$nominee_data['total'] = $total_amount;
			$nominee_data['status'] = 1;
			$this->db->insert('nominee', $nominee_data);
		}
	}

	public function report($param = ''){

		$this->db->select('n.card_no,
					e.name,
					e.componentId employee_id');
		$this->db->from('employee e');
		$this->db->join('nominee n', 'e.componentId = n.employee_id', 'inner');

		if(!isset($param['card_no']) || $param['card_no'] == 'all_cards'){
			$card_no = '';
		}else{
			$card_no = $param['card_no'];
		}

		$this->db->like('n.card_no', $card_no);

		if(!isset($param['status']) || $param['status'] == 'all'){
			$status = '';
		}else{
			$status = $param['status'];
		}

		$this->db->like('n.status', $status);

		//echo "<br>Card No $card_no <br>";


		$start_date = date('Y-m-d',strtotime($param['start_date']));
		

		// if(!isset($param['start_date']) || $param['start_date'] == 'all_start_date'){
		// 	$start_date = date('Y-m-d',strtotime("-365 days"));
		// }else{
		// 	$start_date = date('Y-m-d',strtotime($param['start_date']));
		// }

		//echo "<br>start_date $start_date <br>";


		$end_date = date('Y-m-d',strtotime($param['end_date']));
		

		// if(!isset($param['end_date']) || $param['end_date'] == 'all_end_date'){
		// 	$end_date = date('Y-m-d',strtotime("+365 days"));

		// }else{
		// 	$end_date = date('Y-m-d',strtotime($param['end_date']));
		// }
		//echo "<br>end_date ".$end_date." <br>";

		

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
		//exit();
		$report = $this->db->get()->result_array();

		return $report;
	}

	public function nominees($employee_id){
		$this->db->select('n.componentId nominee_id,
					n.card_no,
					n.name nominee_name,
					n.amount_at_a_time,
					n.amount_per_month,
					n.pay_time_starts,
					n.pay_time_ends,
					n.status,
					n.inactive_date');
		$this->db->from('nominee n');
		$this->db->where('n.employee_id', $employee_id);
		return $this->db->get()->result_array();
	}

	public function edit($employeeId = ''){
		return $this->db->get_where('employee', array('componentId' => $employeeId))->row_array();
	}

	public function edit_nominee($employeeId = ''){
		$nominees = "SELECT
						n.*
						FROM
						nominee n
						INNER JOIN employee e ON e.componentId = n.employee_id
						WHERE e.componentId = $employeeId";
		return $this->db->query($nominees)->result_array();
	}

	public function employee_modify($employeeId = ''){
		//$data['card_no']             = $this->input->post('card_no');
		$data['name']                = $this->input->post('employee_name');
		$data['designation']         = $this->input->post('designation');
		$data['division_chamber']    = $this->input->post('division_chamber');
		$data['district_chamber']    = $this->input->post('district_chamber');
		$data['chamber']             = $this->input->post('chamber');
		//$data['commission_name']   = $this->input->post('commission');
		$data['last_salary']         = $this->input->post('last_sallary');
		$data['file_no']             = $this->input->post('file_no');
		$data['date_of_birth']       = $this->input->post('date_of_birth');
		$data['death']               = $this->input->post('death_accident_date');

		$data['division_bank']       = $this->input->post('division_bank');
		$data['district_bank']       = $this->input->post('district_bank');
		$data['bank']                = $this->input->post('bank');
		//$data['sonalibank_branch'] = $this->input->post('sonalibank_branch');

		$this->db->where('componentId', $employeeId);
		$this->db->update('employee', $data);

		$nominee_id         = $this->input->post('nominee_id');
		$nominee_name       = $this->input->post('name');
		$card_no            = $this->input->post('card_no');
		$nominee_relation   = $this->input->post('relation');
		$nominee_address    = $this->input->post('address');
		$amount_at_a_time   = $this->input->post('amount_at_a_time');
		$amount_per_month   = $this->input->post('amount_per_month');
		$pay_time_starts    = $this->input->post('pay_time_starts');
		$pay_time_ends      = $this->input->post('pay_time_ends');
		$status             = $this->input->post('status');
		$inactive_date      = $this->input->post('inactive_date');
		
		for($n = 0; $n < count($nominee_name); $n++){
			if(!$nominee_name[$n])
				continue;
			
			$nominee['name'] = $nominee_name[$n];
			$nominee['card_no'] = $card_no[$n];
			$nominee['employee_id'] = $employeeId;
			$nominee['relation'] = $nominee_relation[$n];
			$nominee['address'] = $nominee_address[$n];
			$nominee['amount_at_a_time'] = $amount_at_a_time[$n];
			$nominee['amount_per_month'] = $amount_per_month[$n];

			$nominee['status'] = $status[$n-1];
			$nominee['inactive_date'] = date('Y-m-d',strtotime($inactive_date[$n-1]));

			$nominee['pay_time_starts'] = date('Y-m-d',strtotime($pay_time_starts[$n]));
			$nominee['pay_time_ends'] = date('Y-m-d',strtotime($pay_time_ends[$n]));

			$date1 = $nominee['pay_time_starts'];
			$date2 = date('d-m-Y');;

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
			$total_given_time = $diff + 1;

			//$nominee['total'] = $nominee['amount_per_month'] * $total_given_time;

			if($n > 0){
				if($nominee_id[$n-1]){
					$this->db->where('componentId', $nominee_id[$n-1]);
					$this->db->update('nominee', $nominee);
				}else{
					$this->db->insert('nominee', $nominee);
				}
			}
		}
	}
}