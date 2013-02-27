<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    function construct() {
        parent::__contruct();
        require_authentication();
    }
    public function index($offset = 0)
    {       
            $this->load->library('pagination');
            $limit = 2;
            
            $config['full_tag_open']    = '<div class="pagination">';
            $config['full_tag_close']   = '</div>';
            $config['base_url']         = base_url().'user/page';
            $config['per_page']         = $limit;
            $config['total_rows']       = $this->general_model->total('tb_user','');
            $this->pagination->initialize($config);
            
            $offsetlimit                = array($offset,$limit);
            $data['list']               = $this->general_model->select('tb_user','','',$offsetlimit);
            if($data['list'] != FALSE)
            {
                $data['list'] = $data['list']->result_array();
            }
            $data['title']              = "List Data user";
            $data['pagination']         = $this->pagination->create_links();
            $data['content']            = $this->load->view('user/view_user',$data,TRUE);
            $this->load->view('wrapper/content_wrapper',$data);
    }
    public function page() {
        $show = (int) $this->uri->segment(3);
        $this->index($show);
    }

    public function add() {
        $data['title'] = 'Tambah User';
        $data['permission'] = array('Administrator', 'Operator');
        $data['content'] = $this->load->view('user/add_user', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_add() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('permission', 'permission', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>'); // 

        if (!$this->form_validation->run()) {
            $this->add();
        } else {
            $data = array(
                'id_user' => NULL,
                'email_user' => strip_tags($this->input->post('email')),
                'password_user' => md5(strip_tags($this->input->post('password'))),
                'permission' => strip_tags($this->input->post('permission'))
            );
            $insert = $this->general_model->insert('tb_user', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<br><div class="success">User telah disimpan</div>');
                redirect(site_url('user/add'));
            } else {
                $this->session->set_flashdata('message', '<br><div class="error">Something Error</div>');
                redirect(site_url('user/add'));
            }
        }
    }

    public function do_delete($id) {
        $del = $this->general_model->delete('tb_user', array('kode_user' => $id));
        if (!$del) {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="success">user telah di hapus</div>');
        } else {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="error">Something Error, anda belum beruntung</div>');
        }
    }

    public function update($id) {
        $data['list'] = $this->general_model->select('tb_user', array('kode_user' => $id));
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['permission'] = array('Administrator', 'Operator');
        $data['title'] = "Update Data User";
        $data['content'] = $this->load->view('user/update_user', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_update() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('permission', 'permission', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        $id = strip_tags($this->input->post('kode'));
        if (!$this->form_validation->run()) {
            $this->update($id);
        } else {
            $data = array(
                'kode_user' => strip_tags($this->input->post('kode')),
                'email_user' => strip_tags($this->input->post('email')),
                'password_user' => strip_tags($this->input->post('password')),
                'permission' => strip_tags($this->input->post('permission'))
            );
            $insert = $this->general_model->update('tb_user', $data, array('kode_user' => $id));
            if ($insert) {
                $this->session->set_flashdata('message', '<br><div class="success">User telah disimpan</div>');
            } else {
                $this->session->set_flashdata('message', '<br><div class="error">Something Error</div>');
            }
            redirect(site_url('user'));
        }
    }

    public function to_pdf() {
        $data['list'] = $this->general_model->select('tb_user');
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Laporan Data Motor";
        $data['content'] = $this->load->view('user/list_all', $data, TRUE);
        $html = $this->load->view('wrapper/print_wrapper', $data, TRUE);
        $this->load->library('mpdf');
        $this->mpdf->WriteHTML($html);
        $this->mpdf->output();
    }

    public function login() {
        $data['title'] = 'Login User';
        $data['content'] = $this->load->view('user/login', $data, TRUE);
        $this->load->view('wrapper/login_wrapper', $data);
    }

    public function do_login() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>'); // 

        if (!$this->form_validation->run()) {
            $this->login();
        } else {
            $email = strip_tags($this->input->post('email'));
            $password = strip_tags($this->input->post('password'));
            $login = $this->mw_auth->login($email, $password);
            if ($login) {
                $this->session->set_flashdata('message', '<br><div class="success">Selamat Datang di kami</div>');
                redirect(site_url('welcome'));
            } else {
                $this->session->set_flashdata('message', '<br><div class="fail">Username Atau Password Salah</div>');
                redirect(site_url('user/login'));
            }
        }
    }

    public function logout() {
        require_authentication();
        $this->session->sess_destroy();
        $logout = $this->mw_auth->logout();
        if ($logout) {
            $this->session->set_flashdata('message', '<br><div class="success">logout sukses</div>');
        } else {
            $this->session->set_flashdata('message', '<br><div class="success">something wrong</div>');
        }
        redirect(site_url());
    }

}