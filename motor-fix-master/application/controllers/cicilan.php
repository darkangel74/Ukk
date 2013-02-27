<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cicilan extends CI_Controller {

    function construct() {
        parent::__contruct();
        require_authentication();
    }

    public function nama_cek() {
        $data['title'] = 'Cek Nama Pelanggan';
        $data['content'] = $this->load->view('cicilan/nama_cek', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_nama_cek() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        if (!$this->form_validation->run()) {
            $this->nama_cek();
        } else {
            $result = $this->general_model->select('tb_customer', '', '', '', '', '', array('nama', strip_tags($this->input->post('nama')), 'both'));
            if ($result != FALSE) {
                $result = $result->result_array();

                $kodecust = $result[0]['kode_customer'];
                $kredit = $this->general_model->select('v_kredit', 'kode_customer = ' . $kodecust, '', '', '', '', '');
                if ($kredit != FALSE) {
                    $data['list'] = $kredit->result_array();
                    $data['title'] = 'List Kredit';
                    $data['content'] = $this->load->view('cicilan/view_kredit', $data, TRUE);
                    $this->load->view('wrapper/content_wrapper', $data);
                } else {
                    $this->session->set_flashdata('message', '<div class="error">' . strip_tags($this->input->post('nama')) . ' Tidak Memiliki tanggungan kredit</div>');
                    redirect(site_url('kredit/add'));
                }
            } else {
                $this->session->set_flashdata('message', '<br><div class="error">Nama tidak ada dalam system</div>');
                redirect(site_url('cicilan/nama_cek'));
            }
        }
    }

    public function bayar_cicilan($id) {
        $kredit = $this->general_model->select('v_kredit', 'kode_kredit = ' . $id);
        if ($kredit != FALSE) {
            $list = $kredit->result_array();
            $kode_kredit = $list[0]['kode_kredit'];
            $harga_deal = $list[0]['harga_deal'];
            $lama_cicilan = $list[0]['lama_cicilan'];
            $sisa_bayar = $list[0]['sisa'];
            $harga_cicilan = $harga_deal / $lama_cicilan;
            $data = array(
                'nomor_bayar' => NULL,
                'kode_kredit' => $kode_kredit,
                'tanggal_bayar' => date('Y-m-d'),
                'jumlah' => $harga_cicilan
            );
            $insert = $this->general_model->insert('tb_bayar_cicilan', $data);
            $data = array(
                'sisa' => $sisa_bayar - $harga_cicilan
            );
            $update = $this->general_model->update('tb_beli_kredit', $data, array('kode_kredit' => $id));
            $this->session->set_flashdata('message', '<br><div class="success">cicilan berhasil di inputkan</div>');
            redirect(site_url('cicilan/nama_cek'));
        }
    }

    public function lunas_cicilan($id) {
        $kredit = $this->general_model->select('v_kredit', 'kode_kredit = ' . $id);
        if ($kredit != FALSE) {
            $list = $kredit->result_array();
            $kode_kredit = $list[0]['kode_kredit'];
            $harga_deal = $list[0]['harga_deal'];
            $sisa_bayar = $list[0]['sisa'];
            $data = array(
                'nomor_bayar' => NULL,
                'kode_kredit' => $kode_kredit,
                'tanggal_bayar' => date('Y-m-d'),
                'jumlah' => $sisa_bayar
            );
            $insert = $this->general_model->insert('tb_bayar_cicilan', $data);
            $data = array(
                'sisa' => '0'
            );
            $update = $this->general_model->update('tb_beli_kredit', $data, array('kode_kredit' => $id));
            $this->session->set_flashdata('message', '<br><div class="success">Pembayaran Lunas</div>');
            redirect(site_url('cicilan/nama_cek'));
        }
    }

}
