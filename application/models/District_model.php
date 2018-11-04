<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class District_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function divisions(){
		return $this->db->get('divisions')->result_array();
	}

	public function district_save(){
		$districtData['divisionId']               = $this->input->post('division');
		$districtData['district_name']            = $this->input->post('name');
		$this->db->insert('districts', $districtData);
	}

	public function report($param = ''){

		$this->db->select('ds.componentId, ds.district_name, ds.divisionId, dv.division_name');
		$this->db->from('districts ds');
		$this->db->join('divisions dv', 'dv.componentId = ds.divisionId', 'inner');
		if(!isset($param['name']) || $param['name'] == 'all_names'){
			$name = '';
		}else{
			$name = $param['name'];
		}

		//echo "<br>Card No $card_no <br>";

		$this->db->like('district_name', $name);


		if(isset($param['limit']) && !isset($param['offset'])){
			$limit = $param['limit'];
			$this->db->limit($limit);

		}else if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$limit  = $param['limit'];
			$offset = $limit * ($offset-1);
			$this->db->limit($limit, $offset);
		}

		$this->db->order_by('district_name');
		//echo "<pre>";
		//print_r($this->db->get_compiled_select());
		//exit();
		$report = $this->db->get()->result_array();

		return $report;
	}

	public function edit($districtId = null){
		return $this->db->get_where('districts', array('componentId' => $districtId))->result_array();
	}

	public function district_modify($districtId = null){
		$data['district_name'] = $this->input->post('name');

		$this->db->where('componentId', $divisionId);
		$this->db->update('divisions', $data);
	}
}