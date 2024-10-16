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
              <h3 class="card-title">Data Pelanggan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Pelanggan</th>
                  <th>ID User</th>
                  <th>Nama</th>
                  <th>Telp</th>
                  <th>Alamat</th>
                  <th>Username</th>
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

    <!-- TAMBAH DAN EDIT DATA PELANGGAN -->
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
                      <label>Nama</label>
                      <input type="text" class="form-control" name="nm_pelanggan">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Telp/No. HP</label>
                      <input type="text" class="form-control" name="no_pelanggan">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat_pelanggan" rows="3"></textarea>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password">
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
      </div>
    </div>
    <!-- END TAMBAH DAN EDIT DATA PELANGGAN -->
  </section>
</div>
<!-- jQuery -->
<script src="<?= base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>


<!-- PROSES DATA (LOGIKA) -->
<script>
  var save_method;
  var id_edit;
  var id_user;
  $(function () {
    
    REFRESH_DATA()

    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset()
      save_method = "save"
      $("#modal_add .modal-title").text('Add Data')
      $("#modal_add").modal('show')
    }) 

    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize();
      if(save_method == 'save') {
          urlPost = "<?= site_url('pelanggan/saveData') ?>";
      }else{
          urlPost = "<?= site_url('pelanggan/updateData') ?>";
          formData+="&id_pelanggan="+id_edit+"&id_user="+id_user
      }
      // console.log(formData)
      ACTION(urlPost, formData)
      $("#modal_add").modal('hide')
    })
  });

  function REFRESH_DATA(){
    $('#tb_data').DataTable().destroy();
    var tb_data = $("#tb_data").DataTable({
      "order": [[ 0, "asc" ]],
      "autoWidth": false,
      "responsive": true,
      "pageLength": 25,
      "ajax": {
          "url": "<?= site_url('pelanggan/getAllData') ?>",
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "id_pelanggan" },
          { "data": "id_user" },
          { "data": "nm_pelanggan" },
          { "data": "no_pelanggan" },
          { "data": "alamat_pelanggan" },
          { "data": "username" },
          { "data": null, 
            "render" : function(data){
              return `
                <div class="btn-group">
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)" onclick='editData(${JSON.stringify(data)})'><i class='fas fa-edit'></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick='deleteData("${data.id_pelanggan}")'><i class='fas fa-trash'></i> Delete</a>
                  </div>
                </div>
              `;
            },
            className: "text-center"
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
          beforeSend: function () {
            $("#LOADER").show();
          },
          complete: function () {
            $("#LOADER").hide();
          },
          success: function(data){
            // console.log(data)
            if (data.status == "success") {
              toastr.info(data.message)

              REFRESH_DATA()

            }else{
              toastr.error(data.message)
            }
          }
      })
  }

  function editData(data){
    console.log(data)
    save_method = "edit"
    id_edit = data.id_pelanggan;
    id_user = data.id_user
    console.log(id_user)
    $("#modal_add .modal-title").text('Edit Data')
    $("[name='nm_pelanggan']").val(data.nm_pelanggan)
    $("[name='no_pelanggan']").val(data.no_pelanggan)
    $("[name='alamat_pelanggan']").val(data.alamat_pelanggan)
    $("[name='username']").val(data.username)
    $("[name='password']").val(data.password)
    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?= site_url('pelanggan/deleteData') ?>";
    formData = "id_pelanggan="+id
    ACTION(urlPost, formData)
  }
</script>
<!-- END PROSES -->
