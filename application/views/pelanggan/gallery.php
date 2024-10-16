<!-- HEAD -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?= base_url('/assets/front/images/') ?>kalingga_bus.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="<?= base_url() ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Tentang Kami <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Pilih Bus keinginan Anda</h1>
      </div>
    </div>
  </div>
</section>
<!-- ENDHEAD -->
  
<!-- CONTENT -->
<section class="ftco-section">
  <div class="container">
  <div class="row justify-content-center">
      <?php
        $data = $this->db->query("SELECT b.id_bus, a.id_jenis_bus, a.nm_jenis_bus, b.no_pol, 
        b.foto, b.deskripsi FROM tb_jenis_bus a
        INNER JOIN tb_bus b ON a.id_jenis_bus = b.id_jenis_bus")->result();        
        foreach($data as $row){
      ?>
        <div class="col-md-3">
          <div class="car-wrap ftco-animate">
            <div class="img d-flex align-items-end" style="background-image: url('<?= base_url('/assets/images/'.$row->foto) ?>');">
            </div>
            <div class="text p-4 text-center">
              <span><a href="<?= base_url("sewabus/front/detail/".$row->id_bus)?>">Lihat Detail<br><?= $row->nm_jenis_bus ?></a></span>
            </div>
          </div>
        </div>
      <?php
        }
      ?>
    </div>
  </div>
</section>
<!-- END CONTENT -->