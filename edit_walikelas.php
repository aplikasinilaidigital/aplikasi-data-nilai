<?php
include('koneksi.php');
$nip = isset($_GET['nip']) ? $_GET['nip'] : null;
$query = "SELECT * FROM tbl_walikelas WHERE nip = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $nip);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Data Wali Kelas</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                <img src="pgr.webp" alt="Logo" style="width: 60px; height: 60px;">
                </div>
                <div class="sidebar-brand-text mx-3">APLIKASI DATA NILAI</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="guru_pelajaran.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
                </svg>
                    <span>Kembali</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
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
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                        <li class="nav-item dropdown no-arrow">
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <form method="post" action="proses_edit_walikelas.php">
                <input type="hidden" name="old_nip" value="<?php echo htmlspecialchars($row['nip']); ?>">
                <table class="table table-bordered">
                <tr>
                    <th>NIP</th>
                    <td><input type="text" name="nip" class="form-control" value="<?php echo htmlspecialchars($row['nip']); ?>" required></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($row['nama']); ?>" required></td>
                </tr>
                <tr>
                    <th>Wali Kelas</th>
                    <td><input type="text" name="walikelas" class="form-control" value="<?php echo htmlspecialchars($row['walikelas']); ?>" required></td>
                </tr>
                <tr>
                    <th>Mata Pelajaran</th>
                    <td>
                        <select name="mata_pelajaran" class="form-select" required>
                            <option value="Matematika" <?php if ($row['mata_pelajaran'] == 'Matematika') echo 'selected'; ?>>Matematika</option>
                            <option value="Sejarah" <?php if ($row['mata_pelajaran'] == 'Sejarah') echo 'selected'; ?>>Sejarah</option>
                            <option value="Bhs Jepang" <?php if ($row['mata_pelajaran'] == 'Bhs Jepang') echo 'selected'; ?>>Bhs Jepang</option>
                            <option value="Bhs Inggris" <?php if ($row['mata_pelajaran'] == 'Bhs Inggris') echo 'selected'; ?>>Bhs Inggris</option>
                            <option value="IPAS" <?php if ($row['mata_pelajaran'] == 'IPAS') echo 'selected'; ?>>IPAS</option>
                            <option value="PJOK" <?php if ($row['mata_pelajaran'] == 'PJOK') echo 'selected'; ?>>PJOK</option>
                            <option value="PAI" <?php if ($row['mata_pelajaran'] == 'PAI') echo 'selected'; ?>>PAI</option>
                            <option value="Bhs Indonesia" <?php if ($row['mata_pelajaran'] == 'Bhs Indonesia') echo 'selected'; ?>>Bhs Indonesia</option>
                            <option value="PPKN" <?php if ($row['mata_pelajaran'] == 'PPKN') echo 'selected'; ?>>PPKN</option>
                            <option value="-" <?php if ($row['mata_pelajaran'] == '-') echo 'selected'; ?>>-</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="walikelas.php" class="btn btn-secondary">Kembali</a>
        </form>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
