
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
  <link rel="stylesheet" href="/stisla/node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="/stisla/node_modules/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="/stisla/node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="/stisla/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/stisla/assets/css/style.css">
  <link rel="stylesheet" href="/stisla/assets/css/components.css">

  <script src="/stisla/assets/jquery.min.js"></script>
 
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <a href="/logout" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="/logout" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @if (File::exists(asset('storage/' . $foto_profil)) && !empty($foto_profil))
              <img alt="image" src="/storage/{{$foto_profil}}" class="rounded-circle mr-1">
            @else
              <img alt="image" src="/assets/avatar-1.png" class="rounded-circle mr-1">
            @endif
            <div class="d-sm-none d-lg-inline-block">Hi, {{auth()->user()->name}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="/profil" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="/logout">Maziltu Tholiban</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MT</a>
          </div>
          <ul class="sidebar-menu">
            @if (in_array('dashboard', $status_akses))
            <li class="menu-header">Dashboard</li>
              <li class="mb-2 {{ 'dashboard' == request()->segment(1) ? 'active':'' }}"><a class="nav-link"  href="/dashboard"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            @endif
            @if (in_array('anggota', $status_akses))
            <li class="menu-header">Anggota</li>
              <li class="{{ 'tabel-anggota' == request()->segment(1) ? 'active':'' }}"><a class="nav-link" href="/tabel-anggota"><i class="far fa-user"></i> <span>Anggota</span></a></li>
            @endif
            @if (in_array('prisensi', $status_akses))
            <li class="menu-header">Prisensi</li>
              <li class="{{ 'tabel-prisensi' == request()->segment(1) ? 'active':'' }}"><a class="nav-link" href="/tabel-prisensi"><i class="fas fa-sticky-note"></i> <span>Prisensi</span></a></li>
            @endif
            @if (in_array('event', $status_akses)||in_array('berita', $status_akses))
              <li class="menu-header">Event dan Berita</li>
            @endif
            @if (in_array('event', $status_akses))
              <li class="mb-2 {{ 'tabel-event' == request()->segment(1) ? 'active':'' }}"><a class="nav-link" href="/tabel-event"><i class="fas fa-sticky-note"></i> <span>Event</span></a></li>
            @endif
            @if (in_array('berita', $status_akses))
              <li class="mb-2 {{ 'tabel-berita' == request()->segment(1) ? 'active':'' }}"><a class="nav-link" href="/tabel-berita"><i class="far fa-user"></i> <span>Berita</span></a></li>
            @endif 
            @if (in_array('id_card', $status_akses))
              <li class="mb-2 {{ 'id-card' == request()->segment(1) ? 'active':'' }}"><a class="nav-link" href="/id-card"><i class="far fa-id-card"></i> <span>ID Card</span></a></li>
            @endif  
            @if (in_array('event', $status_akses))
              <li class="mb-2 {{ 'tabel-event-transaksi' == request()->segment(1) ? 'active':'' }}"><a class="nav-link" href="/tabel-event-transaksi"><i class="far fa-sticky-note"></i> <span>Transaksi</span></a></li>
            @endif  
            @if (in_array('tampilan', $status_akses))
            <li class="menu-header">Tampilan</li>
              <li class="mb-2  {{ 'edit-carosel' == request()->segment(1) ? 'active':'' }}"><a class="nav-link" href="/edit-carosel"><i class="fas fa-pencil-ruler"></i> <span>Carosel</span></a></li>
              <li class="nav-item dropdown  
              {{ 'edit-info-pesantren' == request()->segment(1) ? 'active':'' }}
              {{ 'edit-info-mzt' == request()->segment(1) ? 'active':'' }}
              ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Tentang</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="/edit-info-pesantren">Tentang Pesantren</a></li>
                  <li><a class="nav-link" href="/edit-info-mzt">Tentang MZT</a></li>
                </ul>
              </li>
            @endif
              @if (in_array('profil', $status_akses))
            <li class="menu-header">Profil</li>
              <li class="{{ 'profil' == request()->segment(1) ? 'active':'' }} mb-2"><a class="nav-link" href="/profil"><i class="fas fa-user"></i> <span>Profil</span></a></li>
              @endif
              @if (in_array('aktivitas_user', $status_akses))
            <li class="menu-header">Log Anggota</li>
              <li class="{{ 'tabel-log-user' == request()->segment(1) ? 'active':'' }} mb-2"><a class="nav-link" href="/tabel-log-user"><i class="fas fa-user"></i> <span>Log Anggota</span></a></li>
              @endif
            </ul>
        </aside>
      </div>


      <script src="/assets/sweetalert.min.js"></script>
      <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          }); 
        </script>




      <!-- Main Content -->
      @yield('konten')

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2023 <div class="bullet"></div> Design By <a >Maziltu Tholiban</a>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->

  <script src="/stisla/assets/js/popper.min.js"></script>
  <script src="/stisla/assets/js/bootstrap.min.js"></script>
  <script src="/stisla/assets/js/jquery.nicescroll.min.js"></script>
  <script src="/stisla/assets/js/moment.min.js"></script>
  <script src="/stisla/assets/js/stisla.js"></script>



  <!-- Template JS File -->
  <script src="/stisla/assets/js/scripts.js"></script>
  <script src="/stisla/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="/stisla/assets/js/page/index.js"></script>


</body>
</html>
