<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller{
    function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->adminlogin = $this->session->userdata('iduser_webpasar');
        $this->thash		=	$this->security->get_csrf_hash();
        $this->tname		=	$this->security->get_csrf_token_name();
        $this->gambar = '';
    }

    function handle_upload($value, $params)
    {
        if (isset($_FILES['image']) && !empty($_FILES['image']['name']))
        {
            if ($this->upload->do_upload('image'))
            {
                // set a $_POST value for 'image' that we can use later
                $upload_data    = $this->upload->data();
                //$_POST['image'] = $upload_data['file_name'];
                $this->gambar = $upload_data['file_name'];
                return true;
            }
            else
            {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        }
        else
        {
            // throw an error because nothing was uploaded
            //$this->form_validation->set_message('handle_upload', "You must upload an image!");
            list($act, $table, $field, $id, $fieldid) = explode("|", $params, 5);
            if($act == 'add') {
                $this->gambar = "default.png";
            }else{
                $this->gambar = $this->m_app->datatable($table,array($fieldid=>$id))[0][$field];
            }
            return true;
        }
    }

    public function index_get() {

            $id = ($this->get('id', TRUE)) ? $this->get('id', TRUE) : '';
        if(!empty($id)) {
            $data = $this->m_app->datatable('master_user',array('ID_USER'=>$id));
        }else{
            $data = $this->m_app->datatable('master_user');
        }

            $array = array();
            if ($data) {
                foreach ($data as $row) {
                    $hakakses = $this->m_app->datatable('master_hakakses', array('ID_HAKAKSES' => $row['IDHAKAKSES_USER']))[0];
                    $array[] = array(
                        $row['ID_USER'],
                        $row['NIP_USER'],
                        $row['NAMA_USER'],
                        $row['IDUPT_USER'],
                        $row['USERNAME_USER'],
                        $row['PASSWORD_USER'],
                        $row['IDHAKAKSES_USER'],
                        $row['LASTLOGIN_USER'],
                        $row['myindex'],
                        $this->m_app->datatable('master_upt', array('ID_UPT' => $row['IDUPT_USER']))[0]['NAMA_UPT'],
                        $hakakses['NAMA_HAKAKSES'],
                        $row['FOTO_USER'],
                        $hakakses['AKSI_HAKAKSES']
                    );
                }

            }
            $this->response(array('aaData' => $array, 'sEcho' => '1', 'recordsTotal' => count($data), 'recordsFiltered' => count($data)), REST_Controller::HTTP_OK);

    }

    public function insert_post() {
        if(!$this->adminlogin) {
            $this->response(array('status' => false, array('error'=>'Data tidak dapat diakses')), REST_Controller::HTTP_OK);
        }else {
            $path = './assets/images/file_photo';
            $config = array(
                'upload_path' => $path,
                'overwrite' => true,
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size' => '500',
                'max_height' => "768",
                'max_width' => "1024",
                'file_name' => $this->post('username', TRUE)
            );
            $this->load->library('upload', $config);

            $this->form_validation->set_message('is_unique', ' %s Sudah ada dalam database');
            $this->form_validation->set_rules('nip', 'Nip', 'trim|is_unique[master_user.NIP_USER]|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[master_user.USERNAME_USER]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
            $this->form_validation->set_rules('image', 'Image', 'callback_handle_upload[add||||]');
            if ($this->form_validation->run() == FALSE) {
                $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {

                $data = array('NIP_USER' => $this->post('nip', TRUE),
                    'NAMA_USER' => $this->post('nama', TRUE),
                    'IDUPT_USER' => $this->post('idupt', TRUE),
                    'USERNAME_USER' => $this->post('username', TRUE),
                    'PASSWORD_USER' => $this->m_app->convert_pw($this->post('password', TRUE)),
                    'IDHAKAKSES_USER' => $this->post('idhakakses', TRUE),
                    'LASTLOGIN_USER' => 'null',
                    'FOTO_USER' => $this->gambar
                );

                $data_log = array(
                    'IDUSER_LOG' => $this->adminlogin,
                    'ACTION_LOG' => 'Insert',
                    'LINK_LOG' => 'User',
                    'KETERANGAN_LOG' => $this->libarraytext->arrayDisplay($data),
                    'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
                );

                $cek = $this->m_app->insert_data('master_user', $data);
                if (!empty($cek)) {
                    $this->m_app->insert_data('master_log',$data_log);
                    $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be inserted'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
    }

    public function updateprofile_post() {
        if(!$this->adminlogin) {
            $this->response(array('status' => false, array('error'=>'Data tidak dapat diakses')), REST_Controller::HTTP_OK);
        }else {
            $path = './assets/images/file_photo';
            $config = array(
                'upload_path' => $path,
                'overwrite' => true,
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size' => '500',
                'max_height' => "768",
                'max_width' => "1024",
                'file_name' => $this->post('username', TRUE)
            );
            $this->load->library('upload', $config);

            $this->form_validation->set_rules('nip', 'Nip', 'trim|callback_edit_unique[master_user|NIP_USER|' . $this->adminlogin . '|ID_USER]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
            $this->form_validation->set_rules('image', 'Image', 'callback_handle_upload[edit|master_user|FOTO_USER|' . $this->adminlogin . '|ID_USER]');
            if ($this->form_validation->run() == FALSE) {
                $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {

                $data = array('NIP_USER' => $this->post('nip', TRUE),
                    'NAMA_USER' => $this->post('nama', TRUE),
                   // 'IDUPT_USER' => $this->post('idupt', TRUE),
                    //       'USERNAME_USER' => $this->post('username', TRUE),
                    //'IDHAKAKSES_USER' => $this->post('idhakakses', TRUE),
                    'FOTO_USER' => $this->gambar
                );

                if ($this->m_app->datatable('master_user', array('ID_USER' => $this->adminlogin))[0]['PASSWORD_USER'] != $this->post('password', TRUE)) {
                    $data['PASSWORD_USER'] = $this->m_app->convert_pw($this->post('password', TRUE));
                }
                $cek = $this->m_app->update_data('master_user', $data, array('ID_USER' => $this->adminlogin));
                if (!empty($cek)) {
                    $data1 = $this->m_app->myquery_array("SELECT * FROM master_user WHERE ID_USER = ".$this->adminlogin);
                    if($data1){
                        $data_log = array(
                            'IDUSER_LOG' => $this->adminlogin,
                            'ACTION_LOG' => 'Update',
                            'LINK_LOG' => 'Profile',
                            'KETERANGAN_LOG' => $this->libarraytext->arrayDisplay($data1[0]),
                            'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
                        );
                    }
                    $this->m_app->insert_data('master_log',$data_log);
                    $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be inserted'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
    }

    public function edit_unique($value, $params)
    {
        $this->form_validation->set_message('edit_unique',
            ' %s Sudah ada dalam database');

        list($table, $field, $id, $fieldid) = explode("|", $params, 4);

        $query = $this->db->select($field)->from($table)
            ->where($field, $value)->where($fieldid.' !=', $id)->limit(1)->get();

        if ($query->row()) {
            return false;
        } else {
            return true;
        }
    }

    public function update_post() {
        if(!$this->adminlogin) {
            $this->response(array('status' => false, array('error'=>'Data tidak dapat diakses')), REST_Controller::HTTP_OK);
        }else {
            $path = './assets/images/file_photo';
            $config = array(
                'upload_path' => $path,
                'overwrite' => true,
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size' => '500',
                'max_height' => "768",
                'max_width' => "1024",
                'file_name' => $this->post('username', TRUE)
            );
            $this->load->library('upload', $config);

            // $this->form_validation->set_message('is_unique', ' %s Sudah ada dalam database');
            $this->form_validation->set_rules('nip', 'Nip', 'trim|callback_edit_unique[master_user|NIP_USER|' . $this->post('id', TRUE) . '|ID_USER]|xss_clean');
            // $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_edit_unique[master_user|NAMA_USER|'.$this->post('id',TRUE).'|ID_USER]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|xss_clean');
            $this->form_validation->set_rules('image', 'Image', 'callback_handle_upload[edit|master_user|FOTO_USER|' . $this->post('id', TRUE) . '|ID_USER]');
            if ($this->form_validation->run() == FALSE) {
                $this->response(array('status' => FALSE, 'message' => $this->form_validation->error_array(), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            } else {

                $data = array('NIP_USER' => $this->post('nip', TRUE),
                    'NAMA_USER' => $this->post('nama', TRUE),
                    'IDUPT_USER' => $this->post('idupt', TRUE),
                    //       'USERNAME_USER' => $this->post('username', TRUE),
                    'IDHAKAKSES_USER' => $this->post('idhakakses', TRUE),
                    'FOTO_USER' => $this->gambar
                );

                if ($this->m_app->datatable('master_user', array('ID_USER' => $this->post('id', TRUE)))[0]['PASSWORD_USER'] != $this->post('password', TRUE)) {
                    $data['PASSWORD_USER'] = $this->m_app->convert_pw($this->post('password', TRUE));
                }
                $cek = $this->m_app->update_data('master_user', $data, array('ID_USER' => $this->post('id', TRUE)));
                if (!empty($cek)) {
                    $data1 = $this->m_app->myquery_array("SELECT * FROM master_user WHERE ID_USER = ".$this->post('id', TRUE));
                    if($data1){
                        $data_log = array(
                            'IDUSER_LOG' => $this->adminlogin,
                            'ACTION_LOG' => 'Update',
                            'LINK_LOG' => 'User',
                            'KETERANGAN_LOG' => $this->libarraytext->arrayDisplay($data1[0]),
                            'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
                        );
                    }
                    $this->m_app->insert_data('master_log',$data_log);
                    $this->response(array('status' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => FALSE, 'message' => array('error' => 'Data could not be inserted'), 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
    }

    public function delete_delete() {
        if(!$this->adminlogin) {
            $this->response(array('status' => false, array('error'=>'Data tidak dapat diakses')), REST_Controller::HTTP_OK);
        }else {
            $data1 = $this->m_app->myquery_array("SELECT * FROM master_user WHERE ID_USER = ".$this->post('id', TRUE));
            if($data1){
                $data_log = array(
                    'IDUSER_LOG' => $this->adminlogin,
                    'ACTION_LOG' => 'Delete',
                    'LINK_LOG' => 'User',
                    'KETERANGAN_LOG' => $this->libarraytext->arrayDisplay($data1[0]),
                    'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
                );
            }
            $where = array('ID_USER' => $this->delete('id', TRUE));
            $data = $this->m_app->datatable('master_user', $where);
            if ($data[0]['FOTO_USER'] == 'default.png') {
                $cek = $this->m_app->delete_data('master_user', $where);
            } else {
                if (unlink('assets/images/file_photo/' . $data[0]['FOTO_USER'])) {
                    $cek = $this->m_app->delete_data('master_user', $where);
                }
            }
            if ($cek) {
                $this->m_app->insert_data('master_log',$data_log);
                $this->response(array('status' => $cek, 'where' => $where), REST_Controller::HTTP_OK);
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
            $cek = $this->m_app->datatable('master_hakakses', array('ID_HAKAKSES' => $id));
            if ($cek) {
                $this->response(array('data' => $cek, 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK);
            } else {
                $this->response(array('data' => FALSE, 'message' => 'Data could not be found', 'tname' => $this->tname, 'thash' => $this->thash), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
}