<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model {

	public $table = 'pengguna';

	public function get_user($user = null, $pass = null){
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		return $this->db->get($this->table);
	}

	public function readAll()
	{
		return $this->db->get($this->table)->result_object();
	}

	public function readId($id = '')
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->result_object();
	}

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data, $id)
	{
		return $this->db->update($this->table, $data, array('id' => $id));
	}

	public function delete($id ='')
	{
		return $this->db->delete($this->table, array('id' => $id));
	}

}