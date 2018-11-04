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
		// $this->output->enable_profiler();
	}

	public function report($card_no = null, $start_date = null, $end_date = null, $status = null){

		// $this->benchmark->mark('my_start');

		if(!is_null($this->input->post('card_no')) && $this->input->post('card_no')){
			$card_no = $this->input->post('card_no');
		}else if(!is_null($card_no)){
			$card_no = $card_no;
		}else{
			$card_no = 'all_cards';
		}

		if(!is_null($this->input->post('start_date')) && $this->input->post('start_date')){
			$start_date = $this->input->post('start_date');
		}else if(!is_null($start_date)){
			$start_date = $start_date;
		}else{
			$start_date = date('Y-m-d',strtotime("-365 days"));
		}

		if(!is_null($this->input->post('end_date')) && $this->input->post('end_date')){
			$end_date = $this->input->post('end_date');
		}else if(!is_null($end_date)){
			$end_date = $end_date;
		}else{
			$end_date = date('Y-m-d',strtotime("+365 days"));
		}

		if($this->input->post('status') == '1' || $this->input->post('status') == '0' || $this->input->post('status') == 'all'){
			$status = $this->input->post('status');
		}else if($status == NULL){
			$status = 'all';
		}

		$param = [
			'card_no'    => $card_no,
			'start_date' => $start_date,
			'end_date'   => $end_date,
			'status'     => $status
		];

		$paginationData = array(
				'rows'        => count($this->Employee_model->report($param)),
				'base_url'    => base_url('Employee/report/').$param['card_no'].'/'.$param['start_date'].'/'.$param['end_date'].'/'.$param['status'],
				'uri_segment' => 7,
				'model'       => 'Employee_model',
				'method'      => 'report'
			);

		$paginationData = $paginationData + $param;
		$employees = paginate($paginationData);

		$data = array();

		foreach ($employees as $employeeKey => $employee) {
			$employee_id = $employee['employee_id'];
			$nominees = $this->Employee_model->nominees($employee_id);

				$data['employees'][$employeeKey]['employee_id'] = $employee['employee_id'];
				//$data['employees'][$employeeKey]['card_no'] = $employee['card_no'];
				$data['employees'][$employeeKey]['name'] = $employee['name'];

			foreach ($nominees as $nomineeKey => $nominee) {
				$data['nominees'][$employee_id][$nomineeKey]['nominee_id'] = $nominee['nominee_id'];
				$data['nominees'][$employee_id][$nomineeKey]['card_no'] = $nominee['card_no'];
				$data['nominees'][$employee_id][$nomineeKey]['nominee_name'] = $nominee['nominee_name'];
				$data['nominees'][$employee_id][$nomineeKey]['amount_at_a_time'] = $nominee['amount_at_a_time'];
				$data['nominees'][$employee_id][$nomineeKey]['amount_per_month'] = $nominee['amount_per_month'];
				$data['nominees'][$employee_id][$nomineeKey]['status'] = $nominee['status'];
				$data['nominees'][$employee_id][$nomineeKey]['inactive_date'] = $nominee['inactive_date'];


				$date1 = $nominee['pay_time_starts'];
				$date2 = date('d-m-Y');

				$pay_time_ends_str = strtotime($nominee['pay_time_ends']);
				$todays_str        = strtotime(date('d-m-Y'));

				if($pay_time_ends_str < $todays_str){
					$date2 = $nominee['pay_time_ends'];
				}


				//echo $pay_time_ends_str.' '.$todays_str.'<br>';
				//exit();
				

				$ts1 = strtotime($date1);
				$ts2 = strtotime($date2);

				$year1 = date('Y', $ts1);
				$year2 = date('Y', $ts2);

				$month1 = date('m', $ts1);
				$month2 = date('m', $ts2);

				$days1=cal_days_in_month(CAL_GREGORIAN, $month1, $year1);
				$days2=cal_days_in_month(CAL_GREGORIAN, $month2, $year2);
				$start_month_payment_days = ($days1 - date('d', $ts1)) + 1;
				$end_month_payment_days   = date('d', $ts2);

				$payment_for_start_month = ($nominee['amount_per_month']/$days1)*$start_month_payment_days;
				$payment_for_end_month = ($nominee['amount_per_month']/$days2)*$end_month_payment_days;
				$start_and_end_month_total = round($payment_for_start_month + $payment_for_end_month, 2);

				$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
				$total_given_time = $diff - 1;

				$total = number_format(($nominee['amount_per_month'] * $total_given_time) + $start_and_end_month_total, 2);

				$total = $total > 0? $total: 0;

				$data['nominees'][$employee_id][$nomineeKey]['total'] = $total;

				$data['nominees'][$employee_id][$nomineeKey]['pay_time_starts'] = $nominee['pay_time_starts'];
				$data['nominees'][$employee_id][$nomineeKey]['pay_time_ends'] = $nominee['pay_time_ends'];
			}
		}
		$data['active'] = 'report';
		$data['card_no'] = $card_no;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['status'] = $status;

		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$data['count_from'] = $per_page * ($pageNumber - 1);

		$this->load->view('dashboard/index', $data);
	}

	public function fetchDistrict($divisionName = null){
		$districts = $this->Employee_model->fetchDistrict($divisionName);
		echo json_encode($districts);
		
	}

	public function fetchBranch($districtName = null){
		$branches = $this->Employee_model->fetchBranch($districtName);
		echo json_encode($branches);
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

		redirect('employee/report');

		// $data['active'] = 'report';
		// $this->load->view('dashboard/index', $data);
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
		//$data['commissions'] = $this->Employee_model->commissions();

		$data['sonalibank_branches'] = $this->Employee_model->sonalibank_branches();
		$data['divisions'] = $this->Employee_model->divisions();
		$data['districts'] = $this->Employee_model->districts();
		$data['branches']      = $this->Employee_model->branches();
		$data['relations'] = $this->Employee_model->relations();
		$this->load->view('dashboard/index', $data);
	}

	

	public function employee_save(){

		//$this->form_validation->set_rules('card_no', 'কার্ড নং', 'trim|required|is_unique[employee.card_no]');
		$this->form_validation->set_rules('file_no', 'নথি নং', 'trim|required|is_unique[employee.file_no]');

		if ($this->form_validation->run()) {
			$this->Employee_model->employee_save();
			$this->session->set_flashdata('success_msg', 'Successful');
			redirect('employee/add');
		} else {
			$data['active'] = 'add';

			$data['designations'] = $this->Employee_model->designations();
			$data['commissions'] = $this->Employee_model->commissions();

			$data['sonalibank_branches'] = $this->Employee_model->sonalibank_branches();
			$data['relations'] = $this->Employee_model->relations();
			$this->load->view('dashboard/index', $data);
		}

		
	}

	public function edit($employeeId = ''){
		$employee = $this->Employee_model->edit($employeeId);
		$nominees = $this->Employee_model->edit_nominee($employeeId);

		$data['employee']['employee_id'] = $employee['componentId'];
		//$data['employee']['card_no'] = $employee['card_no'];
		$data['employee']['name'] = $employee['name'];
		$data['employee']['designation'] = $employee['designation'];
		$data['employee']['division_chamber'] = $employee['division_chamber'];
		$data['employee']['district_chamber'] = $employee['district_chamber'];
		$data['employee']['chamber'] = $employee['chamber'];
		$data['employee']['last_salary'] = $employee['last_salary'];
		$data['employee']['file_no'] = $employee['file_no'];
		$data['employee']['date_of_birth'] = $employee['date_of_birth'];
		$data['employee']['death'] = $employee['death'];
		$data['employee']['division_bank'] = $employee['division_bank'];
		$data['employee']['district_bank'] = $employee['district_bank'];
		$data['employee']['bank'] = $employee['bank'];

		$data['nominees'] = $this->Employee_model->edit_nominee($employeeId);

		$data['designations'] = $this->Employee_model->designations();
		//$data['commissions'] = $this->Employee_model->commissions();

		$data['sonalibank_branches'] = $this->Employee_model->sonalibank_branches();
		$data['relations'] = $this->Employee_model->relations();

		$data['branches'] = $this->Employee_model->branches();
		$data['divisions'] = $this->Employee_model->divisions();
		$data['districts'] = $this->Employee_model->districts();

		$data['active'] = 'edit';
		$this->load->view('dashboard/index', $data);
		
	}

	public function employee_modify($employeeId = ''){
			$this->Employee_model->employee_modify($employeeId);
			$this->session->set_flashdata('success_msg', 'Successful');
			redirect('employee/report');
	}

	public function delete_nominee($nominee_id = ''){
		$this->db->where('componentId', $nominee_id);
		if($this->db->delete('nominee')){
			$data = true;
		}else{
			$data = false;
		}
		echo json_encode($data);
	}

	public function employee_delete($employee_id = ''){
		$deleteSQL = "DELETE
						e, n
						FROM employee e
						INNER JOIN nominee n on e.componentId = n.employee_id
						WHERE e.componentId = $employee_id";
		$this->db->query($deleteSQL);
	}

	public function logout(){
		$this->session->unset_userdata('is_logged_in');
		$this->session->unset_userdata('name');
		$this->session->sess_destroy();
		redirect('employee');
	}


}