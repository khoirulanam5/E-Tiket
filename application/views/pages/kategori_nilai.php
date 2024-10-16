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
              <h3 class="card-title">Data Indikator Kepuasan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Indikator</th>
                  <th>Indikator Kepuasan</th>
                  <th>Nilai</th>
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
                  <label>Indikator Kepuasan</label>
                  <input type="text" class="form-control" name="indikator_kepuasan" >
                </div>
                <div class="form-group">
                  <label>Nilai</label>
                  <input type="number" min="1" max="5" class="form-control" name="nilai" >
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
  var save_method; // Variabel untuk menyimpan metode saat ini, bisa 'save' atau 'edit'
  var id_edit; // Variabel untuk menyimpan ID data yang sedang diedit
  var id_user; // Variabel untuk menyimpan ID user (tidak digunakan dalam kode ini)

  // Fungsi yang dijalankan saat dokumen siap
  $(function () {
    REFRESH_DATA(); // Memuat data saat halaman pertama kali dibuka
    
    // Event listener untuk tombol tambah data
    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset(); // Mereset form
      save_method = "save"; // Set metode ke 'save'
      $("#modal_add .modal-title").text('Add Data'); // Set judul modal
      $("#modal_add").modal('show'); // Menampilkan modal
    });

    // Event listener untuk tombol simpan perubahan
    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize(); // Mengambil data dari form
      
      // Menentukan URL post berdasarkan metode
      if(save_method == 'save') {
          urlPost = "<?= site_url('kategori_nilai/saveData') ?>";
      } else {
          urlPost = "<?= site_url('kategori_nilai/updateData') ?>";
          formData += "&id_indikator_kepuasan=" + id_edit; // Menambahkan ID untuk edit
      }

      ACTION(urlPost, formData); // Memanggil fungsi ACTION untuk menyimpan data
      $("#modal_add").modal('hide'); // Menyembunyikan modal
    });
  });

  // Fungsi untuk memuat ulang data tabel
  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy(); // Menghancurkan DataTable yang sudah ada
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]], // Mengurutkan data berdasarkan kolom pertama
      "autoWidth": false,
      "responsive": true,
      "pageLength": 25,
      "ajax": {
          "url": "<?= site_url('kategori_nilai/getAllData') ?>", // URL untuk mengambil data
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1; // Nomor urut
              }
          },
          { "data": "id_indikator_kepuasan" }, // Kolom ID Indikator
          { "data": "indikator_kepuasan" }, // Kolom Indikator Kepuasan
          { "data": "nilai" }, // Kolom Nilai
          { "data": null, 
            "render" : function(data){
              // Membuat dropdown untuk aksi Edit dan Delete
              return "<div class='dropdown'>" +
                       "<button class='btn btn-primary' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi</button>" +
                       "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                         "<a class='dropdown-item' href='javascript:void(0)' onclick='editData("+ JSON.stringify(data) +");'><i class='fas fa-edit'></i> Edit</a>" +
                         "<a class='dropdown-item' href='javascript:void(0)' onclick='deleteData(\""+ data.id_indikator_kepuasan +"\");'><i class='fas fa-trash'></i> Delete</a>" +
                       "</div>" +
                     "</div>";
            },
            className: "text-center" // Penempatan konten di tengah
          },
      ]
    });
  }

  // Fungsi untuk melakukan aksi (simpan/edit/hapus)
  function ACTION(urlPost, formData){
    $.ajax({
        url: urlPost,
        type: "POST",
        data: formData,
        dataType: "JSON",
        beforeSend: function () {
          $("#LOADER").show(); // Menampilkan loader sebelum request
        },
        complete: function () {
          $("#LOADER").hide(); // Menyembunyikan loader setelah request
        },
        success: function(data){
          if (data.status == "success") {
            toastr.info(data.message); // Menampilkan notifikasi sukses
            REFRESH_DATA(); // Memuat ulang data tabel
          } else {
            toastr.error(data.message); // Menampilkan notifikasi error
          }
        }
    });
  }

  // Fungsi untuk mengedit data
  function editData(data){
    save_method = "edit"; // Set metode ke 'edit'
    id_edit = data.id_indikator_kepuasan; // Set ID data yang akan diedit

    $("#modal_add .modal-title").text('Edit Data'); // Set judul modal
    $("[name='indikator_kepuasan']").val(data.indikator_kepuasan); // Mengisi form dengan data yang akan diedit
    $("[name='nilai']").val(data.nilai); // Mengisi form dengan nilai yang akan diedit
    $("#modal_add").modal('show'); // Menampilkan modal
  }

  // Fungsi untuk menghapus data
  function deleteData(id){
    if(!confirm('Delete this data?')) return; // Konfirmasi sebelum menghapus data

    urlPost = "<?= site_url('kategori_nilai/deleteData') ?>"; // URL untuk menghapus data
    formData = "id_indikator_kepuasan=" + id; // Data yang akan dikirim untuk menghapus
    ACTION(urlPost, formData); // Memanggil fungsi ACTION untuk menghapus data
  }
</script>
