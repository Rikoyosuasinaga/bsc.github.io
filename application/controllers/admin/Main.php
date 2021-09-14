<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('upload');
    }
    var $column_order = array('nama','logo','weekdays_loket_start');
    var $column_search = array('nama','logo','weekdays_loket_start');
    var $order = array('id' => 'ASC');

    function index() {
        $this->load->view('template/template', [
            'content' => $this->load->view('admin/setting/main', [], true)
        ]);
    }
    
    public function listdata() {
        $this->load->helper('url');

        $list = $this->crud->get_data('ms_main', $this->column_order, $this->column_search, $this->order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            // $row[] = '<img class="img-fluid" src="'. base_url() .'logo/'. $l['logo'] .'" />';
            $row[] = $l['nama'];
            $row[] = $l['logo'];
            $row[] = $l['whatsapp'];
            $row[] = '<a class="text-primary" href="javascript:void(0)" title="Edit" onclick="editdata(' . "'" . $l['id'] . "'" . ')"><i class="icofont icofont-2x icofont-edit"></i></a>';
            

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->from('ms_main')->count_all_results(),
            "recordsFiltered" => $this->db->get('ms_main')->num_rows(),
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

    function edit($id) {
        $data = $this->crud->read('ms_main', ['id' => $id])[0];
        echo json_encode($data);
    }

    function update() {
        $error = 0;
        $r = $this->crud->read('ms_main', ['id' => $this->input->post('id')]);
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
            $config['width'] = 500;
            $config['height'] = 0;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        if ($error == 0) {
            $this->crud->update('ms_main', ['id' => $this->input->post('id')], $this->input->post());
            echo json_encode(array("status" => TRUE));
        }
    }


}
