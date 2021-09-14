<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
class Lapangan extends CI_Controller{
    
    function index(){
        $this->load->view('lapangan',[
            'promo' => $this->crud->read('ms_lapangan')
        ]);
    }
    function detail($link){
        $this->load->view('lapangan_detail',[
            'ticket' => $this->crud->read('ms_lapangan',['link' => $link])[0],
            'promo' => $this->crud->read('ms_lapangan')
        ]);
    }
    function beli($link){
        if($this->session->userdata('username_')==''){
            redirect('user');
        }else{
            $r = $this->db->where([
                'link' => $link
            ])->get('ms_lapangan')->row_array();
            if (count($r) <= 0) {
                $this->load->view('notfound/umum');
            }else{
                $this->load->view('lapangan_beli',[
                    'ticket' => $this->crud->read('ms_lapangan',['link' => $link])[0]
                ]);
            }
        }
    }
    function cektgl($id_lap,$tgl,$mulai,$selesai){
        $jam_selesai = substr(date("Y-m-d H:i:s",strtotime($tgl.' '.$mulai)+(60*60*$selesai)),11);
        $ket ='';
        $a = $this->db->where([
            'id_lapangan' => $id_lap,
            'tgl_booking' => $tgl,
            'jam_mulai' => $mulai
        ])->get('tr_booking')->row_array();
        if (count($a) <= 0) {
            $b = $this->db->where([
                'id_lapangan' => $id_lap,
                'tgl_booking' => $tgl,
                'jam_mulai >' => $jam_selesai,
                'jam_selesai <' => $jam_selesai,
            ])->get('tr_booking')->row_array();
            if (count($b) <= 0) {
                $c = $this->db->where([
                    'id_lapangan' => $id_lap,
                    'tgl_booking' => $tgl,
                    'jam_mulai >' => $mulai,
                    'jam_selesai <' => $mulai,
                ])->get('tr_booking')->row_array();
                if (count($b) <= 0) {
                    $ket = 'Tidak';
                }else{
                    $ket = 'Ada';
                }
            }else{
                $ket = 'Ada';
            }
        }else{
            $ket = 'Ada';
        }
        $isi = $jam_selesai;
        $data = array(
            array(
                'nama' => $ket
            )
        );
          $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
