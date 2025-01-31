<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pengelolaan Aset </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/adminlte.min.css?v=3.2.0') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/summernote/summernote-bs4.min.css')?>">
     <style>
        /* Tambahkan ini ke file CSS kustom Anda */
        .ugm {
            background-color: #083D62 !important; /* Warna biru UGM */
            color: #ffffff; /* Warna teks putih agar kontras */
        }

        /* Jika Anda ingin mengubah warna teks link di sidebar */
        .ugm .nav-link {
            color: #ffffff; /* Warna link */
        }

        .ugm .nav-link:hover {
            background-color: #0A4E8A; /* Warna saat hover */
        }
        
        .main-sidebar{
          background-color: #ffffff;
        }
        .nav-sidebar .nav-link {
          color: #333333; /* Mengatur warna teks menjadi gelap */
        }
        .nav-sidebar .nav-link:hover {
            background-color: #f0f0f0; /* Warna latar belakang saat hover */
            color: #0A4E8A;
        }
        .nav-icon {
            color: #333333; /* Mengatur warna ikon menjadi gelap */
        }
        .logo-container {
            display: flex; /* Menggunakan flexbox untuk menempatkan gambar berdampingan */
            align-items: center; /* Memastikan gambar terpusat secara vertikal */
        }

        .logo-container {
            max-width: 100%; 
            height: auto; /* Menjaga rasio aspek gambar */
            margin-left: 5px; /* Menambahkan jarak antara gambar */
        }
        .logo-container img {
            width: 100px; 
            height: auto;
            padding-left: 10px;
            margin-top: -15px;
        } 
        
    </style>   
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand ugm navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-inverse"> </i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Menampilkan nama user -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2" style="color:white"><?= session()->get('username') ?></span>  
                  <i class="far fa-user fa-inverse" style="color:white;"></i> 
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item"  data-toggle="modal" data-target="#ganti_password">Ganti Password</a>
                    <a class="dropdown-item" href="logout">Logout</a>
                </div>
            </li>
        </ul>
  </nav>
  <aside class="main-sidebar sidebar-light elevation-4">
    <!-- Brand Logo -->
    <div class="logo-container">
    
      <img src="<?= base_url('adminLTE/dist/img/ugm/LogoDashboard.png') ?>" alt="Logo" class="img-fluid logo" style="opacity: .8">
      <img src="<?= base_url('adminLTE/dist/img/ugm/logokata.png') ?>" alt="Logo Kata" class="img-fluid" style="opacity: .8">
    </div>
    

    <!-- Sidebar -->
    
<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=base_url('dashboard') ?>" class="nav-link <?= url_is('dashboard') ? 'active' : '' ?>">
               <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          <li class="nav-item">
            <a href="<?=base_url('data_aset') ?>" class="nav-link <?= url_is('data_aset') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data aset
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="<?=base_url('user') ?>" class="nav-link <?= url_is('user') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          </ul>
      </nav>
    </div>
  </aside>
</div>
<div class="modal fade" id="ganti_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="ganti_password" action="<?= base_url('user/ganti_password') ?>" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label for="password"> Password lama</label>
                <input type="password" class="form-control" id="nama" name="password_lama" placeholder="Masukkan password lama" required>
              </div>
              <div class="form-group">
                <label for="password">Password baru</label>
                <input type="password" class="form-control" id="kode" name="password_baru" placeholder="Masukkan password baru" required>
              </div>
              <div class="form-group">
                <label for="password">Ulangi Password baru</label>
                <input type="password" class="form-control" id="kode" name="konfirmasi_password" placeholder="Ulangi password baru" required>
              </div>
              
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>

