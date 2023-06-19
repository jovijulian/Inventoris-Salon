<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Pdf');
    $this->load->model('M_admin');
    $this->load->model('Invoice');
    // $this->load->library('date');
    // $this->load->model('Invoice');
    $this->load->model('BarangKeluar');
  }

  public function barangKeluarManual()
  {

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Barang Keluar');
    $pdf->SetSubject('Barang Keluar');

    //header Data
    $pdf->SetHeaderData('andini-salon.jpg',30,'Laporan Data','Barang Keluar',array(203, 58, 44),array(0, 0, 0));
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));


    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margin
    $pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP + 10,PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);

    //SET Scaling ImagickPixel
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //FONT Subsetting
    $pdf->setFontSubsetting(true);

    $pdf->SetFont('helvetica','',14,'',true);

    $pdf->AddPage('L');

    $html=
      '<div>
        <h1 align="center">Invoice Bukti Pengeluaran Barang</h1>
        <p>No Id Transaksi  :</p>
        <p>Ditunjukan Untuk :</p>
        <p>Tanggal          :</p>
        <p>Po.Customer      :</p>


        <table border="1">
          <tr>
            <th style="width:40px" align="center">No</th>
            <th style="width:110px" align="center">ID Transaksi</th>
            <th style="width:110px" align="center">Tanggal Masuk</th>
            <th style="width:110px" align="center">Tanggal Keluar</th>
            <th style="width:130px" align="center">Keterangan Tempat</th>
            <th style="width:140px" align="center">Kode Barang</th>
            <th style="width:140px" align="center">Nama Barang</th>
            <th style="width:80px" align="center">Satuan</th>
            <th style="width:80px" align="center">Jumlah</th>
          </tr>';

        $html .= '<tr>
                    <td style="height:180px"></td>
                    <td  style="height:180px"></td>
                    <td style="height:180px"></td>
                    <td style="height:180px"></td>
                    <td style="height:180px"></td>
                    <td style="height:180px"></td>
                    <td style="height:180px"></td>
                    <td style="height:180px"></td>
                    <td style="height:180px"></td>
                 </tr>
                 <tr>
                  <td align="center" colspan="8">Jumlah</td>
                  <td></td>
                 </tr>';



        $html .='
            </table>
            <h6>Mengetahui</h6><br>
            <h6>Admin</h6>
          </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('contoh_report.pdf','I');
  }

  public function barangKeluar()
  {
    $id = $this->uri->segment(3);
    $tgl1 = $this->uri->segment(4);
    $tgl2 = $this->uri->segment(5);
    $tgl3 = $this->uri->segment(6);
    $ls   = array('id_transaksi' => $id ,'tanggal_keluar' => $tgl1.'/'.$tgl2.'/'.$tgl3);
    $data = $this->BarangKeluar->get_data('tb_barang_keluar',$ls);

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // document informasi
    $pdf->SetCreator('Web Aplikasi Gudang');
    $pdf->SetTitle('Laporan Data Barang Keluar');
    $pdf->SetSubject('Barang Keluar');

    //header Data
    $pdf->SetHeaderData('logo-gema.jpeg',30,'Laporan Data','Barang Keluar',array(203, 58, 44),array(0, 0, 0));
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));


    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margin
    $pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP + 10,PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);

    //SET Scaling ImagickPixel
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //FONT Subsetting
    $pdf->setFontSubsetting(true);

    $pdf->SetFont('helvetica','',14,'',true);

    $pdf->AddPage('L');

    $html=
      '<div>
        <h1 align="center">Invoice Bukti Pengeluaran Barang</h1><br>
        <p>No Id Transaksi  : '.$id.'</p>
        <p>Ditunjukan Untuk :</p>
        <p>Tanggal          : '.$tgl1.'/'.$tgl2.'/'.$tgl3.'</p>
        <p>Po.Customer      :</p>


        <table border="1">
          <tr>
            <th style="width:40px" align="center">No</th>
            <th style="width:110px" align="center">ID Transaksi</th>
            <th style="width:110px" align="center">Tanggal Masuk</th>
            <th style="width:110px" align="center">Tanggal Keluar</th>
            <th style="width:130px" align="center">Keterangan Tempat</th>
            <th style="width:140px" align="center">Kode Barang</th>
            <th style="width:140px" align="center">Nama Barang</th>
            <th style="width:140px" align="center">Supplier</th>
            <th style="width:80px" align="center">Satuan</th>
            <th style="width:80px" align="center">Jumlah</th>
          </tr>';


          $no = 1;
          foreach($data as $d){
            $html .= '<tr>';
            $html .= '<td align="center">'.$no.'</td>';
            $html .= '<td align="center">'.$d->id_transaksi.'</td>';
            $html .= '<td align="center">'.date('d-m-Y', $d->tanggal_masuk).'</td>';
            $html .= '<td align="center">'.date('d-m-Y', $d->tanggal_keluar).'</td>';
            $html .= '<td align="center">'.$d->lokasi.'</td>';
           
            $html .= '<td align="center">'.$d->nama_barang.'</td>';
            $html .= '<td align="center">'.$d->nama.'</td>';
            $html .= '<td align="center">'.$d->nama_satuan.'</td>';
            $html .= '<td align="center">'.$d->jumlah.'</td>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<td align="center" colspan="8"><b>Jumlah</b></td>';
            $html .= '<td align="center">'.$d->jumlah.'</td>';
            $html .= '</tr>';
            $no++;
          }


        $html .='
            </table><br>
            <h6>Mengetahui</h6><br><br><br>
            <h6>Admin</h6>
          </div>';

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('invoice_barang_keluar.pdf','I');

  }

	public function barangKeluarTahun()
  {
		$tahun2 = $this->input->post('tahun2');
		$data = $this->Invoice->filterbytahun($tahun2);


    // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(500, 300), true, 'UTF-8', false);
	
    // document informasi
    $pdf->SetCreator('Andini Salon');
    $pdf->SetTitle('Laporan Data Pengeluaran Barang');
    $pdf->SetSubject('Pengeluaran Barangr');

    //header Data
    $pdf->SetHeaderData('andini-salon.png',30,'Laporan Data','Pengeluaran Barang',array(0,0,0),array(0, 0, 0));
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));


    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margin
    $pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP + 10,PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);

    //SET Scaling ImagickPixel
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //FONT Subsetting
    $pdf->setFontSubsetting(true);

    $pdf->SetFont('helvetica','',14,'',true);

    $pdf->AddPage('L');

    $html=
      '<div>
        <h1 align="center">Invoice Bukti Pengeluaran Barang</h1><br>
        <p>Ditunjukan Untuk :</p>
        <p>Tanggal          : '.date('d-m-Y').'</p>
       

				<div style="overflow-x: auto;">
        <table border="1" style="width: 100%; table-layout: fixed;">
          <tr>
            <th style="width:40px; text-align: center;">No</th>
            <th style="width:110px; text-align: center;">Kode Transaksi</th>
            <th style="width:130px; text-align: center;">Nama Barang</th>
            <th style="width:110px; text-align: center;">Tanggal Masuk</th>
            <th style="width:110px; text-align: center;">Tanggal Keluar</th>
            <th style="width:130px; text-align: center;">Kategori</th>
            <th style="width:140px; text-align: center;">Supplier</th>
            <th style="width:140px; text-align: center;">Satuan</th>
            <th style="width:140px; text-align: center;">Jumlah</th>
            <th style="width:80px; text-align: center;">Harga</th>
            <th style="width:80px; text-align: center;">Total Harga</th>
            <th style="width:110px; text-align: center;">Tanggal Expire</th>
          </tr>';


          $no = 1;
					$totalHarga = 0;
          foreach($data as $d){
            $html .= '<tr>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$no.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->id_transaksi.'</td>';
						$html .= '<td style="text-align: center; padding: 5px;">'.$d->nama_barang.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->tanggal_masuk)).'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->tanggal_keluar)).'</td>';
						
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->kode_kategori . ' / ' . $d->nama_kategori .'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->nama.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->nama_satuan.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->jumlah.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'. "Rp. " . number_format($d->harga, 0, ',', '.').'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'. "Rp. " . number_format($d->total_harga, 0, ',', '.').'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->expire)).'</td>';
            $html .= '</tr>';
						$totalHarga += $d->total_harga;
            $no++;
					
          }

					$html .= '</table></div>';

					$html .= '<div style="text-align: right; margin-top: 10px;">
						<strong>Total Harga:</strong> ' . "Rp. " . number_format($totalHarga, 0, ',', '.') . '
					</div>';
					
					$html .= '<br><br><br>
						<h6>Mengetahui</h6><br><br><br>
						<h6 style="margin-top: 5%;">Owner</h6>
					</div>';
				

					// Mengatur lebar kolom pada tabel
					
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('invoice_barang_keluar.pdf','I');

  }
	public function barangKeluarBulan()
  {
		$tahun1 = $this->input->post('tahun1');
		$bulanawal = $this->input->post('bulanawal');
		$bulanakhir = $this->input->post('bulanakhir');
		// $this->Barang_model->filterbybulan($tahun1,$bulanawal,$bulanakhir);
		$data = $this->Invoice->filterbybulan($tahun1,$bulanawal,$bulanakhir);


    // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(500, 300), true, 'UTF-8', false);
	
    // document informasi
    $pdf->SetCreator('Andini Salon');
    $pdf->SetTitle('Laporan Data Pengeluaran Barang');
    $pdf->SetSubject('Pengeluaran Barangr');

    //header Data
    $pdf->SetHeaderData('andini-salon.png',30,'Laporan Data','Pengeluaran Barang',array(0,0,0),array(0, 0, 0));
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));


    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margin
    $pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP + 10,PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);

    //SET Scaling ImagickPixel
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //FONT Subsetting
    $pdf->setFontSubsetting(true);

    $pdf->SetFont('helvetica','',14,'',true);

    $pdf->AddPage('L');

		$html=
		'<div>
			<h1 align="center">Invoice Bukti Pengeluaran Barang</h1><br>
			<p>Ditunjukan Untuk :</p>
			<p>Tanggal          : '.date('d-m-Y').'</p>
		 

			<div style="overflow-x: auto;">
			<table border="1" style="width: 100%; table-layout: fixed;">
				<tr>
					<th style="width:40px; text-align: center;">No</th>
					<th style="width:110px; text-align: center;">Kode Transaksi</th>
					<th style="width:130px; text-align: center;">Nama Barang</th>
					<th style="width:110px; text-align: center;">Tanggal Masuk</th>
					<th style="width:110px; text-align: center;">Tanggal Keluar</th>
					<th style="width:130px; text-align: center;">Kategori</th>
					<th style="width:140px; text-align: center;">Supplier</th>
					<th style="width:140px; text-align: center;">Satuan</th>
					<th style="width:140px; text-align: center;">Jumlah</th>
					<th style="width:80px; text-align: center;">Harga</th>
					<th style="width:80px; text-align: center;">Total Harga</th>
					<th style="width:110px; text-align: center;">Tanggal Expire</th>
				</tr>';


				$no = 1;
				$totalHarga = 0;
				foreach($data as $d){
					$html .= '<tr>';
					$html .= '<td style="text-align: center; padding: 5px;">'.$no.'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'.$d->id_transaksi.'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'.$d->nama_barang.'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->tanggal_masuk)).'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->tanggal_keluar)).'</td>';
					
					$html .= '<td style="text-align: center; padding: 5px;">'.$d->kode_kategori . ' / ' . $d->nama_kategori .'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'.$d->nama.'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'.$d->nama_satuan.'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'.$d->jumlah.'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'. "Rp. " . number_format($d->harga, 0, ',', '.').'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'. "Rp. " . number_format($d->total_harga, 0, ',', '.').'</td>';
					$html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->expire)).'</td>';
					$html .= '</tr>';
					$totalHarga += $d->total_harga;
					$no++;
				
				}

				$html .= '</table></div>';

				$html .= '<div style="text-align: right; margin-top: 10px;">
					<strong>Total Harga:</strong> ' . "Rp. " . number_format($totalHarga, 0, ',', '.') . '
				</div>';
				
				$html .= '<br><br><br>
					<h6>Mengetahui</h6><br><br><br>
					<h6 style="margin-top: 5%;">Owner</h6>
				</div>';
				

					// Mengatur lebar kolom pada tabel
					
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('invoice_barang_keluar.pdf','I');

  }

	public function barangKeluarTanggal()
  {
		$tanggalawal = $this->input->post('tanggalawal');
		$tanggalakhir = $this->input->post('tanggalakhir');
		$data =  $this->Invoice->filterbytanggal($tanggalawal, $tanggalakhir);


    // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(500, 300), true, 'UTF-8', false);
	
    // document informasi
    $pdf->SetCreator('Andini Salon');
    $pdf->SetTitle('Laporan Data Pengeluaran Barang');
    $pdf->SetSubject('Pengeluaran Barangr');

    //header Data
    $pdf->SetHeaderData('andini-salon.png',30,'Laporan Data','Pengeluaran Barang',array(0,0,0),array(0, 0, 0));
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));


    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margin
    $pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP + 10,PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);

    //SET Scaling ImagickPixel
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //FONT Subsetting
    $pdf->setFontSubsetting(true);

    $pdf->SetFont('helvetica','',14,'',true);

    $pdf->AddPage('L');

    $html=
      '<div>
        <h1 align="center">Invoice Bukti Pengeluaran Barang</h1><br>
        <p>Ditunjukan Untuk :</p>
        <p>Tanggal          : '.date('d-m-Y').'</p>
       

				<div style="overflow-x: auto;">
        <table border="1" style="width: 100%; table-layout: fixed;">
          <tr>
            <th style="width:40px; text-align: center;">No</th>
            <th style="width:110px; text-align: center;">Kode Transaksi</th>
            <th style="width:130px; text-align: center;">Nama Barang</th>
            <th style="width:110px; text-align: center;">Tanggal Masuk</th>
            <th style="width:110px; text-align: center;">Tanggal Keluar</th>
            <th style="width:130px; text-align: center;">Kategori</th>
            <th style="width:140px; text-align: center;">Supplier</th>
            <th style="width:140px; text-align: center;">Satuan</th>
            <th style="width:140px; text-align: center;">Jumlah</th>
            <th style="width:80px; text-align: center;">Harga</th>
            <th style="width:80px; text-align: center;">Total Harga</th>
            <th style="width:110px; text-align: center;">Tanggal Expire</th>
          </tr>';


          $no = 1;
					$totalHarga = 0;
          foreach($data as $d){
            $html .= '<tr>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$no.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->id_transaksi.'</td>';
						$html .= '<td style="text-align: center; padding: 5px;">'.$d->nama_barang.'</td>';
						$html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->tanggal_masuk)).'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->tanggal_keluar)).'</td>';
						
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->kode_kategori . ' / ' . $d->nama_kategori .'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->nama.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->nama_satuan.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.$d->jumlah.'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'. "Rp. " . number_format($d->harga, 0, ',', '.').'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'. "Rp. " . number_format($d->total_harga, 0, ',', '.').'</td>';
            $html .= '<td style="text-align: center; padding: 5px;">'.date('d-m-Y', strtotime($d->expire)).'</td>';
            $html .= '</tr>';
						$totalHarga += $d->total_harga;
            $no++;
					
          }

					$html .= '</table></div>';

					$html .= '<div style="text-align: right; margin-top: 10px;">
						<strong>Total Harga:</strong> ' . "Rp. " . number_format($totalHarga, 0, ',', '.') . '
					</div>';
					
					$html .= '<br><br><br>
						<h6>Mengetahui</h6><br><br><br>
						<h6 style="margin-top: 5%;">Owner</h6>
					</div>';
				

					// Mengatur lebar kolom pada tabel
					
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

    $pdf->Output('invoice_barang_keluar.pdf','I');

  }
}
?>
