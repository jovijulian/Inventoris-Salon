<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Andini Salon</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?php echo base_url() ?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="<?php echo base_url() ?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/web_admin/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/datetimepicker/css/bootstrap-datetimepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400">

    <style>
    * {
        font-family: 'Montserrat', sans-serif;

    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .form-check {
        display: inline-block
    }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">


        <!-- Left side column. contains the logo and sidebar -->

        <?php $this->load->view('admin/sidebar') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Forms</a></li>
                    <li class="active">Data Pembelian Barang</li>
                </ol>
            </section>
            <!-- function generate id transaksi -->
            <?php 
				$query = $this->db->select('id_transaksi')->order_by('id_transaksi', 'desc')->limit(1)->get('tb_barang_masuk');
				$row = $query->row();
				$digit = $row ?substr($row->id_transaksi, -3) : 0;
				$urutan_terakhir = $row ? (int)$digit : 0;
				$urutan_baru = $urutan_terakhir + 1;
				$format_urutan = sprintf("%03d", $urutan_baru);
			?>
            <?php 
				$query = $this->db->select('kode_barang')->order_by('kode_barang', 'desc')->limit(1)->get('tb_barang');
				$row = $query->row();
				$digit = $row ?substr($row->kode_barang, -3) : 0;
				$urutan_terakhir = $row ? (int)$digit : 0;
				$urutan_baru = $urutan_terakhir + 1;
				$format_urutanBarang = sprintf("%03d", $urutan_baru);
			?>
            <!-- Main content -->
            <section class="content" style="margin-top: 2%">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <div class="container">
                            <!-- general form elements -->
                            <div class="box " style="width:105%;">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Tambah Data
                                        Barang Masuk</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <div class="container">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="<?= base_url('admin/proses_databarang_masuk_insert') ?>"
                                                role="form" method="post">
                                                <div class="box-body">

                                                    <input type="hidden" name="kode_barang" class="form-control"
                                                        readonly="readonly"
                                                        value="KB-<?= date("Y"); ?><?= $format_urutanBarang; ?>">
                                                    <div class="form-group">
                                                        <label for="id_transaksi">Kode Transaksi</label>
                                                        <input type="text" name="id_transaksi" class="form-control"
                                                            readonly="readonly"
                                                            value="TB-<?= date("Y"); ?><?= $format_urutan; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal">Tanggal</label>
                                                        <input type="date" name="tanggal" class="form-control"
                                                            placeholder="Klik Disini" autocomplete="off" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Kategori Barang</label>
                                                        <select class="form-control" name="id_kategori" required>
                                                            <option value="" selected="">-- Pilih --</option>

                                                            <?php foreach ($list_kategori as $s) { ?>
                                                            <option value="<?= $s->id ?>">
                                                                <?= $s->kode_kategori . " - " . $s->nama_kategori ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_Barang">Nama Barang</label>
                                                        <input type="text" name="nama_barang" class="form-control"
                                                            id="nama_Barang" placeholder="Nama Barang" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="suplier">Supplier</label>
                                                        <select class="form-control" name="id_supplier" required>
                                                            <option value="" selected="">-- Pilih --</option>
                                                            <?php foreach ($list_supplier as $s) { ?>
                                                            <option value="<?= $s->id ?>">
                                                                <?= $s->nama ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="satuan">Satuan</label>
                                                        <select class="form-control" name="id_satuan" required>
                                                            <option value="" selected="">-- Pilih --</option>

                                                            <?php foreach ($list_satuan as $s) { ?>
                                                            <option value="<?= $s->id_satuan ?>">
                                                                <?= $s->nama_satuan ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="expire">Tanggal Kadaluarsa</label>
                                                        <input type="date" name="expire" class="form-control "
                                                            placeholder="Klik Disini" autocomplete="off" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah">Jumlah</label>
                                                        <input type="number" name="jumlah" class="form-control"
                                                            id="jumlah" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Harga per satuan</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">Rp.</span>
                                                            <input type="number" name="harga" class="form-control"
                                                                id="harga" required id="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_barang">Keterangan Tempat</label>
                                                        <select class="form-control" name="lokasi" required>
                                                            <option value="">-- Pilih --</option>
                                                            <option value="Rak 1 Atas">Rak 1 Atas</option>
                                                            <option value="Rak 1 Bawah">Rak 1 Bawah</option>
                                                            <option value="Rak 2 Atas">Rak 2 Atas</option>
                                                            <option value="Rak 2 Bawah">Rak 2 Bawah</option>
                                                            <option value="Rak 3 Atas">Rak 3 Atas</option>
                                                            <option value="Rak 3 Bawah">Rak 3 Bawah</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="reset" class="btn btn-basic" name="btn_reset"><i
                                                                class="fa fa-eraser" aria-hidden="true"></i>
                                                            Reset</button>
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer" style="width:100%;">
                                                        <a type="button" class="btn btn-default"
                                                            style="width:10%;margin-right:1%" onclick="history.back(-1)"
                                                            name="btn_kembali"><i class="fa fa-arrow-left"
                                                                aria-hidden="true"></i>
                                                            Kembali</a>
                                                        <a type="button" class="btn"
                                                            style="width:14%;margin-right:53%;background-color: #A4907C; color: #fff"
                                                            href="<?= base_url('admin/tabel_barangmasuk') ?>"
                                                            name="btn_listbarang"><i class="fa fa-table"
                                                                aria-hidden="true"></i>
                                                            Lihat List Barang</a>
                                                        <button type="submit"
                                                            style="width:20%; background-color: #e9decb" id="submit"
                                                            class="btn"><i class="fa fa-check" aria-hidden="true"></i>
                                                            Submit</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->

                            <!-- Form Element sizes -->

                            <!-- /.box -->


                            <!-- /.box -->

                            <!-- Input addon -->

                            <!-- /.box -->

                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <!-- <div class="col-md-6">
       

                      /.box -->
                        <!-- general form elements disabled -->

                        <!-- /.box -->

                    </div>
                </div>
                <!--/.col (right) -->
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; <?= date('Y') ?></strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="<?php echo base_url() ?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url() ?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/web_admin/dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url() ?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>assets/web_admin/dist/js/demo.js"></script>

    <script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayBtn: true,
        pickTime: false,
        minView: 2,
        maxView: 4,
    });
    </script>
    <script type="text/javascript">
    <?php if ($this->session->flashdata('success')) { ?>

    Swal.fire({
        title: 'Sukses',
        text: 'Data Barang Berhasil Ditambahkan',
        icon: 'success',
    })

    <?php } else if ($this->session->flashdata('error')) {  ?>

    Swal.fire({
        title: 'Error',
        text: 'Duplikat nama barang',
        icon: 'error',
    })
    <?php } ?>
    </script>
</body>


</html>
