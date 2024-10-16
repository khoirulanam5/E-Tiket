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
              <h3 class="card-title">Data Penyewaan Bus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th>ID Sewa</th>
                  <th>Tipe Penyewaan</th>
                  <th>ID Kategori Penyewaan</th>
                  <th style="min-width: 60px;">Tipe Bus</th>
                  <th>Jumlah Kursi</th>
                  <th>Tanggal Keberangkatan</th>
                  <th>Maksimal Bus</th>
                  <th>Harga</th>
                  <th style="min-width: 40px;">Aksi</th>
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
                    <label>ID Kategori Penyewaan</label>
                    <select class="form-control" name="tujuan">
                      <option value="PAR2024070001">PAR2024070001</option>
                      <option value="ELF2024070001">ELF2024070001</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Tipe Sewa</label>
                    <input name="tipe_sewa" class="form-control" value="PARIWISATA" readonly>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tipe Bus</label>
                      <select name="id_jenis_bus_sewa" class="form-control" onChange="ISI_JUMLAH_KURSI()"></select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jumlah Kursi</label>
                      <select name="id_bus_sewa" class="form-control" onChange="ISI_MAX_BUS()"></select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tanggal Keberangkatan</label>
                      <input type="text" class="form-control datetime" name="tgl_keberangkatan" readonly="false">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Harga Sewa / Hari</label>
                      <select type="text" class="form-control" name="harga">
                        <option value="5000000">5000000</option>
                        <option value="1500000">1500000</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Maksimal Bus</label>
                      <input type="text" class="form-control" name="jumlah_bus" readonly>
                    </div>
                  </div>
                </div>
              </div>
            <div class="modal-footer justify-content">
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

  // Initialize date-time picker
  $(".datetime").flatpickr({
      enableTime: true,
      time_24hr: true,
      dateFormat: "Y-m-d H:i:S",
  });	
  
  $(function () {
    // Initialize data on page load
    REFRESH_DATA();
    ISI_SELECT();
    
    // Event Handler for Add Data button
    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset();
      save_method = "save";
      $("#modal_add .modal-title").text('Add Data');
      $("#modal_add").modal('show');
    });

    // Event Handler for Save Data button
    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize();
      
      if(save_method === 'save') {
          urlPost = "<?= site_url('sewabus/ketersediaan_bus/saveData') ?>";
      } else {
          urlPost = "<?= site_url('sewabus/ketersediaan_bus/updateData') ?>";
          formData += "&id_ketersediaan_bus=" + id_edit;
      }
      
      // Call AJAX function to handle form submission
      ACTION(urlPost, formData);
      $("#modal_add").modal('hide');
    });
  });

  // Function to populate Jenis Bus dropdown
  function ISI_SELECT(){
    $.ajax({
      url: "<?= site_url('sewabus/bus_sewa/getJenisBus') ?>",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        var options = "<option></option>";
        $.each(data.data, function(index, value) {
          options += "<option value='" + value.id_jenis_bus_sewa + "'>" + value.nm_jenis_bus_sewa + "</option>";
        });
        $("[name='id_jenis_bus_sewa']").html(options);
      }
    });
  }

  // Function to populate Nomor Polisi dropdown based on Jenis Bus selection
  function ISI_JUMLAH_KURSI(){
    $.ajax({
      url: "<?= site_url('sewabus/ketersediaan_bus/getIdBus') ?>",
      type: "POST",
      data: {
        id_jenis_bus_sewa: $("[name='id_jenis_bus_sewa']").val()
      },
      dataType: "JSON",
      success: function(data){
        var options = "<option></option>";
        $.each(data.data, function(index, value) {
          options += "<option value='" + value.id_bus_sewa + "'>" + value.waktu_keberangkatan + "</option>";
        });
        $("[name='id_bus_sewa']").html(options);
      }
    });
  }

  // Function to populate Maksimal Penumpang based on Nomor Polisi selection
  function ISI_MAX_BUS(){
    $.ajax({
      url: "<?= site_url('sewabus/ketersediaan_bus/getJumlahBus') ?>",
      type: "POST",
      data: {
        id_bus_sewa: $("[name='id_bus_sewa']").val()
      },
      dataType: "JSON",
      success: function(data){
        $("[name='jumlah_bus']").val(data.data[0]['jumlah_bus']);
      }
    });
  }

  // Function to refresh DataTable
  function REFRESH_DATA(){
    if ($.fn.DataTable.isDataTable("#tb_data")) {
      $("#tb_data").DataTable().clear().destroy();
    }
    $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]],
      "autoWidth": false,
      "responsive": true,
      "pageLength": 25,
      "ajax": {
          "url": "<?= site_url('sewabus/ketersediaan_bus/getAllData') ?>",
          "type": "GET",
          "dataType": "json",
          "dataSrc": "data" // Ensure correct data source
      },
      "columns": [
          { "data": "id_ketersediaan_bus" }, // ID Tiket Bus
          { "data": "tipe_sewa" }, // Tipe Sewa
          { "data": "tujuan" }, // Tujuan
          { "data": "nm_jenis_bus_sewa" }, // Jenis Bus
          { "data": "waktu_keberangkatan" }, // Waktu Keberangkatan
          { "data": "tgl_keberangkatan" }, // Waktu Keberangkatan
          { "data": "jumlah_bus" }, // Maksimal Penumpang
          { "data": "harga" }, // Harga
          { 
            "data": null, 
            "render": function(data){
              // Dropdown actions for Edit and Delete
              return "<div class='dropdown'>" +
                       "<button class='btn btn-primary btn-sm' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi</button>" +
                       "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                         "<a class='dropdown-item' href='javascript:void(0)' onclick='editData("+ JSON.stringify(data) +");'><i class='fas fa-edit'></i> Edit</a>" +
                         "<a class='dropdown-item' href='javascript:void(0)' onclick='deleteData(\""+ data.id_ketersediaan_bus +"\");'><i class='fas fa-trash'></i> Delete</a>" +
                       "</div>" +
                     "</div>";
            },
            "className": "text-center"
          },
      ]
    });
  }

  // Function to handle Add/Edit Data actions
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
          REFRESH_DATA(); // Refresh DataTable after successful action
        } else {
          toastr.error(data.message);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        toastr.error('Error: ' + textStatus + ' - ' + errorThrown);
      }
    });
  }

  // Function to populate modal with Edit Data
  function editData(data){
    save_method = "edit";
    id_edit = data.id_ketersediaan_bus;

    $("#modal_add .modal-title").text('Edit Data');
    $("[name='id_jenis_bus_sewa']").val(data.id_jenis_bus_sewa).change();
    setTimeout(function() {
      $("[name='id_bus_sewa']").val(data.id_bus_sewa).change();
    }, 1000);
    $("[name='jumlah_bus']").val(data.jumlah_bus);
    $("[name='tujuan']").val(data.tujuan);
    $("[name='tgl_keberangkatan']").val(data.tgl_keberangkatan);
    $("[name='harga']").val(data.harga);
    $("[name='tipe_sewa']").val(data.tipe_sewa);
    
    $("#modal_add").modal('show');
  }

  // Function to delete data
  function deleteData(id){
    if(!confirm('Hapus data ini?')) return;

    urlPost = "<?= site_url('sewabus/ketersediaan_bus/deleteData') ?>";
    formData = "id_ketersediaan_bus=" + id;
    ACTION(urlPost, formData);
  }

  // Function to ensure only numbers are entered in input fields
  function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
        return false;
    }
    return true;
  }
</script>

