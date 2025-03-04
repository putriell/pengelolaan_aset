<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pengelolaan Aset </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="adminLTE/plugins/select2/css/select2.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="adminLTE/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminLTE/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="adminLTE/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="adminLTE/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

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
        .table thead {
          background-color: #083D62;
          color: white;
        }
        .table tbody tr:nth-child(odd){
          background-color: #F0F9FF;
        }
        .table tbody tr:nth-child(even){
          background-color: #ffffff;
        }
        .small-box {
          padding-top: 12px; /* Tambahkan padding jika diperlukan */
        }
        .small-box .inner {
            text-align: center; /* Memusatkan teks di dalam box */
        }
        .main-sidebar{
          background-color: #ffffff;
        }
        .nav-sidebar .nav-link {
        color: #333333; /* Mengatur warna teks menjadi gelap */
        }
        .nav-sidebar .nav-link:hover {
            background-color: #f0f0f0; /* Warna latar belakang saat hover */
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

        /* .logo-container:last-child {
            padding-left: 100px;
             } */
        /* .logo-container:first-child {
            margin-left: 10px;
            } */
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
  <?php include 'navbar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <?php if (session()->get('unit') === 'admin'): ?>
      <div class="col-3">
      <form method="get" action="<?= base_url('dashboard') ?>">
        <div class="form-group">
            <select id="unitSelect" name="unit" class="select2 form-control" style="width: 100%;" onchange="this.form.submit()">
                <option value="" <?= empty($selected_unit) ? 'selected' : '' ?>>Semua Unit</option>
               
                  <?php if (!empty($unit)): ?>
                    <?php foreach ($unit as $units): ?>
                      <option value="<?= esc($units['unit']) ?>" 
                          <?= ($selected_unit == $units['unit']) ? 'selected' : '' ?>>
                          <?= esc($units['unit']) ?>
                      </option>

                    <?php endforeach; ?>
                    <?php else: ?>
                      <option value="" disabled>Tidak ada unit tersedia</option>
                  <?php endif; ?>
            </select>
        </div>
        
      </div>
      <?php endif; ?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info text-center">
              <div class="inner">
                <h3><?= esc($total_aset) ?></h3>
                <p>Total Aset</p>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= esc($aset_tesedia) ?><sup style="font-size: 20px"></sup></h3>

                <p>Aset Tersedia</p>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= esc($aset_rusak) ?></h3>

                <p>Aset Rusak</p>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= esc($aset_hilang) ?></h3>

                <p>Aset Hilang</p>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> Jumlah Aset</h3>
        </div>
              <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Aset</th>
                    
                    <th>Jenis Aset</th>
                    <th>Total</th>
                    <!-- <th>Detail</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1 + (5 * ($page -1)); ?>
                  
                   <?php foreach ($data_aset as $row) : ?>
                   
                    <tr>
                      <td><?= $no++ ?></td>
                      
                      <td><?= esc($row['nama']) ?></td>
                      <td><?= esc($row['jenis']) ?></td>
                      <td><?= esc($row['total']) ?></td>
                     

                    </tr>
                    <?php endforeach; ?>
                    
                  </tbody>
                  

          </table>  
        </div>
        <div class="card-footer">
          <div class="row">
              <div class="col-12">
                  <nav aria-label="Page navigation">
                      <ul class="pagination">
                          <?php if ($totalPages > 1): ?>
                              <?php if ($page > 1): ?>
                                  <li class="page-item">
                                      <a class="page-link" href="?page=<?= $page - 1 ?>">« Prev</a>
                                  </li>
                              <?php endif; ?>

                              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                  <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                      <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                  </li>
                              <?php endfor; ?>

                              <?php if ($page < $totalPages): ?>
                                  <li class="page-item">
                                      <a class="page-link" href="?page=<?= $page + 1 ?>">Next »</a>
                                  </li>
                              <?php endif; ?>
                          <?php endif; ?>
                      </ul>
                  </nav>
              </div>
          </div>
      </div>
      </div>


      
      </script>
    <script src="adminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="adminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="adminLTE/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="adminLTE/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="adminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="adminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="adminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="adminLTE/plugins/moment/moment.min.js"></script>
    <script src="adminLTE/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="adminLTE/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="adminLTE/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="adminLTE/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="adminLTE/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="adminLTE/dist/js/pages/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
      $(document).ready(function() {
          $('.select2').select2();
      });
  </script>
</body>
</html>