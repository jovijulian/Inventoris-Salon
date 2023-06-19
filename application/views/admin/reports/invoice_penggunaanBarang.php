<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Andini Salon</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?php echo base_url()?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="<?php echo base_url()?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert/dist/sweetalert.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/skins/_all-skins.min.css">

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
                <h1>
                    Invoice Penggunaan Barang
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?=base_url('admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Report</li>
                    <li class="active"><a href="<?=base_url('admin/tabel_supplier')?>">Invoice Penggunaan Barang</a>
                    </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- row satu  -->
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                Filter
                            </div>
                            <!--id formfilter adalah nama form untuk filter-->
                            <form id="formfilter">
                                <div class="card-body card-block">
                                    <input name="valnilai" type="hidden">
                                    <div class="row form-group">
                                        <div id="form-tanggal" class="col col-md-3"><label for="select"
                                                class=" form-control-label">Periode </label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="periode" id="periode" class="form-control form-control-user"
                                                title="Pilih Tahun Ajaran">
                                                <option value="">-PILIH-</option>
                                                <option value="tanggal">Tanggal</option>
                                                <option value="bulan">Bulan</option>
                                                <option value="tahun">Tahun</option>
                                            </select>
                                            <small class="help-block form-text"></small>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">

                                    <!--ketika di klik tombol Proses, maka akan mengeksekusi fungsi javascript prosesPeriode() , untuk menampilkan form-->

                                    <button id="btnproses" type="button" onclick="prosesPeriode()" class="btn btn-sm "
                                        style="background-color: #e9decb; color: #000;"><i class="fa fa-edit"></i>
                                        Proses</button>

                                    <!--ketika di klik tombol Reset, maka akan mengeksekusi fungsi javascript prosesReset() , untuk menyembunyikan form-->
                                    <button onclick="prosesReset()" type="button" class="btn btn-sm btn-danger"><i
                                            class="fa fa-ban"></i> Reset</button>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- row kedua  -->
                    <div class="col-lg-7" id="tanggalfilter">
                        <div class="card">
                            <div class="card-header">
                                Filter berdasarkan tanggal
                            </div>
                            <form action="<?=base_url('report/barangKeluarTanggal')?>" method="POST" target="_blank">
                                <input type="hidden" name="nilaifilter" value="1">

                                <input name="valnilai" type="hidden">
                                <div class="card-body card-block">

                                    <div class="row form-group">
                                        <div class="col col-md-2">
                                            <label for="select" class=" form-control-label">Dari tanggal</label>
                                        </div>
                                        <div class="col col-md-4">
                                            <input name="tanggalawal" value="" type="date" class="form-control"
                                                placeholder="Inputkan Jenis Bayar" id="tanggalawal" required="">
                                        </div>
                                        <div class="col col-md-2">
                                            <label for="select" class=" form-control-label">Sampai tanggal</label>
                                        </div>
                                        <div class="col col-md-4">
                                            <input name="tanggalakhir" value="" type="date" class="form-control"
                                                placeholder="Inputkan Jenis Bayar" id="tanggalakhir" required="">
                                        </div>

                                        <small class="help-block form-text"></small>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i>
                                        Print</button>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- row ketiga  -->
                    <div class="col-lg-7" id="bulanfilter">
                        <div class="card">
                            <div class="card-header">
                                Filter berdasarkan bulan
                            </div>
                            <form id="formbulan" action="<?=base_url('report/barangKeluarBulan')?>" method="POST"
                                target="_blank">
                                <div class="card-body card-block">
                                    <input type="hidden" name="nilaifilter" value="2">

                                    <input name="valnilai" type="hidden">
                                    <div class="row form-group">
                                        <div id="form-tanggal" class="col col-md-2"><label for="select"
                                                class=" form-control-label">Pilih Tahun</label></div>
                                        <div class="col-12 col-md-10">
                                            <select name="tahun1" id="tahun1" class="form-control form-control-user"
                                                title="Pilih Tahun">
                                                <option value="">-PILIH-</option>
                                                <?php foreach($tahun as $thn): ?>
                                                <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small class="help-block form-text"></small>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-2">
                                            <label for="select" class=" form-control-label">Dari bulan</label>
                                        </div>
                                        <div class="col col-md-4">
                                            <select name="bulanawal" id="bulanawal"
                                                class="form-control form-control-user" title="Pilih Bulan">
                                                <option value="">-PILIH-</option>
                                                <option value="1">JANUARI</option>
                                                <option value="2">FEBRUARI</option>
                                                <option value="3">MARET</option>
                                                <option value="4">APRIL</option>
                                                <option value="5">MEI</option>
                                                <option value="6">JUNI</option>
                                                <option value="7">JULI</option>
                                                <option value="8">AGUSTUS</option>
                                                <option value="9">SEPTEMBER</option>
                                                <option value="10">OKTOBER</option>
                                                <option value="11">NOVEMBER</option>
                                                <option value="12">DESEMBER</option>
                                            </select>
                                        </div>
                                        <div class="col col-md-2">
                                            <label for="select" class=" form-control-label">Sampai bulan</label>
                                        </div>
                                        <div class="col col-md-4">
                                            <select name="bulanakhir" id="bulanakhir"
                                                class="form-control form-control-user" title="Pilih Bulan">
                                                <option value="">-PILIH-</option>
                                                <option value="1">JANUARI</option>
                                                <option value="2">FEBRUARI</option>
                                                <option value="3">MARET</option>
                                                <option value="4">APRIL</option>
                                                <option value="5">MEI</option>
                                                <option value="6">JUNI</option>
                                                <option value="7">JULI</option>
                                                <option value="8">AGUSTUS</option>
                                                <option value="9">SEPTEMBER</option>
                                                <option value="10">OKTOBER</option>
                                                <option value="11">NOVEMBER</option>
                                                <option value="12">DESEMBER</option>
                                            </select>
                                        </div>
                                        <small class="help-block form-text"></small>

                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i>
                                        Print</button>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- row keempat  -->
                    <div class="col-lg-7" id="tahunfilter">
                        <div class="card">
                            <div class="card-header">
                                Filter berdasarkan tahun
                            </div>
                            <form id="formtahun" action="<?=base_url('report/barangKeluarTahun')?>" method="POST"
                                target="_blank">
                                <input name="valnilai" type="hidden">
                                <div class="card-body card-block">

                                    <input type="hidden" name="nilaifilter" value="3">

                                    <div class="row form-group">
                                        <div id="form-tanggal" class="col col-md-2"><label for="select"
                                                class=" form-control-label">Pilih Tahun</label></div>
                                        <div class="col-12 col-md-10">
                                            <select name="tahun2" id="tahun2" class="form-control form-control-user"
                                                title="Pilih Tahun">
                                                <option value="">-PILIH-</option>
                                                <?php foreach($tahun as $thn): ?>
                                                <option value="<?php echo $thn->tahun; ?>"><?php echo $thn->tahun; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small class="help-block form-text"></small>
                                        </div>
                                    </div>



                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i>
                                        Print</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; <?=date('Y')?></strong>

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
                                <a href="javascript:void(0)" class="text-red pull-right"><i
                                        class="fa fa-trash-o"></i></a>
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
    <script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script
        src="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
    </script>
    <!-- FastClick -->
    <script src="<?php echo base_url()?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>assets/web_admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url()?>assets/web_admin/dist/js/demo.js"></script>
    <!-- page script -->
    <script>
    /*digunakan untuk menyembunyikan form tanggal, bulan dan tahun saat halaman di load */
    $(document).ready(function() {

        $("#tanggalfilter").hide();
        $("#tahunfilter").hide();
        $("#bulanfilter").hide();
        $("#cardbayar").hide();

    });

    function prosesPeriode() {
        var periode = $("[name='periode']").val();

        if (periode == "tanggal") {
            $("#btnproses").hide();
            $("#tanggalfilter").show();
            $("[name='valnilai']").val('tanggal');

        } else if (periode == "bulan") {
            $("#btnproses").hide();
            $("[name='valnilai']").val('bulan');
            $("#bulanfilter").show();

        } else if (periode == "tahun") {
            $("#btnproses").hide();
            $("[name='valnilai']").val('tahun');
            $("#tahunfilter").show();
        }
    }

    /*digunakan untuk menytembunyikan form tanggal, bulan dan tahun*/

    function prosesReset() {
        $("#btnproses").show();

        $("#tanggalfilter").hide();
        $("#tahunfilter").hide();
        $("#bulanfilter").hide();
        $("#cardbayar").hide();

        $("#periode").val('');
        $("#tanggalawal").val('');
        $("#tanggalakhir").val('');
        $("#tahun1").val('');
        $("#bulanawal").val('');
        $("#bulanakhir").val('');
        $("#tahun2").val('');
        $("#targetbayar").empty();

    }


    $(function() {
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false

        })
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    });
    </script>
</body>



</html>