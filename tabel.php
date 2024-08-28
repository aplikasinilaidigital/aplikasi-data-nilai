<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['nisn'])) {
    echo "Anda belum login.";
    exit;
}

$nisn_login = $_SESSION['nisn']; 

try {
    
    $query = "SELECT nisn, nama, mata_pelajaran, nilai_harian, nilai_pat, nilai_pas, nilai_akhir, keterangan, catatan_walikelas 
              FROM tbl_nilai
              WHERE nisn = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $nisn_login); 
    $stmt->execute();
    $result = $stmt->get_result();
    
    if (!$result) {
        throw new Exception("Error fetching data: " . $koneksi->error);
    }
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>NILAI</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon">
                <img src="lai.png" alt="Logo" style="width: 60px; height: 60px;">
            </div>
            <div class="sidebar-brand-text mx-3">APLIKASI DATA NILAI</div>
        </a>
        <hr class="sidebar-divider">
            <li class="nav-item" style="margin-top: 20px;">
                <a class="nav-link" href="siswa.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
                    </svg>
                    <span>Kembali</span>
                </a>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">LAPORAN NILAI</h1>
                <p>SMK PGRI 1 CIMAHI</p>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Laporan Data Nilai</h6>
                    </div>
                    <div class="card-body">
                        <?php
          
            while ($row = $result->fetch_assoc()): ?>
                <div class="student-info mb-3">
                    <strong>NISN:</strong> <?php echo htmlspecialchars($row['nisn']); ?><br>
                    <strong>NAMA:</strong> <?php echo htmlspecialchars($row['nama']); ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Nilai Harian</th>
                                <th>Nilai PAT</th>
                                <th>Nilai PAS</th>
                                <th>Nilai Akhir</th>
                                <th>Keterangan</th>
                                <th>Catatan Walikelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo htmlspecialchars($row['mata_pelajaran']); ?></td>
                                <td><?php echo htmlspecialchars($row['nilai_harian']); ?></td>
                                <td><?php echo htmlspecialchars($row['nilai_pat']); ?></td>
                                <td><?php echo htmlspecialchars($row['nilai_pas']); ?></td>
                                <td><?php echo htmlspecialchars($row['nilai_akhir']); ?></td>
                                <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                                <td><?php echo htmlspecialchars($row['catatan_walikelas']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Optional: You might want to add a separator if there are multiple rows -->
                <hr>
            <?php endwhile; ?>
        </div>
    </div>
</div>





    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
