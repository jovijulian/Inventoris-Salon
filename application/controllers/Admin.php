<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin');
		$this->load->model('BarangMasuk');
		$this->load->model('BarangKeluar');
		$this->load->model('Barang');
		$this->load->model('Kategori');
		$this->load->model('Supplier');
		$this->load->model('Invoice');
		$this->load->library('upload');
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1) {
			$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
			$data['stokBarangMasuk'] = $this->M_admin->sum('tb_barang_masuk', 'jumlah');
			$data['stokBarangKeluar'] = $this->M_admin->sum('tb_barang_keluar', 'jumlah');
			$data['dataSupplier'] = $this->M_admin->numrows('tb_supplier');
			$this->load->view('admin/index', $data);
		} else {
			$this->load->view('login/login');
		}
	}

	public function sigout()
	{
		session_destroy();
		redirect('login');
	}

	####################################
	// Profile
	####################################

	public function profile()
	{
		$data['token_generate'] = $this->token_generate();
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->session->set_userdata($data);
		$this->load->view('admin/profile', $data);
	}

	public function token_generate()
	{
		return $tokens = md5(uniqid(rand(), true));
	}

	private function hash_password($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}

	public function proses_new_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]');

		if ($this->form_validation->run() == TRUE) {
			if ($this->session->userdata('token_generate') === $this->input->post('token')) {
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$new_password = $this->input->post('new_password');

				$data = array(
					'email'    => $email,
					'password' => $this->hash_password($new_password)
				);

				$where = array(
					'id' => $this->session->userdata('id')
				);

				$this->M_admin->update_password('user', $where, $data);

				$this->session->set_flashdata('msg_berhasil', 'Password Telah Diganti');
				redirect(base_url('admin/profile'));
			}
		} else {
			$this->load->view('admin/profile');
		}
	}

	public function proses_gambar_upload()
	{
		$config =  array(
			'upload_path'     => "./assets/upload/user/img/",
			'allowed_types'   => "gif|jpg|png|jpeg",
			'encrypt_name'    => False, //
			'max_size'        => "50000",  // ukuran file gambar
			'max_height'      => "9680",
			'max_width'       => "9024"
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('userpicture')) {
			$this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
			$this->load->view('admin/profile', $data);
		} else {
			$upload_data = $this->upload->data();
			$nama_file = $upload_data['file_name'];
			$ukuran_file = $upload_data['file_size'];

			//resize img + thumb Img -- Optional
			$config['image_library']     = 'gd2';
			$config['source_image']      = $upload_data['full_path'];
			$config['create_thumb']      = FALSE;
			$config['maintain_ratio']    = TRUE;
			$config['width']             = 150;
			$config['height']            = 150;

			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				$data['pesan_error'] = $this->image_lib->display_errors();
				$this->load->view('admin/profile', $data);
			}

			$where = array(
				'username_user' => $this->session->userdata('name')
			);

			$data = array(
				'nama_file' => $nama_file,
				'ukuran_file' => $ukuran_file
			);

			$this->M_admin->update('tb_upload_gambar_user', $data, $where);
			$this->session->set_flashdata('msg_berhasil_gambar', 'Gambar Berhasil Di Upload');
			redirect(base_url('admin/profile'));
		}
	}

	####################################
	// End Profile
	####################################



	####################################
	// Users
	####################################
	public function users()
	{
		$data['list_users'] = $this->M_admin->kecuali('user', $this->session->userdata('name'));
		$data['token_generate'] = $this->token_generate();
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->session->set_userdata($data);
		$this->load->view('admin/users', $data);
	}

	public function form_user()
	{
		$data['list_satuan'] = $this->M_admin->select('tb_satuan');

		$data['token_generate'] = $this->token_generate();
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->session->set_userdata($data);
		$this->load->view('admin/form_users/form_insert', $data);
	}

	public function update_user()
	{
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$data['token_generate'] = $this->token_generate();
		$data['list_data'] = $this->M_admin->get_data('user', $where);
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->session->set_userdata($data);
		$this->load->view('admin/form_users/form_update', $data);
	}

	public function proses_delete_user()
	{
		$id = $this->uri->segment(3);
		$where = array('id' => $id);
		$this->M_admin->delete('user', $where);
		$this->session->set_flashdata('msg_berhasil', 'User Behasil Di Delete');
		redirect(base_url('admin/users'));
	}

	public function proses_tambah_user()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');

		if ($this->form_validation->run() == TRUE) {
			if ($this->session->userdata('token_generate') === $this->input->post('token')) {

				$username     = $this->input->post('username', TRUE);
				$email        = $this->input->post('email', TRUE);
				$password     = $this->input->post('password', TRUE);
				$role         = $this->input->post('role', TRUE);
				if ($role == 'Pegawai') {
					$setRole = 1;
				}

				$data = array(
					'username'     => $username,
					'email'        => $email,
					'password'     => $this->hash_password($password),
					'role'         => $setRole,
				);
				$this->M_admin->insert('user', $data);

				$this->session->set_flashdata('success', 'User Berhasil Ditambahkan');
				redirect(base_url('admin/form_user'));
			}
		} else {
			$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
			$this->load->view('admin/form_users/form_insert', $data);
		}
	}

	public function proses_update_user()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');


		if ($this->form_validation->run() == TRUE) {
			if ($this->session->userdata('token_generate') === $this->input->post('token')) {
				$id           = $this->input->post('id', TRUE);
				$username     = $this->input->post('username', TRUE);
				$email        = $this->input->post('email', TRUE);
				$role         = $this->input->post('role', TRUE);
				if ($role == 'Pegawai') {
					$setRole = 1;
				}


				$where = array('id' => $id);
				$data = array(
					'username'     => $username,
					'email'        => $email,
					'role'         => $setRole,
				);
				$this->M_admin->update('user', $data, $where);
				$this->session->set_flashdata('msg_berhasil', 'Data User Berhasil Diupdate');
				redirect(base_url('admin/users'));
			}
		} else {
			$this->load->view('admin/form_users/form_update');
		}
	}


	####################################
	// End Users
	####################################



	####################################
	// DATA BARANG MASUK
	####################################

	public function form_barangmasuk()
	{
		$data['list_satuan'] = $this->M_admin->select('tb_satuan');
		$data['list_supplier'] = $this->M_admin->select('tb_supplier');
		$data['list_kategori'] = $this->M_admin->select('tb_kategori');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_barangmasuk/form_insert', $data);
	}

	public function tabel_barangmasuk()
	{
		$data = array(
			'list_data' => $this->BarangMasuk->select('tb_barang_masuk'),
			'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'))
		);

		// var_dump($data['suppliers']);
		$this->load->view('admin/tabel/tabel_barangmasuk', $data);
	}

	public function update_barang($id_transaksi)
	{
		$where = array('id_transaksi' => $id_transaksi);
		$data['data_barang_update'] = $this->BarangMasuk->get_data('tb_barang_masuk', $where);
		$data['list_satuan'] = $this->M_admin->select('tb_satuan');
		$data['list_supplier'] = $this->M_admin->select('tb_supplier');
		$data['list_kategori'] = $this->M_admin->select('tb_kategori');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_barangmasuk/form_update', $data);
	}

	public function delete_barang($id_transaksi)
	{
		$where = array('id_transaksi' => $id_transaksi);
		$data['data_barang_delete'] = $this->BarangMasuk->get_data('tb_barang_masuk', $where);
		$where2 = array('id' => $data['data_barang_delete'][0]->id_barang);
		$where3 = array('id' => $data['data_barang_delete'][0]->id_detail_barang);
		// var_dump($data['data_barang_delete'][0]);
		$this->M_admin->delete('tb_barang', $where2);
		$this->M_admin->delete('tb_detail_barang', $where3);
		$this->M_admin->delete('tb_barang_masuk', $where);

		redirect(base_url('admin/tabel_barangmasuk'));
	}



	public function proses_databarang_masuk_insert()
	{
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|is_unique[tb_barang.nama_barang]');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

		if ($this->form_validation->run() == TRUE) {

			####################################
			// TABEL BARANG
			####################################
			$kode_barang = $this->input->post('kode_barang', TRUE);
			$nama_barang  = $this->input->post('nama_barang', TRUE);
			$lokasi       = $this->input->post('lokasi', TRUE);
			$expire       = $this->input->post('expire', TRUE);

			$data1 = array(
				'kode_barang'  => $kode_barang,
				'nama_barang'  => $nama_barang,
				'lokasi'       => $lokasi,
				'expire'       => $expire,
			);
			$this->db->insert('tb_barang', $data1);
			####################################
			// TABEL BARANG
			####################################

			$id_tabelBarang = $this->db->insert_id();

			####################################
			// TABEL DETAIL BARANG
			####################################

			$id_barang = $id_tabelBarang;
			$id_kategori      = $this->input->post('id_kategori', TRUE);
			$jumlah       = $this->input->post('jumlah', TRUE);
			$harga       = $this->input->post('harga', TRUE);
			$total_harga       = ($harga * $jumlah);
			$id_supplier       = $this->input->post('id_supplier', TRUE);
			$id_satuan       = $this->input->post('id_satuan', TRUE);

			$data2 = array(
				'id_barang' => $id_barang,
				'id_kategori'      => $id_kategori,
				'jumlah'       => $jumlah,
				'harga'       => $harga,
				'total_harga'  => $total_harga,
				'id_supplier'       => $id_supplier,
				'id_satuan'       => $id_satuan,
			);
			$this->M_admin->insert('tb_detail_barang', $data2);

			####################################
			// TABEL DETAIL BARANG
			####################################

			####################################
			// TABEL BARANG MASUK
			####################################

			$id_transaksi = $this->input->post('id_transaksi', TRUE);
			$id_barang = $id_tabelBarang;
			$tanggal      = $this->input->post('tanggal', TRUE);
			$lokasi       = $this->input->post('lokasi', TRUE);
			$jumlah       = $this->input->post('jumlah', TRUE);
			$expire       = $this->input->post('expire', TRUE);
			$id_supplier       = $this->input->post('id_supplier', TRUE);
			$id_satuan       = $this->input->post('id_satuan', TRUE);
			$id_kategori  = $this->input->post('id_kategori', TRUE);

			$data3 = array(
				'id_transaksi' => $id_transaksi,
				'id_barang' => $id_barang,
				'tanggal'      => $tanggal,
				'lokasi'       => $lokasi,
				'jumlah'       => $jumlah,
				'expire'       => $expire,
				'id_supplier'       => $id_supplier,
				'id_satuan'       => $id_satuan,
				'id_kategori'  => $id_kategori,
			);

			$this->M_admin->insert('tb_barang_masuk', $data3);
			####################################
			// TABEL BARANG MASUK
			####################################

			####################################
			// TABEL HISTORI
			####################################
			
			$stok_awal       = $this->input->post('jumlah', TRUE);
			

			$data4 = array(
				'id_transaksi'  => $id_transaksi,
				'nama_barang'  => $nama_barang,
				'stok_awal'       => $stok_awal,
			);
			$this->db->insert('tb_histori', $data4);
			####################################
			// TABEL HISTORI
			####################################

			$this->session->set_flashdata('success', 'Data Barang Berhasil Ditambahkan');
			redirect('admin/form_barangmasuk');
		} else {
			$data['list_satuan'] = $this->M_admin->select('tb_satuan');
			$this->session->set_flashdata('error', 'Duplikat nama barang');
			redirect('admin/form_barangmasuk');
		}
	}

	public function proses_databarang_masuk_update()
	{
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		// $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|is_unique[tb_barang.nama_barang]');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

		if ($this->form_validation->run() == TRUE) {
			####################################
			// TABEL BARANG
			####################################
			$where1 = array('id' => $this->input->post('id_barang', TRUE));
			$kode_barang = $this->input->post('kode_barang', TRUE);
			$nama_barang  = $this->input->post('nama_barang', TRUE);
			$lokasi       = $this->input->post('lokasi', TRUE);
			$expire       = $this->input->post('expire', TRUE);

			$data1 = array(
				'kode_barang'  => $kode_barang,
				'nama_barang'  => $nama_barang,
				'lokasi'       => $lokasi,
				'expire'       => $expire,
			);
			$this->M_admin->update('tb_barang', $data1, $where1);
			####################################
			// TABEL BARANG
			####################################

			####################################
			// TABEL DETAIL BARANG
			####################################
			$where2 = array('id' => $this->input->post('id_detail_barang', TRUE));
			$id_barang = $this->input->post('id_barang', TRUE);;
			$id_kategori      = $this->input->post('id_kategori', TRUE);
			$jumlah_awal       = $this->input->post('jumlah_awal', TRUE);
			$jumlah       = $this->input->post('jumlah', TRUE);
			$total_jumlah = $jumlah_awal + $jumlah;
			$harga       = $this->input->post('harga', TRUE);
			$total_harga       = ($harga * $total_jumlah);
			$id_supplier       = $this->input->post('id_supplier', TRUE);
			$id_satuan       = $this->input->post('id_satuan', TRUE);

			$data2 = array(
				'id_barang' => $id_barang,
				'id_kategori'      => $id_kategori,
				'jumlah'       => $total_jumlah,
				'harga'       => $harga,
				'total_harga'  => $total_harga,
				'id_supplier'       => $id_supplier,
				'id_satuan'       => $id_satuan,
			);
			$this->M_admin->update('tb_detail_barang', $data2, $where2);

			####################################
			// TABEL DETAIL BARANG
			####################################


			####################################
			// TABEL BARANG MASUK
			####################################
			$id_transaksi = $this->input->post('id_transaksi', TRUE);
			$id_barang = $this->input->post('id_barang', TRUE);
			$tanggal      = $this->input->post('tanggal', TRUE);
			$lokasi       = $this->input->post('lokasi', TRUE);
			$jumlah_awal       = $this->input->post('jumlah_awal', TRUE);
			$jumlah       = $this->input->post('jumlah', TRUE);
			$total_jumlah = $jumlah_awal + $jumlah;

			$expire       = $this->input->post('expire', TRUE);
			$id_supplier       = $this->input->post('id_supplier', TRUE);
			$id_satuan       = $this->input->post('id_satuan', TRUE);
			$id_kategori  = $this->input->post('id_kategori', TRUE);

			$where3 = array('id_transaksi' => $id_transaksi);

			$data3 = array(
				'id_transaksi' => $id_transaksi,
				'id_barang' => $id_barang,
				'tanggal'      => $tanggal,
				'lokasi'       => $lokasi,
				'jumlah'       => $total_jumlah,
				'expire'       => $expire,
				'id_supplier'       => $id_supplier,
				'id_satuan'       => $id_satuan,
				'id_kategori'  => $id_kategori,
			);
			$this->M_admin->update('tb_barang_masuk', $data3, $where3);
			####################################
			// TABEL BARANG MASUK
			####################################


			$this->session->set_flashdata('msg_berhasil', 'Data Barang Berhasil Diupdate');
			redirect(base_url('admin/tabel_barangmasuk'));
		} else {
			$this->load->view('admin/form_barangmasuk/form_update');
		}
	}
	####################################
	// END DATA BARANG MASUK
	####################################


	####################################
	// SATUAN
	####################################

	public function form_satuan()
	{
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_satuan/form_insert', $data);
	}

	public function tabel_satuan()
	{
		$data['list_data'] = $this->M_admin->select('tb_satuan');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/tabel/tabel_satuan', $data);
	}

	public function update_satuan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_satuan' => $uri);
		$data['data_satuan'] = $this->M_admin->get_data('tb_satuan', $where);
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_satuan/form_update', $data);
	}

	public function delete_satuan()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_satuan' => $uri);
		$this->M_admin->delete('tb_satuan', $where);
		redirect(base_url('admin/tabel_satuan'));
	}

	public function proses_satuan_insert()
	{

		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required|max_length[100]');

		if ($this->form_validation->run() ==  TRUE) {

			$nama_satuan = $this->input->post('nama_satuan', TRUE);

			$data = array(
				'nama_satuan' => $nama_satuan
			);
			$this->M_admin->insert('tb_satuan', $data);

			$this->session->set_flashdata('success', 'Data satuan Berhasil Ditambahkan');
			redirect(base_url('admin/form_satuan/form_insert'));
		} else {
			$this->load->view('admin/form_satuan/form_insert');
		}
	}

	public function proses_satuan_update()
	{
		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required|max_length[100]');

		if ($this->form_validation->run() ==  TRUE) {
			$id_satuan   = $this->input->post('id_satuan', TRUE);
			$nama_satuan = $this->input->post('nama_satuan', TRUE);

			$where = array(
				'id_satuan' => $id_satuan
			);

			$data = array(
				'nama_satuan' => $nama_satuan
			);
			$this->M_admin->update('tb_satuan', $data, $where);
			var_dump($this->session);
			$this->session->set_flashdata('success', 'Data satuan Berhasil Di Update');
			redirect(base_url('admin/tabel_satuan'));
		} else {
			$this->load->view('admin/form_satuan/form_update');
		}
	}

	####################################
	// END SATUAN
	####################################


	####################################
	// DATA MASUK KE DATA KELUAR
	####################################

	public function barang_keluar()
	{
		$uri = $this->uri->segment(3);
		$where = array('id_transaksi' => $uri);
		$data['list_data'] = $this->BarangMasuk->get_data('tb_barang_masuk', $where);
		// var_dump($where);
		// var_dump($data['list_data']);
		$data['list_satuan'] = $this->M_admin->select('tb_satuan');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/perpindahan_barang/form_update', $data);
	}

	public function proses_data_keluar()
	{

		$this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'trim|required');
		$id_transaksi   = $this->input->post('id_transaksi', TRUE);
		if ($this->form_validation->run() === TRUE) {
			$id_transaksi   = $this->input->post('id_transaksi', TRUE);
			$tanggal_masuk  = $this->input->post('tanggal', TRUE);
			$tanggal_keluar = $this->input->post('tanggal_keluar', TRUE);
			$expire = $this->input->post('expire', TRUE);
			$lokasi         = $this->input->post('lokasi', TRUE);
			$jumlah         = $this->input->post('jumlah', TRUE);
			$harga         = $this->input->post('harga', TRUE);
			$total_harga = ($jumlah * $harga);
			$id_supplier    = $this->input->post('id_supplier', TRUE);
			$id_satuan      = $this->input->post('id_satuan', TRUE);
			$id_kategori      = $this->input->post('id_kategori', TRUE);
			$id_barang      = $this->input->post('id_barang', TRUE);

			// $where = array( 'id_transaksi' => $id_transaksi);
			$data = array(
				'id_transaksi' => $id_transaksi,
				'tanggal_masuk' => $tanggal_masuk,
				'tanggal_keluar' => $tanggal_keluar,
				'expire' => $expire,
				'lokasi' => $lokasi,
				'jumlah' => $jumlah,
				'harga' => $harga,
				'total_harga' => $total_harga,
				'id_supplier' => $id_supplier,
				'id_satuan' => $id_satuan,
				'id_kategori' => $id_kategori,
				'id_barang' => $id_barang,
			);
			// var_dump($data);
			$this->M_admin->insertKeluar('tb_barang_keluar', $data);

			
			####################################
			// TABEL DETAIL BARANG
			####################################
			$this->session->set_flashdata('msg_berhasil_keluar', 'Data Berhasil Keluar');
			redirect(base_url('admin/tabel_barangkeluar'));
		} else {
			$this->load->view('perpindahan_barang/form_update/' . $id_transaksi);
		}
	}
	####################################
	// END DATA MASUK KE DATA KELUAR
	####################################


	####################################
	// DATA BARANG KELUAR
	####################################

	public function tabel_barangkeluar()
	{
		$data['list_data'] = $this->BarangKeluar->select('tb_barang_keluar');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/tabel/tabel_barangkeluar', $data);
	}

	####################################
	// SUPPLIER
	####################################

	public function form_supplier()
	{
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_supplier/form_insert', $data);
	}

	public function tabel_supplier()
	{
		$data['list_data'] = $this->M_admin->select('tb_supplier');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/tabel/tabel_supplier', $data);
	}

	public function update_supplier()
	{
		$uri = $this->uri->segment(3);
		$where = array('id' => $uri);
		$data['data_supplier'] = $this->M_admin->get_data('tb_supplier', $where);
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_supplier/form_update', $data);
	}

	public function detail_supplier()
	{
		$uri = $this->uri->segment(3);
		$where = array('id' => $uri);
		$kondisi = $this->Supplier->get_data('tb_supplier', $where);
		if (empty($kondisi)) {

			$data['data_supplier'] = $this->Kategori->get_data_null('tb_supplier', $where);
			$data['detail_supplier'] = $kondisi;
		} else {
			$data['data_supplier'] = $kondisi;
			$data['detail_supplier'] = $kondisi;
		}

		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_supplier/detail_supplier', $data);
	}

	public function delete_supplier()
	{
		$uri = $this->uri->segment(3);
		$where = array('id' => $uri);
		$this->M_admin->delete('tb_supplier', $where);
		redirect(base_url('admin/tabel_supplier'));
	}

	public function proses_supplier_insert()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'trim|required|max_length[16]');

		if ($this->form_validation->run() ==  TRUE) {
			$nama = $this->input->post('nama', TRUE);
			$alamat = $this->input->post('alamat', TRUE);
			$no_hp = $this->input->post('no_hp', TRUE);

			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
			);
			$this->M_admin->insert('tb_supplier', $data);

			$this->session->set_flashdata('success', 'Data supplier Berhasil Ditambahkan');
			redirect(base_url('admin/form_supplier/form_insert'));
		} else {
			$this->load->view('admin/form_supplier/form_insert');
		}
	}

	public function proses_supplier_update()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'trim|required|max_length[16]');

		if ($this->form_validation->run() ==  TRUE) {
			$id   = $this->input->post('id', TRUE);
			$nama = $this->input->post('nama', TRUE);
			$alamat = $this->input->post('alamat', TRUE);
			$no_hp = $this->input->post('no_hp', TRUE);

			$where = array(
				'id' => $id
			);

			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
			);
			$this->M_admin->update('tb_supplier', $data, $where);

			$this->session->set_flashdata('msg_berhasil', 'Data supplier Berhasil Di Update');
			redirect(base_url('admin/tabel_supplier'));
		} else {
			$this->load->view('admin/form_supplier/form_update');
		}
	}

	####################################
	// END SUPPLIER
	####################################

	public function sidebar()
	{
		$this->load->view('admin/sidebar');
	}
	####################################
	// KATEGORI
	####################################

	public function form_kategori()
	{
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_kategori/form_insert', $data);
	}

	public function tabel_kategori()
	{
		$data['list_data'] = $this->M_admin->select('tb_kategori');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/tabel/tabel_kategori', $data);
	}

	public function update_kategori()
	{
		$uri = $this->uri->segment(3);
		$where = array('id' => $uri);
		$data['data_kategori'] = $this->M_admin->get_data('tb_kategori', $where);
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_kategori/form_update', $data);
	}

	public function detail_kategori()
	{
		$uri = $this->uri->segment(3);
		$where = array('id' => $uri);
		$kondisi = $this->Kategori->get_data('tb_kategori', $where);
		if (empty($kondisi)) {

			$data['data_kategori'] = $this->Kategori->get_data_null('tb_kategori', $where);
			$data['detail_kategori'] = $kondisi;
		} else {
			$data['data_kategori'] = $kondisi;
			$data['detail_kategori'] = $kondisi;
		}
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_kategori/detail_kategori', $data);
	}

	public function delete_kategori()
	{
		$uri = $this->uri->segment(3);
		$where = array('id' => $uri);
		$this->M_admin->delete('tb_kategori', $where);
		redirect(base_url('admin/tabel_kategori'));
	}

	public function proses_kategori_insert()
	{
		$this->form_validation->set_rules('kode_kategori', 'Kode Kategori', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|max_length[100]');

		if ($this->form_validation->run() ==  TRUE) {
			$kode_kategori = $this->input->post('kode_kategori', TRUE);
			$nama_kategori = $this->input->post('nama_kategori', TRUE);

			$data = array(
				'kode_kategori' => $kode_kategori,
				'nama_kategori' => $nama_kategori
			);
			$this->M_admin->insert('tb_kategori', $data);

			$this->session->set_flashdata('success', 'Data kategori Berhasil Ditambahkan');
			redirect(base_url('admin/form_kategori/form_insert'));
		} else {
			$this->load->view('admin/form_kategori/form_insert');
		}
	}

	public function proses_kategori_update()
	{
		$this->form_validation->set_rules('kode_kategori', 'Kode Kategori', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|max_length[100]');

		if ($this->form_validation->run() ==  TRUE) {
			$id   = $this->input->post('id', TRUE);
			$kode_kategori = $this->input->post('kode_kategori', TRUE);
			$nama_kategori = $this->input->post('nama_kategori', TRUE);


			$where = array(
				'id' => $id
			);

			$data = array(
				'kode_kategori' => $kode_kategori,
				'nama_kategori' => $nama_kategori
			);
			$this->M_admin->update('tb_kategori', $data, $where);

			$this->session->set_flashdata('msg_berhasil', 'Data kategori Berhasil Di Update');
			redirect(base_url('admin/tabel_kategori'));
		} else {
			$this->load->view('admin/form_kategori/form_update');
		}
	}

	####################################
	// END KATEGORI
	####################################

	####################################
	// BARANG
	####################################

	// public function form_kategori()
	// {
	//   $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
	//   $this->load->view('admin/form_kategori/form_insert',$data);
	// }

	public function tabel_barang()
	{
		$data['list_data'] = $this->Barang->select('tb_barang');
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/tabel/tabel_barang', $data);
	}

	// public function update_kategori()
	// {
	//   $uri = $this->uri->segment(3);
	//   $where = array('id' => $uri);
	//   $data['data_kategori'] = $this->M_admin->get_data('tb_kategori',$where);
	//   $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
	//   $this->load->view('admin/form_kategori/form_update',$data);
	// }

	public function detail_barang()
	{
		$uri = $this->uri->segment(3);
		$where = array('id' => $uri);
		$data['data_barang'] = $this->Barang->get_data('tb_barang', $where);
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/form_barangmasuk/detail_barang', $data);
	}

	// public function delete_kategori()
	// {
	//   $uri = $this->uri->segment(3);
	//   $where = array('id' => $uri);
	//   $this->M_admin->delete('tb_kategori',$where);
	//   redirect(base_url('admin/tabel_kategori'));
	// }

	// public function proses_kategori_insert()
	// {
	//   $this->form_validation->set_rules('kode_kategori','Kode Kategori','trim|required|max_length[20]');
	//   $this->form_validation->set_rules('nama_kategori','Nama Kategori','trim|required|max_length[100]');

	//   if($this->form_validation->run() ==  TRUE)
	//   {
	//     $kode_kategori = $this->input->post('kode_kategori' ,TRUE);
	//     $nama_kategori = $this->input->post('nama_kategori' ,TRUE);

	//     $data = array(
	//           'kode_kategori' => $kode_kategori,
	//           'nama_kategori' => $nama_kategori
	//     );
	//     $this->M_admin->insert('tb_kategori',$data);

	//     $this->session->set_flashdata('msg_berhasil','Data kategori Berhasil Ditambahkan');
	//     redirect(base_url('admin/tabel_kategori'));
	//   }else {
	//     $this->load->view('admin/form_kategori/form_insert');
	//   }
	// }

	// public function proses_kategori_update()
	// {
	// 	$this->form_validation->set_rules('kode_kategori','Kode Kategori','trim|required|max_length[20]');
	//   $this->form_validation->set_rules('nama_kategori','Nama Kategori','trim|required|max_length[100]');

	//   if($this->form_validation->run() ==  TRUE)
	//   {
	//     $id   = $this->input->post('id' ,TRUE);
	// 		$kode_kategori = $this->input->post('kode_kategori' ,TRUE);
	//     $nama_kategori = $this->input->post('nama_kategori' ,TRUE);


	//     $where = array(
	//           'id' => $id
	//     );

	//     $data = array(
	// 			'kode_kategori' => $kode_kategori,
	// 			'nama_kategori' => $nama_kategori
	//     );
	//     $this->M_admin->update('tb_kategori',$data,$where);

	//     $this->session->set_flashdata('msg_berhasil','Data kategori Berhasil Di Update');
	//     redirect(base_url('admin/tabel_kategori'));
	//   }else {
	//     $this->load->view('admin/form_kategori/form_update');
	//   }
	// }

	####################################
	// END Barang
	####################################


	####################################
	// Filter invoice penggunaan barang
	####################################


	public function tabel_invoicePenggunaanBarang()
	{
		$data['tahun'] = $this->Invoice->gettahun();
		$data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));
		$this->load->view('admin/reports/invoice_penggunaanBarang', $data);
	}

	####################################
	// Filter invoice penggunaan barang
	####################################

}