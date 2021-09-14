<?php

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {



  function index() {

    $this->load->view('jadwal', [
    ]);

  }


}