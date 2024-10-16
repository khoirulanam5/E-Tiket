<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.css'); ?>">
<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-default collapsed-card"  style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Jadwal Bus</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">
              <div class="row">
                <div class="col-4">
                  <div class="form-group row">
                    <div class="col-sm-7">
                      <input type="text" class="form-control date" id="tgl_berangkat" onChange="REFRESH_DATA()" value="<?= date("Y-m-d"); ?>" placeholder="Tanggal Keberangkatan">
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-bordered" id="tb_jadwal">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Tiket Bus</th>
                    <th>Tipe Tiket</th>
                    <th>Nomor Bus</th>
                    <th>Tujuan</th>
                    <th>Jadwal Keberangkatan</th>
                    <th>Sudah Terisi</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <div class="card" style="margin-top: 1rem">
            <form id="FRM_DATA">
              <div class="card-header">
                <h3 class="card-title">Cek Tiket Bus</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <h5>Masukkan Nomor Tiket</h5>
                  <input type="text" class="form-control" name="id_penjualan_tiket">
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-info" id="BTN_CHECK">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <div class="col-8" id="lst_show" style="display: none;">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Last Scanned</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                  <table class="table table-bordered table-hover" id="tb_data">
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-secondary" id="BTN_CLOSE">Close</button>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- /.modal -->
  </section>
</div>

<!-- jQuery -->
<script src="<?= base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('/assets/adminlte/plugins/flatpickr/flatpickr.js'); ?>"></script>
<script>

  $(".date").flatpickr({
      dateFormat: "Y-m-d",
  });

  REFRESH_DATA()
  $(function(){
    $("#FRM_DATA").on('submit', function(event){
      event.preventDefault();
      $("#BTN_CLOSE").click(function(){
        $("#lst_show").hide("slow")
      })

      $.ajax({
        url: "<?= site_url('jadwal_tiket/getTiketById') ?>",
        type: "POST",
        data: {
          id_penjualan_tiket: $("[name='id_penjualan_tiket']").val()
        },
        dataType: "HTML",
        success: function(data){
          console.log(data)
          $("#tb_data").html(data)
          $("#lst_show").show("slow")
          $("[name='id_penjualan_tiket']").val("")
        },
        error: function (err) {
          console.log(err);
        }
      })
    })
  })

  function REFRESH_DATA(){
    $.ajax({
      url: "<?= site_url('jadwal_tiket/getJadwalByDate') ?>",
      dataType: "JSON",
      type: "POST",
      data: {
        tgl_berangkat: $("#tgl_berangkat").val()
      },
      success: function(data){
        // console.log(data)
        var row
        $.map( data['data'], function( val, i ) {
          console.log(val)
          row += "<tr>"+
                    "<td>"+i+"</td>"+
                    "<td>"+val.id_tiket_bus+"</td>"+
                    "<td>"+val.tipe_tiket+"</td>"+
                    "<td>"+val.no_pol+"</td>"+
                    "<td>"+val.tujuan+"</td>"+
                    "<td>"+val.tgl_keberangkatan+"</td>"+
                    "<td>"+val.tiket_scanned+"</td>"+
                  "</tr>"
          
        });
        $("#tb_jadwal tbody").html(row)
      }
    })
  }
</script>