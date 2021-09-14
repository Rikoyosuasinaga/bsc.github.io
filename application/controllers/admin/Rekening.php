<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('id','bank','no','nama');
    var $column_search = array('id','bank','no','nama');
    var $order = array('bank' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/setting/rekening', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_rekening', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['bank'];
            $row[] = $l['no'];
            $row[] = $l['nama'];
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_rekening')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_rekening')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function form() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/sponsor/form', '', true)
        ]);
    }

    function save() {
        $this->crud->create('ms_rekening', $this->input->post());
        echo json_encode(array("status" => TRUE));
    }

    function edit($id) {
        $data = $this->crud->read('ms_rekening', ['id' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $this->crud->update('ms_rekening', ['id' => $this->input->post('id')], $this->input->post());
        echo json_encode(array("status" => TRUE));
    }

    function hapus($id) {
        $this->crud->delete('ms_rekening', ['id' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
