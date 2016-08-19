<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Komoditi_rpk extends REST_Controller{
    function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->adminlogin = $this->session->userdata('iduser_webpasar');
        $this->thash		=	$this->security->get_csrf_hash();
        $this->tname		=	$this->security->get_csrf_token_name();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        //$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        //$this->methods['insert_post']['limit'] = 100; // 100 requests per hour per user/key
        //$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function index_get() {
            $data = $this->m_app->myquery_array("SELECT * FROM tb_komoditi AS A, tb_jeniskomoditi AS B, tb_satuan AS C WHERE A.KODE_JENISKOMODITI=B.KODE_JENISKOMODITI AND A.IDSATUAN_KOMODITI=C.ID_SATUAN");

            $array = array();
            if ($data) {
                foreach ($data as $row) {
                    $array[] = array(
                        $row['ID_KOMODITI'], //0
                        $row['KODE_JENISKOMODITI'],
                        $row['NAMA_KOMODITI'],
                        $row['UKURAN_KOMODITI'],
                        $row['HARGA_KOMODITI'],
                        $row['IDSATUAN_KOMODITI'], //5
                        $row['ID_JENISKOMODITI'],
                        $row['NAMA_JENISKOMODITI'],
                        $row['NAMA_SATUAN'],
                        $row['KET_SATUAN'] //9
                    );
                }

            }
            $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function insert_post() {
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

                $cek = $this->m_app->insert_data('tb_toko', $data);
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
            $where = array('ID_TOKO' => $this->delete('id_toko', TRUE));
            $cek = $this->m_app->delete_data('tb_toko', $where);
            if ($cek) {
                //$this->m_app->insert_data('master_log', $data_log);
                $this->response(array('status' => $cek, 'where' => $where), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('status' => FALSE, 'message' => 'Data could not be deleted'), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
    }
}