<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{
    
    function index(){
        $this->load->view('home',[
            'slider' => $this->crud->read('ms_slider'),
            'promo' => $this->crud->readlimit('ms_lapangan',[],'',3)
        ]);
    }

    function notfound(){
        $this->load->view('notfound/umum');
    }
    
    function cobaliat() {
      echo 'Berhasil Membuat';
    }
    
}