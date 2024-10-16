<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Data Jenis Bus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Jenis</th>
                  <th>Jenis Bus</th>
                  <th style="min-width: 80x;">Aksi</th>
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

    <div class="modal fade" id="modal_add">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form id="FRM_DATA">
            <div class="modal-header">
              <h4 class="modal-title">Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label>Jenis Bus</label>
                  <textarea class="form-control" name="nm_jenis_bus" rows="2"></textarea>
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
<script>
  var save_method; // Variabel untuk menyimpan metode (save atau edit)
  var id_edit; // Variabel untuk menyimpan ID data yang akan diedit

  $(function () {
    // Memanggil fungsi untuk menyegarkan data
    REFRESH_DATA()

    // Event handler untuk tombol tambah data
    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset() // Mereset form
      save_method = "save" // Mengatur metode menjadi save
      $("#modal_add .modal-title").text('Add Data') // Mengubah judul modal
      $("#modal_add").modal('show') // Menampilkan modal
    }) 

    // Event handler untuk tombol save pada modal
    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize(); // Serialisasi data form
      if(save_method == 'save') {
          urlPost = "<?= site_url('jenis_bus/saveData') ?>"; // URL untuk save data baru
      }else{
          urlPost = "<?= site_url('jenis_bus/updateData') ?>"; // URL untuk update data
          formData+="&id_jenis_bus="+id_edit // Menambahkan ID data yang akan diedit
      }
      // Memanggil fungsi ACTION untuk mengirim data
      ACTION(urlPost, formData)
      $("#modal_add").modal('hide') // Menutup modal
    })
  });

  // Fungsi untuk menyegarkan data pada tabel
  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy();
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]],
      "autoWidth": false,
      "responsive": true,
      "pageLength": 25,
      "ajax": {
          "url": "<?= site_url('jenis_bus/getAllData') ?>", // URL untuk mengambil data
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "id_jenis_bus" },
          { "data": "nm_jenis_bus" },
          { "data": null, 
            "render" : function(data){
              // Membuat dropdown untuk aksi edit dan delete
              return `
                <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                  <ul class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick='editData(${JSON.stringify(data)});'><i class='fas fa-edit'></i> Edit</a>
                    <a class="dropdown-item" href="#" onclick='deleteData("${data.id_jenis_bus}");'><i class='fas fa-trash'></i> Delete</a>
                  </ul>
                </div>
              `
            },
            className: "text-center"
          },
      ]
    })
  }

  // Fungsi untuk mengirim data ke server
  function ACTION(urlPost, formData){
      $.ajax({
          url: urlPost,
          type: "POST",
          data: formData,
          dataType: "JSON",
          beforeSend: function () {
            $("#LOADER").show(); // Menampilkan loader sebelum mengirim data
          },
          complete: function () {
            $("#LOADER").hide(); // Menyembunyikan loader setelah mengirim data
          },
          success: function(data){
            if (data.status == "success") {
              toastr.info(data.message) // Menampilkan pesan sukses
              REFRESH_DATA() // Menyegarkan data pada tabel
            }else{
              toastr.error(data.message) // Menampilkan pesan error
            }
          }
      })
  }

  // Fungsi untuk mengisi form edit dengan data yang akan diedit
  function editData(data){
    save_method = "edit" // Mengatur metode menjadi edit
    id_edit = data.id_jenis_bus;

    $("#modal_add .modal-title").text('Edit Data') // Mengubah judul modal
    $("[name='nm_jenis_bus']").val(data.nm_jenis_bus) // Mengisi form dengan data
    $("#modal_add").modal('show') // Menampilkan modal
  }

  // Fungsi untuk menghapus data
  function deleteData(id){
    if(!confirm('Delete this data?')) return // Konfirmasi sebelum menghapus data

    urlPost = "<?= site_url('jenis_bus/deleteData') ?>"; // URL untuk delete data
    formData = "id_jenis_bus="+id
    ACTION(urlPost, formData) // Memanggil fungsi ACTION untuk mengirim data
  }
</script>
