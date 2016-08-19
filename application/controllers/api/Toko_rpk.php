<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Toko_rpk extends REST_Controller{
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
        $id = ($this->get('idtoko', TRUE)) ? $this->get('idtoko', TRUE) : '';
        if(!empty($id)) {
            $data = $this->m_app->myquery_array("SELECT * FROM tb_toko AS A, entitas AS B, tb_user AS C WHERE A.IDENTITAS_TOKO=B.ID_ENTITAS AND A.ID_TOKO=C.IDTOKO_USER AND A.ID_TOKO='".$id."'");
        }else{
            $data = $this->m_app->myquery_array("SELECT * FROM tb_toko AS A, entitas AS B, tb_user AS C WHERE A.IDENTITAS_TOKO=B.ID_ENTITAS AND A.ID_TOKO=C.IDTOKO_USER");
        }
            $array = array();
            if ($data) {
                foreach ($data as $row) {
                    $array[] = array(
                        $row['ID_TOKO'],
                        $row['NAMA_TOKO'],
                        $row['IDENTITAS_TOKO'],
                        $row['NPWP_TOKO'],
                        $row['ALAMAT_TOKO'],
                        $row['TELP_TOKO'],
                        $row['KETERANGAN_TOKO'],
                        $row['LONG_TOKO'],
                        $row['LAT_TOKO'],
                        $row['NAMA_ENTITAS'],
                        $row['USERNAME_USER'],
                        $row['ROLE_USER'],
                        $row['TANGGAL_TOKO']
                    );
                }

            }
            $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function insert_post() {
        $this->form_validation->set_rules('nama', 'Nama Toko', 'trim|required|xss_clean');
        $this->form_validation->set_rules('entitas', 'Entitas', 'trim|required|xss_clean');
        $this->form_validation->set_rules('npwp', 'NPWP', 'trim|required|xss_clean');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
        $this->form_validation->set_rules('telp', 'Telp', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $data = array('NAMA_TOKO' => $this->post('nama', TRUE),
                    'IDENTITAS_TOKO' => $this->post('entitas', TRUE),
                    'NPWP_TOKO' => $this->post('npwp', TRUE),
                    'ALAMAT_TOKO' => $this->post('alamat', TRUE),
                    'TELP_TOKO' => $this->post('telp', TRUE),
                    'KETERANGAN_TOKO' => $this->post('keterangan', TRUE),
                    'LONG_TOKO' => '',
                    'LAT_TOKO' => ''
                    );
                $id = ($this->post('idtoko', TRUE)) ? $this->post('idtoko', TRUE) : '';
                if (empty($id)) {
                    $data['TANGGAL_TOKO'] = mdate('%Y-%m-%d %H:%i:%s', now());
                    $cek = $this->m_app->insert_data('tb_toko', $data);
                    $data1 = array('USERNAME_USER'=>$this->post('username', TRUE),
                        'PASSWORD_USER'=>$this->m_app->myencrypt($this->post('password', TRUE),'myrpkbulog'),
                        'IDTOKO_USER'=>$cek,
                        'ROLE_USER'=>'2'
                    );
                    $cek = $this->m_app->insert_data('tb_user', $data1);
                }else{
                    $cek = $this->m_app->update_data('tb_toko', $data, array('ID_TOKO' => $this->post('idtoko', TRUE)));
                }
                if (!empty($cek)) {
                    $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be inserted'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
    }

    public function update_post() {
            $this->form_validation->set_rules('id_toko', 'ID TOKO', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nama', 'Nama Toko', 'trim|required|xss_clean');
            $this->form_validation->set_rules('identitas', 'Entitas', 'trim|required|xss_clean');
            $this->form_validation->set_rules('npwp', 'NPWP', 'trim|required|xss_clean');
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
            $this->form_validation->set_rules('telp', 'Telp', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $data = array('NAMA_TOKO' => $this->post('nama', TRUE),
                    'IDENTITAS_TOKO' => $this->post('identitas', TRUE),
                    'NPWP_TOKO' => $this->post('npwp', TRUE),
                    'ALAMAT_TOKO' => $this->post('alamat', TRUE),
                    'TELP_TOKO' => $this->post('telp', TRUE),
                    'KETERANGAN_TOKO' => $this->post('ket', TRUE),
                    'LONG_TOKO' => '',
                    'LAT_TOKO' => '',
                );

                $where = array('ID_TOKO' => $this->post('id_toko', TRUE));
                $cek = $this->m_app->update_data('tb_toko', $data, $where);
                if (!empty($cek)) {
                    $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be updated'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
    }

    public function delete_delete() {
            $where = array('ID_TOKO' => $this->delete('idtoko', TRUE));
            $cek = $this->m_app->delete_data('tb_toko', $where);
            if ($cek) {
                //$this->m_app->insert_data('master_log', $data_log);
                $this->response(array('status' => $cek, 'where' => $where), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('status' => FALSE, 'message' => 'Data could not be deleted'), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
    }
}