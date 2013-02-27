<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cash extends CI_Controller {

    function construct() {
        parent::__contruct();
         require_authentication();
    }

    public function index($offset = 0) {
        $this->load->library('pagination');
        $limit = 2;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['base_url'] = base_url() . 'cash/page';
        $config['per_page'] = $limit;
        $config['total_rows'] = $this->general_model->total('v_cash', '');
        $this->pagination->initialize($config);

        $offsetlimit = array($offset, $limit);
        $data['list'] = $this->general_model->select('v_cash', '', '', $offsetlimit);
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "List Data Pembelian Cash";
        $data['pagination'] = $this->pagination->create_links();
        $data['content'] = $this->load->view('cash/view_cash', $data, TRUE);
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
        $data['motor'] = $motor;
        $data['cust'] = $cust;
        $data['title'] = 'Bayar Cash';
        $data['content'] = $this->load->view('cash/add_cash', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_add() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('merek', 'merek', 'required');
        $this->form_validation->set_rules('warna', 'warna', 'required');
        $this->form_validation->set_rules('pelanggan', 'pelanggan', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        if (!$this->form_validation->run()) {
            $this->add();
        } else {
            $data = array(
                'kode_cash' => NULL,
                'tanggal_cash' => date('Y-m-d'),
                'kode_customer' => strip_tags($this->input->post('pelanggan')),
                'kode_motor' => strip_tags($this->input->post('merek')),
                'harga_deal' => strip_tags($this->input->post('harga_deal')),
                'warna' => strip_tags($this->input->post('warna')),
                'keterangan' => strip_tags($this->input->post('keterangan'))
            );
            $insert = $this->general_model->insert('tb_beli_cash', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<br><div class="success">Transaksi telah disimpan</div>');
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
            }
            redirect(site_url('cash/add'));
        }
    }

    public function do_delete($id) {
        $del = $this->general_model->delete('tb_beli_cash', array('kode_cash' => $id));
        if (!$del) {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="success">Transaksi Cash telah di hapus</div>');
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
        $motor_arr = $this->general_model->select('tb_motor', 'kode_motor = ' . $id, 'harga')->result_array();
        echo $motor_arr[0]['harga'];
    }

}