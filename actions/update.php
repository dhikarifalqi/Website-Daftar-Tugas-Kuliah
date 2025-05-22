<?php
include '../config/koneksi.php';

$id = intval($_POST['id']);
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

// Ambil data tugas lama dulu
$result = mysqli_query($conn, "SELECT * FROM tugas WHERE id=$id");
$data = mysqli_fetch_assoc($result);

$file_name = $data['file']; // default file lama

// Cek apakah ada file baru diupload
if (isset($_FILES['file_tugas']) && $_FILES['file_tugas']['error'] == UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['file_tugas']['tmp_name'];
    $file_name_new = basename($_FILES['file_tugas']['name']);
    $target_dir = '../uploads/';
    $target_file = $target_dir . $file_name_new;

    // Upload file baru
    if (move_uploaded_file($file_tmp, $target_file)) {
        // Jika ada file lama, hapus
        if (!empty($file_name) && file_exists($target_dir . $file_name)) {
            unlink($target_dir . $file_name);
        }
        $file_name = $file_name_new;
    }
}

$sql = "UPDATE tugas SET judul=?, deskripsi=?, file=? WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'sssi', $judul, $deskripsi, $file_name, $id);
mysqli_stmt_execute($stmt);

header('Location: ../views/index.php');
exit;
?>
