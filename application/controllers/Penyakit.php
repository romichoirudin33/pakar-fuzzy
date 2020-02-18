<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyakit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'admin' || $this->session->userdata('status') == null) {
			redirect('admin','refresh');
		}
		$this->load->model('Penyakit_model');
	}

	public function index()
	{
		$object['data'] = $this->Penyakit_model->readAll();
		$this->load->view('penyakit_view', $object);
	}

	public function add()
	{
		if ($this->input->post('submit')) {
			$config['upload_path']          = './asset/penyakit/';
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gbr_penyakit'))
            {
                $nm_penyakit = $this->input->post('nm_penyakit');
				$penyebab	= $this->input->post('penyebab');
				$penanganan = $this->input->post('penanganan');
				$gbr_penyakit = $this->upload->data('file_name');
				$object = array(
					'nm_penyakit' => $nm_penyakit,
					'penyebab'	  => $penyebab,
					'penanganan' => $penanganan,
					'gbr_penyakit' => $gbr_penyakit
					);
				if ($this->Penyakit_model->create($object)) {
					$this->session->set_flashdata('info', 'Data Berhasil Di Tambah');
					redirect('penyakit');
				}else{
					$this->session->set_flashdata('info', 'Data Gagal Di Tambah');
					redirect('penyakit');
				}
            }
            else
            {
            	$this->session->set_flashdata('info', $this->upload->display_errors());
				redirect('penyakit');
            }
		}else{
			$this->load->view('penyakit_tambah');
		}
	}

	public function edit($id = null)
	{
		if ($this->input->post('submit')) {
			$id = $this->input->post('id');
			$nm_penyakit = $this->input->post('nm_penyakit');
			$penyebab = $this->input->post('penyebab');
			$penanganan = $this->input->post('penanganan');
			$object = array(
				'nm_penyakit' => $nm_penyakit,
				'penyebab' => $penyebab,
				'penanganan' => $penanganan,
				);
			if ($this->Penyakit_model->update($object,$id)) {
				$this->session->set_flashdata('info', 'Data Berhasil Di Ubah');
				redirect('penyakit');
			}else{
				$this->session->set_flashdata('info', 'Data Gagal Di Ubah');
				redirect('penyakit');
			}
		 }else{
			if ($this->Penyakit_model->readId($id)) {
				$object['data'] = $this->Penyakit_model->readId($id);
				$this->load->view('penyakit_edit', $object);
			}else{
				redirect('penyakit');
			}
		}
	}

	public function delete($id = null)
	{
		if ($this->Penyakit_model->delete($id)) {
			$this->session->set_flashdata('info', 'Data Berhasil Di Hapus !');
			redirect('penyakit','refresh');
		}else{
			$this->session->set_flashdata('info', 'Data Gagal Di Hapus !');
			redirect('penyakit','refresh');
		}
	}


}
