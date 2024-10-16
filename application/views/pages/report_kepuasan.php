<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2/css/select2.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-8">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Data Kepuasan Pelanggan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php if($this->session->userdata('level') == "SEKERTARIS"){ ?>
                <a href="<?= base_url('kepuasan/addKepuasan') ?>" class="btn btn-sm btn-info" style="margin-bottom: 10px;" ><i class="fas fa-plus-circle"></i> Tambah</a>
              <?php } ?>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Penilaian</th>
                  <th>ID Tiket Bus</th>
                  <th>Nilai Kepuasan</th>
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
                <label>ID Tiket Bus</label>
                <select name="id_tiket_bus" class="form-control select2" onChange="hitungKepuasan()"></select>
              </div>
                  
              <div class="form-group">
                <label>Nilai Kepuasan</label>
                <input type="text" class="form-control" name="nilai_kepuasan" readonly>
              </div>
                
            </div>
              
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<!-- Select2 -->
<script src="<?= base_url('/assets/adminlte/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
  var save_method;
  var id_edit;
  var id_user;

  $('.select2').select2()
  ISI_TIKET()

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
          urlPost = "<?= site_url('jenis_bus/saveData') ?>";
      }else{
          urlPost = "<?= site_url('jenis_bus/updateData') ?>";
          formData+="&id_jenis_bus="+id_edit
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
          "url": "<?= site_url('kepuasan/getAllData') ?>",
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "id_penilaian" },
          { "data": "id_tiket_bus" },{ "data": "nilai_kepuasan" },
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

  function editData(data, index){
    console.log(data)
    save_method = "edit"
    id_edit = data.id_jenis_bus;


    $("#modal_add .modal-title").text('Edit Data')
    $("[name='id_jenis_bus']").val(data.id_jenis_bus)
    $("[name='nm_jenis_bus']").val(data.nm_jenis_bus)
    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?= site_url('kepuasan/deleteData') ?>";
    formData = "id_jenis_bus="+id
    ACTION(urlPost, formData)
  }

  function ISI_TIKET(){
    $.ajax({
      url: "<?= site_url('kepuasan/getTiket') ?>",
      type: "POST",
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_tiket_bus+"'>"+val.id_tiket_bus+" - "+val.no_pol+" - "+val.tujuan+" - "+val.tgl_keberangkatan+"</option>"
          
        });
        $("[name='id_tiket_bus']").html(row)
      }
    })
  }

  function hitungKepuasan(){
    $.ajax({
      url: "<?= site_url('kepuasan/getNilaiKepuasan') ?>",
      type: "POST",
      data: {
        id_tiket_bus: $("[name='id_tiket_bus']").val()
      },
      dataType: "JSON",
      success: function(data){
        console.log(data)
      }
    })
  }
</script>