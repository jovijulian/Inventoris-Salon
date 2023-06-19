<?php

class Barang extends CI_Model
{



  public function select($tabel)
  {
		
		$this->db->order_by('expire', 'asc');
		$query = $this->db->get($tabel);
	
		$data = $query->result();
		return $data;

  }
  public function get_data($tabel,$id_transaksi)
  {
		$this->db->select('tb_barang.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_detail_barang.*, tb_kategori.nama_kategori, tb_barang_masuk.jumlah AS jumlahBarang');
		$this->db->from('tb_barang');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang.id', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_detail_barang.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_detail_barang.id_satuan', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_detail_barang.id_kategori', 'left');
		$this->db->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_detail_barang.id_barang', 'left');
		$this->db->where('tb_barang.id', $id_transaksi['id']);
		$query = $this->db->get();
	
		$data = $query->result();
		return $data;
  }

}
 ?>