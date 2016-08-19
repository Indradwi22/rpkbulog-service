<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Retur_rpk extends REST_Controller{
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

        $data = $this->m_app->myquery_array("SELECT A.*,B.*, D.*, E.NAMA_ENTITAS FROM tb_retur AS A, tb_komoditi AS B, tb_toko AS D, entitas AS E WHERE A.id_komoditi_retur=B.ID_KOMODITI AND A.id_toko_retur=D.ID_TOKO AND D.IDENTITAS_TOKO=E.ID_ENTITAS ORDER BY tanggal_retur DESC");

        $array = array();
        if ($data) {
            foreach ($data as $row) {
                $array[] = array(
                    $row['id_retur'],
                    $row['id_komoditi_retur'],
                    $row['id_toko_retur'],
                    $row['jumlah_komoditi_retur'],
                    $row['tanggal_retur'],
                    $row['keterangan_retur'], //5
                    $row['NAMA_KOMODITI'],
                    $row['HARGA_KOMODITI'], //7
                    $row['NAMA_TOKO'],
                );
            }

        }
        $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function insert_post() {
        $this->form_validation->set_rules('komoditi', 'Komoditi', 'trim|required|xss_clean');
        $this->form_validation->set_rules('namarpk', 'Nama RPK', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {
                $data = array('id_komoditi_retur' => $this->post('komoditi', TRUE),
                    'id_toko_retur' => $this->post('namarpk', TRUE),
                    'jumlah_komoditi_retur' => $this->post('jumlah', TRUE),
                    'tanggal_retur' => $this->post('tanggal', TRUE),
                    'keterangan_retur' => $this->post('keterangan', TRUE)
                    );

                /*$data_log = array(
                    'IDUSER_LOG' => $this->adminlogin,
                    'ACTION_LOG' => 'Insert',
                    'LINK_LOG' => 'Kelas',
                    'KETERANGAN_LOG' => $this->libarraytext->arrayDisplay($data),
                    'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
                );*/
                $id = ($this->post('idretur', TRUE)) ? $this->post('idretur', TRUE) : '';
                if (empty($id)) {
                    $cek = $this->m_app->insert_data('tb_retur', $data);
                }else{
                    $cek = $this->m_app->update_data('tb_retur', $data, array('id_retur' => $this->post('idretur', TRUE)));
                }
                if (!empty($cek)) {
                    //$this->m_app->insert_data('master_log', $data_log);
                    $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be inserted'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
    }


    public function delete_delete() {
            /*$data = $this->m_app->myquery_array("SELECT * FROM master_hakakses WHERE ID_HAKAKSES = ".$this->delete('id', TRUE));
            if($data){
                $data_log = array(
                    'IDUSER_LOG' => $this->adminlogin,
                    'ACTION_LOG' => 'Delete',
                    'LINK_LOG' => 'Kelas',
                    'KETERANGAN_LOG' => $this->libarraytext->arrayDisplay($data[0]),
                    'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
                );
            }*/
            $where = array('id_retur' => $this->delete('idretur', TRUE));
            $cek = $this->m_app->delete_data('tb_retur', $where);
            if ($cek) {
                //$this->m_app->insert_data('master_log', $data_log);
                $this->response(array('status' => $cek, 'where' => $where), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('status' => FALSE, 'message' => 'Data could not be deleted'), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
    }

   /* public function select_get() {
        if(!$this->adminlogin) {
            $this->response(array('status' => false, array('error'=>'Data tidak dapat diakses')), REST_Controller::HTTP_OK);
        }else {
            $id = $this->get('id', TRUE);
            $cek = $this->m_app->datatable('master_hakakses', array('ID_HAKAKSES' => $id));
            if ($cek) {
                $this->response(array('data' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('data' => FALSE, 'message' => 'Data could not be found', 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }*/
}