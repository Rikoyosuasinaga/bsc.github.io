<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lapangan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('id');
    var $column_search = array('id');
    var $order = array('id' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/lapangan/list', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_lapangan', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $l['nama'];
            $row[] = rupiah($l['harga']);
            $row[] = '<img class="img img-fluid" src="'.base_url().'banner/'.$l['banner'].'" />';
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>
            <a class="text-danger del" href="" rel="'. $l['id'].' " title="Hapus"><i class="icofont icofont-2x icofont-ui-delete"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_lapangan')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_lapangan')->num_rows(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        $error = 0;
        $this->load->library('upload');
        $this->load->library('image_lib');
        $find = array(" ","/",":","`",",","?","!","#","'",".","%");
        $replace = array("-","","","","","","","","","","");

        $brt['upload_path'] = './banner/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'banner_'  . time();

        $this->upload->initialize($brt);
        if ($_FILES['banner']['name'] == '' || !$this->upload->do_upload('banner')) {
            echo $this->upload->display_errors();
        } else {
            $_POST['banner'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'banner/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 1000;
            $config['height'] = 1000;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
        if ($error == 0) {
            $_POST['id'] = $this->uuid->v4();
            $_POST['link'] = strtolower(str_replace($find,$replace, $this->input->post('nama')));
            $this->crud->create('ms_lapangan', $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function edit($id) {
        $data = $this->crud->read('ms_lapangan', ['id' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_lapangan', ['id' => $this->input->post('id')]);
        $this->load->library('upload');
        $this->load->library('image_lib');
        $find = array(" ","/",":","`",",","?","!","#","'",".","%");
        $replace = array("-","","","","","","","","","","");

        $brt['upload_path'] = './banner/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'banner_'  . time();

        $this->upload->initialize($brt);
        if ($_FILES['banner']['name'] == '' || !$this->upload->do_upload('banner')) {
            echo $this->upload->display_errors();
        } else {
            unlink('banner/' . $r[0]['banner']);
            $_POST['banner'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'banner/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 1000;
            $config['height'] = 1000;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        if ($error == 0) {
            $_POST['link'] = strtolower(str_replace($find,$replace, $this->input->post('nama')));
            $this->crud->update('ms_lapangan', ['id' => $this->input->post('id')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function hapus($id) {
        $r = $this->crud->read('ms_lapangan', ['id' => $id]);
        unlink('banner/' . $r[0]['banner']);
        $this->crud->delete('ms_lapangan', ['id' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
