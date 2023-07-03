<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportUser extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();;
    $this->load->model('Invoice');

  }

	public function barangMasukTahun()
  {
		$tahun2 = $this->input->post('tahun2');
		$data = $this->Invoice->filterbytahunMasuk($tahun2);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));
   
  }
	public function barangMasukBulan()
  {
		$tahun1 = $this->input->post('tahun1');
		$bulanawal = $this->input->post('bulanawal');
		$bulanakhir = $this->input->post('bulanakhir');
		$data = $this->Invoice->filterbybulanMasuk($tahun1,$bulanawal,$bulanakhir);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));
  }

	public function barangMasukTanggal()
  {
		$tanggalawal = $this->input->post('tanggalawal');
		$tanggalakhir = $this->input->post('tanggalakhir');
		$data =  $this->Invoice->filterbytanggalMasuk($tanggalawal, $tanggalakhir);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));

  }

  public function barangKeluarTahun()
  {
		$tahun2 = $this->input->post('tahun2');
		$data = $this->Invoice->filterbytahun($tahun2);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));
   
  }
	public function barangKeluarBulan()
  {
		$tahun1 = $this->input->post('tahun1');
		$bulanawal = $this->input->post('bulanawal');
		$bulanakhir = $this->input->post('bulanakhir');
		$data = $this->Invoice->filterbybulan($tahun1,$bulanawal,$bulanakhir);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));
  }

	public function barangKeluarTanggal()
  {
		$tanggalawal = $this->input->post('tanggalawal');
		$tanggalakhir = $this->input->post('tanggalakhir');
		$data =  $this->Invoice->filterbytanggal($tanggalawal, $tanggalakhir);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));

  }
}
?>