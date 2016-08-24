<?php if(!defined('BASEPATH')) exit('');

class M_app extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function convert_pw($s)	{
        return substr(do_hash(base64_encode($s), 'md5'), 0, 10);
    }

    function myencrypt($string, $key) {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }

        return base64_encode($result);
    }

    function mydecrypt($string, $key) {
        $result = '';
        $string = base64_decode($string);

        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }

        return $result;
    }

    function aksilogin($user, $pass)
    {
        $search = array('USERNAME_USER' => $user, 'PASSWORD_USER' => $this->myencrypt($pass,'myrpkbulog'));
        $data = $this->datatable('tb_user', $search);
        if (!empty($data)) {
            /*$data_log = array(
                'ACTION_LOG' => 'Login',
                'LINK_LOG' => 'Login',
                'KETERANGAN_LOG' => '',
                'TANGGAL_LOG' => mdate('%Y-%m-%d %H:%i:%s', now())
            );
            foreach ($data as $log): $login = array('iduser_webpasar' => $log['ID_USER']);  $data_log['IDUSER_LOG']=$log['ID_USER'];
            endforeach;*/
            //$return = "";
            /*if($data[0]['ROLE_USER']){
                $return = "ADMIN";
            }else{
                $return = "USER";
            }*/
            //$this->insert_data('master_log',$data_log);
            //$this->session->set_userdata($login);
            return array('status'=>TRUE,'iduser_rpk'=>$data[0]['ID_USER'],'idtoko_rpk'=>$data[0]['IDTOKO_USER'],'role_rpk'=>$data[0]['ROLE_USER']);
        } else {
            return array('status'=>FALSE);
        }
    }

    function myquery($query){
        $query = $this->db->query($query);
        return $query->result();
    }

    function myquery_array($query){
        $query = $this->db->query($query);
        return $query->result_array();
    }

    function  datatable($table, $search='' ,$max	=	'', $order = '', $id='')
    {
        $this->db->select($table.'.*,@rownum := @rownum+1 as myindex',false);
        $this->db->from($table.', (SELECT @rownum := 0) as d');
        if($search && is_array($search)){
            $this->db->where($search);
        }
        if($max){
            $this->db->limit($max);
        }
        if($order && $id){
            $this->db->order_by($id, $order);
        }

        $kueri = $this->db->get('');
        if($kueri->num_rows() > 0):
            return $kueri->result_array();
        else:
            return FALSE;
        endif;

    }

    function double_datatable($table1, $table2, $field1, $field2, $fieldsearch = '',$max	=	'', $order = '', $id='')
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table2.'.'.$field2 .'='. $table1.'.'.$field1);

        if($fieldsearch && is_array($fieldsearch)){
            $this->db->where($fieldsearch);
        }

        if($max){
            $this->db->limit($max);
        }
        if($order && $id){
            $this->db->order_by($id, $order);
        }

        $tampil = $this->db->get('');

		if($tampil->num_rows() > 0):
            return $tampil->result();
        else:
            return FALSE;
        endif;
        /*if ($tampil->num_rows() > 0) {
            foreach ($tampil->result() as $data){
                $info[] = $data;
            }
            return $info;
        }*/
    }

    function insert_data($table,$data){
		$return = NULL;

		if(is_array($data) && !empty($table)) {
			$return_id = $this->db->insert($table, $data);
			if($return_id) {
				$return	= $this->db->insert_id();
			}
		}
        
		return $return;
    }

    function update_data($table,$data,$where)
    {
		$return = FALSE;
        if(!empty($where) && is_array($where)) {
            $this->db->where($where);
            if($this->db->update($table, $data)){
				$return = TRUE;
			}
        }
		return $return;
    }

    function delete_data($table,$where = '')
    {
        $r = false;
        if(!empty($where) && is_array($where)) {
            $this->db->where($where);
            if($this->db->delete($table)){
				$r = true;
			}
        }
        return $r;
    }

    function datapagination($base_url, $table1, $fieldsearch = '',$max	=	5, $order = '', $id='')
    {
        $this->db->select('*');
        $this->db->from($table1);

        if($fieldsearch && is_array($fieldsearch)){
            $this->db->where($fieldsearch);
        }

        if($order && $id){
            $this->db->order_by($id, $order);
        }

        $uri_seg = count(explode('/',$base_url))+1;
        $config['base_url'] = site_url($base_url);
        $config['total_rows'] = $this->db->get('')->num_rows();
        $config['use_page_numbers'] = TRUE;
        $config['per_page']=$max;
        $config['num_links']=2;
        $config['next_link']='<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link']='<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link']='Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';
        $config['cur_tag_open'] = '<li><a class="activemenu">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '<li>';
        $config['uri_segment']=$uri_seg;

        $this->pagination->initialize($config);
        if($this->uri->segment($uri_seg) > 0)    $offset = ($this->uri->segment($uri_seg) + 0)*$config['per_page'] - $config['per_page'];
        else    $offset = $this->uri->segment($uri_seg);

        $this->db->select('*');
        $this->db->from($table1);
        if($fieldsearch && is_array($fieldsearch)){
            $this->db->where($fieldsearch);
        }

        if($order && $id){
            $this->db->order_by($id, $order);
        }

        $seleksiNews[0] = $this->db->get('', $config['per_page'], $offset);

        $seleksiNews[1] = $this->pagination->create_links();
        return $seleksiNews;
    }

    function search_datapagination($base_url, $table1, $fieldsearch = '',$fieldsearch1 = '',$max	=	5, $order = '', $id='')
    {
        $this->db->select('*');
        $this->db->from($table1);

        if($fieldsearch && is_array($fieldsearch)){
            $this->db->like($fieldsearch);
        }

        if($fieldsearch1 && is_array($fieldsearch1)){
            $this->db->or_like($fieldsearch1);
        }

        if($order && $id){
            $this->db->order_by($id, $order);
        }

        $uri_seg = count(explode('/',$base_url))+1;
        $config['base_url'] = site_url($base_url);
        $config['total_rows'] = $this->db->get('')->num_rows();
        $config['use_page_numbers'] = TRUE;
        $config['per_page']=$max;
        $config['num_links']=2;
        $config['next_link']='<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link']='<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link']='Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';
        $config['cur_tag_open'] = '<li><a class="activemenu">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '<li>';
        $config['uri_segment']=$uri_seg;

        $this->pagination->initialize($config);
        if($this->uri->segment($uri_seg) > 0)    $offset = ($this->uri->segment($uri_seg) + 0)*$config['per_page'] - $config['per_page'];
        else    $offset = $this->uri->segment($uri_seg);

        $this->db->select('*');
        $this->db->from($table1);
        if($fieldsearch && is_array($fieldsearch)){
            $this->db->like($fieldsearch);
        }

        if($fieldsearch1 && is_array($fieldsearch1)){
            $this->db->or_like($fieldsearch1);
        }

        if($order && $id){
            $this->db->order_by($id, $order);
        }

        $seleksiNews[0] = $this->db->get('', $config['per_page'], $offset);

        $seleksiNews[1] = $this->pagination->create_links();
        return $seleksiNews;
    }

    function double_datapagination($base_url, $table1, $table2, $field1, $field2, $fieldsearch = '',$max	=	5, $order = '', $id='')
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table2.'.'.$field2 .'='. $table1.'.'.$field1);

        if($fieldsearch && is_array($fieldsearch)){
            $this->db->where($fieldsearch);
        }

        if($order && $id){
            $this->db->order_by($id, $order);
        }

        $uri_seg = count(explode('/',$base_url))+1;
        $config['base_url'] = site_url($base_url);
        $config['total_rows'] = $this->db->get('')->num_rows();
        $config['use_page_numbers'] = TRUE;
        $config['per_page']=$max;
        $config['num_links']=2;
        $config['next_link']='<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link']='<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link']='Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';
        $config['cur_tag_open'] = '<li><a class="activemenu">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '<li>';
        $config['uri_segment']=$uri_seg;

        $this->pagination->initialize($config);
        if($this->uri->segment($uri_seg) > 0)    $offset = ($this->uri->segment($uri_seg) + 0)*$config['per_page'] - $config['per_page'];
        else    $offset = $this->uri->segment($uri_seg);

        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table2.'.'.$field2 .'='. $table1.'.'.$field1);
        if($fieldsearch && is_array($fieldsearch)){
            $this->db->where($fieldsearch);
        }

        if($order && $id){
            $this->db->order_by($id, $order);
        }

        $seleksiNews[0] = $this->db->get('', $config['per_page'], $offset);

        $seleksiNews[1] = $this->pagination->create_links();
        return $seleksiNews;
    }
}