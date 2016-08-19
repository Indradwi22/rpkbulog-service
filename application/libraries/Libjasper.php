<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH.'/third_party/libjasper/vendor/autoload.php');
use Jaspersoft\Client\Client;

class Libjasper {

	protected $server;
	protected $user;
	protected $pass;
	protected $org;
	
    function __construct()
    {
        $CI = & get_instance();
        log_message('Debug', 'Jasper Client class is loaded.');
    }

	function connect($server='',$user='',$pass='',$org='')
	{
		$this->server = $server;
		$this->user = $user;
		$this->pass = $pass;
		$this->org = $org;
	}

	function load($rpt,$params=array()){
		if(!empty($rpt)):
			if(is_array($params)):
				foreach($params	as	$key	=>	$val):
					if($key	!==	'rpt'):
						$params[$key]	=	$val;
					else:
						$params			=	array(''	=>	NULL);
					endif;
				endforeach;
				try{
					$c	=	new Client(
						$this->server,
						$this->user,
						$this->pass,
						$this->org
					);
					$c->setRequestTimeout(60);
					$controls	=	$params;
					$report		=	$c->reportService()->runReport('/Dinas_Pasar/'.$rpt, 'pdf', null, null, $controls);

					header('Content-Length: '.strlen($report));
					header('Content-Type: application/pdf');

					echo	$report;
				}
				catch(Exception $e) {
					printf('<b>%s</b>', $e->getMessage());
				}
			endif;
		else:
			exit('No direct access allowed!');
		endif;
	}

}