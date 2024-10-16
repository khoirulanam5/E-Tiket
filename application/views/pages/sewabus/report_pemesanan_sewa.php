<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
        

        <div class="row">
          <div class="col-12">
          <div class="card" style="margin-top: 1rem">
              <div class="card-header">
                <h3 class="card-title">Data Penyewaan Bus</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?= base_url('sewabus/report_sewa/ctkPemesanan') ?>" method="POST" target="_blank">
                  <div class="row">
                      <div class="col-2" style="margin-bottom: 10px;">
                          <input type="text" class="form-control datepicker" name="start_date" placeholder="Dari">
                      </div>
                      <div class="col-2" style="margin-bottom: 10px;">
                          <input type="text" class="form-control datepicker" name="end_date"  placeholder="Sampai">
                      </div>
                      <div class="col-6" style="margin-bottom: 10px;">
                          <button type="button" class="btn btn-default" id="btnCari"><i class="fas fa-search"></i> Tampil</button>
                          <button class="btn btn-default" id="proses"><i class="fas fa-print"></i> Cetak</button>
                      </div>
                  </div>
                </form>
                <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                  <thead>
                  <tr>
                    <th>ID Sewa</th>
                    <th>ID Ketersediaan Bus</th>
                    <th>Tujuan</th>
                    <th>Tgl Keberangkatan</th>
                    <th>Tgl Pengembalian</th>
                    <th>Pelanggan</th>
                    <th>Tgl Pembelian</th>
                    <th>Jenis Pembelian</th>
                    <th>Pembayaran</th>
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
  </section>
</div>

<script src="<?= base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script>
  var save_method;
  var id_edit;
  var tb_data;

  $(function () {
    // Initialize datepicker
    $(".datepicker").datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    // Search button click event
    $("#btnCari").click(function() {
      // Destroy the previous DataTable instance
      $('#tb_data').DataTable().destroy();

      // Initialize DataTable with new data
      tb_data = $("#tb_data").DataTable({
        "order": [[0, "asc"]],
        "autoWidth": false,
        "responsive": true,
        "pageLength": 25,
        "ajax": {
          "url": "<?= site_url('sewabus/report_sewa/getPenjualan') ?>",
          "data": {
            "start_date": $("[name='start_date']").val(),
            "end_date": $("[name='end_date']").val()
          },
          "type": "POST"
        },
        "columns": [
          { "data": "id_sewa_bus" },
          { "data": "id_ketersediaan_bus" },
          { "data": "tujuan" },
          { "data": "tgl_keberangkatan" },
          { "data": "tgl_pengembalian" },
          { "data": "nm_pelanggan" },
          { "data": "tgl_pembelian" },
          { "data": "jenis_penyewaan" },
          { "data": "nominal" }
        ]
      });
    });
  });
</script>