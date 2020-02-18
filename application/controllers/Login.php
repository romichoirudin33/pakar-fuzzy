<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengguna_model');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	public function daftar()
	{
		$object = array(
			'status' => 'pengguna',
			'nm_pengguna' => $this->input->post('nm_pengguna'),
			'jenis_kelamin'=> $this->input->post('jenis_kelamin'),
			'tanggal_lahir'=> $this->input->post('tanggal_lahir'),
			'username'=> $this->input->post('username'),
			'password'=> $this->input->post('password'),
			'tanggal'=> date('Y/m/d')
			);
		if ($this->Pengguna_model->create($object)) {
			$this->session->set_flashdata('info', 'Berhasil ditambah, Silahkan Login');
			redirect('login');
		}
	}

	public function cek(){
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$query = $this->Pengguna_model->get_user($user,$pass);
		$result = $query->row();
		if ($query->row()) {
			if ($result->status !== 'pengguna') {
				$this->session->set_flashdata('info', 'User ini bukan user pengguna');
				redirect('login','refresh');
			}else{
				$array = array(
					'nama' => $result->nm_pengguna,
					'id' => $result->id,
					'status' => $result->status
				);				
				$this->session->set_userdata( $array );
				redirect('analisa','refresh');
			}
		}else{
			$this->session->set_flashdata('info', 'Login Gagal');
			redirect('login','refresh');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

}
