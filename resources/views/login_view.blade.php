<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Maziltu Tholiban</title>

    <!-- Favicons -->
    <link href="/assets/logo-pondok.jpg" rel="icon">
    <link href="/assets/logo-pondok.jpg" rel="apple-touch-icon">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="/stisla/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/stisla/node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/stisla/assets/css/style.css">
  <link rel="stylesheet" href="/stisla/assets/css/components.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">

          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="/assets/logo-pondok.jpg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            @if (session()->has('captcha'))
            <div  data-aos="fade-down-right">
              <div class="alert alert-danger text-center" role="alert">
                {{session('captcha')}}
              </div>
            </div>
            @endif
            <div class="card card-primary">

              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="/login-aksi" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="id_anggota">ID Anggota</label>
                    <input id="id_anggota" type="number" class="form-control" name="id_anggota" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        tolong masukan ID Anggota anda
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      tolong masukan password anda
                    </div>
                  </div>
                  <div class="form-group">
                @csrf
                    <div class="g-recaptcha" data-sitekey="6LfyeFsqAAAAADshwLvT2CTPs_y1YBjjw7dztckP" required></div>
                    <div class="invalid-feedback">
                      tolong masukan password anda
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->

  <script src="stisla/assets/jquery.min.js"></script>


  <script>
    window.addEventListener('load', () => {
  const $recaptcha = document.querySelector('.g-recaptcha-response');
  if ($recaptcha) {
    $recaptcha.setAttribute('required', 'required');
  }
})
  </script>
  <script src="/stisla/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="/stisla/assets/js/popper.min.js"></script>
  <script src="/stisla/assets/js/bootstrap.min.js"></script>
  <script src="/stisla/assets/js/jquery.nicescroll.min.js"></script>
  <script src="/stisla/assets/js/moment.min.js"></script>
  <script src="/stisla/assets/js/scripts.js"></script>
  <script src="/stisla/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
