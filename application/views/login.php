<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>PO. Kalingga Jaya</title>
  <link rel="shortcut icon" type="image/icon" href="<?= base_url('/assets/furn/assets/logo/kalingga.png'); ?>"/>
  <link rel="stylesheet" href="<?= base_url('/assets/login/style.css'); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/assets/adminlte/plugins/toastr/toastr.min.css'); ?>">
  <style>
    .hero-wrap {
        width: 100%;
        height: 850px;
        position: inherit;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top center;
    }
  </style>
  
</head>
<body class="hero-wrap" style="background-image: url('<?= base_url('/assets/front/images/') ?>kalingga_bus.jpg ');">

<!-- content login -->
    <div class="main">
      <div class="container a-container" id="a-container">
        <form class="form" id="FRM_DATA" method="" action="">
          <h2 class="form_title title">Masuk ke Website</h2>
          <input class="form__input" type="text" name="username" placeholder="Username">
          <input class="form__input" type="password" name="password" placeholder="Password">
          <button class="switch__button button switch-btn" type="submit">Masuk</button>
        </form>
      </div>
<!-- endcontent -->

<!-- content register -->
      <div class="container b-container" id="b-container">
        <form class="form" id="FRM_REGISTER" method="" action="">
          <h2 class="form_title title">Buat Akun</h2>
          <input class="form__input" type="text" name="nm_pelanggan" placeholder="Nama Lengkap">
          <input class="form__input" type="text" name="no_pelanggan" placeholder="No. Telpone">
          <textarea name="alamat_pelanggan" class="form__input" style="height:unset;padding-top: 10px;" rows="3" placeholder="Alamat"></textarea>
          <input class="form__input" type="text" name="username" placeholder="Username">
          <input class="form__input" type="password" name="password" placeholder="Password">
          <button class="switch__button button switch-btn" type="submit">Daftar</button>
        </form>
      </div>
<!-- endcontent -->

<!-- regist -->
      <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
          <h2 class="switch__title title">Selamat Datang</h2>
          <p class="switch__description description" style="color: #fff;">untuk dapat terhubung dengan kami, silahkan masuk dengan akun pribadi anda</p>
          <button class="switch__button button switch-btn">Daftar</button>
        </div>

<!-- login -->
        <div class="switch__container is-hidden" id="switch-c2">
          <h2 class="switch__title title">Halo Temanku!!</h2>
          <p class="switch__description description" style="color: #fff;">masukan data pribadi anda dan mulailah perjalanan bersama kami</p>
          <button class="switch__button button switch-btn">Masuk</button>
        </div>
      </div>
    </div>

<!-- partial -->
  <script  src="<?= base_url('/assets/login/script.js'); ?>"></script>
  <!-- jQuery -->
  <script src="<?= base_url('/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('/assets/adminlte/plugins/toastr/toastr.min.js'); ?>"></script>



<!-- PROSES LOGIKA -->
  <script>
    $(function(){
      $("#FRM_DATA").submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "<?= site_url('login/login') ?>",
            type: "POST",
            data: formData,
            dataType: "JSON",
            success: function(data){
              if (data.status == "success") {
                window.location="<?= base_url('home');?>"
              }else{
                toastr.error(data.message)
              }
            }
        })
      })

      $("#FRM_REGISTER").submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "<?= site_url('login/signUp') ?>",
            type: "POST",
            data: formData,
            dataType: "JSON",
            success: function(data){
              console.log(data)
              if (data.status == "success") {
                alert('Pendaftaran Berhasil')
                window.location="<?= base_url('front/login');?>"
              }else{
                toastr.error(data.message)
              }
            }
        })
      })
    })
  </script>
</body>
</html>
