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
  <div class="content-wrapper" style="padding: 20px">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item" ><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Aset</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="d-flex align-item-center">
            <button type="button" class="btn btn-block btn-primary mr-2" data-toggle="modal" data-target="#tambah-data">Tambah</button>
          </div>
          
            <div class="form-group mx-auto" style="max-width:500px; padding-top: 20px; ">
            <form action="<?= base_url('data_aset/search') ?>" method="get">
                <div class="input-group input-group-lg">
                    <input type="search" name="keyword" class="form-control form-control-lg" placeholder="Type your keywords here" value="<?= isset($keyword) ? esc($keyword) : '' ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                </div>
              </form>
            </div>
          
            
        </div>
              <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead class="text-center">
                  <tr>
                    <th>No.</th>
                    <th>Nama Aset</th>
                    <th>Kode Aset</th>
                    <th>Jenis Aset</th>
                    <th>Unit</th>
                    <th>Kondisi</th>
                    <th>Tindakan</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($data_aset)) : ?>
                  <?php $no = 1; ?>
                   <?php foreach ($data_aset as $row) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= esc($row['nama']) ?></td>
                      <td><?= esc($row['kode']) ?></td>
                      <td><?= esc($row['jenis']) ?></td>
                      <td><?= esc($row['unit']) ?></td>
                      <td><?= esc($row['kondisi']) ?></td>
                      <td class="text-center" >
                      
                        <a href="#" data-href="<?=base_url('data_aset/edit/'.$row['id']) ?>" class="edit-data" data-id="<?= esc($row['id']) ?>" 
                data-nama="<?= esc($row['nama']) ?>" 
                data-kode="<?= esc($row['kode']) ?>" 
                data-jenis="<?= esc($row['jenis']) ?>" 
                data-unit="<?= esc($row['unit']) ?>" 
                data-kondisi="<?= esc($row['kondisi']) ?>"
                data-toggle="modal" data-target="#edit-data">
                         <i class="fas fa-edit"></i></a>
                       <a href="#" data-href="<?= base_url('data_aset/hapus/'.$row['id']) ?>" onclick="confirmToDelete(this)">
                          <i class="fas fa-trash-alt pl-3"></i>
                        </a> 
                      </td>
                      

                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
          </table>  
                  
    </div>  
    </div>
    
    
    <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="tambah-data" action="<?= base_url('/data_aset/simpan') ?>" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label for="nama">Nama Aset</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Aset" required>
              </div>
              <div class="form-group">
                <label for="kode">Kode Aset</label>
                <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan Kode Aset" required>
              </div>
              <div class="form-group">
                <label for="jenis">Jenis Aset</label>
                <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukkan Jenit Aset" required>
              </div>
              <div class="form-group">
                <label for="unit">Unit</label>
                <input type="text" class="form-control" id="unit" name="unit" placeholder="Masukkan Unit Tempat Aset" required>
              </div>
              <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <select class="form-control" id="kondisi" name="kondisi">
                  <option value="Tersedia">Tersedia</option>
                  <option value="Tidak Tersedia">Tidak Tersedia</option>
                  <option value="Rusak">Rusak</option>
                  <option value="Hilang">Hilang</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
   
    
    <div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Edit Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <form id="edit-data"  action="<?= base_url('data_aset/update') ?>" method="POST">
            <div class="modal-body">
              <input type="hidden" name="id" value="<?= esc($row['id']) ?>">
              <div class="form-group">
                <label for="nama">Nama Aset</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($row['nama']) ?>" required> 
              </div>
              <div class="form-group">
                <label for="kode">Kode Aset</label>
                <input type="text" class="form-control" id="kode" name="kode" value="<?= esc($row['kode']) ?>" required> 
              </div>
              
              <div class="form-group">
                <label for="jenis">Jenis Aset</label>
                <input type="text" class="form-control" id="jenis" name="jenis" value="<?= esc($row['jenis']) ?>" required> 
              </div>
              <div class="form-group">
                <label for="unit">Unit</label>
                <input type="text" class="form-control" id="unit" name="unit" value="<?= esc($row['unit']) ?>" required> 
                </div>
              <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <select class="form-control" id="kondisi" name="kondisi" value="<?= esc($row['kondisi']) ?>" required>
                  <option value="Tersedia">Tersedia</option>
                  <option value="Tidak Tersedia">Tidak Tersedia</option>
                  <option value="Rusak">Rusak</option>
                  <option value="Hilang">Hilang</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
              </div>
          </form>
          
          
          </div>
      </div>
    </div>
    <?php echo $row['id'] ?>

<div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h2 class="h2">Are you sure?</h2>
        <p>The data will be deleted and lost forever</p>
      </div>
      <div class="modal-footer">
        <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
  function confirmToDelete(el){
    const href = el.getAttribute('data-href');
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
          window.location.href = href;
      }
      // $("#delete-button").attr("href", el.dataset.href);
      // $("#confirm-dialog").modal('show');
  } 

</script>
<script>
// Script untuk mengisi modal dengan data aset yang dipilih
$(document).ready(function() {
    $('.edit_data').on('click', function() {
        var id = $(this).data('id'); // Ambil ID dari tombol yang diklik
        var nama = $(this).data('nama');
        var kode = $(this).data('kode');
        var jenis = $(this).data('jenis');
        var unit = $(this).data('unit');
        var kondisi = $(this).data('kondisi');

        // Isi nilai-nilai ke dalam modal
        $('#edit-data #id').val(id);
        $('#edit-data #nama').val(nama);
        $('#edit-data #kode').val(kode);
        $('#edit-data #jenis').val(jenis);
        $('#edit-data #unit').val(unit);
        $('#edit-data #kondisi').val(kondisi);

        // Tampilkan modal
        $('#edit-data').modal('show');
    });
});
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</body>
</html>

