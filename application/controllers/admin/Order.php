<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');


class Order extends CI_Controller {



function __construct() {
    parent::__construct();
    $this->load->library('upload');
    $this->load->library("Pdf");
    $this->load->library('m_pdf');
    $this->load->library('zend');
}



  var $column_order = array('waktu', null);
  var $column_search = array('waktu');
  var $order = array('waktu' => 'ASC');



  function index() {

    $this->baru();

    /* $this->load->view('template/template', [

            'content' => $this->load->view('admin/order/list', [], true)

        ]); */

  }





  var $ncolumn_order = array('waktu', null);

  var $ncolumn_search = array('waktu');

  var $norder = array('waktu' => 'ASC');



  function baru() {

    $this->load->view('template/template', [

      'content' => $this->load->view('admin/order/baru', [], true)

    ]);

  }



  var $pcolumn_order = array('waktu_upload', null);

  var $pcolumn_search = array('waktu_upload');

  var $porder = array('waktu_upload' => 'ASC');



  function pending() {

    $this->load->view('template/template', [

      'content' => $this->load->view('admin/order/pending', [], true)

    ]);

  }



  function sukses() {

    $this->load->view('template/template', [

      'content' => $this->load->view('admin/order/sukses', [], true)

    ]);

  }



  public function listfinddatabaru() {

    $this->load->helper('url');



    $list = $this->crud->getfind_data('tr_booking', $this->ncolumn_order, $this->ncolumn_search, $this->norder, 'status', 'baru');

    $data = array();

    $no = $_POST['start'];

    $n = 0;

    foreach ($list as $l) {
      $lap = $this->crud->read('ms_lapangan',['id'=>$l['id_lapangan']])[0];
        $no++;
        $row = array();
        $row[] = '<div style="white-space:normal; width:100%;"><p>'.tanggal(substr($l['waktu'], 0, 10), true) . ' ' . substr($l['waktu'], 11, 8).' WIB</p></div>';
        $row[] = '<div style="white-space:normal; width:100%;"><p>'.$l['nama'] . ' (' . $l['email'] . ' - ' . $l['no_hp'] . ')</p></div>';
        $row[] = $lap['nama'];
        $row[] = rupiah($lap['harga']);
        $row[] = rupiah($l['nominal']);


        $data[] = $row;

    }



    $output = array(

      "draw" => $_POST['draw'],

      "recordsTotal" => $this->db->where('status', 'baru')->from('tr_booking')->count_all_results(),

      "recordsFiltered" => $this->db->where('status', 'baru')->get('tr_booking')->num_rows(),

      "data" => $data,

    );

    //output to json format

    echo json_encode($output);

  }



  public function listfinddatapending() {

    $this->load->helper('url');



    $list = $this->crud->getfind_data('tr_booking', $this->pcolumn_order, $this->pcolumn_search, $this->porder, 'status', 'pending');

    $data = array();

    $no = $_POST['start'];

    $n = 0;

    foreach ($list as $l) {
        $lap = $this->crud->read('ms_lapangan',['id'=>$l['id_lapangan']])[0];
      $no++;

      $row = array();

      $row[] = tanggal(substr($l['waktu_upload'], 0, 10), true) . ' ' . substr($l['waktu_upload'], 11, 8);

      $row[] = $l['nama'] . ' (' . $l['email'] . ' - ' . $l['no_hp'] . ')';
        
      $row[] = $lap['nama'].' | '.tanggal($l['tgl_booking'], true).' ('.substr($l['jam_mulai'], 0, 5).'-'.substr($l['jam_selesai'], 0, 5).')';

      $row[] = $l['bank'] . ' (' . $l['norek'] . ' An. ' . $l['nama_norek'] . ')';

      $row[] = rupiah($l['nominal']);

      $row[] = '<a class="text-success" href="javascript:void(0)" title="Bukti" onclick="bukti(' . "'" . $l['id_booking'] . "'" . ')"><i class="icofont icofont-2x icofont-ui-v-card"></i></a>';





      $data[] = $row;

    }



    $output = array(

      "draw" => $_POST['draw'],

      "recordsTotal" => $this->db->where('status', 'pending')->from('tr_booking')->count_all_results(),

      "recordsFiltered" => $this->db->where('status', 'pending')->get('tr_booking')->num_rows(),

      "data" => $data,

    );

    //output to json format

    echo json_encode($output);

  }



  public function listfinddatasukses() {

    $this->load->helper('url');



    $list = $this->crud->getfind_data('tr_booking', $this->ncolumn_order, $this->ncolumn_search, $this->order, 'status', 'sukses');

    $data = array();

    $no = $_POST['start'];

    $n = 0;

    foreach ($list as $l) {
        $lap = $this->crud->read('ms_lapangan',['id'=>$l['id_lapangan']])[0];
      $no++;

      $row = array();

      $row[] = $l['waktu_verifed'];

      $row[] = $l['nama'] . ' (' . $l['email'] . ' - ' . $l['no_hp'] . ')';

      $row[] = $lap['nama'].' | '.tanggal($l['tgl_booking'], true).' ('.substr($l['jam_mulai'], 0, 5).'-'.substr($l['jam_selesai'], 0, 5).')';

      $row[] = rupiah($lap['harga']);

      $row[] = $l['bank'] . ' (' . $l['norek'] . ' An. ' . $l['nama_norek'] . ')';

      $row[] = rupiah($l['nominal']);

      $row[] = '';





      $data[] = $row;

    }



    $output = array(

      "draw" => $_POST['draw'],

      "recordsTotal" => $this->db->where('status', 'sukses')->from('tr_booking')->count_all_results(),

      "recordsFiltered" => $this->db->where('status', 'sukses')->get('tr_booking')->num_rows(),

      "data" => $data,

    );

    //output to json format

    echo json_encode($output);

  }



  function edit($id) {

    $data = $this->crud->read('tr_booking', ['id_booking' => $id])[0];

    echo json_encode($data);

  }

  function kirim(){
    $_POST['waktu_verifed'] = date('Y-m-d H:i:s');
    $_POST['status'] = 'Sukses';
    $_POST['admin'] = $this->session->userdata('id_user');
    $this->crud->update('tr_booking', ['id_booking' => $this->input->post('id_booking')], $this->input->post());

    echo json_encode(array("status" => TRUE));
  }






}