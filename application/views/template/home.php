<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Google Font: Roboto -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
    .content-wrapper h3 {
      font-weight: 700;
    }
    .content-wrapper p {
      font-weight: 400;
    }
  </style>
<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="margin-top: 1rem">
            
            <!-- /.card-header -->
            <div class="card-body text-center">
              <?php 
                // Menentukan pesan berdasarkan level user
                $level = $this->session->userdata('level');
                $welcome_message = '';
                switch($level) {
                  case 'ADMIN':
                    $welcome_message = 'Selamat datang Admin, semoga harimu menyenangkan.<p>Anda dapat melakukan pekerjaan anda sesuai dengan jabatan anda</p>';
                    break;
                  case 'SEKERTARIS':
                    $welcome_message = 'Selamat datang Sekertaris, semoga harimu menyenangkan.<p>Anda dapat melakukan pekerjaan anda sesuai dengan jabatan anda</p>';
                    break;
                  case 'BENDAHARA':
                    $welcome_message = 'Selamat datang Bendahara, semoga harimu menyenangkan.<p>Anda dapat melakukan pekerjaan anda sesuai dengan jabatan anda</p>';
                    break;
                  case 'DIREKTUR':
                    $welcome_message = 'Selamat datang Direktur, semoga harimu menyenangkan.<p>Anda dapat melakukan pekerjaan anda sesuai dengan jabatan anda</p>';
                    break;
                  case 'PELANGGAN':
                    $welcome_message = 'Selamat datang Pelanggan, semoga harimu menyenangkan.<p>Anda dapat melakukan pekerjaan anda sesuai dengan jabatan anda</p>';
                    break;
                  default:
                    $welcome_message = 'Selamat datang pada Sistem Penjualan Tiket Bus dan Penilaian Kepuasan Pelanggan';
                }
              ?>
              <h3><?= $welcome_message ?></h3>
              <img src="<?= base_url('/assets/furn/assets/logo/home.png'); ?>" alt="Bus Image" class="img-fluid mt-1" style="width: 550px; height: auto;">
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </section>
</div>

<!-- jQuery -->
<script src="<?= base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('/assets/adminlte/plugins/select2/js/select2.full.min.js'); ?>"></script>
