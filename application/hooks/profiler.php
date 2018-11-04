<?php
function profiler_hook(){
	$CI =& get_instance();
	$CI->output->enable_profiler();
}