<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.css'); ?>">
<style>
  .flatpickr-day {
    max-width: 33px;
    height: 33px;
  }
</style>

<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Jadwal Keberangkatan Bus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="min-width: 60px;">ID Tiket</th>
                  <th>Tipe Tiket</th>
                  <th style="min-width: 40px;">Jenis Bus</th>
                  <th>Nopol</th>
                  <th style="min-width: 50px;">Kota Keberangkatan</th>
                  <th style="min-width: 40px;">Titik Kumpul</th>
                  <th>Tujuan</th>
                  <th style="min-width: 60px;">Waktu Keberangkatan</th>
                  <th style="min-width: 30px;">Maksimal Penumpang</th>
                  <th style="min-width: 40px;">Harga</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>

    <!-- Modal Add/Edit Data -->
    <div class="modal fade" id="modal_add">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="FRM_DATA">
            <div class="modal-header">
              <h4 class="modal-title">Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jenis Bus</label>
                      <select name="id_jenis_bus" class="form-control" onChange="ISI_NOPOL()"></select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>No. Polisi</label>
                      <select name="id_bus" class="form-control" onChange="ISI_MAX_PENUMPANG()"></select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Kota Keberangkatan</label>
                      <input type="text" class="form-control" name="kota_keberangkatan">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Titik Kumpul</label>
                      <input type="text" class="form-control" name="lokasi_kumpul">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tujuan</label>
                      <input type="text" class="form-control" name="tujuan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Waktu Keberangkatan</label>
                      <input type="text" class="form-control datetime" name="tgl_keberangkatan" readonly="false">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Harga tiket</label>
                      <input type="text" class="form-control" name="harga" onkeypress="return onlyNumberKey(event)">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Maksimal Penumpang</label>
                      <input type="text" class="form-control" name="jumlah_max" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tipe Tiket</label>
                      <select name="tipe_tiket" class="form-control">
                        <option value="ANTAR KOTA">ANTAR KOTA</option>
                        <option value="WISATA">WISATA</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="BTN_SAVE">Save</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </section>
</div>

<!-- jQuery -->
<script src="<?= base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.js'); ?>"></script>	
<script>
  var save_method;
  var id_edit;
  var id_user;

  $(".datetime").flatpickr({
      enableTime: true,
      time_24hr: true,
      dateFormat: "Y-m-d H:i:S",
  });	
  
  $(function () {
    REFRESH_DATA();
    ISI_SELECT();
    
    // Event Handler untuk Tombol Tambah Data
    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset();
      save_method = "save";
      $("#modal_add .modal-title").text('Add Data');
      $("#modal_add").modal('show');
    });

    // Event Handler untuk Tombol Simpan Data
    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize();
      
      if(save_method === 'save') {
          urlPost = "<?= site_url('jadwal_tiket/saveData') ?>";
      } else {
          urlPost = "<?= site_url('jadwal_tiket/updateData') ?>";
          formData += "&id_tiket_bus=" + id_edit;
      }
      ACTION(urlPost, formData);
      $("#modal_add").modal('hide');
    });
  });

  // Fungsi untuk Mengisi Dropdown Jenis Bus
  function ISI_SELECT(){
    $.ajax({
      url: "<?= site_url('bus/getJenisBus') ?>",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        var row = "<option></option>";
        $.map(data['data'], function(val) {
          row += "<option value='" + val.id_jenis_bus + "'>" + val.nm_jenis_bus + "</option>";
        });
        $("[name='id_jenis_bus']").html(row);
      }
    });
  }

  // Fungsi untuk Mengisi Dropdown Nomor Polisi Berdasarkan Jenis Bus
  function ISI_NOPOL(){
    $.ajax({
      url: "<?= site_url('Jadwal_Tiket/getIdBus') ?>",
      type: "POST",
      data: {
        id_jenis_bus: $("[name='id_jenis_bus']").val()
      },
      dataType: "JSON",
      success: function(data){
        var row = "<option></option>";
        $.map(data['data'], function(val) {
          row += "<option value='" + val.id_bus + "'>" + val.no_pol + "</option>";
        });
        $("[name='id_bus']").html(row);
      }
    });
  }

  // Fungsi untuk Mengisi Maksimal Penumpang Berdasarkan Nomor Polisi
  function ISI_MAX_PENUMPANG(){
    $.ajax({
      url: "<?= site_url('Jadwal_Tiket/getKursiBus') ?>",
      type: "POST",
      data: {
        id_bus: $("[name='id_bus']").val()
      },
      dataType: "JSON",
      success: function(data){
        $("[name='jumlah_max']").val(data['data'][0]['jumlah_kursi']);
      }
    });
  }

// Fungsi untuk Refresh Data Table
function REFRESH_DATA(){
  $('#tb_data').DataTable().destroy();
  var tb_data = $("#tb_data").DataTable({
    "order": [[ 0, "asc" ]],
    "autoWidth": false,
    "responsive": true,
    "pageLength": 25,
    "ajax": {
        "url": "<?= site_url('jadwal_tiket/getAllData') ?>",
        "type": "GET"
    },
    "columns": [
        { "data": "id_tiket_bus" }, // ID Tiket Bus
        { "data": "tipe_tiket" }, // Tipe Tiket
        { "data": "nm_jenis_bus" }, // Jenis Bus
        { "data": "no_pol" }, // Nomor Polisi
        { "data": "kota_keberangkatan" }, // Kota Keberangkatan
        { "data": "lokasi_kumpul" }, // Titik Kumpul
        { "data": "tujuan" }, // Tujuan
        { "data": "tgl_keberangkatan" }, // Waktu Keberangkatan
        { "data": "jumlah_max", class: "text-center" }, // Maksimal Penumpang
        { "data": "harga", class: "text-right" }, // Harga
        { "data": null, 
          "render": function(data){
            // Menampilkan dropdown aksi untuk Edit dan Delete
            return "<div class='dropdown'>" +
                     "<button class='btn btn-primary' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi</button>" +
                     "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                       "<a class='dropdown-item' href='javascript:void(0)' onclick='editData("+ JSON.stringify(data) +");'><i class='fas fa-edit'></i> Edit</a>" +
                       "<a class='dropdown-item' href='javascript:void(0)' onclick='deleteData(\""+ data.id_tiket_bus +"\");'><i class='fas fa-trash'></i> Delete</a>" +
                     "</div>" +
                   "</div>";
          },
          className: "text-center"
        },
    ]
  });
}

// Fungsi untuk Menangani Aksi Tambah/Edit Data
function ACTION(urlPost, formData){
  $.ajax({
      url: urlPost,
      type: "POST",
      data: formData,
      dataType: "JSON",
      beforeSend: function () {
        $("#LOADER").show();
      },
      complete: function () {
        $("#LOADER").hide();
      },
      success: function(data){
        if (data.status === "success") {
          toastr.info(data.message);
          REFRESH_DATA();
        } else {
          toastr.error(data.message);
        }
      }
  });
}

// Fungsi untuk Memuat Data ke Modal Edit
function editData(data){
  save_method = "edit";
  id_edit = data.id_tiket_bus;

  $("#modal_add .modal-title").text('Edit Data');
  $("[name='id_jenis_bus']").val(data.id_jenis_bus).change();
  setTimeout(function() {
    $("[name='id_bus']").val(data.id_bus).change();
  }, 1000);
  $("[name='jumlah_max']").val(data.jumlah_max);
  $("[name='lokasi_kumpul']").val(data.lokasi_kumpul);
  $("[name='tujuan']").val(data.tujuan);
  $("[name='tgl_keberangkatan']").val(data.tgl_keberangkatan);
  $("[name='harga']").val(data.harga);
  $("[name='tipe_tiket']").val(data.tipe_tiket);
  $("[name='kota_keberangkatan']").val(data.kota_keberangkatan);
  
  $("#modal_add").modal('show');
}

// Fungsi untuk Menghapus Data
function deleteData(id){
  if(!confirm('Hapus data ini?')) return;

  urlPost = "<?= site_url('jadwal_tiket/deleteData') ?>";
  formData = "id_tiket_bus=" + id;
  ACTION(urlPost, formData);
}

// Fungsi untuk Memastikan Input Hanya Angka
function onlyNumberKey(evt) {
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
  if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
      return false;
  }
  return true;
}
</script>
