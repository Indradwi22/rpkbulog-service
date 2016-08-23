<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Stok_rpk extends REST_Controller{
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
        $status = ($this->get('status', TRUE) && $this->get('status', TRUE)=="1") ? "AND status_stok_rpk='1'" : "AND status_stok_rpk='0'";
        if(!empty($id)) {
            /*$data = $this->m_app->myquery_array("SELECT *, SUM(jumlah_komoditi_stok_rpk) AS JUMLAH, @rownum := @rownum+1 as myindex FROM tb_stok_rpk AS A, tb_komoditi AS B,
(SELECT @rownum := 0) as Z WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI AND id_komoditi_stok_rpk='".$id."' GROUP BY id_komoditi_stok_rpk, id_toko_stok_rpk");*/
            $data = $this->m_app->myquery_array("SELECT A.*,B.*, D.*, SUM(jumlah_komoditi_stok_rpk)-IFNULL(C.JUMLAH, '0') AS JUMLAH, E.NAMA_ENTITAS FROM tb_stok_rpk AS A LEFT JOIN (SELECT id_toko_penjualan_rpk, id_komoditi_penjualan_rpk, SUM(jumlah_komoditi_penjualan_rpk) AS JUMLAH FROM tb_penjualan_rpk WHERE id_toko_penjualan_rpk='".$id."' GROUP BY id_toko_penjualan_rpk, id_komoditi_penjualan_rpk) AS C ON A.id_toko_stok_rpk=C.id_toko_penjualan_rpk AND A.id_komoditi_stok_rpk=C.id_komoditi_penjualan_rpk, tb_komoditi AS B, tb_toko AS D, entitas AS E WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI AND A.id_toko_stok_rpk=D.ID_TOKO AND D.IDENTITAS_TOKO=E.ID_ENTITAS AND id_toko_stok_rpk='".$id."' ".$status." GROUP BY id_komoditi_stok_rpk, id_toko_stok_rpk ORDER BY id_komoditi_stok_rpk");
        }else{
           /* $data = $this->m_app->myquery_array('SELECT *, SUM(jumlah_komoditi_stok_rpk) AS JUMLAH, @rownum := @rownum+1 as myindex FROM tb_stok_rpk AS A, tb_komoditi AS B,
(SELECT @rownum := 0) as Z WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI GROUP BY id_komoditi_stok_rpk, id_toko_stok_rpk');*/
            $data = $this->m_app->myquery_array("SELECT A.*,B.*, D.*, SUM(jumlah_komoditi_stok_rpk)-IFNULL(C.JUMLAH, '0') AS JUMLAH, E.NAMA_ENTITAS FROM tb_stok_rpk AS A LEFT JOIN (SELECT id_toko_penjualan_rpk, id_komoditi_penjualan_rpk, SUM(jumlah_komoditi_penjualan_rpk) AS JUMLAH FROM tb_penjualan_rpk GROUP BY id_toko_penjualan_rpk, id_komoditi_penjualan_rpk) AS C ON A.id_toko_stok_rpk=C.id_toko_penjualan_rpk AND A.id_komoditi_stok_rpk=C.id_komoditi_penjualan_rpk, tb_komoditi AS B, tb_toko AS D, entitas AS E WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI AND A.id_toko_stok_rpk=D.ID_TOKO AND D.IDENTITAS_TOKO=E.ID_ENTITAS ".$status." GROUP BY id_komoditi_stok_rpk, id_toko_stok_rpk ORDER BY id_komoditi_stok_rpk");
        }
            $array = array();
            if ($data) {
                foreach ($data as $row) {
                    $array[] = array(
                        $row['id_stok_rpk'],
                        $row['ID_KOMODITI'],
                        $row['NAMA_KOMODITI'],
                        $row['JUMLAH'],
                        $row['HARGA_KOMODITI'],
                        $row['ID_TOKO'],
                        $row['NAMA_TOKO'], //6
                        $row['IDENTITAS_TOKO'],
                        $row['NPWP_TOKO'],
                        $row['ALAMAT_TOKO'],
                        $row['TELP_TOKO'],
                        $row['KETERANGAN_TOKO'],
                        $row['LONG_TOKO'],
                        $row['LAT_TOKO'],
                        $row['NAMA_ENTITAS'],
                    );
                }

            }
            $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function allrequest_get() {
        $id = ($this->get('idtoko', TRUE)) ? $this->get('idtoko', TRUE) : '';
       // $status = (($this->get('status', TRUE)) ? (($this->get('status', TRUE) === "0") ? "AND status_stok_rpk='0'" : "AND status_stok_rpk='1'") :"");
        $status = "";
            if($this->get('status', TRUE) == "1"){
                $status = "AND status_stok_rpk='1'";
            }else if($this->get('status', TRUE) == "0"){
                $status = "AND status_stok_rpk='0'";
            }else if($this->get('status', TRUE) == "all"){
                $status = "";
            }
        //$status = ($this->get('status', TRUE) && $this->get('status', TRUE)=="1") ? "AND status_stok_rpk='1'" : "AND status_stok_rpk='0'";
        if(!empty($id)) {
            $data = $this->m_app->myquery_array("SELECT A.*,B.*, D.*, SUM(jumlah_komoditi_stok_rpk) AS JUMLAH, SUM(jumlah_komoditi_stok_rpk*HARGA_KOMODITI) AS total, E.NAMA_ENTITAS FROM tb_stok_rpk AS A, tb_komoditi AS B, tb_toko AS D, entitas AS E WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI AND A.id_toko_stok_rpk=D.ID_TOKO AND D.IDENTITAS_TOKO=E.ID_ENTITAS AND id_toko_stok_rpk='".$id."' ".$status." GROUP BY noreq_stok_rpk ORDER BY status_stok_rpk ASC, tanggal_stok_rpk DESC");
        }else{
            $data = $this->m_app->myquery_array("SELECT A.*,B.*, D.*, SUM(jumlah_komoditi_stok_rpk) AS JUMLAH, SUM(jumlah_komoditi_stok_rpk*HARGA_KOMODITI) AS total, E.NAMA_ENTITAS FROM tb_stok_rpk AS A, tb_komoditi AS B, tb_toko AS D, entitas AS E WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI AND A.id_toko_stok_rpk=D.ID_TOKO AND D.IDENTITAS_TOKO=E.ID_ENTITAS ".$status." GROUP BY noreq_stok_rpk ORDER BY status_stok_rpk ASC, tanggal_stok_rpk DESC");
        }
        $array = array();
        if ($data) {
            foreach ($data as $row) {
                $array[] = array(
                    $row['id_stok_rpk'], //0
                    $row['noreq_stok_rpk'],//1
                    $row['id_komoditi_stok_rpk'],//2
                    $row['id_toko_stok_rpk'],//3
                    $row['tanggal_stok_rpk'],//4
                    $row['NAMA_TOKO'],//5
                    $row['NAMA_ENTITAS'],//6
                    $row['JUMLAH'],//7
                    $row['total'],//8
                    $row['status_stok_rpk'],//9
                );
            }

        }
        $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function detail_get() {
        $id = ($this->get('noreq', TRUE)) ? $this->get('noreq', TRUE) : '';
        if(!empty($id)) {
            $data = $this->m_app->myquery_array("SELECT * FROM
tb_stok_rpk AS A, tb_komoditi AS B, tb_toko AS C, entitas AS D WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI AND A.id_toko_stok_rpk=C.ID_TOKO AND C.IDENTITAS_TOKO=D.ID_ENTITAS AND A.noreq_stok_rpk='".$id."'");
        }else{
            $data = $this->m_app->myquery_array("SELECT * FROM
tb_stok_rpk AS A, tb_komoditi AS B, tb_toko AS C, entitas AS D WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI AND A.id_toko_stok_rpk=C.ID_TOKO AND C.IDENTITAS_TOKO=D.ID_ENTITAS");
        }
        $array = array();
        //  if ($data) {
        foreach ($data as $row) {
            $array[] = array(
                $row['id_stok_rpk'], //0
                $row['noreq_stok_rpk'],//1
                $row['id_komoditi_stok_rpk'],//2
                $row['tanggal_stok_rpk'],//3
                $row['NAMA_KOMODITI'],//4
                $row['UKURAN_KOMODITI'],//5
                $row['harga_komoditi_stok_rpk'],//6
                $row['ID_TOKO'],//7
                $row['NAMA_TOKO'],//8
                $row['NAMA_ENTITAS'],//9
                $row['jumlah_komoditi_stok_rpk'],//10
            );
        }
        //  }
        $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function verifikasi_get() {
        $noreq = ($this->get('noreq', TRUE)) ? $this->get('noreq', TRUE) : '';
        //$noreq = ($this->get('status', TRUE)) ? $this->get('noreq', TRUE) : '';
        $cek = $this->m_app->update_data('tb_stok_rpk', array('status_stok_rpk'=>$this->get('status', TRUE)), array('noreq_stok_rpk' => $noreq));
        if (!empty($cek)) {
            //$this->m_app->insert_data('master_log', $data_log);
            $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be inserted'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function allstok_get() {

        $data = $this->m_app->myquery_array("SELECT A.*,B.*, D.*, E.NAMA_ENTITAS FROM tb_stok_rpk AS A, tb_komoditi AS B, tb_toko AS D, entitas AS E WHERE A.id_komoditi_stok_rpk=B.ID_KOMODITI AND A.id_toko_stok_rpk=D.ID_TOKO AND D.IDENTITAS_TOKO=E.ID_ENTITAS ORDER BY tanggal_stok_rpk DESC");

        $array = array();
        if ($data) {
            foreach ($data as $row) {
                $array[] = array(
                    $row['id_stok_rpk'],
                    $row['id_komoditi_stok_rpk'],
                    $row['id_toko_stok_rpk'],
                    $row['jumlah_komoditi_stok_rpk'],
                    $row['tanggal_stok_rpk'],
                    $row['NAMA_KOMODITI'],
                    $row['HARGA_KOMODITI'], //6
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
                $data = array('id_komoditi_stok_rpk' => $this->post('komoditi', TRUE),
                    'id_toko_stok_rpk' => $this->post('namarpk', TRUE),
                    'jumlah_komoditi_stok_rpk' => $this->post('jumlah', TRUE),
                    'tanggal_stok_rpk' => $this->post('tanggal', TRUE)
                    //'tanggal_stok_rpk' => mdate('%Y-%m-%d %H:%i:%s', now())
                    );

                /*$data_log = array(
                    'IDUSER_LOG' => $this->adminlogin,
                    'ACTION_LOG' => 'Insert',
                    'LINK_LOG' => 'Kelas',
                    'KETERANGAN_LOG' => $this->libarraytext->arrayDisplay($data),
                    'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
                );*/
                $id = ($this->post('idstok', TRUE)) ? $this->post('idstok', TRUE) : '';
                if (empty($id)) {
                    $cek = $this->m_app->insert_data('tb_stok_rpk', $data);
                }else{
                    $cek = $this->m_app->update_data('tb_stok_rpk', $data, array('id_stok_rpk' => $this->post('idstok', TRUE)));
                }
                if (!empty($cek)) {
                    //$this->m_app->insert_data('master_log', $data_log);
                    $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be inserted'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
    }

    public function insertreq_post() {
        $this->form_validation->set_rules('kodebarang[]', 'Barang', 'trim|required|xss_clean');
        $this->form_validation->set_rules('norequest', 'No Request', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jumlah[]', 'Jumlah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('harga[]', 'Harga', 'trim|required|xss_clean');
        $this->form_validation->set_rules('idtoko', 'Toko', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('dibayar', 'toko', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('idtoko', 'toko', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        } else {

            $idkomoditi = $this->post('kodebarang', TRUE);
            $jumlah = $this->post('jumlah', TRUE);
            $harga = $this->post('harga', TRUE);
            for($i=0; $i<count($idkomoditi);$i++){
                $data = array(
                    'id_toko_stok_rpk' =>$this->post('idtoko', TRUE),
                    'noreq_stok_rpk' =>$this->post('norequest', TRUE),
                    'id_komoditi_stok_rpk' => $idkomoditi[$i],
                    'harga_komoditi_stok_rpk' => $harga[$i],
                    'jumlah_komoditi_stok_rpk' => $jumlah[$i],
                    'tanggal_stok_rpk' => $this->post('tanggal', TRUE),
                    'status_stok_rpk' => "0"
                );
                $cek = $this->m_app->insert_data('tb_stok_rpk', $data);
                //  $this->m_app->myquery_array("UPDATE tb_stok_rpk SET jumlah_komoditi_stok_rpk=jumlah_komoditi_stok_rpk-".$jumlah[$i]." WHERE id_stok_rpk='' AND ");
            }

            if (!empty($cek)) {
                $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be saved'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
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
            $where = array('id_stok_rpk' => $this->delete('id_stok', TRUE));
            $cek = $this->m_app->delete_data('tb_stok_rpk', $where);
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