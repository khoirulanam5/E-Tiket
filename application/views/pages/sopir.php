<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Data Sopir</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>ID Sopir</th>
                  <th>Nama Sopir</th>
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

    <div class="modal fade" id="modal_add">
      <div class="modal-dialog">
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
                <p>Nama Sopir</p>
                <input type="text" class="form-control" name="nm_sopir" placeholder="Nama Sopir">
              </div>
              <div class="modal-footer justify-content">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-sm btn-primary" id="BTN_SAVE">Save</button>
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
  var save_method; // Variabel untuk menyimpan metode (save/update)
  var id_sopir; // Variabel untuk menyimpan ID sopir yang sedang diedit

  $(function () {
    REFRESH_DATA(); // Memuat ulang data tabel

    // Event saat tombol tambah data diklik
    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset(); // Mereset form
      save_method = "save"; // Menetapkan metode save
      $("#modal_add .modal-title").text('Add Data'); // Mengubah judul modal
      $("#modal_add").modal('show'); // Menampilkan modal
    })

    // Event saat tombol simpan pada modal diklik
    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize(); // Mengambil data dari form
      if(save_method == 'save') {
          urlPost = "<?= site_url('sopir/saveData') ?>"; // URL untuk menyimpan data baru
      }else{
          urlPost = "<?= site_url('sopir/updateData') ?>"; // URL untuk memperbarui data
          formData+="&id_sopir="+id_sopir; // Menambahkan ID sopir ke data form
      }
      ACTION(urlPost, formData); // Melakukan aksi (simpan/update)
      $("#modal_add").modal('hide'); // Menyembunyikan modal
    })
  });

  // Fungsi untuk melakukan aksi (simpan/update)
  function ACTION(urlPost, formData){
      $.ajax({
          url: urlPost, // URL post
          type: "POST", // Metode post
          data: formData, // Data dari form
          dataType: "JSON", // Tipe data JSON
          beforeSend: function () {
            $("#LOADER").show(); // Menampilkan loader sebelum request
          },
          complete: function () {
            $("#LOADER").hide(); // Menyembunyikan loader setelah request
          },
          success: function(data){
            console.log(data)
            if (data.status == "success") {
              toastr.info(data.message) // Menampilkan pesan sukses
              REFRESH_DATA(); // Memuat ulang data tabel
            }else{
              toastr.error(data.message) // Menampilkan pesan error
            }
          }
      })
  }

  // Fungsi untuk memuat ulang data tabel
  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy(); // Menghancurkan instance DataTable yang ada
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]], // Urutan berdasarkan kolom pertama
      "pageLength": 25, // Panjang halaman
      "autoWidth": false, // Lebar otomatis
      "responsive": true, // Responsif
      "ajax": {
          "url": "<?= site_url('sopir/getAllSopir') ?>", // URL untuk mendapatkan semua data sopir
          "type": "GET" // Metode GET
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1; // Nomor urut
              }
          },
          { "data": "id_sopir" },
          { "data": "nm_sopir" },
          {
            "data": null, 
            "render": function(data, type, full, meta) {
              // Membuat dropdown untuk opsi aksi
              return `
                <div class="dropdown">
                  <button class="btn btn-sm btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" onclick='editSopir(${JSON.stringify(data)}, "${meta.row}");'><i class='fas fa-edit'></i> Edit</a>
                    <a class="dropdown-item" href="#" onclick='deleteSopir("${data.id_sopir}");'><i class='fas fa-trash'></i> Delete</a>
                  </div>
                </div>
              `;
            },
            className: "text-center"
          },
      ]
    })
  }

  // Fungsi untuk mengedit data user
  function editSopir(data, index){
    console.log(data)
    save_method = "edit"; // Menetapkan metode edit
    id_sopir = data.id_sopir; // Menetapkan ID user
    $("#modal_add .modal-title").text('Edit Data'); // Mengubah judul modal
    $("[name='nm_sopir']").val(data.nm_sopir);
    $("#modal_add").modal('show'); // Menampilkan modal
  }

  // Fungsi untuk menghapus data user
  function deleteSopir(id){
    if(!confirm('Delete this data?')) return; // Konfirmasi penghapusan

    urlPost = "<?= site_url('sopir/deleteData') ?>"; // URL untuk menghapus data
    formData = "id_sopir="+id; // Data yang akan dikirim
    ACTION(urlPost, formData); // Melakukan aksi hapus
  }
</script>
