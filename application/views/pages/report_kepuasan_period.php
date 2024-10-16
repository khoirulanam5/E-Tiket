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
        <div class="col-12">
          <div class="card" style="margin-top: 1rem">
            <div class="card-header">
              <h3 class="card-title">Kepuasan Pelanggan Periode</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?= base_url('report/ctkKepuasanPeriod') ?>" method="POST" target="_blank">
                <div class="row">
                    <div class="col-3" style="margin-bottom: 10px;">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No. Polisi</label>
                        <div class="col-sm-9">
                          <select name="id_bus" class="form-control">
                            <option value="ALL">ALL</option>
                            <?php
                              $data = $this->db->query("SELECT * FROM tb_bus Order By no_pol")->result_array();
                              foreach ($data as $row) {
                                echo "<option value='".$row['id_bus']."'>".$row['no_pol']."</option>";
                              }
                            ?>
                          </select>
                        </div>
                        
                      </div>
                        
                    </div>
                    <div class="col-2" style="margin-bottom: 10px;">
                        <input type="text" class="form-control datepicker" name="start_date" placeholder="Dari">
                    </div>
                    <div class="col-2" style="margin-bottom: 10px;">
                        <input type="text" class="form-control datepicker" name="end_date"  placeholder="Sampai">
                    </div>
                    <div class="col-5" style="margin-bottom: 10px;">
                        <button type="button" class="btn btn-default" id="btnCari"><i class="fas fa-search"></i> Tampil</button>
                        <button class="btn btn-default" id="proses"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                </div>
              </form>
              <table id="tb_data" class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                <tr>
                  <th>No. Polisi</th>
                  <th>Kategori</th>
                  <th>Tgl Keberangkatan</th>
                  <th>Pemberangkatan</th>
                  <th>Tujuan</th>
                  <th>Penumpang</th>
                  <th>Nilai Kepuasan (dari 100%)</th>
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

<!-- jQuery -->
<script src="<?= base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>

<script>


  $(function () {

    $(".datepicker").datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    $("#btnCari").click(function(){
      $('#tb_data').DataTable().destroy();
      var tb_data = $("#tb_data").DataTable({
        "order": [[ 0, "asc" ]],
        "autoWidth": false,
        "responsive": true,
        "pageLength": 25,
        "ajax": {
            "url": "<?= site_url('report/getKepuasanPeriod') ?>",
            "data": {
              "id_bus": $("[name='id_bus']").val(),
              "start_date": $("[name='start_date']").val(),
              "end_date": $("[name='end_date']").val()
            },
            "type": "POST"
        },
        "columns": [
            { "data": "no_pol" },
            { "data": "id_kategori" },{ "data": "tgl_keberangkatan" },{ "data": "kota_keberangkatan" },
            { "data": "tujuan" },{ "data": "jumlah_pelanggan" },
            { "data": "nilai_kepuasan" },
        ]
      })
    })
    

  })
  
</script>