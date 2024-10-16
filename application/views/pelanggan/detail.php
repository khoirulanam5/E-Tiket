<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?php echo base_url('/assets/front/images/') ?>kalingga_bus.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo base_url('/sewabus/front/gallery/') ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
        <h1 class="mb-3 bread">Pilih Bus keinginan Anda</h1>
      </div>
    </div>
  </div>
</section>
  
<section class="ftco-section ftco-car-details">
  <div class="container">
    <!-- <style>
      .car-details {
        display: flex;
        justify-content: space-between;
      }

      .car-details .img {
        width: 88%;
        background-size: cover;
        background-position: center;
      }

      .car-details .img-foto {
        height: 800px;
      }

      .car-details .img-denah {
        width: 40%;
        height: 800px;
        background-size: contain; /* Ensure the entire image fits without being cut off */
        background-repeat: no-repeat; /* Prevent repeating if the image is smaller than the container */
      }
    </style> -->
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="car-details d-flex justify-content-between">
          <div class="img img-foto" style="background-image: url('<?php echo base_url('/assets/images/'.$data[0]['foto']) ?>');"></div>
        </div>
        <div class="text text-center">
          <!-- <span class="subheading"><?php echo $data[0]['no_pol'] ?></span> -->
          <h2><?php echo $data[0]['nm_jenis_bus'] ?></h2>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 pills">
        <div class="bd-example bd-example-tabs">
          <div class="d-flex justify-content-center">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Deskripsi Harga & Fasilitas</a>
              </li>
            </ul>
          </div>

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
              <p><?php echo $data[0]['deskripsi']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
