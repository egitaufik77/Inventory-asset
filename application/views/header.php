<?php
// safety defaults agar tidak error ketika $curr / $menu / $submenu belum diset
if (!isset($curr) || !is_array($curr)) $curr = ['name' => 'Administrator'];
if (!isset($menu)) $menu = 0;
if (!isset($submenu)) $submenu = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?= base_url() ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title . " - " : "" ?><?= get_setting("webname") ?> Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <?= cms_register("header") ?>

    <!-- small style improvements untuk form/card yang akan pakai di user add/edit -->
    <style>
    /* Header / Navbar tweak */
    .navbar-brand { font-weight: 700; font-size: 18px; }
    .top-user { color: #fff; padding-right: 12px; }

    /* Card form style (dipakai di user_add & user_edit) */
    .card-form {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
      padding: 22px;
      max-width: 640px;
      margin: 0 auto 30px;
    }
    .card-form h4 { text-align:center; margin-bottom:18px; font-weight:600; color:#2c3e50; }

    /* tombol primary konsisten */
    .btn-primary, .btn-submit {
      background: #3085d6; border-color: #3078c6;
    }

    .side-nav li.active > a {
  background-color: #337ab7 !important;
  color: #fff !important;
}
.side-nav li.active > a:hover {
  background-color: #286090 !important;
}


    /* Fancybox content */
    .fancybox-content {
      background: #fff;
      border-radius: 8px;
      padding: 15px;
    }

    /* tabel data adjustments (agar rapih) */
    table.data { width:100% !important; table-layout:auto; }
    table.data th, table.data td { padding:8px 10px; vertical-align:middle; }
    table.data th { background:#f9f9f9; font-weight:600; }

    /* responsive small fix */
    @media (max-width: 768px) {
      .card-form { padding:16px; }
      .navbar-brand { font-size:16px; }
    }
    </style>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
</head>
<body>
<div id="wrapper">

  <!-- Top navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= base_url("backend") ?>"><?= get_setting("webname") ?></a>
    </div>

    <ul class="nav navbar-right top-nav">
      <li class="top-user"><i class="fa fa-user"></i> <?= htmlspecialchars($curr['name']) ?></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down"></i></a>
        <ul class="dropdown-menu">
          <li><a href="home/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>

    <!-- Sidebar -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
  <!-- Data Master -->
  <li class="<?= ($menu == 2 ? 'active' : '') ?>">
    <a href="javascript:;" data-toggle="collapse" data-target="#master"
       aria-expanded="<?= ($menu == 2 ? 'true' : 'false') ?>">
       <i class="fa fa-fw fa-file-text-o"></i> Data Master <i class="fa fa-fw fa-caret-down"></i>
    </a>
    <ul id="master" class="collapse<?= ($menu == 2 ? ' in' : '') ?>">
      <li class="<?= ($submenu == 21 ? 'active' : '') ?>"><a href="master/cc">Inventory</a></li>
      <li class="<?= ($submenu == 22 ? 'active' : '') ?>"><a href="master/divisi">Divisi</a></li>
    </ul>
  </li>

  <!-- Menu lainnya -->
  <li class="<?= ($menu == 3 ? 'active' : '') ?>"><a href="mutasi/penerimaan"><i class="fa fa-fw fa-bars"></i> Rekap Stok Consumable IT</a></li>
  <li class="<?= ($menu == 4 ? 'active' : '') ?>"><a href="mutasi/pengiriman"><i class="fa fa-fw fa-picture-o"></i> Rekap Penggunaan per Divisi</a></li>
  <li class="<?= ($menu == 5 ? 'active' : '') ?>"><a href="user"><i class="fa fa-user"></i> User Management</a></li>
  <li class="<?= ($menu == 6 ? 'active' : '') ?>"><a href="laporan"><i class="fa fa-fw fa-bookmark"></i> Laporan</a></li>
  <li class="<?= ($menu == 7 ? 'active' : '') ?>"><a href="history"><i class="fa fa-fw fa-cog"></i> History</a></li>
</ul>

    </div>
  </nav>

  <div id="page-wrapper">
    <div class="container-fluid">

      <!-- Page header (title) -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"><?= isset($title) ? $title : '' ?></h1>
          <div class="divider"></div>
        </div>
      </div>
