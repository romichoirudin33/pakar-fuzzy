<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') !== 'admin' || $this->session->userdata('status') == null) {
			redirect('admin','refresh');
		}
		//Do your magic here
	}
	
	public function index()
	{
		// $object['data'] = array(
		// 	$this->surat_masuk->bulan_ini()->row(),
		// 	$this->surat_keluar->bulan_ini()->row(),
		// 	$this->surat_disposisi->bulan_ini()->row()
		// 	);
		//echo "$date";
		//echo $this->surat_masuk->bulan_ini($date)->row();
		//print_r($this->surat_masuk->bulan_ini($date)->row());
		$this->load->view('beranda');
	}

}
