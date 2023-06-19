<?php

class Supplier extends CI_Model
{


  public function get_data($tabel,$id_transaksi)
  {

		$this->db->select('tb_barang_masuk.*, tb_kategori.*, tb_barang.*, tb_supplier.*');
		$this->db->from('tb_supplier');
		$this->db->join('tb_barang_masuk', 'tb_barang_masuk.id_supplier = tb_supplier.id');
		$this->db->join('tb_kategori', 'tb_barang_masuk.id_kategori = tb_kategori.id');
		$this->db->join('tb_barang', 'tb_barang_masuk.id_barang = tb_barang.id');
		$this->db->where('tb_supplier.id', $id_transaksi['id']);
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