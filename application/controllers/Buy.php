<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends CI_Controller {

  function order() {
    $_POST['nominal'] = $this->input->post('nominal')*$this->input->post('jam_selesai');
    $_POST['jam_selesai'] = substr(date("Y-m-d H:i:s", strtotime($this->input->post('tgl_booking').' '.$this->input->post('jam_mulai'))+(60*60*$this->input->post('jam_selesai'))), 11);
    $_POST['waktu'] = date('Y-m-d H:i:s');
    $_POST['status'] = 'Baru';
    $_POST['batas_upload'] = date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s'))+(60*60*8));
    $_POST['id_user'] = $this->session->userdata('id_user_');
    $this->crud->create('tr_booking', $this->input->post());
    redirect('riwayat');
  }
}