<?php

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {



  function index() {

    $this->load->view('riwayat', [



    ]);

  }

  var $column_order = array('id_lapangan', 'tgl_booking', 'jam_mulai', 'jam_selesai');

  var $column_search = array('id_lapangan', 'tgl_booking', 'jam_mulai', 'jam_selesai');

  var $order = array('tgl_booking' => 'DESC');

  public function listdata() {

    $this->load->helper('url');



    $list = $this->crud->getfind_data('tr_booking', $this->column_order, $this->column_search, $this->order, 'id_user', $this->session->userdata('id_user_'));

    $data = array();

    $no = $_POST['start'];

    foreach ($list as $l) {

      $no++;

      $row = array();

      $lapangan = $this->crud->read('ms_lapangan', ['id' => $l['id_lapangan']])[0];

      $row[] = $lapangan['nama'];

      $row[] = tanggal($l['tgl_booking'], true).' ('.substr($l['jam_mulai'], 0, 5).'-'.substr($l['jam_selesai'], 0, 5).')';

      if ($l['status'] == "Baru") {

        $row[] = 'Menunggu Pembayaran ('.rupiah($l['nominal']).')';

        $row[] = '<a class="text-primary" href="javascript:void(0)" title="Bayar" onclick="edit(' . "'" . $l['id_booking'] . "'" . ')">Bayar</a>';

      } else if ($l['status'] == "Pending") {
        $row[] = $l['status'];
        $row[] = '<a class="text-primary" href="https://api.whatsapp.com/send?phone=62'.substr(mainweb('whatsapp'),1).'&text=Hallo%20Admin,%0AMohon%20Percepat%20ACC%20Pesanan%20Saya%0ANama:%20" target="_BLANK" title="Percepat">Percepat ACC</a>';

      } else if ($l['status'] == "Sukses") {

        $row[] = $l['status'];

        $row[] = '';

      }







      $data[] = $row;

    }



    $output = array(

      "draw" => $_POST['draw'],

      "recordsTotal" => $this->db->where('id_user', $this->session->userdata('id_user_'))->from('tr_booking')->count_all_results(),

      "recordsFiltered" => $this->db->where('id_user', $this->session->userdata('id_user_'))->get('tr_booking')->num_rows(),

      "data" => $data,

    );

    //output to json format

    echo json_encode($output);

  }



  function edit($id) {

    $data = $this->crud->read('tr_booking', ['id_booking' => $id])[0];

    echo json_encode($data);

  }
  
  function kirimresi() {

        $error = 0;

        $r = $this->crud->read('tr_booking', ['id_booking' => $this->input->post('id_booking')]);

        $this->load->library('upload');

        $this->load->library('image_lib');



        $brt['upload_path'] = './resi/';

        $brt['allowed_types'] = 'gif|jpg|png';

        $brt['file_name'] = 'resi_' . time();



        $this->upload->initialize($brt);

        if ($_FILES['resi']['name'] == '' || !$this->upload->do_upload('resi')) {

            echo $this->upload->display_errors();

        } else {

            $_POST['resi'] = $this->upload->data('file_name');

            $config['image_library'] = 'gd2';

            $config['source_image'] = 'resi/' . $this->upload->data('file_name');

            $config['create_thumb'] = FALSE;

            $config['maintain_ratio'] = TRUE;

            $config['width'] = 500;

            $config['height'] = 0;

            $this->image_lib->initialize($config);

            $this->image_lib->resize();

        }



        if ($error == 0) {

            $_POST['waktu_upload'] = date('Y-m-d H:i:s');
            $_POST['status'] =  'Pending';
            $this->crud->update('tr_booking', ['id_booking' => $this->input->post('id_booking')], $this->input->post());

            echo json_encode(array("status" => TRUE));

        }

    }

}