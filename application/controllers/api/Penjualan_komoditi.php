<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Penjualan_komoditi extends REST_Controller{
    function __construct(){
        // Construct the parent class
        parent::__construct();
        //$this->adminlogin = $this->session->userdata('iduser_webpasar');
        $this->thash		=	$this->security->get_csrf_hash();
        $this->tname		=	$this->security->get_csrf_token_name();
    }

    public function index_get() {
        $id = ($this->get('idtoko', TRUE)) ? $this->get('idtoko', TRUE) : '';
        $group = ($this->get('group', TRUE) && $this->get('group', TRUE) == 'y') ? " ,id_toko_penjualan_rpk" : '';
        if(!empty($id)) {
            $data = $this->m_app->myquery_array("SELECT *, SUM(jumlah_komoditi_penjualan_rpk) as jumlah, SUM(jumlah_komoditi_penjualan_rpk*HARGA_KOMODITI) AS total FROM
tb_penjualan_rpk AS A, tb_komoditi AS B, tb_toko AS C, entitas AS D WHERE A.id_komoditi_penjualan_rpk=B.ID_KOMODITI AND A.id_toko_penjualan_rpk=C.ID_TOKO AND C.IDENTITAS_TOKO=D.ID_ENTITAS AND A.id_toko_penjualan_rpk='".$id."' GROUP BY A.no_nota_penjualan_rpk".$group." ORDER BY A.tanggal_penjualan_rpk DESC");
        }else{
            $data = $this->m_app->myquery_array("SELECT *, SUM(jumlah_komoditi_penjualan_rpk) as jumlah, SUM(jumlah_komoditi_penjualan_rpk*HARGA_KOMODITI) AS total FROM
tb_penjualan_rpk AS A, tb_komoditi AS B, tb_toko AS C, entitas AS D WHERE A.id_komoditi_penjualan_rpk=B.ID_KOMODITI AND A.id_toko_penjualan_rpk=C.ID_TOKO AND C.IDENTITAS_TOKO=D.ID_ENTITAS GROUP BY A.no_nota_penjualan_rpk".$group." ORDER BY A.tanggal_penjualan_rpk DESC");
        }
            $array = array();
          //  if ($data) {
                foreach ($data as $row) {
                    $array[] = array(
                        $row['id_penjualan_rpk'], //0
                        $row['no_nota_penjualan_rpk'],//1
                        $row['id_komoditi_penjualan_rpk'],//2
                        $row['tanggal_penjualan_rpk'],//3
                        $row['NAMA_TOKO'],//4
                        $row['NAMA_ENTITAS'],//5
                        $row['jumlah'],//6
                        $row['total'],//7
                        $row['dibayar_penjualan_rpk'],//8
                        $row['kembali_penjualan_rpk'],//9
                    );
                }
          //  }
            $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function detail_get() {
        $id = ($this->get('nota', TRUE)) ? $this->get('nota', TRUE) : '';
        if(!empty($id)) {
            $data = $this->m_app->myquery_array("SELECT * FROM
tb_penjualan_rpk AS A, tb_komoditi AS B, tb_toko AS C, entitas AS D WHERE A.id_komoditi_penjualan_rpk=B.ID_KOMODITI AND A.id_toko_penjualan_rpk=C.ID_TOKO AND C.IDENTITAS_TOKO=D.ID_ENTITAS AND A.no_nota_penjualan_rpk='".$id."'");
        }else{
            $data = $this->m_app->myquery_array("SELECT * FROM
tb_penjualan_rpk AS A, tb_komoditi AS B, tb_toko AS C, entitas AS D WHERE A.id_komoditi_penjualan_rpk=B.ID_KOMODITI AND A.id_toko_penjualan_rpk=C.ID_TOKO AND C.IDENTITAS_TOKO=D.ID_ENTITAS");
        }
        $array = array();
        //  if ($data) {
        foreach ($data as $row) {
            $array[] = array(
                $row['id_penjualan_rpk'], //0
                $row['no_nota_penjualan_rpk'],//1
                $row['id_komoditi_penjualan_rpk'],//2
                $row['tanggal_penjualan_rpk'],//3
                $row['NAMA_KOMODITI'],//4
                $row['UKURAN_KOMODITI'],//5
                $row['harga_komoditi_penjualan_rpk'],//6
                $row['ID_TOKO'],//7
                $row['NAMA_TOKO'],//8
                $row['NAMA_ENTITAS'],//9
                $row['jumlah_komoditi_penjualan_rpk'],//10
            );
        }
        //  }
        $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function getnota_get(){
        $id = ($this->get('idtoko', TRUE)) ? $this->get('idtoko', TRUE) : '';
        if(!empty($id)) {
            $data_toko = $this->m_app->datatable("tb_toko",array('ID_TOKO'=>$id))[0];
        }
        $entitas = $data_toko['IDENTITAS_TOKO'];

        $data = $this->m_app->myquery_array("SELECT * FROM tb_penjualan_rpk WHERE no_nota_penjualan_rpk LIKE '%STR".$entitas."%' ORDER BY no_nota_penjualan_rpk DESC LIMIT 0,1");
        $number = 0;
        if($data){
            $lastnota = $data[0]['no_nota_penjualan_rpk'];
            $number = explode('.',$lastnota)[1]+1;
        }
        //$full = "STR".$entitas.".".sprintf('%05d',$number);
        $full = "STR".$entitas.".".sprintf('%05d',$number);
        $this->response(array('status' => $full, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
    }


    public function insert_post() {
            $this->form_validation->set_rules('kodebarang[]', 'Barang', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nota', 'Nota', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required|xss_clean');
            $this->form_validation->set_rules('jumlah[]', 'Jumlah', 'trim|required|xss_clean');
            $this->form_validation->set_rules('harga[]', 'Harga', 'trim|required|xss_clean');
            $this->form_validation->set_rules('idtoko', 'toko', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dibayar', 'Dibayar', 'trim|required|xss_clean');
           // $this->form_validation->set_rules('idtoko', 'toko', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {

                $idkomoditi = $this->post('kodebarang', TRUE);
                $jumlah = $this->post('jumlah', TRUE);
                $harga = $this->post('harga', TRUE);
                for($i=0; $i<count($idkomoditi);$i++){
                    $data = array(
                        'id_toko_penjualan_rpk' =>$this->post('idtoko', TRUE),
                        'no_nota_penjualan_rpk' =>$this->post('nota', TRUE),
                        'id_komoditi_penjualan_rpk' => $idkomoditi[$i],
                        'harga_komoditi_penjualan_rpk' => $harga[$i],
                        'jumlah_komoditi_penjualan_rpk' => $jumlah[$i],
                        'tanggal_penjualan_rpk' => $this->post('tanggal', TRUE),
                        'dibayar_penjualan_rpk' => $this->post('dibayar', TRUE),
                        'kembali_penjualan_rpk' => $this->post('kembali', TRUE)
                    );
                    $cek = $this->m_app->insert_data('tb_penjualan_rpk', $data);
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
        if(!$this->adminlogin) {
            $this->response(array('status' => false, array('error'=>'Data tidak dapat diakses')), REST_Controller::HTTP_OK);
        }else {
            $data = $this->m_app->myquery_array("SELECT * FROM ".$this->table." WHERE ".$this->idfield." = ".$this->delete('id', TRUE));
            if($data){
                $data_log = array(
                    'IDUSER_LOG' => $this->adminlogin,
                    'ACTION_LOG' => 'Delete',
                    'LINK_LOG' => 'Penjualan Tiket',
                    'KETERANGAN_LOG' => $this->libarraytext->arrayDisplay($data[0]),
                    'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
                );
            }
            $where = array($this->idfield => $this->delete('id', TRUE));
            $cek = $this->m_app->delete_data($this->table, $where);
            if ($cek) {
                $this->m_app->insert_data('master_log',$data_log);
                $this->response(array('status' => $cek), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('status' => FALSE, 'message' => 'Data could not be deleted'), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function select_get() {
        if(!$this->adminlogin) {
            $this->response(array('status' => false, array('error'=>'Data tidak dapat diakses')), REST_Controller::HTTP_OK);
        }else {
            $id = $this->get('id', TRUE);
            $cek = $this->m_app->datatable($this->table, array($this->idfield => $id));
            if ($cek) {
                $this->response(array('data' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('data' => FALSE, 'message' => 'Data could not be found', 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
}