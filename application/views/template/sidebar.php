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
  </head>
<!-- Sidebar Menu -->
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url("home")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="HOME" OR $this->uri->segment(1)==""){echo 'active';}?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <!-- HAK AKSES UNTUK SEKERTARIS -->
          <?php if($this->session->userdata('level') == "SEKERTARIS"){ ?>
            
            <li class="nav-item">
              <a href="#" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="DATA" OR $this->uri->segment(1)==""){echo 'active';}?>">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Data Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url("jadwal_tiket/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="JADWAL_TIKET"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Tiket Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("sewabus/ketersediaan_bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KETERSEDIAAN_BUS"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Penyewaan Bus</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url("kategori_bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KATEGORI_BUS"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori Bus</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url("jenis_bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="JENIS_BUS"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Jenis Bus</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url("sewabus/jenis_bus_sewa/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="JENIS_BUS_SEWA"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Jenis Bus Sewa</p>
              </a>
            </li>
                <li class="nav-item">
                  <a href="<?= base_url("bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="BUS"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("user/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="USER"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("sopir/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="SOPIR"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Sopir</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url("pelanggan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PELANGGAN"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Pelanggan</p>
              </a>
            </li>
              <li class="nav-item">
                <a href="<?= base_url("sewabus/bus_sewa/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="BUS_SEWA"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ketersediaan Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("parameter_kepuasan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PARAMETER_KEPUASAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parameter Kepuasan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("kategori_nilai/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KATEGORI_NILAI"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parameter Penilaian</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url("kepuasan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KEPUASAN" OR $this->uri->segment(1)==""){echo 'active';}?>">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Kepuasan Pelanggan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url("login/logout")?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
          <!-- END SEKERTARIS -->

          <!-- HAK AKSES UNTUK ADMIN -->
          <?php }elseif($this->session->userdata('level') == "ADMIN"){ ?>
            
            <li class="nav-item">
                <a href="<?= base_url("pelanggan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1)) == "PELANGGAN"){echo 'active';}?>">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Data Pelanggan</p>
                </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Data Transaksi
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url("penjualan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PENJUALAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Tiket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("pembayaran/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMBAYARAN"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembayaran Tiket</p>
              </a>
            </li>
                <li class="nav-item">
                  <a href="<?= base_url("sewabus/penjualan_sewa/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="SEWA"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penyewaan Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("sewabus/pembayaran_sewa/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMBAYARAN_SEWA"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Pembayaran Sewa</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>
              Cek Tiket
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url("jadwal_tiket/cektiket")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1)) == "TIKET_BUS"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Tiket Bus</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url("sewabus/ketersediaan_bus/cektiket")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1)) == "SEWA_BUS"){echo 'active';}?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Sewa Bus</p>
              </a>
            </li>
          </ul>
        </li>

          <li class="nav-item">
            <a href="<?= base_url("login/logout")?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
          <!-- END ADMIN -->

          <!-- HAK AKSES UNTUK BENDAHARA -->
          <?php }elseif($this->session->userdata('level') == "BENDAHARA"){ ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?= base_url("penjualan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PENJUALAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Tiket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("pembayaran/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMBAYARAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembayaran Tiket</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?= base_url("sewabus/penjualan_sewa/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="SEWA"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penyewaan Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("sewabus/pembayaran_sewa/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMBAYARAN_SEWA"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembayaran Sewa</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url("report/pemesanan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMESANAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Penjualan Tiket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("sewabus/report_sewa/pemesanan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PENYEWAAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Penyewaan Bus</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url("login/logout")?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
          <!-- END BENDAHARA -->

          <!-- HAL AKSES UNTUK DIREKTUR -->
          <?php }else{ ?>

            <li class="nav-item">
                <a href="<?= base_url("user/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="USER"){echo 'active';}?>">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Data User</p>
                </a>
              </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url("report/pelanggan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PELANGGAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("report/pemesanan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMESANAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Penjualan Tiket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("sewabus/report_sewa/pemesanan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PENYEWAAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Penyewaan Bus</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?= base_url("report/kepuasan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KEPUASAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kepuasan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("report/kepuasanPeriod")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KEPUASAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kepuasan Pelanggan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url("login/logout")?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
          <!-- END DIREKTUR -->
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>