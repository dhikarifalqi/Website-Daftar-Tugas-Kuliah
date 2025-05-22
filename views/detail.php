<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM tugas WHERE id=$id");

if (mysqli_num_rows($result) == 0) {
    echo "Tugas tidak ditemukan.";
    exit;
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Detail Tugas - <?= htmlspecialchars($data['judul']) ?></title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<div class="container">
    <h1>Detail Tugas</h1>
    <h2><?= htmlspecialchars($data['judul']) ?></h2>
    <p><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>

    <?php if (!empty($data['file'])): ?>
        <p>File tugas: <a href="../uploads/<?= urlencode($data['file']) ?>" target="_blank"><?= htmlspecialchars($data['file']) ?></a></p>
    <?php else: ?>
        <p>Tidak ada file tugas yang diupload.</p>
    <?php endif; ?>

    <p><a href="index.php">Kembali ke daftar tugas</a></p>
</div>
</body>
</html>
