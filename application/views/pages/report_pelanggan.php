<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<div class="content-wrapper">  
  <section class="content">
    <div class="container-fluid">
        <form action="<?= base_url('report/ctkPelanggan') ?>" method="POST" target="_blank">
            <div class="row">
                <div class="col-12">
                <div class="card" style="margin-top: 1rem">
                    <div class="card-header">
                    <h3 class="card-title">Data Pelanggan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button class="btn btn-default" style="margin-bottom: 10px;" id="proses"><i class="fas fa-print"></i> Cetak</button>
                        <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                          <thead>
                          <tr>
                            <th style="width: 25px;">No.</th>
                            <th>ID Pelanggan</th>
                            <th>Nama</th>
                            <th>Telp</th>
                            <th>Alamat</th>
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
        </form>
    </div>
  </section>
</div>


<script src="<?= base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
<script>
  var save_method;
  var id_edit;
  var tb_data;
  $(function () {
    
    $(".datepicker").datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    REFRESH_DATA()

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
          { "data": "id_pelanggan" },{ "data": "nm_pelanggan" },
          { "data": "no_pelanggan" },{ "data": "alamat_pelanggan" },
      ]
    })
  }

  });

  
</script>