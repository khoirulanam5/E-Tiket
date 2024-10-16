<!DOCTYPE html>
<html lang="en">
  <!-- HEAD -->
  <head>
    <title>PO. Kalingga Jaya</title>
    <link rel="shortcut icon" type="image/icon" href="<?= base_url('/assets/furn/assets/logo/kalingga.png'); ?>"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/open-iconic-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/aos.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/jquery.timepicker.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/icomoon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/front/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/toastr/toastr.min.css'); ?>">
  </head>
  <body>
  <!-- ENDHEAD -->
    
    <!-- NAVBAR -->
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="./">PO.<span> Kalingga Jaya</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
                <!-- Menu item for Home or Pesan Tiket -->
                <li class="nav-item <?= ($this->uri->segment(1) == 'front' && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'pesan_tiket')) ? 'active' : '' ?>">
                    <a href="<?= base_url("front/") ?>" class="nav-link">
                        <?= $this->session->userdata('id_user') ? 'Pesan Tiket' : 'Cek Jadwal Tiket' ?>
                    </a>
                </li>
                <!-- Menu item for Ketersediaan Bus, hanya tampil jika belum login -->
                <?php if(!$this->session->userdata('id_user')) { ?>
                    <li class="nav-item <?= ($this->uri->segment(2) == 'ketersediaan_bus') ? 'active' : '' ?>">
                        <a href="<?= base_url("front/ketersediaan_bus") ?>" class="nav-link">Cek Ketersediaan Bus</a>
                    </li>
                <?php } ?>
                <!-- Menu item for Sewa Bus -->
                <?php if($this->session->userdata('id_user')) { ?>
                    <li class="nav-item <?= ($this->uri->segment(2) == 'front') ? 'active' : '' ?>">
                        <a href="<?= base_url("sewabus/front") ?>" class="nav-link">Sewa Bus</a>
                    </li>
                <?php } ?>
                <!-- Menu item for Gallery -->
                <li class="nav-item <?= ($this->uri->segment(2) == 'gallery') ? 'active' : '' ?>">
                    <a href="<?= base_url("front/gallery") ?>" class="nav-link">Gallery</a>
                </li>
                <!-- Menu item for Feedback -->
                <li class="nav-item <?= ($this->uri->segment(2) == 'feedback') ? 'active' : '' ?>">
                    <a href="<?= base_url("front/feedback") ?>" class="nav-link">Feedback</a>
                </li>
            </ul>
            <!-- Login/Logout Button -->
            <?php
            if(!$this->session->userdata('id_user')){
            ?>
                <a class="btn btn-info" style="margin-left: 10px;" href="<?= base_url("front/login")?>"><i class="fas fa-user"></i> Masuk</a>
            <?php
            } else {
            ?>
                <a class="btn btn-info" style="margin-left: 10px;" href="<?= base_url("login/logout")?>"><i class="fas fa-user"></i> Keluar</a>
            <?php
            }
            ?>
        </div>
	    </div>
	  </nav>
<!-- END nav -->

    