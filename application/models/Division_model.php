<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Division_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function divisions(){
		return $this->db->get('divisions')->result_array();
	}

	public function division_save(){
		$divisionData['division_name']            = $this->input->post('name');
		$this->db->insert('divisions', $divisionData);
	}

	public function report($param = ''){

		$this->db->select('componentId, division_name');
		$this->db->from('divisions');
		if(!isset($param['name']) || $param['name'] == 'all_names'){
			$name = '';
		}else{
			$name = $param['name'];
		}

		//echo "<br>Card No $card_no <br>";

		$this->db->like('division_name', $name);


		if(isset($param['limit']) && !isset($param['offset'])){
			$limit = $param['limit'];
			$this->db->limit($limit);

		}else if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$limit  = $param['limit'];
			$offset = $limit * ($offset-1);
			$this->db->limit($limit, $offset);
		}

		$this->db->order_by('division_name');
		//echo $this->db->get_compiled_select();
		//exit();
		$report = $this->db->get()->result_array();

		return $report;
	}

	public function edit($divisionId = null){
		return $this->db->get_where('divisions', array('componentId' => $divisionId))->result_array();
	}

	public function division_modify($divisionId = null){
		$data['division_name'] = $this->input->post('name');

		$this->db->where('componentId', $divisionId);
		$this->db->update('divisions', $data);
	}
}