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
              <h3 class="card-title">Data Ketersediaan Bus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th style="min-width: 50px;">ID Bus Sewa</th>
                  <th style="min-width: 50px;">Tipe Bus</th>
                  <th style="min-width: 50px;">Jumlah Kursi</th>
                  <th style="min-width: 50px;">Jumlah Bus</th>
                  <th style="min-width: 80px;">Foto</th>
                  <th style="min-width: 80px;">Denah Kursi</th>
                  <th style="min-width: 100px;">Deskripsi</th>
                  <th style="min-width: 50px;">Aksi</th>
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
          <form id="FRM_DATA" method="post" enctype="multipart/form-data">
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
                      <label>Tipe Bus</label>
                      <select name="id_jenis_bus_sewa" class="form-control"></select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Kategori Bus</label>
                      <select name="id_kategori" class="form-control"></select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jumlah Bus</label>
                      <input type="text" class="form-control" name="jumlah_bus" 
                        onkeypress="return onlyNumberKey(event)" maxlength="3">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jumlah Kursi</label>
                      <input type="text" class="form-control" name="waktu_keberangkatan" >
                    </div>
                  </div>
                </div>
              <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Foto Bus</label>
                  <input type="file" name="foto" class="form-control">
                </div>
              </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Denah Kursi Bus</label>
                  <input type="file" name="denah_kursi" class="form-control">
                </div>
              </div>
            </div>
                <div class="form-group">
                  <label>Deskripsi Bus</label>
                  <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                </div>
              </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="BTN_SAVE">Save</button>
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
  var save_method; // Variabel untuk metode simpan
  var id_edit; // Variabel untuk menyimpan ID yang sedang diedit
  var id_user; // Variabel ID user

  $(function () {
    REFRESH_DATA() // Memuat ulang data saat halaman pertama kali dibuka
    ISI_SELECT() // Mengisi dropdown saat halaman pertama kali dibuka
    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset() // Mereset form saat tombol tambah data diklik
      save_method = "save" // Set metode menjadi save
      $("#modal_add .modal-title").text('Add Data') // Mengubah judul modal menjadi Add Data
      $("#modal_add").modal('show') // Menampilkan modal tambah data
    }) 
  });

  function ISI_SELECT(){
    // Mengisi dropdown Jenis Bus
    $.ajax({
      url: "<?= site_url('sewabus/bus_sewa/getJenisBus') ?>",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        console.log(data)
        $.map( data['data'], function( val, i ) {
          $("[name='id_jenis_bus_sewa']").append("<option value='"+val.id_jenis_bus_sewa+"'>"+val.nm_jenis_bus_sewa+"</option>")
        });
      }
    })

    // Mengisi dropdown Kategori Bus
    $.ajax({
      url: "<?= site_url('sewabus/bus_sewa/getKategoriBus') ?>",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        console.log(data)
        $.map( data['data'], function( val, i ) {
          $("[name='id_kategori']").append("<option value='"+val.id_kategori+"'>"+val.nm_kategori+"</option>")
        });
      }
    })
  }

  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy(); // Menghancurkan DataTable yang sudah ada
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]], // Mengurutkan data berdasarkan kolom pertama
      "autoWidth": false, // Menonaktifkan lebar otomatis
      "responsive": true, // Mengaktifkan fitur responsif
      "pageLength": 25, // Mengatur jumlah data yang ditampilkan per halaman
      "ajax": {
          "url": "<?= site_url('sewabus/bus_sewa/getAllData') ?>", // URL untuk mengambil data
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1; // Menampilkan nomor urut
              }
          },
          { "data": "id_bus_sewa" }, // Menampilkan ID Bus
          { "data": "nm_jenis_bus_sewa" }, // Menampilkan Jenis Bus
          { "data": "waktu_keberangkatan" }, // Menampilkan waktu keberangkatan
          { "data": "jumlah_bus" }, // Menampilkan Jumlah Kursi
          { "data": "foto", 
            "render" : function(data){
              if(data == ""){
                return "Tidak ada Foto" // Menampilkan pesan jika tidak ada foto
              }else{
                return "<a target='_blank' href='<?= base_url() ?>assets/images/"+data+"'><img  style='max-width: 120px;' class='img-fluid' src='<?= base_url() ?>assets/images/"+data+"' ></a>" // Menampilkan foto jika ada
              }
              
            },
            className: "text-center" // Menempatkan konten di tengah
          },
          { "data": "denah_kursi", 
            "render" : function(data){
              if(data == ""){
                return "Tidak ada Foto" // Menampilkan pesan jika tidak ada foto
              }else{
                return "<a target='_blank' href='<?= base_url() ?>assets/images/"+data+"'><img  style='max-width: 120px;' class='img-fluid' src='<?= base_url() ?>assets/images/"+data+"' ></a>" // Menampilkan foto jika ada
              }
              
            },
            className: "text-center" // Menempatkan konten di tengah
          },
          { "data": "deskripsi" }, // Menampilkan deskripsi
          { "data": null, 
            "render" : function(data){
              return "<div class='dropdown'>" +
                       "<button class='btn btn-primary' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi</button>" +
                       "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                         "<a class='dropdown-item' href='javascript:void(0)' onclick='editData("+ JSON.stringify(data) +");'><i class='fas fa-edit'></i> Edit</a>" +
                         "<a class='dropdown-item' href='javascript:void(0)' onclick='deleteData(\""+ data.id_bus_sewa +"\");'><i class='fas fa-trash'></i> Delete</a>" +
                       "</div>" +
                     "</div>"; // Membuat dropdown untuk aksi Edit dan Delete
            },
            className: "text-center" // Menempatkan konten di tengah
          },
      ]
    })
  }

  function ACTION(urlPost, formData){
      $.ajax({
          url: urlPost,
          type: "POST",
          data: formData,
          dataType: "JSON",
          success: function(data){
            if (data.status == "success") {
              toastr.info(data.message) // Menampilkan pesan sukses
              REFRESH_DATA() // Memuat ulang data setelah sukses
            } else {
              toastr.error(data.message) // Menampilkan pesan error
            }
          },
          error: function (err) {
            console.log(err); // Menampilkan error di konsol jika terjadi kesalahan
          }
      })
  }

  $("#FRM_DATA").on('submit', function(event){
    event.preventDefault(); // Mencegah form dari reload halaman saat submit
    let formData = new FormData(this); // Mengambil data form
    if(save_method == 'save') {
        urlPost = "<?= site_url('sewabus/bus_sewa/saveData') ?>"; // URL untuk menyimpan data baru
    } else {
        urlPost = "<?= site_url('sewabus/bus_sewa/updateData/') ?>" + id_edit; // URL untuk memperbarui data
    }

    $.ajax({
      url: urlPost,
      type: "POST",
      data: formData,
      processData: false, // Mengatur agar data tidak diproses
      cache: false, // Mengatur agar tidak menggunakan cache
      contentType: false, // Mengatur agar tidak menggunakan contentType
      success: function(data){
        data = JSON.parse(data); // Parse JSON data dari server
        if (data.status == "success") {
          toastr.info(data.message); // Menampilkan pesan sukses
          REFRESH_DATA(); // Memuat ulang data setelah sukses
          $("#modal_add").modal('hide'); // Menyembunyikan modal
        } else {
          toastr.error(data.message); // Menampilkan pesan error
        }
      },
      error: function (err) {
        console.log(err); // Menampilkan error di konsol jika terjadi kesalahan
      }
    })
  })

  function editData(data){
    save_method = "edit"; // Set metode menjadi edit
    id_edit = data.id_bus_sewa; // Set ID data yang akan diedit
    $("#modal_add .modal-title").text('Edit Data'); // Mengubah judul modal menjadi Edit Data
    $("[name='id_jenis_bus_sewa']").val(data.id_jenis_bus_sewa); // Mengisi dropdown Jenis Bus
    $("[name='id_kategori']").val(data.id_kategori); // Mengisi dropdown Kategori Bus
    $("[name='jumlah_bus']").val(data.jumlah_bus); // Mengisi jumlah kursi
    $("[name='waktu_keberangkatan']").val(data.waktu_keberangkatan); // Mengisi no polisi
    $("[name='deskripsi']").val(data.deskripsi); // Mengisi deskripsi
    $("#modal_add").modal('show'); // Menampilkan modal
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return; // Konfirmasi sebelum menghapus data
    urlPost = "<?= site_url('sewabus/bus_sewa/deleteData') ?>"; // URL untuk menghapus data
    formData = "id_bus_sewa=" + id; // Menyiapkan data yang akan dikirim
    ACTION(urlPost, formData); // Mengirim data ke server
  }

  function onlyNumberKey(evt) {
      // Hanya karakter ASCII dalam rentang tertentu yang diperbolehkan
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
          return false; // Memastikan hanya angka yang diperbolehkan
      return true; // Memungkinkan input
  }
</script>
