<style>
.skin-blue .sidebar-menu>li:hover>a,
.skin-blue .sidebar-menu>li.active>a,
.skin-blue .sidebar-menu>li.menu-open>a {
    /* display: none; */
    padding: 10px;
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    transition: background-color 0.3s;
    background-color: #A4907C;
}

.skin-blue .sidebar-menu>li>.treeview-menu {
    margin: 0 1px;
    background: #A4907C;
}

.skin-blue .sidebar-menu .treeview-menu>li.active>a,
.skin-blue .sidebar-menu .treeview-menu>li>a:hover {
    /* display: none; */
    padding: 10px;
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    transition: background-color 0.3s;
    background-color: #fff;
}

.skin-blue .main-header .navbar .sidebar-toggle:hover {
    background-color: #e9decb;
}
</style>
<header class="main-header" style="background-color: #A4907C;">
    <!-- Logo -->
    <a href="<?php echo base_url('admin')?>" class="logo" style="background-color: #A4907C;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?php echo base_url("assets/images/andini-salon.jpg.png"); ?>" alt=""
                style="width: 40px; height: 40px;"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Andini Salon</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #A4907C;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php foreach($avatar as $a){ ?>
                        <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="user-image"
                            alt="User Image">
                        <?php } ?>
                        <span class="hidden-xs"><?=$this->session->userdata('name')?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="background-color: #e9decb;">
                            <?php foreach($avatar as $a){ ?>
                            <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle"
                                alt="User Image">
                            <?php } ?>
                            <p style="color: #000">
                                <?=$this->session->userdata('name')?>
                                <small>Last Login : <?=$this->session->userdata('last_login')?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= base_url('admin/profile')?>" class="btn btn-default btn-flat"><i
                                        class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('admin/sigout')?>" class="btn btn-default btn-flat"><i
                                        class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
<aside class="main-sidebar" style="background-color: #e9decb;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php foreach($avatar as $a){ ?>
                <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle"
                    alt="User Image">
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p style="color: #000; font-weight: bold"><?=$this->session->userdata('name')?></p>
                <a href="#" style="color: #000; font-weight: bold"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li>
                <a href="<?= base_url('admin')?>" style="color: #000; font-weight: bold">
                    <i class="fa fa-dashboard" style="color: #000; font-weight: bold"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <!-- <i class="fa fa-angle-left pull-right"></i> -->
                    </span>
                </a>
                <!-- <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>assets/web_admin/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo base_url('admin')?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> -->
            </li>

            <li class="treeview">
                <a href="#" style="color: #000; font-weight: bold">
                    <i class="fa fa-edit" style="color: #000; font-weight: bold"></i> <span>Forms</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('admin/form_barangmasuk')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i>
                            Tambah
                            Pembelian Barang</a></li>
                    <li><a href="<?= base_url('admin/form_satuan')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i>
                            Tambah
                            Satuan Barang</a></li>
                    <li><a href="<?= base_url('admin/form_kategori')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i>
                            Tambah
                            Kategori</a></li>
                    <li><a href="<?= base_url('admin/form_supplier')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i>
                            Tambah
                            Supplier</a></li>

                </ul>
            </li>
            <!-- <li class="treeview active">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a> -->
            <li class="treeview">
                <a href="#" style="color: #000; font-weight: bold">
                    <i class="fa fa-table" style="color: #000; font-weight: bold"></i> <span>Tables</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('admin/tabel_supplier')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i> Tabel
                            Supplier</a></li>
                    <li><a href="<?= base_url('admin/tabel_barang')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i> Tabel
                            Barang</a></li>
                    <li class=""><a href="<?= base_url('admin/tabel_barangmasuk')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i>
                            Tabel Pembelian Barang</a></li>
                    <li><a href="<?= base_url('admin/tabel_barangkeluar')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i>
                            Tabel Penggunaan Barang</a></li>
                    <li><a href="<?= base_url('admin/tabel_kategori')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i> Tabel
                            Kategori</a></li>
                    <li><a href="<?= base_url('admin/tabel_satuan')?>"
                            style="font-size: 13px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i> Tabel
                            Satuan</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#" style="color: #000; font-weight: bold">
                    <i class="fa fa-file" style="color: #000; font-weight: bold"></i> <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('admin/tabel_invoicePenggunaanBarang')?>"
                            style="font-size: 12px; color: #000; font-weight: bold"><i class="fa fa-circle-o"></i>
                            Invoice
                            Penggunaan
                            Barang</a></li>

                </ul>
            </li>

            <li>
                <a href="<?php echo base_url('admin/profile')?>" style="color: #000; font-weight: bold">
                    <i class="fa fa-cogs" aria-hidden="true"></i> <span>Profile</span></a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/users')?>" style="color: #000; font-weight: bold">
                    <i class="fa fa-fw fa-users" aria-hidden="true"></i> <span>Users</span></a>
            </li>
        </ul>
    </section>
    <!--
 /.sideb

ar -->




</aside>