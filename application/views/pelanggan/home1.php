<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/css/kursi.css'); ?>">
<div class="hero-wrap" style="background-image: url('<?= base_url('/assets/front/images/') ?>kalingga_bus.jpg ');" data-stellar-background-ratio="0.5">
<div class="overlay"></div>
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
<!-- sidebar -->
<div class="container">
  <div class="row no-gutters  justify-content-start align-items-center" style="padding-top: 100px;">
    <div class="col-lg-12 col-md-12">
      <div class="row">
        <div class="col-md-3" style="background-color: #0C2F91;padding: 20px;">
          <div class="d-flex flex-md-column list-group" id="list-tab" role="tablist">
            <a class="list-group-item active" id="list-ticket-list" data-toggle="list" href="#list-ticket" role="tab" aria-controls="ticket" aria-selected="false">
              <i class="fas fa-ticket-alt"></i>
              <span style="font-size:14px;"> Pesan Tiket</span>
            </a>
            <a class="list-group-item list-group-item-action" id="bayar" href="<?= base_url('front/history')?>" role="tab" aria-controls="bayar">
              <i class="fas fa-receipt"></i>
              <span style="font-size:14px;"> Pembayaran Tiket</span>
            </a>
          </div>
        </div>
        <!-- endsidebar -->

        <!-- reservasi tiket -->
        <div class="col-md-9" style="background-color: #fff;padding: 20px;">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade bordered show active" id="list-ticket" role="tabpanel" aria-labelledby="list-ticket-list">
              <form id="FRM_ORDER">
                <?php
                  $nm_pelanggan = $this->db->query("SELECT nm_pelanggan FROM `tb_pelanggan` 
                  WHERE id_user = '".$this->session->userdata('id_user')."'")->row()->nm_pelanggan;
                  $no_pelanggan = $this->db->query("SELECT no_pelanggan FROM `tb_pelanggan` 
                  WHERE id_user = '".$this->session->userdata('id_user')."'")->row()->no_pelanggan;
                ?>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">Jenis Tiket</label>
                    <select name="jenis_tiket" class="form-control">
                      <option value="ANTAR KOTA">ANTAR KOTA</option>
                      <option value="WISATA">WISATA</option>
                    </select>
                  </div>
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">Nama Pelanggan</label>
                    <input type="text" class="form-control" name="nm_pelanggan" value="<?= $nm_pelanggan ?>" >
                  </div>
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">No. Telphone</label>
                    <input type="text" class="form-control" name="no_pelanggan" value="<?= $no_pelanggan ?>">
                  </div>
                </div>
                <div class="d-md-flex mt-2">
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">Tanggal keberangkatan</label>
                    <input type="text" name="tgl_keberangkatan" 
                      onChange="ISI_TUJUAN()" class="form-control date" placeholder="Tanggal keberangkatan">
                  </div>
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">Kota Keberangkatan</label>
                    <select class="form-control" name="kota_keberangkatan"></select>
                  </div>
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">Tujuan</label>
                    <select class="form-control select2" name="tujuan" onChange="ISI_JENISBUS()"></select>
                  </div>
                </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">Jenis Bus</label>
                    <select class="form-control" name="id_jenis_bus" onChange="ISI_BUS()"></select>
                  </div>
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">No. Pol & Jam Keberangkatan</label>
                    <select class="form-control" name="id_tiket_bus" onChange="ISI_HARGA()"></select>
                  </div>
                  <div class="form-group col-12 col-md-4">
                    <label for="" class="label">Jumlah Tiket</label>
                    <input type="text" class="form-control" name="jumlah_pembelian" placeholder="Jumlah Tiket">
                  </div>
                </div>
              <div class="d-md-flex">
                <div class="form-group col-12 col-md-12">
                <label for="" class="label">Pilih No. Kursi</label>
                <div id="kursi-container" class="checkbox-container kursi-grid"></div>
            </div>
              </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Maksimal Kursi</label>
                    <input type="text" class="form-control" name="max_kursi" readonly placeholder="Maksimal Kursi">
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Jumlah Kursi Kosong</label>
                    <input type="text" class="form-control" name="kursi_kosong" readonly placeholder="Jumlah Kursi Kosong">
                  </div>
                </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Harga Tiket</label>
                    <input type="text" class="form-control" name="harga_tiket" readonly placeholder="Harga Tiket">
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Total Pembayaran</label>
                    <input type="text" class="form-control" name="nominal" readonly placeholder="Total Pembayaran">
                  </div>
                </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-12" style="text-align: right;">
                    <button type="button" id="btnOrder" class="btn btn-info py-3 px-4"><i class="fas fa-search"></i> Order Tiket</button>
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
<script src="<?= base_url('/assets/front/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.js'); ?>"></script>
<!-- endfooter -->

<!-- proses logika -->
<script>
var timer = null
  timer = setInterval(function() {
    zenziva_api()
  }, 5000);

  function zenziva_api(){
    $.ajax({
      url: "<?= site_url('front/zenziva_api') ?>",
      type: "POST",
      dataType: "JSON",
      success: function(data){
        console.log(data)
        if(data.status == "selesai"){
          clearInterval(timer);
          timer = null
        }
      }
    })
  }

  $(".date").flatpickr({
      dateFormat: "Y-m-d",
  });

  function ISI_TUJUAN(){
    $.ajax({
      url: "<?= site_url('penjualan/getTujuanBusAntarKota') ?>",
      type: "POST",
      data: {
        tgl_berangkat: $("[name='tgl_keberangkatan']").val(),
        jenis_tiket: $("[name='jenis_tiket']").val()
      },
      dataType: "JSON",
      success: function(data){
        console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.tujuan+"'>"+val.tujuan+"</option>"
          
        });
        $("[name='tujuan']").html(row)
      }
    })

    $.ajax({
      url: "<?= site_url('penjualan/getKotaBerangkat') ?>",
      type: "POST",
      data: {
        tgl_berangkat: $("[name='tgl_keberangkatan']").val(),
        jenis_tiket: $("[name='jenis_tiket']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var rows = "<option></option>"
        $.map( data['data'], function( val, i ) {
          rows += "<option value='"+val.kota_keberangkatan+"'>"+val.kota_keberangkatan+"</option>"
          
        });
        $("[name='kota_keberangkatan']").html(rows)
      }
    })
    
  }

  function ISI_JENISBUS(){
    $.ajax({
      url: "<?= site_url('penjualan/getJenisBus') ?>",
      type: "POST",
      data: {
        tujuan: $("[name='tujuan']").val(),
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_jenis_bus+"'>"+val.nm_jenis_bus+"</option>"
          
        });
        $("[name='id_jenis_bus']").html(row)
      }
    })
  }

  function ISI_BUS(){
    $.ajax({
      url: "<?= site_url('penjualan/getBus') ?>",
      type: "POST",
      data: {
        tujuan: $("[name='tujuan']").val(),
        id_jenis_bus: $("[name='id_jenis_bus']").val(),
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_tiket_bus+"'>"+val.no_pol+" - "+val.waktu_berangkat+"</option>"
          
        });
        $("[name='id_tiket_bus']").html(row)
      }
    })
  }

  function ISI_HARGA() {
    $.ajax({
        url: "<?= site_url('penjualan/getHarga') ?>",
        type: "POST",
        data: {
            id_tiket_bus: $("[name='id_tiket_bus']").val()
        },
        dataType: "JSON",
        success: function(data) {
            if (data['data'][0]['kursi_kosong'] === undefined || parseInt(data['data'][0]['kursi_kosong']) === 0) {
                alert('Tidak ada kursi kosong');
                location.reload();
            } else {
                $("[name='harga_tiket']").val(data['data'][0]['harga']);
                $("[name='max_kursi']").val(data['data'][0]['jumlah_max']);
                $("[name='kursi_kosong']").val(data['data'][0]['kursi_kosong']);

                let kursiContainer = $("#kursi-container");
                kursiContainer.empty();

                let kursiList = data['data'][0]['kursi_kosong_list'];
                let kursiTerisi = data['data'][0]['kursi_terisi'] || [];
                let is50Seats = kursiList.length > 35;
                let is22Seats = kursiList.length <= 22 && kursiList.length > 15;
                let is15Seats = kursiList.length <= 15;

                // Menambahkan kelas kapasitas pada grid
                kursiContainer.removeClass('kapasitas-50 kapasitas-35 kapasitas-22 kapasitas-15');
                if (is50Seats) {
                    kursiContainer.addClass('kapasitas-50');
                } else if (is22Seats) {
                    kursiContainer.addClass('kapasitas-22');
                } else if (is15Seats) {
                    kursiContainer.addClass('kapasitas-15');
                } else {
                    kursiContainer.addClass('kapasitas-35');
                }

                // Menambahkan kursi
                if (is22Seats) {
                    let kursiDepan = kursiList.slice(0, 20);
                    let kursiBelakang = kursiList.slice(20);

                    // Menambahkan kursi depan dengan spasi setiap 2 kolom
                    kursiDepan.forEach(function(kursi, index) {
                        kursiContainer.append('<div class="kursi-item' + ((index + 1) % 3 == 0 ? ' margin-right' : '') + '">' +
                            '<input class="form-check-input" type="checkbox" name="no_kursi[]" value="' + kursi + '" id="kursi_' + kursi + '"' + (kursiTerisi.includes(kursi.toString()) ? ' checked disabled' : '') + '>' +
                            '<label class="form-check-label" for="kursi_' + kursi + '">' + kursi + '</label>' +
                            '</div>');
                    });

                    // Menambahkan kursi baris terakhir
                    if (kursiBelakang.length > 0) {
                        let barisTerakhir = $('<div class="baris-terakhir"></div>');
                        kursiBelakang.forEach(function(kursi) {
                            barisTerakhir.append('<div class="kursi-item baris-terakhir-kursi">' +
                                '<input class="form-check-input" type="checkbox" name="no_kursi[]" value="' + kursi + '" id="kursi_' + kursi + '"' + (kursiTerisi.includes(kursi.toString()) ? ' checked disabled' : '') + '>' +
                                '<label class="form-check-label" for="kursi_' + kursi + '">' + kursi + '</label>' +
                                '</div>');
                        });
                        kursiContainer.append(barisTerakhir);
                    }
                } else if (is15Seats) {
                    let kursiDepan = kursiList.slice(0, 3);
                    let kursiBelakang = kursiList.slice(3);

                    // Menambahkan kursi depan
                    kursiDepan.forEach(function(kursi) {
                        kursiContainer.append('<div class="kursi-item baris-depan">' +
                            '<input class="form-check-input" type="checkbox" name="no_kursi[]" value="' + kursi + '" id="kursi_' + kursi + '"' + (kursiTerisi.includes(kursi.toString()) ? ' checked disabled' : '') + '>' +
                            '<label class="form-check-label" for="kursi_' + kursi + '">' + kursi + '</label>' +
                            '</div>');
                    });

                    // Menambahkan kursi baris selanjutnya
                    if (kursiBelakang.length > 0) {
                        kursiBelakang.forEach(function(kursi) {
                            kursiContainer.append('<div class="kursi-item baris-selanjutnya">' +
                                '<input class="form-check-input" type="checkbox" name="no_kursi[]" value="' + kursi + '" id="kursi_' + kursi + '"' + (kursiTerisi.includes(kursi.toString()) ? ' checked disabled' : '') + '>' +
                                '<label class="form-check-label" for="kursi_' + kursi + '">' + kursi + '</label>' +
                                '</div>');
                        });
                    }
                } else {
                    let kursiDepan = kursiList.slice(0, is50Seats ? 44 : 30);
                    let kursiBelakang = kursiList.slice(is50Seats ? 44 : 30);

                    // Menambahkan kursi depan
                    kursiDepan.forEach(function(kursi, index) {
                        kursiContainer.append('<div class="kursi-item' + (index >= 44 ? ' baris-terakhir-kursi' : '') + '">' +
                            '<input class="form-check-input" type="checkbox" name="no_kursi[]" value="' + kursi + '" id="kursi_' + kursi + '"' + (kursiTerisi.includes(kursi.toString()) ? ' checked disabled' : '') + '>' +
                            '<label class="form-check-label" for="kursi_' + kursi + '">' + kursi + '</label>' +
                            '</div>');
                    });

                    // Menambahkan kursi baris terakhir
                    if (kursiBelakang.length > 0) {
                        let barisTerakhir = $('<div class="baris-terakhir"></div>');
                        kursiBelakang.forEach(function(kursi) {
                            barisTerakhir.append('<div class="kursi-item baris-terakhir-kursi">' +
                                '<input class="form-check-input" type="checkbox" name="no_kursi[]" value="' + kursi + '" id="kursi_' + kursi + '"' + (kursiTerisi.includes(kursi.toString()) ? ' checked disabled' : '') + '>' +
                                '<label class="form-check-label" for="kursi_' + kursi + '">' + kursi + '</label>' +
                                '</div>');
                        });
                        kursiContainer.append(barisTerakhir);
                    }
                }
                // Validate the selection after seats are populated
                validateKursiSelection();
            }
        }
    });
  }

  function validateKursiSelection() {
    var jumlah_pembelian = parseInt($("[name='jumlah_pembelian']").val());
    var kursiContainer = $("#kursi-container");

    // Event listener untuk checkbox
    kursiContainer.find('input[type="checkbox"]').off('change').on('change', function() {
        var selectedOptions = kursiContainer.find('input[type="checkbox"]:checked:not(.booked)').length;

        if (selectedOptions > jumlah_pembelian) {
            alert('Anda hanya bisa memilih ' + jumlah_pembelian + ' kursi.');
            $(this).prop('checked', false);
        }

        // Atur tombol order
        if (selectedOptions === jumlah_pembelian) {
            $("#btnOrder").attr('disabled', false);
        } else {
            $("#btnOrder").attr('disabled', true);
        }

        saveSelectedSeats();  // Simpan kursi yang dipilih setiap kali ada perubahan
    });

    // Memeriksa status kursi apakah sudah dipesan atau belum
    kursiContainer.find('input[type="checkbox"]').each(function() {
        var checkbox = $(this);
        var noKursi = checkbox.val();
        var idTiketBus = $("[name='id_tiket_bus']").val();

        // Memeriksa status kursi
        $.ajax({
            type: "POST",
            url: "<?= base_url('penjualan/checkKursi') ?>",
            data: { id_tiket_bus: idTiketBus, no_kursi: noKursi },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'booked') {
                    checkbox.prop('checked', true);
                    checkbox.prop('disabled', true);
                    checkbox.addClass('booked');
                    checkbox.closest('.kursi-item').addClass('booked');
                }
            },
            complete: function() {
            loadSelectedSeats(); // Muat kursi yang dipilih setelah pemeriksaan status
        }
        });
    });
}

// Fungsi untuk menyimpan kursi yang dipilih
function saveSelectedSeats() {
    var selectedSeats = [];
    $("#kursi-container").find('input[type="checkbox"]:checked').each(function() {
        selectedSeats.push($(this).val());
    });
    // Simpan kursi yang dipilih ke local storage atau server
    localStorage.setItem('selectedSeats', JSON.stringify(selectedSeats));
}

// Fungsi untuk memuat kursi yang dipilih dari local storage atau server
function loadSelectedSeats() {
    var selectedSeats = JSON.parse(localStorage.getItem('selectedSeats')) || [];
    selectedSeats.forEach(function(seat) {
        $("#kursi-container").find('input[type="checkbox"][value="' + seat + '"]').prop('checked', true);
    });
}

$("[name='jumlah_pembelian']").change(function() {
    var jumlah_pembelian = parseInt($(this).val());
    var kosong = parseInt($("[name='kursi_kosong']").val());

    if (jumlah_pembelian > kosong) {
        alert('Pemesanan melampaui Jumlah Kursi Kosong');
        $("#btnOrder").attr('disabled', true);
        location.reload();
        return;
    }

    var nominal = jumlah_pembelian * parseInt($("[name='harga_tiket']").val());
    $("[name='nominal']").val(nominal);

    // Reset pilihan kursi dan panggil validasi pilihan kursi
    $("#kursi-container input[type='checkbox']:not(:disabled)").prop('checked', false);
    validateKursiSelection();
});

$("#btnOrder").click(function(event) {
    // Validasi untuk memastikan nomor kursi sesuai dengan jumlah pembelian tiket
    var selectedKursi = $("#kursi-container input[type='checkbox']:checked:not(.booked)").length;
    var jumlah_pembelian = parseInt($("[name='jumlah_pembelian']").val());

    if (selectedKursi !== jumlah_pembelian) {
        alert('Jumlah kursi yang dipilih harus sesuai dengan jumlah pembelian tiket.');
        event.preventDefault();
    }

// Panggil fungsi validasi saat halaman pertama kali dimuat
$(document).ready(function() {
    validateKursiSelection();
});

    // Kirim data form via AJAX
    var formData = $("#FRM_ORDER").serialize();
    var urlPost = "<?= site_url('penjualan/saveDataFront') ?>";

    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data){
            if (data.status == "success") {
                toastr.info(data.message);
                $('#FRM_ORDER')[0].reset();
            } else {
                toastr.error(data.message);
            }
        },
        error: function (err) {
            console.log(err);
            toastr.error("An error occurred. Please try again.");
        }
    });
});

function ACTION(urlPost, formData){
    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data){
            if (data.status == "success") {
                toastr.info(data.message);
            } else {
                toastr.error(data.message);
            }
        }
    });
}


  $("#FRM_UPLOAD").on('submit', function(event){
    event.preventDefault();
    let formData = new FormData(this);

    urlPost = "<?= site_url('pembayaran/saveDataFront') ?>";

    $.ajax({
      url: urlPost,
      type: "POST",
      data: formData,
      processData : false,
      cache: false,
      contentType : false,
      success: function(data){
        data = JSON.parse(data)
        if (data.status == "success") {
          toastr.info(data.message)

        }else{
          toastr.error(data.message)
        }
      },
    })
  })

  function cekTicket(){
    $.ajax({
      url: "<?= site_url('penjualan/cekTicket') ?>",
      type: "POST",
      data: {
        id_penjualan_tiket: $("[name='id_penjualan_tiket']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data.status)
        if(data['status'] == "success"){
          $("#jmlBayar").val(data['message'])
          $("#btnUpload").attr('disabled',false)
        }else{
          toastr.error(data.message)
          $("#btnUpload").attr('disabled',true)
        }
      }
    })
  }

  function CEK_PEMBAYARAN(){
    $.ajax({
      url: "<?= site_url('penjualan/cekPembayaran') ?>",
      type: "POST",
      data: {
        id_tiket: $("[name='id_tiket']").val()
      },
      dataType: "JSON",
      success: function(data){
        if(data['status'] == "success"){
          $("#jmlBayar").val(data['message'])
          $("#btnCetak").attr('disabled',false)
        }else{
          toastr.error(data.message)
          $("#btnCetak").attr('disabled',true)
        }
      }
    })
  }
</script>