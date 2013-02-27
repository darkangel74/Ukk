<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Motor extends CI_Controller {

    function construct() {
        parent::__contruct();
        require_authentication();
    }

    public function index($offset = 0) {
        $this->load->library('pagination');
        $limit = 2;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['base_url'] = base_url() . 'motor/page';
        $config['per_page'] = $limit;
        $config['total_rows'] = $this->general_model->total('tb_motor', '');
        $this->pagination->initialize($config);

        $offsetlimit = array($offset, $limit);
        $data['list'] = $this->general_model->select('tb_motor', '', '', $offsetlimit);
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "List Data Motor";
        $data['pagination'] = $this->pagination->create_links();
        $data['content'] = $this->load->view('motor/view_motor', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function page() {
        $show = (int) $this->uri->segment(3);
        $this->index($show);
    }

    public function add() {
        $data['title'] = 'Tambah Motor';
        $data['content'] = $this->load->view('motor/add_motor', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_add() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('merek', 'merek', 'required');
        $this->form_validation->set_rules('warna', 'warna', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required|numeric');
        $this->form_validation->set_rules('jumlah', 'harga', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        if (!$this->form_validation->run()) {
            $this->add();
        } else {
            $data = array(
                'kode_motor' => NULL,
                'merek' => strip_tags($this->input->post('merek')),
                'warna' => strip_tags($this->input->post('warna')),
                'harga' => strip_tags($this->input->post('harga')),
                'jumlah' => strip_tags($this->input->post('jumlah')),
                'stok' => strip_tags($this->input->post('jumlah'))
            );
            $insert = $this->general_model->insert('tb_motor', $data);
            if ($insert) {
                $a = $this->db->query('select * from tb_motor order by kode_motor desc')->row();
                if ($this->upload_foto($a->kode_motor)) {
                    $this->session->set_flashdata('message', '<br><div class="success">Motor telah disimpan</div>');
                    redirect(site_url('motor/add'));
                } else {
                    $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
                    redirect(site_url('motor/add'));
                }
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
                redirect(site_url('motor/add'));
            }
        }
    }

    public function do_delete($id) {
        $del = $this->general_model->delete('tb_motor', array('kode_motor' => $id));
        if (!$del) {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="success">Motor telah di hapus</div>');
        } else {
            $this->index();
            $this->session->set_flashdata('message', '<br><div class="error">Something Error, anda belum beruntung</div>');
        }
    }

    public function update($id) {
        $data['list'] = $this->general_model->select('tb_motor', array('kode_motor' => $id));
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Update Data Motor";
        $data['content'] = $this->load->view('motor/update_motor', $data, TRUE);
        $this->load->view('wrapper/content_wrapper', $data);
    }

    public function do_update() {
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('merek', 'merek', 'required');
        $this->form_validation->set_rules('warna', 'warna', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'stok', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class=error>', '</div>');
        $id = strip_tags($this->input->post('kode'));
        if (!$this->form_validation->run()) {
            $this->update($id);
        } else {
            $data = array(
                'kode_motor' => strip_tags($this->input->post('kode')),
                'merek' => strip_tags($this->input->post('merek')),
                'warna' => strip_tags($this->input->post('warna')),
                'harga' => strip_tags($this->input->post('harga')),
                'jumlah' => strip_tags($this->input->post('stok')),
                'stok' => strip_tags($this->input->post('stok')),
            );
            $update = $this->general_model->update('tb_motor', $data, array('kode_motor' => $id));
            if ($update) {
                if ($this->upload_foto($this->input->post('kode'))) {
                    $this->session->set_flashdata('message', '<br><div class="success">Motor telah diupdate</div>');
                } else {
                    $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
                }
            } else {
                $this->session->set_flashdata('message', '<br><div class="success">Something Error</div>');
            }
            redirect(site_url('motor'));
        }
    }

    public function to_pdf() {
        $data['list'] = $this->general_model->select('tb_motor');
        if ($data['list'] != FALSE) {
            $data['list'] = $data['list']->result_array();
        }
        $data['title'] = "Laporan Data Motor";
        $data['content'] = $this->load->view('motor/list_all', $data, TRUE);
        $html = $this->load->view('wrapper/print_wrapper', $data, TRUE);
        $this->load->library('mpdf');
        $this->mpdf->WriteHTML($html);
        $this->mpdf->output();
    }

    public function upload_foto($id) {
        $config['upload_path'] = "./assets/motor/asli/";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';

        $this->load->library('upload', $config);


        if ($this->upload->do_upload('foto')) {
            $data = $this->upload->data();

            /* PATH */
            $source = "./assets/motor/asli/" . $data['file_name'];
            $destination_medium = "./assets/motor/";

            // Permission Configuration
            chmod($source, 0777);

            /* Resizing Processing */
            // Configuration Of Image Manipulation :: Static
            $this->load->library('image_lib');
            $img['image_library'] = 'GD2';
            $img['maintain_ratio'] = TRUE;

            /// Limit Width Resize
            $limit_medium = 200;

            // Size Image Limit was using (LIMIT TOP)
            $limit_use = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'];

            // Percentase Resize
            if ($limit_use > $limit_medium) {
                $percent_medium = $limit_medium / $limit_use;
            }

            ////// Making MEDIUM /////////////
            $img['width'] = $limit_use > $limit_medium ? $data['image_width'] * $percent_medium : $data['image_width'];
            $img['height'] = $limit_use > $limit_medium ? $data['image_height'] * $percent_medium : $data['image_height'];

            // Configuration Of Image Manipulation :: Dynamic
            $img['quality'] = '100%';
            $img['source_image'] = $source;
            $img['new_image'] = $destination_medium;

            // Do Resizing
            $this->image_lib->initialize($img);
            $this->image_lib->resize();
            $this->image_lib->clear();
            //====simpan patch ke database========================================
            $path = $data['file_name'];
            $this->db->query("update tb_motor set image = '$path' where kode_motor = '$id'");
            //===============================================================================================
            return true;
        } else {
            return false;
        }
    }

}