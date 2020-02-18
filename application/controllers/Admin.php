<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengguna_model');
	}

	public function index()
	{
		$this->load->view('login_admin_view');
	}

	public function cek()
	{
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$query = $this->Pengguna_model->get_user($user,$pass);
		$result = $query->row();
		if ($query->row()) {
			if ($result->status !== 'admin') {
				$this->session->set_flashdata('info', 'User ini bukan user admin');
				redirect('admin','refresh');
			}else{
				$array = array(
					'nama' => $result->nm_pengguna,
					'id' => $result->id,
					'status' => $result->status
				);				
				$this->session->set_userdata( $array );
				redirect('beranda','refresh');
			}
		}else{
			$this->session->set_flashdata('info', 'Login Gagal');
			redirect('admin','refresh');
		}
	}

}
