<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM tugas WHERE id=$id");
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Data tugas tidak ditemukan.";
    exit;
}
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <div class="container">
        <h1>Edit Tugas</h1>
        <form method="POST" action="../actions/update.php" enctype="multipart/form-data" class="task-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>" />
            
            <label for="judul">Judul Tugas</label>
            <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required />
            
            <label for="deskripsi">Deskripsi Tugas</label>
            <textarea id="deskripsi" name="deskripsi" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
            
            <label for="file">Upload File Tugas (opsional)</label>
            <input type="file" id="file" name="file" />
            
            <?php if (!empty($data['file'])): ?>
                <p>File saat ini: <a href="../uploads/<?= urlencode($data['file']) ?>" target="_blank"><?= htmlspecialchars($data['file']) ?></a></p>
            <?php endif; ?>
            
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
