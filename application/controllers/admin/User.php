<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('username');
    var $column_search = array('username');
    var $order = array('username' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/user/list', [
            ], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');
        
        $list = $this->crud->getfind_data('ms_user', $this->column_order, $this->column_search, $this->order, 'hak_akses', 'User');
        $data = array();
        $no = $_POST['start'];
        $n=0;
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['username'];
            $row[] = $l['nama_user'].' ('.$l['jenis_kelamin'].')';
            $row[] = $l['no_hp'];
            $row[] = $l['tgl_lahir'];
            $row[] = $l['alamat'];
            $row[] = '<a class="text-danger del" href="" rel="'. $l['id_user'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->where('hak_akses', 'Panpel')->from('ms_user')->count_all_results(),
            "recordsFiltered" => $this->db->where('hak_akses', 'Panpel')->get('ms_user')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function hapus($id) {
        $this->crud->delete('ms_user', ['id_user' => $id]);
        echo json_encode(array("status" => TRUE));
    }
    
}
