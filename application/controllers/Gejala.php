<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gejala extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'admin' || $this->session->userdata('status') == null) {
			redirect('admin','refresh');
		}
		$this->load->model('Gejala_model');
	}

	public function index()
	{
		$object['data'] = $this->Gejala_model->readAll();
		$this->load->view('gejala_view', $object);
	}

	public function add()
	{
		if ($this->input->post('submit')) {
			$config['upload_path']          = './asset/gejala/';
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gmbr_gejala'))
            {
            	$nm_gejala = $this->input->post('nm_gejala');
				$gmbr_gejala= $this->upload->data('file_name');
				$object = array(
					'nm_gejala' => $nm_gejala,
					'gmbr_gejala' => $gmbr_gejala,
					);
				if ($this->Gejala_model->create($object)) {
					$this->session->set_flashdata('info', 'Data Berhasil Di Tambah');
					redirect('gejala');
				}else{
					$this->session->set_flashdata('info', 'Data Gagal Di Tambah');
					redirect('gejala');
				}
            }
            else
            {
            	$this->session->set_flashdata('info', $this->upload->display_errors());
				redirect('gejala');
            }
		}else{
			$this->load->view('gejala_tambah');
		}
	}

	public function edit($id = null)
	{
		if ($this->input->post('submit')) {
			$id = $this->input->post('id');
			$nm_gejala = $this->input->post('nm_gejala');
			$object = array(
				'nm_gejala' => $nm_gejala
				);
			if ($this->Gejala_model->update($object, $id)) {
				$this->session->set_flashdata('info', 'Data Berhasil Di Ubah');
				redirect('gejala');
			}else{
				$this->session->set_flashdata('info', 'Data Gagal Di Ubah');
				redirect('gejala');
			}
		}else{
			if ($this->Gejala_model->readId($id)) {
				$object['data'] = $this->Gejala_model->readId($id);
				$this->load->view('gejala_edit', $object);
			}else{
				redirect('gejala');
			}
		}
	}

	public function delete($id = null)
	{
		if ($this->Gejala_model->delete($id)) {
			$this->session->set_flashdata('info', 'Data Berhasil Di Hapus !');
			redirect('gejala','refresh');
		}else{
			$this->session->set_flashdata('info', 'Data Gagal Di Hapus !');
			redirect('gejala','refresh');
		}
	}

}
