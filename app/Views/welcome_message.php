<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pengelolaan Aset </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="adminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminLTE/dist/css/adminlte.min.css">

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

    </style>   
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand ugm navbar-light">
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item user">
        <a class="nav-link" style="color: white;" data-toggle="user" href="login">
          Login
        </a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="padding: 20px">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item" >Data Aset</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
      <div class="card">
        <div class="card-header">
            <div class="form-group mx-auto" style="max-width:500px; padding-top: 20px; ">
                <div class="input-group input-group-lg">
                    <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here" value="Lorem ipsum">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                </div>
            </div>
        </div>
              <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead class="text-center">
                  <tr>
                    <th>No.</th>
                    <th>Nama Aset</th>
                    <th>Jenis Aset</th>
                    <th>Unit</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($data_aset as $row) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= esc($row['nama']) ?></td>
                      <td><?= esc($row['jenis']) ?></td>
                      <td><?= esc($row['unit']) ?></td>
                      <td><?= esc($row['total']) ?></td>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
          </table>            
    </div>
    </section>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>
</html>