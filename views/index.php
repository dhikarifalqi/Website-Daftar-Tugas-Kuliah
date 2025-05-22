<?php
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Tugas Kuliah</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<div class="container">
    <h1>Daftar Tugas Kuliah</h1>

    <form action="../actions/add.php" method="POST" class="task-form" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul Tugas" required />
        <textarea name="deskripsi" placeholder="Deskripsi Tugas" required></textarea>
        <input type="file" name="file_tugas" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar" />
        <button type="submit">Tambah Tugas</button>
    </form>

    <div class="task-list">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM tugas ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='task'>";
            echo "<h2>" . htmlspecialchars($row['judul']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($row['deskripsi'])) . "</p>";

            if (!empty($row['file'])) {
                echo "<p>File: <a href='../uploads/" . urlencode($row['file']) . "' target='_blank'>" . htmlspecialchars($row['file']) . "</a></p>";
            }

            echo "<div class='actions'>";
            echo "<a href='detail.php?id=" . $row['id'] . "'>Lihat Detail</a> | ";
            echo "<a href='edit.php?id=" . $row['id'] . "'>Edit</a> | ";
            echo "<a href='../actions/delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Hapus tugas ini?');\">Hapus</a>";
            echo "</div></div>";
        }
        ?>
    </div>
</div>
</body>
</html>
