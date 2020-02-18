<?php
class Penyakit_detail_model extends CI_Model {

	private $table = 'penyakit_detail';
	private $tableView = 'view_penyakit_detail';

	public function readAll()
	{
		$this->db->order_by('penyakit_id', 'ASC');
		return $this->db->get($this->tableView)->result_object();
	}

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function cekExist($data)
	{
		foreach ($data as $key => $value) {
			$this->db->where($key, $value);
		}
		return $this->db->get($this->tableView)->result_object();
	}

	public function delete($id ='')
	{
		return $this->db->delete($this->table, array('id' => $id));
	}

	public function cekPenyakit($data)
	{
		foreach ($data as $key => $value) {
			$this->db->or_where('gejala_id', $value);
		}
		$this->db->select('penyakit_id');
		return $this->db->get($this->table)->result();
	}

	public function cekPenyakitRand($data)
	{
		$this->db->order_by('rand()');
		$this->db->limit(1);
		foreach ($data as $key => $value) {
			$this->db->or_where('gejala_id', $value);
		}
		$this->db->select('penyakit_id');
		return $this->db->get($this->table)->result_object();
	}

}