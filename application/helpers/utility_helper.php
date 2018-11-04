<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('paginate'))
{
    function paginate($param = array())
    {
    		$CI =& get_instance();

            $CI->load->library('pagination');

			if(!empty($param['base_url'])){
				$config['base_url'] = $param['base_url'];
			}

			if(!empty($param['rows'])){
				$config['total_rows'] = $param['rows'];
			}
			
			
			$config['per_page'] = 50;

			if(!empty($param['uri_segment'])){
				$config['uri_segment'] = $param['uri_segment'];
			}
			$config['use_page_numbers'] = TRUE;

			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';


			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';

			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			$config['next_link'] = "&gt;";

			$config['next_tag_open'] = "<li>";
			$config['next_tag_close'] = "</li>";


			$config['prev_link'] = "&lt;";
			
			$config['prev_tag_open'] = "<li>";
			$config['prev_tag_close'] = "</li>";

			$config['cur_tag_open'] = "<li class='active'><a href='#'>";
			$config['cur_tag_close'] = '</a></li>';


			$config['num_tag_open'] = "<li>";
			$config['num_tag_close'] = "</li>";

			$config['num_links'] = 1;

			$CI->pagination->initialize($config);

			$model  = $param['model'];
			$method = $param['method'];
			
			if($CI->uri->segment($param['uri_segment']) == ''){
				$param = array('limit' => $config['per_page']) + $param;
				$pageData['designations']  = $CI->$model->$method($param);

			}else{

				$offset = (int)$CI->uri->segment($param['uri_segment']);
				$param = array('limit' => $config['per_page'], 'offset' => $offset) + $param;
				$pageData['designations']    = $CI->$model->$method($param);
			}

			return $pageData['designations'];
    }   
}