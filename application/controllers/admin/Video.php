<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('id','judul', 'link');
    var $column_search = array('id','judul', 'link');
    var $order = array('judul' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/video/list', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_video', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['judul'];
            $row[] = '<iframe width="100%" height="315" src="'.$l['link'].'"
                frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>';
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_video')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_video')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function form() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/klub/form', '', true)
        ]);
    }

    function save() {
        $_POST['id'] = $this->uuid->v4();
        $_POST['created'] = date('Y-m-d H:i:s');
        $_POST['user'] = $this->session->userdata('id_user');
        $this->crud->create('ms_video', $this->input->post());
        echo json_encode(array("status" => TRUE));
    }

    function edit($id) {
        $data = $this->crud->read('ms_video', ['id' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $_POST['created'] = date('Y-m-d H:i:s');
        $_POST['user'] = $this->session->userdata('id_user');
        $this->crud->update('ms_video', ['id' => $this->input->post('id')], $this->input->post());
        echo json_encode(array("status" => TRUE));
    }

    function hapus($id) {
        $this->crud->delete('ms_video', ['id' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
