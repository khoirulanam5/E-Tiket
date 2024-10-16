<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<style>
  .form-control{
    font-size: 12px;
    height: unset!important;
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
<!-- head -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?= base_url('/assets/front/images/') ?>kalingga1.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="<?= base_url('/sewabus/front/') ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>History Sewa<i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">History Penyewaan Bus</h1>
      </div>
    </div>
  </div>
</section>
<!-- endhead -->
  
<!-- tabel -->
<section class="ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered" id="tb_history" style="font-size:12px;min-width:800px!important;width:100%;">
          <thead>
            <tr>
              <th style="width:70px;">No.<br>Sewa</th>
              <th>Tanggal<br>Pembelian</th>
              <th>Tanggal<br>Penyewaan</th>
              <th>Tanggal<br>Pengembalian</th>
              <th>Jumlah Bus<br>Disewa</th>
              <th>Alamat<br>Penjemputan</th>
              <th>Crew Bus</th>
              <th>Tipe Bus</th>
              <th style="width:50px;">Total<br>Bayar</th>
              <th>Status<br>Pembayaran</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
<!-- endtabel -->

<!-- tabel content -->
  <div class="modal fade" id="modal_add">
    <div class="modal-dialog ">
      <div class="modal-content">
      <form id="FRM_UPLOAD" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
            <h4 class="modal-title">Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="d-md-flex mt-2">
                <div class="form-group col-6 col-md-6">
                    <label for="" class="label">Nomor Sewa</label>
                    <input type="text" class="form-control" name="id_sewa_bus" readonly>
                </div>
                <div class="form-group col-6 col-md-6">
                    <label for="" class="label">Bukti Pembayaran</label>
                    <input type="file" class="form-control" name="bukti_pembayaran" accept="image/png, image/gif, image/jpeg" required>
                </div>
            </div>
            <div class="d-md-flex mt-2">
                <div class="form-group col-6 col-md-6">
                    <label for="" class="label">Jumlah Pembayaran</label>
                    <input type="text" class="form-control" name="total_pembayaran" readonly>
                </div>
            </div>
            <div class="d-md-flex mt-2">
                <div class="form-group col-12">
                    <label for="" class="label">Jenis Pembayaran</label><br>
                    <input type="radio" id="dp" name="jenis_pembayaran" value="dp">
                    <label for="dp">DP</label><br>
                    <input type="radio" id="lunas" name="jenis_pembayaran" value="lunas">
                    <label for="lunas">Lunas</label>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-info" id="BTN_SAVE">Kirim</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

</section>
<script src="<?= base_url('/assets/front/js/jquery.min.js'); ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/assets/adminlte/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?= base_url('/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?= base_url('/assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?= base_url('/assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>

<!-- proses logika -->
<script>

  REFRESH_DATA()

  function REFRESH_DATA(){
    $('#tb_history').DataTable().destroy();
    var tb_data = $("#tb_history").DataTable({
      "order": [[ 0, "desc" ]],
      "autoWidth": false,
      "responsive": true,
      "pageLength": 10,
      "ajax": {
          "url": "<?= site_url('sewabus/penjualan_sewa/getHistoryTiket') ?>",
          "type": "GET"
      },
      "columns": [
          { "data": "id_sewa_bus", className: "text-center" },
          { "data": "tgl_pembelian", className: "text-center" },
          { "data": "tgl_keberangkatan", className: "text-center" },
          { "data": "tgl_pengembalian", className: "text-center" },
          { "data": "jumlah_pembelian", className: "text-center" },
          { "data": "penjemputan", className: "text-center" },
          { "data": "crew_bus", className: "text-center"},
          { "data": null,
            "render" : function(data){
              return data.nm_jenis_bus_sewa
            },
            className: "text-center" 
          },
          { "data": "total_pembayaran", className: "text-center" },
          { 
            "data": null, 
            "render": function(data) {
              var row;

              // Jika status_validasi belum ada atau statusnya DP_UPLOAD, tampilkan tombol upload untuk DP atau LUNAS
              if (!data.status_validasi) {
                row = "<button class='btn btn-sm btn-info' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-upload'></i> Bukti DP</button>";
              } else if (data.status_validasi === 'DP_UPLOAD') {
                // Jika sudah mengupload DP, tampilkan tombol untuk upload LUNAS
                row = "<span class='text-success'>DP Sukses</span><br><button class='btn btn-sm btn-info' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-upload'></i> Bukti Lunas</button>";
              } else if (data.status_validasi === 'LUNAS_UPLOAD') {
                // Jika sudah mengupload LUNAS, tampilkan status atau tombol lain jika diperlukan
                row = "<span class='text-success'>Pembayaran Lunas</span>";
              } else if (data.status_validasi === 'LUNAS_VALIDATED') {
                // Jika sudah di validasi admin, tampilan status lunas validasi 
                row = "<span class='text-success'>Pembayaran Tervalidasi</span>"
              }

              return row;
            },
            className: "text-center" 
          },
      ]
    })
  }

  function editData(data, index) {
    console.log(data);
    save_method = "edit";
    id_edit = data.id_sewa_bus;

    // Set modal title and input values based on status
    if (data.status_validasi === 'DP_UPLOAD') {
        $("#modal_add .modal-title").text('Upload Bukti Lunas');
        $("input[name='jenis_pembayaran'][value='lunas']").prop('checked', true);
        $("input[name='jenis_pembayaran'][value='dp']").prop('disabled', true);
    } else {
        $("#modal_add .modal-title").text('Upload Bukti Pembayaran');
        $("input[name='jenis_pembayaran'][value='dp']").prop('checked', true);
        $("input[name='jenis_pembayaran']").prop('disabled', false);
    }
    
    $("[name='id_sewa_bus']").val(data.id_sewa_bus);
    $("[name='total_pembayaran']").val(data.total_pembayaran);
    $("#modal_add").modal('show');
}

$("#FRM_UPLOAD").on('submit', function(event) {
    event.preventDefault();
    
    let formData = new FormData(this);
    
    // Append jenis_pembayaran dari radio button yang dipilih
    let jenisPembayaran = $("input[name='jenis_pembayaran']:checked").val();
    formData.append('jenis_pembayaran', jenisPembayaran);

    $.ajax({
        url: "<?= site_url('sewabus/pembayaran_sewa/saveDataFront') ?>",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            data = JSON.parse(data);
            if (data.status === "success") {
                toastr.info(data.message);
                $("#modal_add").modal('hide');
                setTimeout(function() {
                    location.reload(); 
                }, 2000);
            } else {
                toastr.error(data.message);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
});
</script>