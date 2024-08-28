<?php
include 'koneksi.php';

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    $query = "DELETE FROM tbl_walikelas WHERE nip = '$nip'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: walikelas.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
}
?>