<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dependensi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') !== 'admin' || $this->session->userdata('status') == null) {
			redirect('login','refresh');
		}
		$this->load->model('Penyakit_model');
		$this->load->model('Penyakit_detail_model');
	}

	public function index()
	{
		$object['data'] = $this->Penyakit_detail_model->readAll();
		$object['penyakit'] = $this->Penyakit_model->readAll();
		$this->load->view('dependensi_view', $object);
	}

	public function add()
	{
		$this->load->model('Gejala_model');
		if ($this->input->post('submit')) {
			$object = array(
					'penyakit_id' => $this->input->post('penyakit_id'),
					'gejala_id' => $this->input->post('gejala_id')
					);
			$data = $this->Penyakit_detail_model->cekExist($object);
			foreach ($data as $key) {
				$namaPenyakit = $key->nm_penyakit;
				$namaGejala = $key->nm_gejala;
			}
			if (count($data) != 0) {
				$this->session->set_flashdata('info', 'Data gagal disimpan, penyakit <b>'
					.$namaPenyakit.'</b> dengan gejala <b>'.$namaGejala.'</b> sudah ada');
				redirect('dependensi');
			}else{
				if ($this->Penyakit_detail_model->create($object)) {
					$this->session->set_flashdata('info', 'Data Berhasil Di Tambah');
					redirect('dependensi');
				}else{
					$this->session->set_flashdata('info', 'Data Gagal Di Tambah');
					redirect('dependensi');
				}
			}
		}else{
			$object['penyakit'] = $this->Penyakit_model->readAll();
			$object['gejala'] = $this->Gejala_model->readAll();
			$this->load->view('dependensi_tambah', $object);
		}
	}

	public function delete($id = null)
	{
		if ($this->Penyakit_detail_model->delete($id)) {
			$this->session->set_flashdata('info', 'Data Berhasil Di Hapus !');
			redirect('dependensi','refresh');
		}else{
			$this->session->set_flashdata('info', 'Data Gagal Di Hapus !');
			redirect('dependensi','refresh');
		}
	}

}