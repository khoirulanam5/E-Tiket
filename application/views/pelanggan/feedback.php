<style>
  .table tbody tr td {
    padding: 10px!important;
  }
</style>
<style>
    .btn {
              /* Menggunakan background gradient dari atas ke bawah dan background-size */
              background-image: linear-gradient(180deg, black 50%, transparent 50%);
              background-size: 200% 200%;
              background-position: bottom;
              /* Transisi halus pada background-position */
              transition: background-position 0.3s;
          }
          /* Efek ketika hover */
          .btn:hover {
              /* Menggeser background untuk memunculkan warna dari bawah */
              background-position: top;
          }
  </style>
<!-- head bg -->
<div class="hero-wrap" style="background-image: url('<?= base_url('/assets/front/images/') ?>kalingga_bus.jpg ');" data-stellar-background-ratio="0.5">
    <div class="overlay">
  </div>

    <!-- content -->
    <div class="container">
      <div class="row no-gutters  justify-content-start align-items-center" style="padding-top: 100px;">
        <div class="col-lg-12 col-md-12">
          <div class="row">
            <div class="col-md-3" style="background-color: #0C2F91;padding: 20px;">
              <div class="d-flex flex-md-column list-group" id="list-tab" role="tablist">
                <a class="list-group-item active" id="list-ticket-list" data-toggle="list" href="#list-ticket" role="tab" aria-controls="ticket" aria-selected="false">
                  <i class="fas fa-ticket-alt"></i>
                  <span style="font-size:14px;">Feedback</span>
                </a>
              </div>
            </div>
            <div class="col-md-9" style="background-color: #fff;padding: 20px;">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade bordered show active" id="list-ticket" role="tabpanel" aria-labelledby="list-ticket-list">
                  <form >
                    <div class="d-md-flex mt-2">
                      <div class="form-group col-12 col-md-12">
                        <label for="" class="label">Masukkan Nomor Tiket Anda</label>
                        <input type="text" class="form-control" name="id_penjualan_tiket" placeholder="Masukkan Nomor Tiket Anda">
                      </div>
                    </div>
                    <div class="d-md-flex">
                      <div class="form-group col-12 col-md-12" style="text-align: right;">
                        <button type="button" id="btnFeedback" class="btn btn-info py-3 px-4"><i class="fas fa-search"></i> isi Feedback</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- endcontent -->

<!-- content tabel feedback -->
<section class="ftco-section" id="colFeedback">
  <div class="container" style="max-width:1200px;">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 text-center d-flex ftco-animate">
        <form id="FRM_DATA" action="">
          <div class="blog-entry justify-content-end" style="display:none;" id="showRow">
            <table class="table table-bordered" style="font-size:14px;" id="tbFeedback">

            </table>
            <textarea name="saran" style="font-size:12px;" class="form-control" rows="3" placeholder="Saran dan masukan untuk kami"></textarea>
            <div class="d-md-flex" style="margin-top: 10px;">
              <div class="form-group col-12 col-md-12">
                <button type="button" id="BTN_SAVE" class="btn btn-info"><i class="fas fa-save"></i> SUBMIT</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- endcontent -->
<script src="<?= base_url('/assets/front/js/jquery.min.js'); ?>"></script>

<!-- PROSES LOGIKA -->
<script>
  function ISI_TABLE(){
    $.ajax({
      url: "<?= site_url('/front/getParameter') ?>",
      type: "POST",
      dataType: "HTML",
      data:{
        id_penjualan_tiket: $("#id_penjualan_tiket").val()
      },
      success: function(data){
        $("#tbFeedback").html(data)
      }
    })
  }

  $(document).ready(function (){
      $("#btnFeedback").click(function (){
          $('html, body').animate({
              scrollTop: $("#colFeedback").offset().top
          }, 1500);
          ISI_TABLE()
          $("#showRow").css("display","")
      });
  });

  $("#BTN_SAVE").click(function(){
    event.preventDefault();
    var formData = $("#FRM_DATA").serialize();
    formData+="&id_penjualan_tiket="+$("[name='id_penjualan_tiket']").val()
    urlPost = "<?= site_url('front/saveData') ?>";
    console.log(formData)
    ACTION(urlPost, formData)
  })

  function ACTION(urlPost, formData){
      $.ajax({
          url: urlPost,
          type: "POST",
          data: formData,
          dataType: "JSON",
          success: function(data){
            alert(data.message)
            window.location="<?= base_url('front/feedback');?>"
          }
      })
  }
</script>