<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('id_slider', null);
    var $column_search = array('id_slider');
    var $order = array('id_slider' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/slider/list', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_slider', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = '<img class="img-fluid" src="'. base_url() .'slider/'. $l['banner_slider'] .'" />';
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_slider'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id_slider'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_slider')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_slider')->num_rows(),
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
        $error = 0;
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './slider/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'slider_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['banner_slider']['name'] == '' || !$this->upload->do_upload('banner_slider')) {
            echo $this->upload->display_errors();
        } else {
            $_POST['banner_slider'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'slider/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 1904;
            $config['height'] = 842;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
        if ($error == 0) {
            $_POST['id_slider'] = '';
            $_POST['created'] = date('Y-m-d H:i:s');
            $_POST['user'] = $this->session->userdata('id_user');
            $this->crud->create('ms_slider', $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function edit($id) {
        $data = $this->crud->read('ms_slider', ['id_slider' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_slider', ['id_slider' => $this->input->post('id_slider')]);
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './slider/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'slider_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['banner_slider']['name'] == '' || !$this->upload->do_upload('banner_slider')) {
            echo $this->upload->display_errors();
        } else {
            unlink('slider/' . $r[0]['banner_slider']);
            $_POST['banner_slider'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'slider/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 1904;
            $config['height'] = 842;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        if ($error == 0) {
            $this->crud->update('ms_slider', ['id_slider' => $this->input->post('id_slider')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function hapus($id) {
        $r = $this->crud->read('ms_slider', ['id_slider' => $id]);
        unlink('slider/' . $r[0]['banner_slider']);
        $this->crud->delete('ms_slider', ['id_slider' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
