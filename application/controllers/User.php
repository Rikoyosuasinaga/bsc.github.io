<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{
    
    function index(){
        $this->load->view('user_login',[
        ]);
    }
    function validasi() {
        $r = $this->db->where([
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password'))
                ])->get('ms_user')->row_array();
        if (count($r) <= 0) {
            redirect('user');
        } else {
            $this->session->set_userdata('id_user_', $r['id_user']);
            $this->session->set_userdata('username_', $r['username']);
            $this->session->set_userdata('nama_', $r['nama_user']);
            $this->session->set_userdata('tgl_', $r['tgl_lahir']);
            $this->session->set_userdata('jk_', $r['jenis_kelamin']);
            $this->session->set_userdata('alamat_', $r['alamat']);
            $this->session->set_userdata('no_hp_', $r['no_hp']);
            $this->session->set_userdata('email_', $r['email']);
            $this->session->set_userdata('foto_', $r['foto']);
            $this->session->set_userdata('akses_', $r['hak_akses']);
            redirect('home');
        }
    }
    function daftar(){
        $this->load->view('user_daftar',[
        ]);
    }
    function verifikasi() {
        $this->_validate();
        unset($_POST['password_']);
        $_POST['password'] = md5($this->input->post('password'));
        $_POST['hak_akses'] = 'User';
        $this->crud->create('ms_user', $this->input->post());
        echo json_encode(array("status" => TRUE));
    }
    private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_user') == '')
		{
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Nama tidak boleh kosong!';
			$data['status'] = FALSE;
		}
		if($this->input->post('jenis_kelamin') == '')
		{
            $data['inputerror'][] = 'jenis_kelamin';
			$data['error_string'][] = 'Jenis Kelamin Wajib dipilih!';
			$data['status'] = FALSE;
		}
        if($this->input->post('tgl_lahir') == '')
        {
            $data['inputerror'][] = 'tgl_lahir';
            $data['error_string'][] = 'Tanggal Lahir tidak boleh kosong!';
            $data['status'] = FALSE;
        }
        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Tanggal Lahir tidak boleh kosong!';
            $data['status'] = FALSE;
        }
        if($this->input->post('no_hp') == '')
        {
            $data['inputerror'][] = 'no_hp';
            $data['error_string'][] = 'Tanggal Lahir tidak boleh kosong!';
            $data['status'] = FALSE;
        }
        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Tanggal Lahir tidak boleh kosong!';
            $data['status'] = FALSE;
        }
        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'username tidak boleh kosong!';
            $data['status'] = FALSE;
        }else{
            $this->db->from('ms_user');
            $this->db->where('username', $this->input->post('username'));
            $n = $this->db->get();
            $rowcount1 = $n->num_rows();
            if ($rowcount1 >= 1) {
                $data['inputerror'][] = 'username';
                $data['error_string'][] = 'Username sudah ada!';
                $data['status'] = FALSE;
            }
        }
        if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password tidak boleh kosong!';
            $data['status'] = FALSE;
        }else {
            if($this->input->post('password')!=$this->input->post('password_')){
                $data['inputerror'][] = 'password_';
                $data['error_string'][] = 'Password tidak sesuai!';
                $data['status'] = FALSE;
            }
        }

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
    }
    function logout() {
        $this->session->unset_userdata('id_user_');
        $this->session->unset_userdata('username_');
        $this->session->unset_userdata('nama_');
        $this->session->unset_userdata('tgl_');
        $this->session->unset_userdata('jk_');
        $this->session->unset_userdata('alamat_');
        $this->session->unset_userdata('no_hp_');
        $this->session->unset_userdata('email_');
        $this->session->unset_userdata('foto_');
        $this->session->unset_userdata('akses_');
        redirect('home');
    }
}