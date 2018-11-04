<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Branch_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function branch_save(){
		$branchData['branch_name'] = $this->input->post('name');
		$this->db->insert('sonali_bank_branches', $branchData);
	}

	public function report($param = ''){

		$this->db->select('componentId, branch_name');
		$this->db->from('sonali_bank_branches');
		if(!isset($param['name']) || $param['name'] == 'all_names'){
			$name = '';
		}else{
			$name = $param['name'];
		}

		//echo "<br>Card No $card_no <br>";

		$this->db->like('branch_name', $name);


		if(isset($param['limit']) && !isset($param['offset'])){
			$limit = $param['limit'];
			$this->db->limit($limit);

		}else if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$limit  = $param['limit'];
			$offset = $limit * ($offset-1);
			$this->db->limit($limit, $offset);
		}

		$this->db->order_by('branch_name');
		//echo $this->db->get_compiled_select();
		//exit();
		$report = $this->db->get()->result_array();

		return $report;
	}

	public function edit($branchId = null){
		return $this->db->get_where('sonali_bank_branches', array('componentId' => $branchId))->result_array();
	}

	public function branch_modify($branchId = null){
		$data['branch_name'] = $this->input->post('name');

		$this->db->where('componentId', $branchId);
		$this->db->update('sonali_bank_branches', $data);
	}
}