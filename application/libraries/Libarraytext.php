<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Libarraytext {
	
    function __construct()
    {
        $CI = & get_instance();
        log_message('Debug', 'Jasper Client class is loaded.');
    }

	function arrayDisplay($input){
		return implode(
			', ',
			array_map(
				function ($v, $k) {
					return sprintf("%s => '%s'", $k, $v);
				},
				$input,
				array_keys($input)
			)
		);
	}

}