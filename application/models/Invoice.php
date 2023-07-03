<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Model {


	function gettahun(){

		$query = $this->db->query("SELECT YEAR(tanggal_keluar) AS tahun FROM tb_barang_keluar GROUP BY YEAR(tanggal_keluar) ORDER BY YEAR(tanggal_keluar) ASC");

		return $query->result();

	}

	function gettahunMasuk(){

		$query = $this->db->query("SELECT YEAR(tanggal) AS tahun FROM tb_barang_masuk GROUP BY YEAR(tanggal) ORDER BY YEAR(tanggal) ASC");

		return $query->result();

	}

	function filterbytanggal($tanggal1, $tanggal2){
		$this->db->select('tb_barang_keluar.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_kategori.nama_kategori, tb_detail_barang.id as id_detail_barang, tb_barang.nama_barang');
		$this->db->from('tb_barang_keluar');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_barang_keluar.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang_keluar.id_satuan', 'left');
		$this->db->join('tb_barang', 'tb_barang.id = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_barang_keluar.id_kategori', 'left');
		$this->db->where("tb_barang_keluar.tanggal_keluar BETWEEN '$tanggal1' AND '$tanggal2'", NULL, FALSE);
		$this->db->order_by('tb_barang_keluar.tanggal_keluar', 'ASC');
		$query = $this->db->get();
		$data = $query->result();
		return $data;
	}

	function filterbybulan($tahun1,$bulanawal,$bulanakhir){
		$this->db->select('tb_barang_keluar.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_kategori.nama_kategori, tb_detail_barang.id as id_detail_barang, tb_barang.nama_barang');
		$this->db->from('tb_barang_keluar');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_barang_keluar.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang_keluar.id_satuan', 'left');
		$this->db->join('tb_barang', 'tb_barang.id = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_barang_keluar.id_kategori', 'left');
		$this->db->where('YEAR(tb_barang_keluar.tanggal_keluar)', $tahun1);
		$this->db->where("MONTH(tb_barang_keluar.tanggal_keluar) BETWEEN $bulanawal AND $bulanakhir", NULL, FALSE);
		$this->db->order_by('tb_barang_keluar.tanggal_keluar', 'ASC');
	

		$query = $this->db->get();
		$data = $query->result();
		// var_dump($data);
		return $data;
	}

	function filterbytahun($tahun2){
		$this->db->select('tb_barang_keluar.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_kategori.nama_kategori, tb_detail_barang.id as id_detail_barang, tb_barang.nama_barang');
		$this->db->from('tb_barang_keluar');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_barang_keluar.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang_keluar.id_satuan', 'left');
		$this->db->join('tb_barang', 'tb_barang.id = tb_barang_keluar.id_barang', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_barang_keluar.id_kategori', 'left');
		$this->db->where('YEAR(tb_barang_keluar.tanggal_keluar)', $tahun2);
		$this->db->order_by('tb_barang_keluar.tanggal_keluar', 'ASC');

		$query = $this->db->get();
		$data = $query->result();
		// var_dump($data);
		return $data;
	}

	function filterbytahunMasuk($tahun2){
		$this->db->select('tb_barang_masuk.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_kategori.nama_kategori, tb_detail_barang.id as id_detail_barang, tb_barang.nama_barang, tb_detail_barang.harga, tb_detail_barang.total_harga, tb_histori.stok_awal');
		$this->db->from('tb_barang_masuk');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang_masuk.id_barang', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_barang_masuk.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang_masuk.id_satuan', 'left');
		$this->db->join('tb_barang', 'tb_barang.id = tb_barang_masuk.id_barang', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_barang_masuk.id_kategori', 'left');
		$this->db->join('tb_histori', 'tb_histori.id_transaksi = tb_barang_masuk.id_transaksi', 'left');
		$this->db->where('YEAR(tb_barang_masuk.tanggal)', $tahun2);
		$this->db->order_by('tb_barang_masuk.tanggal', 'ASC');

		$query = $this->db->get();
		$data = $query->result();
		// var_dump($data);
		return $data;
	}

	function filterbybulanMasuk($tahun1,$bulanawal,$bulanakhir){
		$this->db->select('tb_barang_masuk.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_kategori.nama_kategori, tb_detail_barang.id as id_detail_barang, tb_barang.nama_barang, tb_detail_barang.harga, tb_detail_barang.total_harga, tb_histori.stok_awal');
		$this->db->from('tb_barang_masuk');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang_masuk.id_barang', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_barang_masuk.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang_masuk.id_satuan', 'left');
		$this->db->join('tb_barang', 'tb_barang.id = tb_barang_masuk.id_barang', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_barang_masuk.id_kategori', 'left');
		$this->db->join('tb_histori', 'tb_histori.id_transaksi = tb_barang_masuk.id_transaksi', 'left');
		$this->db->where('YEAR(tb_barang_masuk.tanggal)', $tahun1);
		$this->db->where("MONTH(tb_barang_masuk.tanggal) BETWEEN $bulanawal AND $bulanakhir", NULL, FALSE);
		$this->db->order_by('tb_barang_masuk.tanggal', 'ASC');
	

		$query = $this->db->get();
		$data = $query->result();
		// var_dump($data);
		return $data;
	}

	function filterbytanggalMasuk($tanggal1, $tanggal2){
		$this->db->select('tb_barang_masuk.*, tb_supplier.*, tb_satuan.nama_satuan as nama_satuan, tb_kategori.kode_kategori, tb_kategori.nama_kategori, tb_detail_barang.id as id_detail_barang, tb_barang.nama_barang, tb_detail_barang.harga, tb_detail_barang.total_harga');
		$this->db->from('tb_barang_masuk');
		$this->db->join('tb_detail_barang', 'tb_detail_barang.id_barang = tb_barang_masuk.id_barang', 'left');
		$this->db->join('tb_supplier', 'tb_supplier.id = tb_barang_masuk.id_supplier', 'left');
		$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang_masuk.id_satuan', 'left');
		$this->db->join('tb_barang', 'tb_barang.id = tb_barang_masuk.id_barang', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id = tb_barang_masuk.id_kategori', 'left');
		$this->db->join('tb_histori', 'tb_histori.id_transaksi = tb_barang_masuk.id_transaksi', 'left');
		$this->db->where("tb_barang_masuk.tanggal BETWEEN '$tanggal1' AND '$tanggal2'", NULL, FALSE);
		$this->db->order_by('tb_barang_masuk.tanggal', 'ASC');
		$query = $this->db->get();
		$data = $query->result();
		return $data;
	}




}

/* End of file Barang_model.php */
/* Location: ./application/models/Barang_model.php */