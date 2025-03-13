<?php
require_once 'class/nilai_mhs.php';
$gradeObj = new nilai_mhs();
$grades = $gradeObj->getAllGrades();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Lihat Nilai</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center text-dark">Daftar Nilai Mahasiswa</h2>

        <div class="card shadow-sm p-4 bg-white">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grades as $row) : ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['course_name']); ?></td>
                                <td><strong><?= htmlspecialchars($row['grade']); ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>
