<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/

class Branch extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Branch_model');
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
				'rows'        => count($this->Branch_model->report($param)),
				'base_url'    => base_url('branch/report/').$param['name'],
				'uri_segment' => 4,
				'model'       => 'Branch_model',
				'method'      => 'report'
			);

		$paginationData = $paginationData + $param;

		$data['branches'] = paginate($paginationData);

		$data['active'] = 'report';
		$data['name'] = $name;

		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$data['count_from'] = $per_page * ($pageNumber - 1);

		$this->load->view('branch/index', $data);
	}

	public function add(){
		$data['active'] = 'add';
		$this->load->view('branch/index', $data);
	}
	public function branch_save(){
		$this->Branch_model->branch_save();
		redirect('branch/report');
	}

	public function edit($branchId = null){
		$data['branch'] = $this->Branch_model->edit($branchId);
		$data['active'] = 'edit';
		$this->load->view('branch/index', $data);
	}

	public function branch_modify($branchId = null){
		$this->Branch_model->branch_modify($branchId);
		redirect('branch/report');
	}

	public function delete($branchId){
		$this->db->where('componentId', $branchId);
		if($this->db->delete('sonali_bank_branches')){
			$data = true;
		}else{
			$data = false;
		}

		echo json_encode($data);
	}
}