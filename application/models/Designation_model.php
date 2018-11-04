<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Designation_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}



	public function designations(){
		// return $this->db->get('designation')->result_array();
		$this->db->select('*');
		$this->db->from('designation');
		$this->db->order_by('name');
		return $this->db->get()->result_array();
	}

	public function designation_save(){
		$designationData['name']            = $this->input->post('name');
		$this->db->insert('designation', $designationData);
	}

	public function report($param = ''){

		$this->db->select('componentId, name');
		$this->db->from('designation');
		if(!isset($param['name']) || $param['name'] == 'all_names'){
			$name = '';
		}else{
			$name = $param['name'];
		}

		//echo "<br>Card No $card_no <br>";

		$this->db->like('name', $name);


		if(isset($param['limit']) && !isset($param['offset'])){
			$limit = $param['limit'];
			$this->db->limit($limit);

		}else if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$limit  = $param['limit'];
			$offset = $limit * ($offset-1);
			$this->db->limit($limit, $offset);
		}

		$this->db->order_by('name');
		//echo $this->db->get_compiled_select();
		//exit();
		$report = $this->db->get()->result_array();

		return $report;
	}

	public function edit($designationId = null){
		return $this->db->get_where('designation', array('componentId' => $designationId))->result_array();
	}

	public function designation_modify($designationId = null){
		$data['name'] = $this->input->post('name');

		$this->db->where('componentId', $designationId);
		$this->db->update('designation', $data);
	}
}