<?php
include '../config/koneksi.php';

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

// Upload file jika ada
$file_name = '';
if (isset($_FILES['file_tugas']) && $_FILES['file_tugas']['error'] == UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['file_tugas']['tmp_name'];
    $file_name = basename($_FILES['file_tugas']['name']);

    // Bisa tambahin validasi ekstensi dan ukuran file di sini
    $target_dir = '../uploads/';
    $target_file = $target_dir . $file_name;

    move_uploaded_file($file_tmp, $target_file);
}

$sql = "INSERT INTO tugas (judul, deskripsi, file) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'sss', $judul, $deskripsi, $file_name);
mysqli_stmt_execute($stmt);

header('Location: ../views/index.php');
exit;
?>
