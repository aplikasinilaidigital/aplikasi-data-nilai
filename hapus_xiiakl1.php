<?php
include 'koneksi.php';

if (isset($_GET['no'])) {
    $no = $_GET['no'];

    $query = "DELETE FROM xiiakl1 WHERE no = '$no'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: xiiakl1.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
}
?>