<?php
require_once 'class/nilai_mhs.php';
$gradeObj = new nilai_mhs();

$students = $gradeObj->getStudents();
$courses = $gradeObj->getCourses();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $gradeObj->addGrade($_POST['student_id'], $_POST['course_id'], $_POST['grade']);
}

if (isset($_GET['delete'])) {
    $gradeObj->deleteGrade($_GET['delete']);
}

$grades = $gradeObj->getAllGrades(); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Nilai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Kelola Nilai</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center text-dark">Kelola Nilai Mahasiswa</h2>

        <div class="card shadow-sm p-4 mb-4 bg-white">
            <h4 class="mb-3">Tambah Nilai</h4>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?= $student['id']; ?>"><?= htmlspecialchars($student['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mata Kuliah</label>
                    <select name="course_id" class="form-control" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= $course['id']; ?>"><?= htmlspecialchars($course['course_name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai</label>
                    <input type="text" name="grade" class="form-control" placeholder="Nilai" required>
                </div>

                <button type="submit" name="add" class="btn btn-dark w-100">Tambah</button>
            </form>
        </div>

        <div class="card shadow-sm p-4 bg-white">
            <h4 class="mb-3">Daftar Nilai</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grades as $row) : ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['course_name']); ?></td>
                                <td><strong><?= htmlspecialchars($row['grade']); ?></strong></td>
                                <td>
                                    <a href="edit_nilai.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="?delete=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>

