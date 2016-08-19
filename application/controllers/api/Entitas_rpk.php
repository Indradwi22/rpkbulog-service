<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Entitas_rpk extends REST_Controller{
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
        $id = ($this->get('identitas', TRUE)) ? $this->get('identitas', TRUE) : '';
        if(!empty($id)) {
            $data = $this->m_app->datatable('entitas',array('ID_ENTITAS'=>$id));
        }else{
            $data = $this->m_app->datatable('entitas');
        }
            $array = array();
            if ($data) {
                foreach ($data as $row) {
                    $array[] = array(
                        $row['ID_ENTITAS'],
                        $row['NAMA_ENTITAS']
                    );
                }

            }
            $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function insert_post() {
        $this->form_validation->set_rules('nama', 'Nama Entitas', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $data = array('NAMA_ENTITAS' => $this->post('nama', TRUE)
                    );
                $id = ($this->post('identitas', TRUE)) ? $this->post('identitas', TRUE) : '';
                if (empty($id)) {
                    $cek = $this->m_app->insert_data('entitas', $data);
                }else{
                    $cek = $this->m_app->update_data('entitas', $data, array('ID_ENTITAS' => $this->post('identitas', TRUE)));
                }
                if (!empty($cek)) {
                    $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be inserted'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
    }

    public function delete_delete() {
            $where = array('ID_ENTITAS' => $this->delete('identitas', TRUE));
            $cek = $this->m_app->delete_data('entitas', $where);
            if ($cek) {
                //$this->m_app->insert_data('master_log', $data_log);
                $this->response(array('status' => $cek, 'where' => $where), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('status' => FALSE, 'message' => 'Data could not be deleted'), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
    }
}