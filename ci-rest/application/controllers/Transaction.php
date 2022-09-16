<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Transaction extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('idx_anggota');
        if ($id == '') {
            $simpanan = $this->db->get('sp_simpanan')->result();
        } else {
            $this->db->where('idx_anggota', $id);
            $simpanan = $this->db->get('sp_simpanan')->result();
        }
        $this->response($simpanan, 200);
    }


	function index_post() {
        $data = array(
                    'nama_anggota'      => $this->post('nama_anggota'),
                    'tgl_lahir_anggota' => $this->post('tgl_lahir_anggota'),
                    'alamat_anggota'    => $this->post('alamat_anggota'));
        $insert = $this->db->insert('sp_simpanan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	
	function index_put() {
        $id = $this->put('id');
        $data = array(
                    'nama_anggota'   	=> $this->put('nama_anggota'),
                    'tgl_lahir_anggota' => $this->put('tgl_lahir_anggota'),
                    'alamat_anggota' 	=> $this->put('alamat_anggota'));
        $this->db->where('idx_simpanan', $id);
        $update = $this->db->update('sp_simpanan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	
	function index_delete() {
        $id = $this->delete('id');
        $this->db->where('idx_simpanan', $id);
        $delete = $this->db->delete('sp_simpanan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>