<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/

class Designation extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Designation_model');
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
				'rows'        => count($this->Designation_model->report($param)),
				'base_url'    => base_url('Designation/report/').$param['name'],
				'uri_segment' => 4,
				'model'       => 'Designation_model',
				'method'      => 'report'
			);

		$paginationData = $paginationData + $param;

		$data['designations'] = paginate($paginationData);

		$data['active'] = 'report';
		$data['name'] = $name;

		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$data['count_from'] = $per_page * ($pageNumber - 1);

		$this->load->view('designation/index', $data);
	}

	public function add(){
		$data['active'] = 'add';

		$data['designations'] = $this->Designation_model->designations();
		$this->load->view('designation/index', $data);
	}
	public function designation_save(){
		$this->Designation_model->designation_save();
		redirect('designation/report');
	}

	public function edit($designationId = null){
		$data['designation'] = $this->Designation_model->edit($designationId);
		$data['active'] = 'edit';
		$this->load->view('designation/index', $data);
	}

	public function designation_modify($designationId = null){
		$this->Designation_model->designation_modify($designationId);
		redirect('designation/report');
	}

	public function delete($designationId){
		$this->db->where('componentId', $designationId);
		if($this->db->delete('designation')){
			$data = true;
		}else{
			$data = false;
		}

		echo json_encode($data);
	}
}