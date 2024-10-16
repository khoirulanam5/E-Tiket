<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- HEADER -->
  <title>PO Kalingga Jaya</title>
  <link rel="shortcut icon" type="image/icon" href="<?= base_url('/assets/furn/assets/logo/kalingga.png'); ?>"/>
  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('/assets/ionicons/ionicons.min.css'); ?>">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/jqvmap/jqvmap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/dist/css/adminlte.min.css'); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datepicker/datepicker3.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/toastr/toastr.min.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/summernote/summernote-bs4.min.css'); ?>"> -->
  <link rel="stylesheet" href="<?= base_url('/assets/css/loader.css'); ?>">
  <style>

    .tabel {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    .tabel td, .tabel th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    .tabel tr:nth-child(even){background-color: #f2f2f2;}

    .tabel tr:hover {background-color: #ddd;}

    .tabel th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #4CAF50;
      color: white;
    }
    .tabel thead th { 
      position: sticky; 
      top: 0; 
      z-index: 1;
      resize: horizontal;
      overflow: auto;
    }
    .tb_no_top>thead>tr>th{
        border: none;
        vertical-align: middle;
    }
    .tb_no_top>tbody>tr>td{
        border-top: none;
        vertical-align: middle;
    }
    .slimScrollBar{
      width: 10px!important;
      background: rgb(204, 204, 204)!important;
      border-radius: 0px!important;
    }
    .content-wrapper{
      font-size: 12px;
    }
    .skin-blue-light .treeview-menu>li.active>a {
      font-weight: 400;
    }
  </style>
  <style>
    .btn {
              /* Menggunakan background gradient dari atas ke bawah dan background-size */
              background-image: linear-gradient(180deg, black 50%, transparent 50%);
              background-size: 200% 200%;
              background-position: bottom;
              /* Transisi halus pada background-position */
              transition: background-position 0.3s;
          }
          /* Efek ketika hover */
          .btn:hover {
              /* Menggeser background untuk memunculkan warna dari bawah */
              background-position: top;
          }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="before-loader" id="LOADER" style="display: none;">
  <div class="loader5" ></div>
</div>
<!-- Navbar -->
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" id="menuHeader" style="display:none!important">
        <button class="btn btn-sm btn-default" id="btn_tambah"><i class="fas fa-plus"></i> Tambah</button>
        <button class="btn btn-sm btn-info" id="btn_edit"><i class="fas fa-edit"></i> Edit</button>
        <button class="btn btn-sm btn-danger" id="btn_delete"><i class="fas fa-trash"></i> Delete</button>
        <button class="btn btn-sm btn-primary" id="btn_save" disabled><i class="fas fa-save"></i> Save Changes</button>
        <button class="btn btn-sm btn-warning" id="btn_cancel" disabled><i class="fas fa-times-circle"></i> Cancel</button>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('/assets/adminlte/dist/img/kalingga.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PO. Kalingga Jaya</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('/assets/adminlte/dist/img/default.png'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= strtoupper($this->session->userdata('level')); ?></a>
        </div>
      </div>

      