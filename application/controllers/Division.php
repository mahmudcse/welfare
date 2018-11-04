<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/

class Division extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Division_model');
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
				'rows'        => count($this->Division_model->report($param)),
				'base_url'    => base_url('Division/report/').$param['name'],
				'uri_segment' => 4,
				'model'       => 'Division_model',
				'method'      => 'report'
			);

		$paginationData = $paginationData + $param;

		$data['divisions'] = paginate($paginationData);

		$data['active'] = 'report';
		$data['name'] = $name;

		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$data['count_from'] = $per_page * ($pageNumber - 1);
		
		$this->load->view('division/index', $data);
	}

	public function add(){
		$data['active'] = 'add';

		//$data['comissions'] = $this->Division_model->comissions();
		$this->load->view('division/index', $data);
	}
	public function division_save(){
		$this->Division_model->division_save();
		redirect('division/report');
	}

	public function edit($divisionId = null){
		$data['division'] = $this->Division_model->edit($divisionId);
		$data['active'] = 'edit';
		$this->load->view('division/index', $data);
	}

	public function division_modify($divisionId = null){
		$this->Division_model->division_modify($divisionId);
		redirect('division/report');
	}

	public function delete($divisionId){
		$this->db->where('componentId', $divisionId);
		if($this->db->delete('divisions')){
			$data = true;
		}else{
			$data = false;
		}

		echo json_encode($data);
	}
}