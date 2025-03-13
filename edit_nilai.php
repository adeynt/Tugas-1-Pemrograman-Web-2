<?php
require_once 'class/nilai_mhs.php';
$gradeObj = new nilai_mhs();

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];
$gradeData = $gradeObj->getGradeById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $gradeObj->updateGrade($id, $_POST['grade']);
    header("Location: dosen.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Update Nilai</h2>
    <form method="POST">
        <div class="form-group mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($gradeData['name']); ?>" readonly>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Mata Kuliah</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($gradeData['course_name']); ?>" readonly>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Nilai</label>
            <input type="text" name="grade" class="form-control" value="<?= htmlspecialchars($gradeData['grade']); ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="dosen.php" class="btn btn-secondary">Kembali</a>
    </form>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
