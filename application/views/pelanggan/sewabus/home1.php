<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.css'); ?>">
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
              <span style="font-size:14px;">Penyewaan Bus</span>
            </a>
            <a class="list-group-item list-group-item-action" id="bayar" href="<?= base_url('sewabus/front/history')?>" role="tab" aria-controls="bayar">
              <i class="fas fa-receipt"></i>
              <span style="font-size:14px;">Pembayaran Sewa</span>
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
                    <label for="" class="label">Tipe Sewa</label>
                    <input name="tipe_sewa" class="form-control" value="PARIWISATA" readonly>
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
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Tanggal Penyewaan</label>
                    <input type="text" name="tgl_keberangkatan" 
                      onChange="ISI_TUJUAN()" class="form-control date" placeholder="Cek Ketersediaan Bus">
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">ID Kategori Penyewaan</label>
                    <select class="form-control select2" name="tujuan" onChange="ISI_JENISBUS()"></select>
                  </div>
                </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Tipe Bus</label>
                    <select class="form-control" name="id_jenis_bus_sewa" onChange="ISI_BUS()"></select>
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Jumlah Kursi</label>
                    <select class="form-control" name="id_ketersediaan_bus" onChange="ISI_HARGA()"></select>
                  </div>
                </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Tanggal Pengembalian</label>
                    <input type="text" class="form-control date" name="tgl_pengembalian" placeholder="Tanggal Pengembalian">
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Masukan Jumlah Bus Yang Akan di Sewa</label>
                    <input type="text" class="form-control" name="jumlah_pembelian" placeholder="Masukan Jumlah Bus">
                  </div>
                </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Jumlah Bus Tersedia</label>
                    <input type="text" class="form-control" name="jumlah_bus" readonly placeholder="Jumlah Bus Tersedia">
                  </div>
                  <div class="form-group col-12 col-md-6">
                      <label for="jumlah_hari">Jumlah Hari Penyewaan</label>
                      <input type="text" name="jumlah_hari" class="form-control" readonly>
                  </div>
                </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Harga Sewa / Hari</label>
                    <input type="text" class="form-control" name="harga" readonly placeholder="Harga Sewa / Hari">
                  </div>
                  <div class="form-group col-12 col-md-6">
                    <label for="" class="label">Total Pembayaran</label>
                    <input type="text" class="form-control" name="nominal" readonly placeholder="Total Pembayaran">
                  </div>
                </div>
              <div class="d-md-flex">
                <div class="form-group col-12 col-md-6">
                  <label for="" class="label">Alamat Penjemputan</label>
                  <input type="text" class="form-control" id="penjemputan" name="penjemputan" >
                </div>
                <div class="form-group col-12 col-md-6">
                  <label for="crew_bus" class="label">Tambah Crew Bus?</label>
                  <select class="form-control" id="crew_bus" name="crew_bus">
                    <option value=""></option>
                    <option value="YA">YA</option>
                    <option value="TIDAK">TIDAK</option>
                  </select>
                </div>
              </div>
                <div class="d-md-flex">
                  <div class="form-group col-12 col-md-12" style="text-align: right;">
                    <button type="button" id="btnOrder" class="btn btn-info py-3 px-4"><i class="fas fa-search"></i> Order Sewa</button>
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
      url: "<?= site_url('sewabus/front/zenziva_api') ?>",
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
      url: "<?= site_url('sewabus/penjualan_sewa/getTujuanBusAntarKota') ?>",
      type: "POST",
      data: {
        tgl_berangkat: $("[name='tgl_keberangkatan']").val(),
        tipe_sewa: $("[name='tipe_sewa']").val()
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

    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getKotaBerangkat') ?>",
      type: "POST",
      data: {
        tgl_berangkat: $("[name='tgl_keberangkatan']").val(),
        tipe_sewa: $("[name='tipe_sewa']").val()
      },
      dataType: "JSON",
      success: function(data){
        var rows = "<option></option>"
        $.map( data['data'], function( val, i ) {
          rows += "<option value='"+val.kota_keberangkatan+"'>"+val.kota_keberangkatan+"</option>"
        });
        $("[name='kota_keberangkatan']").html(rows)
      }
    })

    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getLokasiKumpul') ?>",
        type: "POST",
          data: {
            tgl_berangkat: $("[name='tgl_keberangkatan']").val(),
            tipe_sewa: $("[name='tipe_sewa']").val()
            },
            dataType: "JSON",
            success: function(data){
            var row = "<option></option>";
            $.map(data['data'], function(val, i) {
              row += "<option value='"+val.lokasi_kumpul+"'>"+val.lokasi_kumpul+"</option>";
            });
            $("[name='lokasi_kumpul']").html(row);
          }
      });
    }

  function ISI_JENISBUS(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getJenisBus') ?>",
      type: "POST",
      data: {
        tujuan: $("[name='tujuan']").val(),
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_jenis_bus_sewa+"'>"+val.nm_jenis_bus_sewa+"</option>"
          
        });
        $("[name='id_jenis_bus_sewa']").html(row)
      }
    })
  }

  function ISI_BUS(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getBus') ?>",
      type: "POST",
      data: {
        tujuan: $("[name='tujuan']").val(),
        id_jenis_bus_sewa: $("[name='id_jenis_bus_sewa']").val(),
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_ketersediaan_bus+"'>"+val.waktu_keberangkatan+"</option>"
          
        });
        $("[name='id_ketersediaan_bus']").html(row)
      }
    })
  }

  function ISI_HARGA() {
    $.ajax({
        url: "<?= site_url('sewabus/penjualan_sewa/getHarga') ?>",
        type: "POST",
        data: {
            id_ketersediaan_bus: $("[name='id_ketersediaan_bus']").val()
        },
        dataType: "JSON",
        success: function(data) {
            if (data.data.length > 0) {
                var harga = data.data[0].harga;
                var jumlah_bus = data.data[0].jumlah_bus;

                $("[name='harga']").val(harga);
                $("[name='jumlah_bus']").val(jumlah_bus);

                // Recalculate total price
                hitungTotalHarga();
            }
        }
    });

    $("[name='jumlah_pembelian'], [name='tgl_keberangkatan'], [name='tgl_pengembalian']").change(function() {
        hitungTotalHarga();
    });

    $("#btnOrder").click(function(event) {
        event.preventDefault();
        var formData = $("#FRM_ORDER").serialize();
        var urlPost = "<?= site_url('sewabus/penjualan_sewa/saveDataFront') ?>";
        ACTION(urlPost, formData);
    });
}

function hitungTotalHarga() {
    var jumlah_pembelian = parseInt($("[name='jumlah_pembelian']").val());
    var harga_per_hari = parseInt($("[name='harga']").val());
    var tgl_berangkat = new Date($("[name='tgl_keberangkatan']").val());
    var tgl_pengembalian = new Date($("[name='tgl_pengembalian']").val());

    if (!isNaN(jumlah_pembelian) && !isNaN(harga_per_hari) && !isNaN(tgl_berangkat) && !isNaN(tgl_pengembalian)) {
        // Menghitung jumlah hari penyewaan, termasuk hari keberangkatan
        var rentalDays = Math.ceil((tgl_pengembalian - tgl_berangkat) / (1000 * 60 * 60 * 24)) + 1;
        var totalPrice = jumlah_pembelian * harga_per_hari * rentalDays;

        // Set total price
        $("[name='nominal']").val(totalPrice);

        // Set rental days to the form input field
        $("[name='jumlah_hari']").val(rentalDays);

        // Validate the number of buses available
        var jumlah_bus = parseInt($("[name='jumlah_bus']").val());
        if (jumlah_pembelian > jumlah_bus) {
            alert('Pemesanan melampaui Jumlah Bus Yang Tersedia');
            $("[name='jumlah_pembelian']").val(''); // Reset kolom jumlah_pembelian
            $("#btnOrder").attr('disabled', true);
            return;
        }
        $("#btnOrder").attr('disabled', false);
    }
}

function ACTION(urlPost, formData) {
    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data) {
            if (data.status == "success") {
                toastr.info(data.message);
                $('#FRM_ORDER')[0].reset();
            } else {
                toastr.error(data.message);
            }
        },
        error: function(err) {
            console.error(err);
        }
    });
  }


$("#FRM_UPLOAD").on('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    urlPost = "<?= site_url('sewabus/pembayaran_sewa/saveDataFront') ?>";

    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        processData: false,
        cache: false,
        contentType: false,
        success: function(data) {
            data = JSON.parse(data);
            if (data.status == "success") {
                toastr.info(data.message);
            } else {
                toastr.error(data.message);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
});

  function cekTicket(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/cekTicket') ?>",
      type: "POST",
      data: {
        id_sewa_bus: $("[name='id_sewa_bus']").val()
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
      url: "<?= site_url('sewabus/penjualan_sewa/cekPembayaran') ?>",
      type: "POST",
      data: {
        id_sewa: $("[name='id_sewa']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data.status)
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