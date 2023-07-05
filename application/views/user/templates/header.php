<!DOCTYPE html>
<html>

<head>
    <title>Andini Salon</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/simple-sidebar/css/simple-sidebar.css">
    <link rel="stylesheet"
        href="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/assets/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?= base_url()?>/assets/simple-sidebar/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <script
        src="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    <style>
    .bg-dark {
        background-color: #343a40 !important;
    }

    .nav-link {
        color: rgba(255, 255, 255, .5);
    }

    .display-3 {
        font-size: 4.5rem;
        font-weight: 300;
        line-height: 1.1;
    }

    .lead {
        font-size: 1.25rem;
        font-weight: 300;
    }

    .text-center {
        text-align: center !important;
    }

    .jumbotron {
        margin-bottom: 2rem;
        background-color: #e9ecef;
        border-radius: .3rem;
    }

    .mr-auto {
        margin-right: auto !important;
    }

    .navbar-brand {
        color: #fff;
        font-family: 'Playfair Display', serif;
        margin-left: 10px;
        font-size: 14px;
    }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top bg-dark">
        <div class="container">

            <ul class="nav navbar-nav mr-auto">
                <a href="<?= base_url('user')?>"> <span class="logo-mini"><img
                            src="<?php echo base_url("assets/images/Magic-remove.png"); ?>" alt=""
                            style="width: 140%; height: 70px; padding: 5px"></span></a>
            </ul>
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= base_url('user')?>"
                    style=" color: #fff;font-family: 'Playfair Display', serif;margin-left: 10px;font-size: 14px;">True
                    beauty is <br> being true to yourself</a>
            </div>
            <ul class="nav navbar-nav navbar-right" style="padding: 10px">

                <li><a class="nav-link" style="color: #fff">Last Login : <?=$this->session->userdata('last_login')?></a>
                </li>
                <li><a class="nav-link" href="<?= base_url('user/setting') ?>" style="color: #fff"><i class="fa fa-user"
                            aria-hidden="true"></i> Setting</a></li>
                <li><a class="nav-link" href="<?= base_url('user/signout')?>" style="color: #fff"><i
                            class="fa fa-sign-out" aria-hidden="true"></i> Sign Out</a></li>
            </ul>


        </div>
    </nav>