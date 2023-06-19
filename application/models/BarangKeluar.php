<?php

class BarangKeluar extends CI_Model
{



  public function select($tabel)
  {
		$this->db->select('tb_barang_keluar.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_kategori.nama_kategori, tb_detail_barang.id as id_detail_barang, tb_barang.nama_barang');
		$this->db->from('tb_barang_keluar');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_barang_keluar.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang_keluar.id_satuan', 'left');
		$this->db->join('tb_barang', 'tb_barang.id = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_barang_keluar.id_kategori', 'left');
		$this->db->order_by('tb_barang_keluar.id_transaksi', 'desc');
		$query = $this->db->get();
	
		$data = $query->result();
		return $data;
  }
  public function get_data($tabel,$id_transaksi)
  {
		$this->db->select('tb_barang_keluar.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_detail_barang.harga, tb_detail_barang.total_harga, tb_kategori.nama_kategori, tb_detail_barang.id as id_detail_barang, tb_barang.nama_barang');
		$this->db->from('tb_barang_keluar');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_barang_keluar.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang_keluar.id_satuan', 'left');
		$this->db->join('tb_barang', 'tb_barang.id = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_barang_keluar.id_kategori', 'left');
		$this->db->where($id_transaksi);
		$query = $this->db->get();
		$data = $query->result();
		// var_dump($data);
		return $data;
  }

}
 ?>
