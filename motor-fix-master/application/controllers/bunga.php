<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bunga extends CI_Controller {

    function construct() {
        parent::__construct();
        require_authentication();
    }

    public function index($offset = 0) {
        $this->load->library('pagination');
        $limit = 2;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['base_url'] = base_url() . 'bunga/page';
        $config['per_page'] = $limit;
        $config['total_rows'] = $this->general_model->total('tb_bunga', '');
        $this->pagination->initialize($config);

        $offsetlimit = array($offset, $limit);
        $data['list'] = $this->general_model->select('tb_bunga', '', '', $offsetlimit);
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "List Data Bunga";
        $data['pagination'] = $this->pagination->create_links();
        $data['content'] = $this->load->view('bunga/view_bunga', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function page() {
        if($this->session->userdata('email')=='')
            redirect('user/login');
        $show = (int) $this->uri->segment(3);
        $this->index($show);
    }

    public function add() {
        if($this->session->userdata('email')=='')
            redirect('user/login');
        $data['title'] = 'Tambah Bunga';
        $data['content'] = $this->load->view('bunga/add_bunga', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_add() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('lama_cicilan', 'lama_cicilan', 'required|numeric');
        $this->form_validation->set_rules('bunga', 'bunga', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        if (!$this->form_validation->run()) {
            $this->add();
        } else {
            $data = array(
                'kode_bunga' => NULL,
                'lama_cicilan' => strip_tags($this->input->post('lama_cicilan')),
                'bunga' => strip_tags($this->input->post('bunga'))
            );
            $insert = $this->general_model->insert('tb_bunga', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<br><div class="success">Bunga telah disimpan</div>');
                redirect(site_url('bunga/add'));
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
                redirect(site_url('bunga/add'));
            }
        }
    }

    public function do_delete($id) {
        $del = $this->general_model->delete('tb_bunga', array('kode_bunga' => $id));
        if (!$del) {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="success">Bunga telah di hapus</div>');
        } else {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="error">Something Error, anda belum beruntung</div>');
        }
    }

    public function update($id) {
        $data['list'] = $this->general_model->select('tb_bunga', array('kode_bunga' => $id));
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Update Data BUnga";
        $data['content'] = $this->load->view('bunga/update_bunga', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_update() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('lama_cicilan', 'lama_cicilan', 'required|numeric');
        $this->form_validation->set_rules('bunga', 'bunga', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        $id = strip_tags($this->input->post('kode'));
        if (!$this->form_validation->run()) {
            $this->update($id);
        } else {
            $data = array(
                'kode_bunga' => strip_tags($this->input->post('kode')),
                'lama_cicilan' => strip_tags($this->input->post('lama_cicilan')),
                'bunga' => strip_tags($this->input->post('bunga'))
            );
            $insert = $this->general_model->update('tb_bunga', $data, array('kode_bunga' => $id));
            if ($insert) {
                $this->session->set_flashdata('message', '<br><div class="success">Bunga telah disimpan</div>');
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
            }
            redirect(site_url('bunga'));
        }
    }

    public function to_pdf() {
        $data['list'] = $this->general_model->select('tb_bunga');
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Laporan Data Motor";
        $data['content'] = $this->load->view('bunga/list_all', $data, TRUE);
        $html = $this->load->view('wrapper/print_wrapper', $data, TRUE);
        $this->load->library('mpdf');
        $this->mpdf->WriteHTML($html);
        $this->mpdf->output();
    }

}