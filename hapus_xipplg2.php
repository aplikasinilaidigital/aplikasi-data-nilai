<?php
include 'koneksi.php';

if (isset($_GET['no'])) {
    $no = $_GET['no'];

    $query = "DELETE FROM xipplg2 WHERE no = '$no'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: xipplg2.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
}
?>