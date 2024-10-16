<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2/css/select2.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

<div class="content-wrapper">  
  <section class="content">
    <form id="FRM_DATA">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="card" style="margin-top: 1rem">
              <div class="card-header">
                <h3 class="card-title">Data Kepuasan Pelanggan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <label>ID Penjualan Tiket Bus</label>
                  <select name="id_tiket_bus" class="form-control select2" onChange="hitungKepuasan()"></select>
                </div>
                <div class="form-group">
                  <label>Nilai Kepuasan Pelanggan</label>
                  <input type="text" class="form-control" name="nilai_kepuasan" readonly>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-primary" id="BTN_SAVE">Save</button>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card" style="margin-top: 1rem">
              <div class="card-body" id="hasil">
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
    </form>
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
    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset()
      save_method = "save"
      $("#modal_add .modal-title").text('Add Data')
      $("#modal_add").modal('show')
    }) 

    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize();
      urlPost = "<?= site_url('kepuasan/saveData') ?>";
      // console.log(formData)
      ACTION(urlPost, formData)
    })
  });

  function ACTION(urlPost, formData){
      $.ajax({
          url: urlPost,
          type: "POST",
          data: formData,
          dataType: "JSON",
          success: function(data){
            // console.log(data)
            if (data.status == "success") {
              alert(data.message)
              window.location="<?= base_url('kepuasan/');?>"
            }else{
              toastr.error(data.message)
            }
          }
      })
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
      dataType: "HTML",
      success: function(data){
        console.log(data)
        $("#hasil").html(data)
        var nilai = $("[name='nilai_sevqual']").val()
        $("[name='nilai_kepuasan']").val(nilai)
      }
    })
  }
</script>