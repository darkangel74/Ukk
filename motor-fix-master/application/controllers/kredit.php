<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kredit extends CI_Controller {

    function construct() {
        parent::__construct();
        require_authentication();
    }

    function index($offset = 0) {
        $this->load->library('pagination');
        $limit = 2;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['base_url'] = base_url() . 'kredit/page';
        $config['per_page'] = $limit;
        $config['total_rows'] = $this->general_model->total('tb_beli_kredit', '');
        $this->pagination->initialize($config);

        $offsetlimit = array($offset, $limit);
        $data['list'] = $this->general_model->select('tb_beli_kredit', '', '', $offsetlimit);
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "List Data Kredit";
        $data['pagination'] = $this->pagination->create_links();
        $data['content'] = $this->load->view('kredit/view_kredit', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function page() {
        $show = (int) $this->uri->segment(3);
        $this->index($show);
    }

    public function add() {
        $motor_arr = $this->general_model->select('tb_motor', '', 'kode_motor,merek');
        if ($motor_arr != FALSE) {
            $motor_arr = $motor_arr->result_array();
            foreach ($motor_arr as $row) {
                $motor[''] = '-Merek Motor-';
                $motor[$row['kode_motor']] = $row['merek'];
            }
        }
        $cust_arr = $this->general_model->select('tb_customer', '', 'kode_customer,nama');
        if ($cust_arr != FALSE) {
            $cust_arr = $cust_arr->result_array();
            foreach ($cust_arr as $row) {
                $cust[''] = '-Pelanggan-';
                $cust[$row['kode_customer']] = $row['nama'];
            }
        }
        $cicilan_arr = $this->general_model->select('tb_bunga', '');
        if ($cicilan_arr != FALSE) {
            $cicilan_arr = $cicilan_arr->result_array();
            foreach ($cicilan_arr as $row) {
                $cicilan[''] = '-Jumlah Cicilan-';
                $cicilan[$row['lama_cicilan']] = $row['lama_cicilan'];
            }
        }
        $data['uangmuka'] = array('' => '-Uang Muka-', '500000' => 'Rp 500.000', '1000000' => 'Rp 1.000.000');
        $data['motor'] = $motor;
        $data['cust'] = $cust;
        $data['cicilan'] = $cicilan;
        $data['title'] = 'Bayar Kredit';
        $data['content'] = $this->load->view('kredit/add_kredit', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_add() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('merek', 'merek', 'required');
        $this->form_validation->set_rules('warna', 'warna', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        $this->form_validation->set_rules('uang_muka', 'uang_muka', 'required');
        $this->form_validation->set_rules('lama_cicilan', 'lama_cicilan', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        if (!$this->form_validation->run()) {
            $this->add();
        } else {
            $harga = strip_tags($this->input->post('harga'));
            $uang_muka = strip_tags($this->input->post('uang_muka'));
            $lama_cicilan = strip_tags($this->input->post('lama_cicilan'));
            $sisa_bayar = $harga - $uang_muka;

            $bunga_arr = $this->general_model->select('tb_bunga', 'lama_cicilan = ' . $lama_cicilan, 'bunga')->result_array();
            $bunga = $bunga_arr[0]['bunga'] / 100;
            $total_bunga = $sisa_bayar * $bunga;
            $sisa_bayar = $sisa_bayar + $total_bunga;
            $data = array(
                'kode_kredit' => NULL,
                'tanggal_kredit' => date('Y-m-d'),
                'kode_customer' => strip_tags($this->input->post('pelanggan')),
                'kode_motor' => strip_tags($this->input->post('merek')),
                'warna' => strip_tags($this->input->post('warna')),
                'keterangan' => strip_tags($this->input->post('keterangan')),
                'uang_muka' => strip_tags($this->input->post('uang_muka')),
                'lama_cicilan' => strip_tags($this->input->post('lama_cicilan')),
                'harga_deal' => $sisa_bayar,
                'sisa' => $sisa_bayar
            );
            $insert = $this->general_model->insert('tb_beli_kredit', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<br><div class="success">Transaksi telah disimpan</div>');
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
            }
            redirect(site_url('kredit/add'));
        }
    }

    public function do_delete($id) {
        $this->db->query("delete from tb_bayar_cicilan where kode_kredit = '$id'");
        $del = $this->general_model->delete('tb_beli_kredit', array('kode_kredit' => $id));
        if (!$del) {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="success">Data kredit di hapus</div>');
        } else {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="error">Something Error, anda belum beruntung</div>');
        }
    }

    public function ajax_warna() {
        $id = $this->input->post('id');
        $motor_arr = $this->general_model->select('tb_motor', 'kode_motor = ' . $id, 'warna')->result_array();
        $warna_arr = explode(',', $motor_arr[0]['warna']);
        foreach ($warna_arr as $row) {
            $warna[$row] = $row;
        }
        $data['value'] = $warna;
        $data['title'] = 'Warna : ';
        $this->load->view('wrapper/dropdown_wrapper', $data);
    }

    public function ajax_harga() {
        $id = $this->input->post('id');
        $cicilan = $this->input->post('cicilan');
        $motor_arr = $this->general_model->select('tb_motor', 'kode_motor = ' . $id, 'harga')->result_array();
        $harga = $motor_arr[0]['harga'] + ($cicilan / 100);
        echo $harga;
    }

    public function update($id) {
        $data['list'] = $this->general_model->select('tb_beli_kredit', array('kode_kredit' => $id));
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Update Data Kredit";
        $data['content'] = $this->load->view('kredit/update_kredit', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_update() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('kode_customer', 'kode_customer', 'required');
        $this->form_validation->set_rules('kode_motor', 'kode_motor', 'required');
        $this->form_validation->set_rules('warna', 'warna', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        $id = strip_tags($this->input->post('kode'));
        if (!$this->form_validation->run()) {
            $this->update($id);
        } else {
            $data = array(
                'kode_customer' => strip_tags($this->input->post('kode_customer')),
                'kode_motor' => strip_tags($this->input->post('kode_motor')),
                'warna' => strip_tags($this->input->post('warna')),
				'uang_muka' => strip_tags($this->input->post('uang_muka')),
				'lama_cicilan' => strip_tags($this->input->post('lama_cicilan'))
            );
            $update = $this->general_model->update('tb_beli_kredit', $data, array('kode_kredit' => $id));
            if ($update) {
                $this->session->set_flashdata('message', '<br><div class="success">Data Kredit telah diupdate</div>');
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
            }
            redirect(site_url('kredit'));
        }
    }

    public function to_pdf() {
        $data['list'] = $this->general_model->select('tb_beli_kredit');
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Laporan Pembelian Kredit";
        $data['content'] = $this->load->view('kredit/list_all', $data, TRUE);
        $html = $this->load->view('wrapper/print_wrapper', $data, TRUE);
        $this->load->library('mpdf');
        $this->mpdf->WriteHTML($html);
        $this->mpdf->output();
    }

}