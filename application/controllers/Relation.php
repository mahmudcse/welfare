<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/

class Relation extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Relation_model');
	}

	public function report($name = null){
		if(!is_null($this->input->post('name')) && $this->input->post('name')){
			$name = $this->input->post('name');
		}else if(!is_null($name)){
			$name = $name;
		}else{
			$name = 'all_names';
		}

		$param = [
			'name'    => $name
		];

		$paginationData = array(
				'rows'        => count($this->Relation_model->report($param)),
				'base_url'    => base_url('Relation/report/').$param['name'],
				'uri_segment' => 4,
				'model'       => 'Relation_model',
				'method'      => 'report'
			);

		$paginationData = $paginationData + $param;

		$data['relations'] = paginate($paginationData);

		$data['active'] = 'report';
		$data['name'] = $name;
		
		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$data['count_from'] = $per_page * ($pageNumber - 1);
		$this->load->view('relation/index', $data);
	}

	public function add(){
		$data['active'] = 'add';

		$data['relations'] = $this->Relation_model->relations();
		$this->load->view('relation/index', $data);
	}
	public function relation_save(){
		$this->Relation_model->relations_save();
		redirect('relation/report');
	}

	public function edit($relationId = null){
		$data['relation'] = $this->Relation_model->edit($relationId);

		$data['active'] = 'edit';
		$this->load->view('relation/index', $data);
	}

	public function relation_modify($relationId = null){
		$this->Relation_model->relation_modify($relationId);
		redirect('relation/report');
	}

	public function delete($relationId){
		$this->db->where('componentId', $relationId);
		if($this->db->delete('relation')){
			$data = true;
		}else{
			$data = false;
		}

		echo json_encode($data);
	}
}