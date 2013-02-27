<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    function construct() {
        parent::__contruct();
         require_authentication();
    }

    public function index($offset = 0) {
        $this->load->library('pagination');
        $limit = 2;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['base_url'] = base_url() . 'pelanggan/page';
        $config['per_page'] = $limit;
        $config['total_rows'] = $this->general_model->total('tb_customer', '');
        $this->pagination->initialize($config);

        $offsetlimit = array($offset, $limit);
        $data['list'] = $this->general_model->select('tb_customer', '', '', $offsetlimit);
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "List Data Motor";
        $data['pagination'] = $this->pagination->create_links();
        $data['content'] = $this->load->view('pelanggan/view_pelanggan', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function page() {
        $show = (int) $this->uri->segment(3);
        $this->index($show);
    }

    public function add() {
        $data['title'] = 'Tambah Pelanggan';
        $data['content'] = $this->load->view('pelanggan/add_pelanggan', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_add() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('telepon', 'telepon', 'required|numeric');
        $this->form_validation->set_rules('hp', 'hp', 'required|numeric');
        $this->form_validation->set_rules('ktp', 'ktp', 'required|numeric');
        $this->form_validation->set_rules('kk', 'kk', 'required|numeric');
        $this->form_validation->set_rules('gaji', 'gaji', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        if (!$this->form_validation->run()) {
            $this->add();
        } else {
            $data = array(
                'kode_customer' => NULL,
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'hp' => $this->input->post('hp'),
                'no_ktp' => $this->input->post('ktp'),
                'kk' => $this->input->post('kk'),
                'slip_gaji' => $this->input->post('gaji'),
                'keterangan' => $this->input->post('keterangan')
            );
            $insert = $this->general_model->insert('tb_customer', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<br><div class="success">Pelanggan telah disimpan</div>');
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
            }
            redirect(site_url('pelanggan/add'));
        }
    }

    public function update($id) {
        $data['list'] = $this->general_model->select('tb_customer', array('kode_customer' => $id));
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Update Data Pelanggan";
        $data['content'] = $this->load->view('pelanggan/update_pelanggan', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_update() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('telepon', 'telepon', 'required|numeric');
        $this->form_validation->set_rules('hp', 'hp', 'required|numeric');
        $this->form_validation->set_rules('ktp', 'ktp', 'required|numeric');
        $this->form_validation->set_rules('kk', 'kk', 'required|numeric');
        $this->form_validation->set_rules('gaji', 'gaji', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        $id = strip_tags($this->input->post('kode'));
        if (!$this->form_validation->run()) {
            $this->add();
        } else {
            $data = array(
                'kode_customer' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
                'hp' => $this->input->post('hp'),
                'no_ktp' => $this->input->post('ktp'),
                'kk' => $this->input->post('kk'),
                'slip_gaji' => $this->input->post('gaji'),
                'keterangan' => $this->input->post('keterangan')
            );
            $update = $this->general_model->update('tb_customer', $data, array('kode_customer' => $id));
            if ($update) {
                $this->session->set_flashdata('message', '<br><div class="success">Data Pelanggan telah ter-update</div>');
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
            }
            redirect(site_url('pelanggan'));
        }
    }

    public function to_pdf() {
        $data['list'] = $this->general_model->select('tb_customer');
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Laporan Data Motor";
        $data['content'] = $this->load->view('pelanggan/list_all', $data, TRUE);
        $html = $this->load->view('wrapper/print_wrapper', $data, TRUE);
        $this->load->library('mpdf');
        $this->mpdf->WriteHTML($html);
        $this->mpdf->output();
    }

}