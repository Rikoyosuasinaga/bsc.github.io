<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('id','nama','testi', null);
    var $column_search = array('id','nama','testi', null);
    var $order = array('nama' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/testimonials/list', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_testimonials', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['nama'];
            $row[] = substr($l['testi'],0,70).'...';
            $row[] = '<img class="img-fluid" src="'. base_url() .'testimonials/'. $l['foto'] .'" />';
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_testimonials')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_testimonials')->num_rows(),
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

        $brt['upload_path'] = './testimonials/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'testimonials_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['foto']['name'] == '' || !$this->upload->do_upload('foto')) {
            echo $this->upload->display_errors();
        } else {
            $_POST['foto'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'testimonials/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 0;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
        if ($error == 0) {
            $_POST['id'] = $this->uuid->v4();
            $_POST['created'] = date('Y-m-d H:i:s');
            $_POST['user'] = $this->session->userdata('id_user');
            $this->crud->create('ms_testimonials', $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function edit($id) {
        $data = $this->crud->read('ms_testimonials', ['id' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_testimonials', ['id' => $this->input->post('id')]);
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './testimonials/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'testimonials_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['foto']['name'] == '' || !$this->upload->do_upload('foto')) {
            echo $this->upload->display_errors();
        } else {
            unlink('testimonials/' . $r[0]['foto']);
            $_POST['foto'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'testimonials/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 0;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        if ($error == 0) {
            $_POST['created'] = date('Y-m-d H:i:s');
            $_POST['user'] = $this->session->userdata('id_user');
            $this->crud->update('ms_testimonials', ['id' => $this->input->post('id')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function hapus($id) {
        $r = $this->crud->read('ms_testimonials', ['id' => $id]);
        unlink('testimonials/' . $r[0]['foto']);
        $this->crud->delete('ms_testimonials', ['id' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
