<?php
class Analisa_hasil_model extends CI_Model {

	private $table = 'analisa_hasil';

	public function readAll()
	{
		return $this->db->get($table)->result_object();
	}

	public function readId($id = '')
	{
		$this->db->where('id', $id);
		return $this->db->get($table)->result_object();
	}

	public function create($data)
	{
		return $this->db->insert($table, $data);
	}

	public function update($data, $id)
	{
		return $this->db->update($table, $data, array('id' => $id));
	}

	public function delete($id ='')
	{
		return $this->db->delete($table, array('id' => $id));
	}

}