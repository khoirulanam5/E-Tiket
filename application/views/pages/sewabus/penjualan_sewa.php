<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.css'); ?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2/css/select2.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">

<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Data Sewa Bus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php if($this->session->userdata('level') != "BENDAHARA"){ ?>
                <!-- <button class="btn btn-sm btn-info" style="margin-bottom: 10px;" id="add_data"><i class="fas fa-plus-circle"></i> Tambah</button> -->
              <?php } ?>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th style="width: 25px;">No.</th>
                  <th>ID Sewa</th>
                  <th>Tanggal<br>Pembelian</th>
                  <th>ID Kategori</th>
                  <th>Tanggal<br>Penyewaan</th>
                  <th>Tanggal<br>Pengembalian</th>
                  <th>Alamat<br>Penjemputan</th>
                  <th>Crew Bus</th>
                  <th>Jumlah Bus</th>
                  <?php if($this->session->userdata('level') != "BENDAHARA"){ ?>
                  <th style="min-width: 80px;">Aksi</th>
                  <?php } ?>
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
                      <label>Tanggal Penyewaan</label>
                      <input type="text" class="form-control date" name="tgl_keberangkatan" 
                      onChange="ISI_TUJUAN()" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tujuan</label>
                      <select class="form-control" name="tujuan" onChange="ISI_JENISBUS()"></select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Tipe Bus</label>
                      <select class="form-control" name="id_jenis_bus" onChange="ISI_BUS()"></select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Pilih Bus</label>
                      <select class="form-control" name="id_ketersediaan_bus" onChange="ISI_HARGA()"></select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>ID Pelanggan</label>
                      <select class="form-control select2" name="id_pelanggan" onChange="ISI_NM_PELANGGAN()" ></select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nama Pelanggan</label>
                      <input type="text" class="form-control" name="nm_pelanggan">
                    </div>
                  </div>
                </div>

                <div class="row">
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>No. Telpon</label>
                      <input type="text" class="form-control" name="no_pelanggan">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Jumlah Bus</label>
                      <input type="text" class="form-control" name="jumlah_pembelian" >
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group clearfix">
                      <h5 style="display: contents;">Bayar Sekarang? </h5>
                      <div class="icheck-primary d-inline">
                        <input type="checkbox"  id="cbbayar" checked="">
                        <label for="cbbayar">
                          Ya
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6" >
                    <div class="form-group">
                      <label>Harga Sewa</label>
                      <input type="text" class="form-control" name="harga" readonly>
                    </div>
                  </div>
                  <div class="col-sm-6"  id="frmBayar">
                    <div class="form-group">
                      <label>Jumlah Pembayaran</label>
                      <input type="text" class="form-control" name="nominal" readonly>
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
<!-- Select2 -->
<script src="<?= base_url('/assets/adminlte/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script>
  var save_method;
  var id_edit;
  var id_user;

  $(".datetime").flatpickr({
      enableTime: true,
      time_24hr: true,
      dateFormat: "Y-m-d H:i:S",
  });
  
  $(".date").flatpickr({
      dateFormat: "Y-m-d",
  });

  $('.select2').select2()

  $(function () {
    

    REFRESH_DATA()
    ISI_PELANGGAN()


    $("#add_data").click(function(){
      $("#FRM_DATA")[0].reset()
      save_method = "save"
      $("#modal_add .modal-title").text('Add Data')
      $("#modal_add").modal('show')
    }) 

    $("#cbbayar").change(function(){
      if($("#cbbayar").is(":checked") == true){
        $("#frmBayar").css("display", "")
      }else{
        $("#frmBayar").css("display", "none")
      }
      
    })

    $("#BTN_SAVE").click(function(){
      event.preventDefault();
      var formData = $("#FRM_DATA").serialize();

      
      if(save_method == 'save') {
          urlPost = "<?= site_url('sewabus/penjualan_sewa/saveData') ?>";
      }else{
          urlPost = "<?= site_url('sewabus/penjualan_sewa/updateData') ?>";
          formData+="&id_sewa_bus="+id_edit
      }

      if($("#cbbayar").is(":checked") == true){
        formData+="&bayar=true"
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
          "url": "<?= site_url('sewabus/penjualan_sewa/getAllData') ?>",
          "type": "GET"
      },
      "columns": [
          {
              "data": null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "id_sewa_bus" },
          { "data": "tgl_pembelian" },
          { "data": "tujuan" },
          { "data": "tgl_keberangkatan" },
          { "data": "tgl_pengembalian" },
          { "data": "penjemputan"},
          { "data": "crew_bus"},
          { "data": "jumlah_pembelian" },
          <?php if($this->session->userdata('level') != "BENDAHARA"){ ?>
          { "data": null, 
            "render" : function(data){
              if(data.jenis_penyewaan == "ONLINE"){
                return "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_sewa_bus+"\");'><i class='fas fa-trash'></i> Delete</button>"
              }else{
                return "<button class='btn btn-sm btn-warning' onclick='editData("+JSON.stringify(data)+");'><i class='fas fa-edit'></i> Edit</button><br> "+
                "<button class='btn btn-sm btn-danger' onclick='deleteData(\""+data.id_sewa_bus+"\");'><i class='fas fa-trash'></i> Delete</button>"
              }
              
            },
            className: "text-center"
          },
          <?php } ?>
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
    // console.log(data)
    save_method = "edit"
    id_edit = data.id_sewa_bus;

    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getPenjualanByID') ?>",
      type: "POST",
      data: {
        id_sewa_bus: id_edit
      },
      dataType: "JSON",
      success: function(data){
        console.log(data[0])
        $("[name='tgl_keberangkatan']").val(data[0].tgl_keberangkatan).change()
        setTimeout(() => {
          $("[name='tujuan']").val(data[0].tujuan).change()
        }, 500);

        setTimeout(() => {
          $("[name='id_jenis_bus']").val(data[0].id_jenis_bus).change()
        }, 1000);

        setTimeout(() => {
          $("[name='id_ketersediaan_bus']").val(data[0].id_ketersediaan_bus).change()
          $("[name='nm_pelanggan']").val(data[0].nm_pelanggan)
          $("[name='no_pelanggan']").val(data[0].no_pelanggan)
          var nominal = parseInt(data[0].jumlah_pembelian) * parseInt($("[name='harga']").val())
          $("[nominal='nominal']").val(nominal)
        }, 1500);

        setTimeout(() => {
          var nominal = parseInt(data[0].jumlah_pembelian) * parseInt($("[name='harga']").val())
          console.log(nominal)
          $("[name='nominal']").val(nominal)
        }, 2000);
        
        var $newOption = $("<option selected='selected'></option>").val(data[0].id_pelanggan).text(data[0].nm_pelanggan)
        $("[name='id_pelanggan']").append($newOption).trigger('change');
        
        $("[name='jumlah_pembelian']").val(data[0].jumlah_pembelian)
        
      }
    })


    $("#modal_add .modal-title").text('Edit Data')
    $("#modal_add").modal('show')
  }

  function deleteData(id){
    if(!confirm('Delete this data?')) return

    urlPost = "<?= site_url('sewabus/penjualan_sewa/deleteData') ?>";
    formData = "id_sewa_bus="+id
    ACTION(urlPost, formData)
  }

  function ISI_TUJUAN(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getTujuanBus') ?>",
      type: "POST",
      data: {
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.tujuan+"'>"+val.tujuan+"</option>"
          
        });
        $("[name='tujuan']").html(row)
      }
    })
    
  }

  function ISI_JENISBUS(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getJenisBus') ?>",
      type: "POST",
      data: {
        tujuan: $("[name='tujuan']").val(),
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_jenis_bus+"'>"+val.nm_jenis_bus+"</option>"
          
        });
        $("[name='id_jenis_bus']").html(row)
      }
    })
  }

  function ISI_BUS(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getBus') ?>",
      type: "POST",
      data: {
        tujuan: $("[name='tujuan']").val(),
        id_jenis_bus: $("[name='id_jenis_bus']").val(),
        tgl_berangkat: $("[name='tgl_keberangkatan']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_ketersediaan_bus+"'>"+val.waktu_keberangkatan+" - "+val.waktu_berangkat+"</option>"
          
        });
        $("[name='id_ketersediaan_bus']").html(row)
      }
    })
  }

  function ISI_PELANGGAN(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getPelanggan') ?>",
      type: "POST",
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        var row = "<option></option>"
        $.map( data['data'], function( val, i ) {
          row += "<option value='"+val.id_pelanggan+"'>"+val.id_pelanggan+" - "+val.nm_pelanggan+"</option>"
          
        });
        $("[name='id_pelanggan']").html(row)
      }
    })
  }

  function ISI_NM_PELANGGAN(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getNamaPelanggan') ?>",
      type: "POST",
      data: {
        id_pelanggan: $("[name='id_pelanggan']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data)
        $("[name='nm_pelanggan']").val(data['data'][0]['nm_pelanggan'])
        $("[name='no_pelanggan']").val(data['data'][0]['no_pelanggan'])
      }
    })
  }

  function ISI_HARGA(){
    $.ajax({
      url: "<?= site_url('sewabus/penjualan_sewa/getHarga') ?>",
      type: "POST",
      data: {
        id_ketersediaan_bus: $("[name='id_ketersediaan_bus']").val()
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data['data'])
        $("[name='harga_tiket']").val(data['data'][0]['harga'])
      }
    })
  }

  $("[name='jumlah_pembelian']").change(function(){
    var nominal = parseInt($("[name='jumlah_pembelian']").val()) * parseInt($("[name='harga_tiket']").val())
    $("[name='nominal']").val(nominal)
    
  })
</script>