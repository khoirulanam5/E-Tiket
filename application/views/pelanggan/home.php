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
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.css'); ?>">
<div class="hero-wrap" style="background-image: url('<?= base_url('/assets/front/images/') ?>kalingga_bus.jpg ');" data-stellar-background-ratio="0.5">
<div class="overlay"></div>

    <!-- cek jadwal keberangkatan -->
    <div class="container">
      <div class="row no-gutters  justify-content-start align-items-center" style="padding-top: 100px;">
        <div class="col-lg-12 col-md-12">
          <div class="row">
            <div class="col-md-3" style="background-color: #0C2F91;padding: 20px;">
              <div class="d-flex flex-md-column list-group" id="list-tab" role="tablist">
                <a class="list-group-item active" id="list-ticket-list" data-toggle="list" href="#list-ticket" role="tab" aria-controls="ticket" aria-selected="false">
                  <i class="fas fa-ticket-alt"></i>
                  <span style="font-size:14px;">Jadwal Keberangkatan</span>
                </a>
              </div>
            </div>
            <div class="col-md-9" style="background-color: #fff;padding: 20px;">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade bordered show active" id="list-ticket" role="tabpanel" aria-labelledby="list-ticket-list">
                  <form >
                    <div class="d-md-flex mt-2">
                      <div class="form-group col-12 col-md-4">
                        <label for="" class="label">Jenis Tiket</label>
                        <select name="jenis_tiket" class="form-control">
                          <option></option>
                          <option value="ANTAR KOTA">ANTAR KOTA</option>
                          <option value="WISATA">WISATA</option>
                        </select>
                      </div>
                      <div class="form-group col-12 col-md-4">
                        <label for="" class="label">Tanggal keberangkatan</label>
                        <input type="text" class="form-control date" name="tgl_keberangkatan" onChange="ISI_TUJUAN()" placeholder="Tanggal keberangkatan">
                      </div>
                      <div class="form-group col-12 col-md-4">
                        <label for="" class="label">Tujuan</label>
                        <select class="form-control select2" name="tujuan" ></select>
                      </div>
                    </div>
                    <div class="d-md-flex">
                      <div class="form-group col-12 col-md-12" style="text-align: right;">
                        <button type="button" id="btnCekAntarKota" class="btn btn-info py-3 px-4"><i class="fas fa-search"></i> Cek Jadwal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- info jadwal -->
  <section class="ftco-section ftco-cart" id="colData" style="display:none;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 ftco-animate">
          <div class="car-list">
            <table class="table">
              <thead class="thead-primary">
                <tr class="text-center">
                  <th>&nbsp;</th>
                  <th class="bg-primary heading">Lokasi kumpul</th>
                  <th class="bg-primary heading">Keberangkatan</th>
                  <th class="bg-dark heading">Harga Tiket</th>
                  <th class="bg-black heading">Maksimal<br>Penumpang</th>
                </tr>
              </thead>
              <tbody id="tbData">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
  <section class="ftco-section services-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">Layanan</span>
          <h2 class="mb-2">Layanan Kami</h2>
        </div>
      </div>
      <div class="row d-flex">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-customer-support"></span></div>
                <h3 class="heading mb-0 pl-3">Layanan 24/7</h3>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-route"></span></div>
                <h3 class="heading mb-0 pl-3">Banyak Tujuan</h3>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-online-booking"></span></div>
                <h3 class="heading mb-0 pl-3">Reservasi Tiket</h3>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-rent"></span></div>
                <h3 class="heading mb-0 pl-3">Sewa Bus</h3>
              </div>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container-fluid px-4">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">Fasilitas</span>
          <h2 class="mb-2">Fasilitas Kami</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="car-wrap ftco-animate" style="padding: 30px;">
            <div class="img d-flex align-items-end" style="background-image: url(<?= base_url('/assets/front/images/') ?>ac.png);">
            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0">Pendingin Ruangan</h2>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="car-wrap ftco-animate" style="padding: 30px;">
            <div class="img d-flex align-items-end" style="background-image: url(<?= base_url('/assets/front/images/') ?>24jam.png);">
            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0">Layanan 24 jam</h2>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="car-wrap ftco-animate" style="padding: 30px;">
            <div class="img d-flex align-items-end" style="background-image: url(<?= base_url('/assets/front/images/') ?>lcd.png);">
            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0">LCD TV</h2>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="car-wrap ftco-animate" style="padding: 30px;">
            <div class="img d-flex align-items-end" style="background-image: url(<?= base_url('/assets/front/images/') ?>kursi.png);">
            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0">Tempat Duduk Nyaman</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section services-section img" style="background-image: url(<?= base_url('/assets/front/images/') ?>kalingga_bus.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          <span class="subheading">Pemesanan</span>
          <h2 class="mb-3">Alur Pemesanan</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
              <h3>Pilih Tanggal Keberangkatan</h3>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-select"></span></div>
              <h3>Pilih Kota Tujuan</h3>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
              <h3>Pilih jenis Bus</h3>
            </div>
          </div>      
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-review"></span></div>
              <h3>Masukan Jumlah Penumpang</h3>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(<?= base_url('/assets/front/images/') ?>kalingga1.jpg);">
        </div>
        <div class="col-md-6 wrap-about py-md-5 ftco-animate">
          <div class="heading-section mb-5 pl-md-5">
            <span class="subheading">Tentang kami</span>
            <h2 class="mb-4">Banyak pilihan Bus Ternyaman</h2>
            <p>Rencana healing? Anda wajib mencoba layanan bus AKAP Kalingga Jaya.</p>
            <p>PO. Kalingga Jaya adalah perusahaan otobus Bermarkas di Kota Jepara, Jawa Tengah, bus Kalingga Jaya tentunya menjadi kebangaan dan solusi transportasi warga Jawa Tengah yang ingin pergi healing.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
<footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Kontak Kami?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Desa Daren, Kec. Nalumsari, Kab. Jepara, Jawa Tengah</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+XXXXXXXX</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">kalingga@jaya.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <p>
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | PO. Kalingga Jaya <i aria-hidden="true"></i>
            </p>
          </div>
        </div>
      </div>
    </footer>
<!-- endfooter -->
<script src="<?= base_url('/assets/front/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.js'); ?>"></script>
<!-- endfooter -->

<!-- proses logika -->
<script>
  $(".date").flatpickr({
      dateFormat: "Y-m-d",
  });
  $(document).ready(function (){
      $("#btnCekAntarKota").click(function (){
          $('html, body').animate({
              scrollTop: $("#colData").offset().top
          }, 1500);
          ISI_TABLE()
          $("#colData").css("display","")
      });
  });

  function ISI_TUJUAN(){
    $.ajax({
      url: "<?= site_url('penjualan/getTujuanBusAntarKota') ?>",
      type: "POST",
      data: {
        tgl_berangkat: $("[name='tgl_keberangkatan']").val(),
        jenis_tiket: $("[name='jenis_tiket']").val(),
      },
      dataType: "JSON",
      success: function(data){
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.tujuan+"'>"+val.tujuan+"</option>"
        });
        $("[name='tujuan']").html(row)
      }
    })
  }

  function ISI_TABLE(){
    $.ajax({
      url: "<?= site_url('/front/getJadwal') ?>",
      type: "POST",
      dataType: "HTML",
      data:{
        tgl_berangkat: $("[name='tgl_keberangkatan']").val(),
        tujuan: $("[name='tujuan']").val(),
        jenis_tiket: $("[name='jenis_tiket']").val(),
      },
      success: function(data){
        $("#tbData").html(data)
      }
    })
  }
</script>