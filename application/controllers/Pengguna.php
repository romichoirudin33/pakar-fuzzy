<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'admin' || $this->session->userdata('status') == null) {
			redirect('admin','refresh');
		}
		$this->load->model('Pengguna_model');
	}

	public function index()
	{
		$object['data'] = $this->Pengguna_model->readAll();
		$this->load->view('pengguna_view', $object);
	}

	public function add(){
		if ($this->input->post('submit')) {
			$nm_pengguna = $this->input->post('nm_pengguna');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$object = array(
				'nm_pengguna' => $nm_pengguna,
				'status' => 'admin',
				'jenis_kelamin' => $jenis_kelamin,
				'tanggal_lahir' => $tanggal_lahir,
				'username'	=> $username,
				'password' => $password,
				'tanggal' => date('Y/m/d'),
				);
			if ($this->Pengguna_model->create($object)) {
				$this->session->set_flashdata('info', 'Data Berhasil Di Tambah');
				redirect('pengguna');
			}else{
				$this->session->set_flashdata('info', 'Data Gagal Di Tambah');
				redirect('pengguna');
			}
		}else{
			$this->load->view('pengguna_tambah');
		}
	}

	public function edit($id = null)
	{
		if ($this->input->post('submit')) {
			$id = $this->input->post('id');
			$nm_pengguna = $this->input->post('nm_pengguna');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$object = array(
				'nm_pengguna' => $nm_pengguna,
				'jenis_kelamin' => $jenis_kelamin,
				'tanggal_lahir' => $tanggal_lahir,
				);
			if ($this->Pengguna_model->update($object,$id)) {
				$this->session->set_flashdata('info', 'Data Berhasil Di Ubah');
				redirect('pengguna');
			}else{
				$this->session->set_flashdata('info', 'Data Gagal Di Ubah');
				redirect('pengguna');
			}
		 }else{
			if ($this->Pengguna_model->readId($id)) {
				$object['data'] = $this->Pengguna_model->readId($id);
				$this->load->view('pengguna_edit', $object);
			}else{
				redirect('pengguna');
			}
		}
	}
	public function delete($id = null)
	{
		if ($this->Pengguna_model->delete($id)) {
			$this->session->set_flashdata('info', 'Data Berhasil Di Hapus !');
			redirect('pengguna','refresh');
		}else{
			$this->session->set_flashdata('info', 'Data Gagal Di Hapus !');
			redirect('pengguna','refresh');
		}
	}

}