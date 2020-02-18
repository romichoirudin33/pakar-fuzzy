<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petunjuk extends CI_Controller {

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
		$this->load->view('petunjuk_view');
	}


}
