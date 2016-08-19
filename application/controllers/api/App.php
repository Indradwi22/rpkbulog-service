<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class App extends REST_Controller{
    function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->thash		=	$this->security->get_csrf_hash();
        $this->tname		=	$this->security->get_csrf_token_name();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        //$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        //$this->methods['insert_post']['limit'] = 100; // 100 requests per hour per user/key
        //$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function index_get() {
        $respon = array('tname'=>$this->tname,
            'thash'=>$this->thash
        );
        $this->response($respon, REST_Controller::HTTP_OK);
    }

    public function login_post() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE)
        {
            $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(),'tname'=>$this->tname,'thash'=>$this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }else {

            $user = $this->post('username', TRUE);
            $pass = $this->post('password', TRUE);

            $login = $this->m_app->aksilogin($user,$pass);
            if ($login['status']) {
                $this->response(array('status' => $login, 'message' => 'Success Login','tname'=>$this->tname,'thash'=>$this->thash), REST_Controller::HTTP_OK);
            }else {
                $this->response(array('status' => FALSE, 'message' => array('error'=>'Gagal Login'),'tname'=>$this->tname,'thash'=>$this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
}