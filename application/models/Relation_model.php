<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Relation_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}



	public function relations(){
		// return $this->db->get('relation')->result_array();
		$this->db->select('*');
		$this->db->from('relation');
		$this->db->order_by('relation_name');
		return $this->db->get()->result_array();
	}

	public function relations_save(){
		$relationData['relation_name'] = $this->input->post('name');
		$this->db->insert('relation', $relationData);
	}

	public function report($param = ''){

		$this->db->select('componentId, relation_name');
		$this->db->from('relation');
		if(!isset($param['name']) || $param['name'] == 'all_names'){
			$name = '';
		}else{
			$name = $param['name'];
		}

		//echo "<br>Card No $card_no <br>";

		$this->db->like('relation_name', $name);


		if(isset($param['limit']) && !isset($param['offset'])){
			$limit = $param['limit'];
			$this->db->limit($limit);

		}else if(isset($param['limit']) && isset($param['offset'])){
			$offset = $param['offset'];
			$limit  = $param['limit'];
			$offset = $limit * ($offset-1);
			$this->db->limit($limit, $offset);
		}

		$this->db->order_by('relation_name');
		//echo $this->db->get_compiled_select();
		//exit();
		$report = $this->db->get()->result_array();

		return $report;
	}

	public function edit($relationId = null){
		return $this->db->get_where('relation', array('componentId' => $relationId))->result_array();
	}

	public function relation_modify($relationId = null){
		$data['relation_name'] = $this->input->post('name');

		$this->db->where('componentId', $relationId);
		$this->db->update('relation', $data);
	}
}