<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_template_email extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('id_config','logo','banner','nama','footer');
    var $column_search = array('id_config','logo','banner','nama','footer');
    var $order = array('id_config' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/setting/email', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_config_email', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = '<img class="img-fluid" src="'. base_url() .'logo/'. $l['logo'] .'" />';
            $row[] = '<img class="img-fluid" src="'. base_url() .'logo/'. $l['banner'] .'" />';
            $row[] = $l['nama'];
            $row[] = $l['email'];
            $row[] = $l['facebook'];
            $row[] = $l['instagram'];
            $row[] = $l['twitter'];
            $row[] = $l['footer'];
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id_config'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_config_email')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_config_email')->num_rows(),
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
        $error = 0;
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './logo/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'logo_'  . time();

        $this->upload->initialize($brt);
        if ($_FILES['logo_sponsor']['name'] == '' || !$this->upload->do_upload('logo_sponsor')) {
            echo $this->upload->display_errors();
        } else {
            $_POST['logo_sponsor'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'logo/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 200;
            $config['height'] = 214;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
        if ($error == 0) {
            $_POST['id_sponsor'] = '';
            $_POST['created'] = date('Y-m-d H:i:s');
            $_POST['user'] = $this->session->userdata('id_user');
            $this->crud->create('ms_sponsor', $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function edit($id) {
        $data = $this->crud->read('ms_config_email', ['id_config' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_config_email', ['id_config' => $this->input->post('id_config')]);
        $this->load->library('upload');
        $this->load->library('image_lib');

        $brt['upload_path'] = './logo/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'logo_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['logo']['name'] == '' || !$this->upload->do_upload('logo')) {
            echo $this->upload->display_errors();
        } else {
            unlink('logo/' . $r[0]['logo']);
            $_POST['logo'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'logo/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 0;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        $brt['upload_path'] = './logo/';
        $brt['allowed_types'] = 'gif|jpg|png';
        $brt['file_name'] = 'banner_' . time();

        $this->upload->initialize($brt);
        if ($_FILES['banner']['name'] == '' || !$this->upload->do_upload('banner')) {
            echo $this->upload->display_errors();
        } else {
            unlink('logo/' . $r[0]['banner']);
            $_POST['banner'] = $this->upload->data('file_name');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'logo/' . $this->upload->data('file_name');
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 712;
            $config['height'] = 0;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        if ($error == 0) {
            $this->crud->update('ms_config_email', ['id_config' => $this->input->post('id_config')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }

    function hapus($id) {
        $r = $this->crud->read('ms_sponsor', ['id_sponsor' => $id]);
        unlink('logo/' . $r[0]['logo_sponsor']);
        $this->crud->delete('ms_sponsor', ['id_sponsor' => $id]);
        echo json_encode(array("status" => TRUE));
    }

}
