<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/

class District extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('District_model');
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
				'rows'        => count($this->District_model->report($param)),
				'base_url'    => base_url('District/report/').$param['name'],
				'uri_segment' => 4,
				'model'       => 'District_model',
				'method'      => 'report'
			);

		$paginationData = $paginationData + $param;

		$data['districts'] = paginate($paginationData);

		$data['active'] = 'report';
		$data['name'] = $name;

		if($this->uri->segment($paginationData['uri_segment'])){
			$pageNumber = $this->uri->segment($paginationData['uri_segment']);
		}else{
			$pageNumber = 1;
		}
		$per_page = $this->pagination->per_page;

		$data['count_from'] = $per_page * ($pageNumber - 1);
		
		$this->load->view('district/index', $data);
	}

	public function add(){
		$data['active'] = 'add';

		$data['divisions'] = $this->District_model->divisions();
		$this->load->view('district/index', $data);
	}
	public function district_save(){
		$this->District_model->district_save();
		redirect('district/report');
	}

	public function edit($districtId = null){
		$data['divisions'] = $this->District_model->divisions();
		$data['district'] = $this->District_model->edit($districtId);
		$data['active'] = 'edit';
		$this->load->view('district/index', $data);
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