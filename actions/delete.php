<?php
include '../config/koneksi.php';

$id = intval($_GET['id']);

// Ambil data file dulu
$result = mysqli_query($conn, "SELECT * FROM tugas WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if ($data) {
    $file_name = $data['file'];
    if (!empty($file_name) && file_exists('../uploads/' . $file_name)) {
        unlink('../uploads/' . $file_name);
    }
}

mysqli_query($conn, "DELETE FROM tugas WHERE id=$id");

header('Location: ../views/index.php');
exit;
?>
