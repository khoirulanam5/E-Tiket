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
              <h3 class="card-title">Data Parameter Kepuasan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Parameter</th>
                  <th>Parameter</th>
                  <th style="min-width: 80px;">Aksi</th>
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
                  <label>Parameter Kepuasan</label>
                  <textarea class="form-control" name="parameter" rows="2"></textarea>
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
  var save_method; // Variabel untuk menentukan metode simpan (add atau edit)
  var id_edit; // Variabel untuk menyimpan ID data yang akan diedit
  var id_user; // Variabel untuk menyimpan ID user (tidak digunakan dalam contoh ini)

  // Fungsi yang dijalankan ketika dokumen sudah siap
  $(function () {
    REFRESH_DATA(); // Memuat data awal
    
    // Event ketika tombol "Tambah" diklik
    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset(); // Reset form
      save_method = "save"; // Set metode simpan ke "save"
      $("#modal_add .modal-title").text('Add Data'); // Set judul modal
      $("#modal_add").modal('show'); // Tampilkan modal
    });

    // Event ketika tombol "Save changes" diklik
    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize(); // Serialize data form
      
      // Tentukan URL POST berdasarkan metode simpan
      if(save_method == 'save') {
          urlPost = "<?= site_url('parameter_kepuasan/saveData') ?>";
      } else {
          urlPost = "<?= site_url('parameter_kepuasan/updateData') ?>";
          formData += "&id_parameter=" + id_edit; // Tambahkan ID parameter untuk update
      }

      ACTION(urlPost, formData); // Panggil fungsi ACTION untuk simpan data
      $("#modal_add").modal('hide'); // Sembunyikan modal
    });
  });

  // Fungsi untuk merefresh data tabel
  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy(); // Hancurkan instance DataTable yang sudah ada
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]], // Urutkan berdasarkan kolom pertama
      "autoWidth": false,
      "responsive": true,
      "pageLength": 25,
      "ajax": {
          "url": "<?= site_url('parameter_kepuasan/getAllData') ?>", // URL untuk mengambil data
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1; // Penomoran baris
              }
          },
          { "data": "id_parameter" }, // Kolom ID Parameter
          { "data": "parameter" }, // Kolom Parameter
          { "data": null, 
            "render": function(data){
              // Menampilkan dropdown aksi untuk Edit dan Delete
              return "<div class='dropdown'>" +
                       "<button class='btn btn-primary' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi</button>" +
                       "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                         "<a class='dropdown-item' href='javascript:void(0)' onclick='editData("+ JSON.stringify(data) +");'><i class='fas fa-edit'></i> Edit</a>" +
                         "<a class='dropdown-item' href='javascript:void(0)' onclick='deleteData(\""+ data.id_parameter +"\");'><i class='fas fa-trash'></i> Delete</a>" +
                       "</div>" +
                     "</div>";
            },
            className: "text-center" // Penempatan konten di tengah
          },
      ]
    });
  }

  // Fungsi untuk menangani aksi simpan data
  function ACTION(urlPost, formData){
    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        dataType: "JSON",
        beforeSend: function () {
          $("#LOADER").show(); // Tampilkan loader sebelum request
        },
        complete: function () {
          $("#LOADER").hide(); // Sembunyikan loader setelah request selesai
        },
        success: function(data){
          if (data.status == "success") {
            toastr.info(data.message); // Tampilkan notifikasi sukses
            REFRESH_DATA(); // Refresh data tabel
          } else {
            toastr.error(data.message); // Tampilkan notifikasi error
          }
        }
    });
  }

  // Fungsi untuk memuat data ke dalam modal edit
  function editData(data){
    save_method = "edit"; // Set metode simpan ke "edit"
    id_edit = data.id_parameter; // Set ID data yang akan diedit

    $("#modal_add .modal-title").text('Edit Data'); // Set judul modal
    $("[name='parameter']").val(data.parameter); // Set nilai parameter ke input form
    $("#modal_add").modal('show'); // Tampilkan modal
  }

  // Fungsi untuk menghapus data
  function deleteData(id){
    if(!confirm('Delete this data?')) return; // Konfirmasi sebelum menghapus data

    urlPost = "<?= site_url('parameter_kepuasan/deleteData') ?>"; // URL untuk delete data
    formData = "id_parameter=" + id; // Data yang akan dikirim untuk delete
    ACTION(urlPost, formData); // Panggil fungsi ACTION untuk delete data
  }
</script>
