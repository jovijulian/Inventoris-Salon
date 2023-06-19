<?php

class Kategori extends CI_Model
{


  public function get_data($tabel,$id_transaksi)
  {

		$this->db->select('tb_barang_masuk.*, tb_kategori.*, tb_barang.*');
		$this->db->from('tb_kategori');
		$this->db->join('tb_barang_masuk', 'tb_barang_masuk.id_kategori = tb_kategori.id');
		$this->db->join('tb_barang', 'tb_barang_masuk.id_barang = tb_barang.id');
		$this->db->where('tb_kategori.id', $id_transaksi['id']);
		$query = $this->db->get();
		$data = $query->result();
		// var_dump($data);
		return $data;
  }

  public function get_data_null($tabel,$id_transaksi)
  {

		$query = $this->db->select()
			->from($tabel)
			->where($id_transaksi)
			->get();
		return $query->result();
  }
  

}
 ?>