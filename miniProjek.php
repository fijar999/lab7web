
<?php
// BAGIAN 1: PEMROSESAN DATA PHP

$data = null;
$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Mengambil data dari form
    $nama = trim($_POST["nama"] ?? "");
    $nim = trim($_POST["nim"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $semesterInput = $_POST["semester"] ?? "";
    $email = trim($_POST["email"] ?? "");

    // Validasi data
    if ($nama === "") {
        $error[] = "Nama wajib diisi.";
    }

    if ($nim === "") {
        $error[] = "NIM wajib diisi.";
    }

    if ($prodi === "") {
        $error[] = "Program studi wajib diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }

    if (
        !ctype_digit((string)$semesterInput) ||
        (int)$semesterInput < 1 ||
        (int)$semesterInput > 14
    ) {
        $error[] = "Semester harus berupa angka 1-14.";
    }

    // Jika tidak ada kesalahan, simpan data
    if (!$error) {
        $data = compact("nama", "nim", "prodi", "email");
        $data["semester"] = (int)$semesterInput;
    }
}
?>

<!-- BAGIAN 2: FORMULIR HTML -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Data Mahasiswa</title>
</head>
<body>

    <h2>Formulir Data Mahasiswa</h2>

    <form method="POST" action="">

        <label for="nama">Nama Lengkap:</label><br>
        <input type="text" id="nama" name="nama"
        value="<?= htmlspecialchars($nama ?? "", ENT_QUOTES, "UTF-8") ?>"
        required>
        <br><br>

        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim"
        value="<?= htmlspecialchars($nim ?? "", ENT_QUOTES, "UTF-8") ?>"
        required>
        <br><br>

        <label for="prodi">Program Studi:</label><br>
        <input type="text" id="prodi" name="prodi"
        value="<?= htmlspecialchars($prodi ?? "", ENT_QUOTES, "UTF-8") ?>"
        required>
        <br><br>

        <label for="semester">Semester:</label><br>
        <input type="number" id="semester" name="semester"
        min="1" max="14" step="1"
        value="<?= htmlspecialchars($semesterInput ?? "", ENT_QUOTES, "UTF-8") ?>"
        required>
        <br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"
        value="<?= htmlspecialchars($email ?? "", ENT_QUOTES, "UTF-8") ?>"
        required>
        <br><br>

        <button type="submit">Kirim Data</button>

    </form>

    <!-- BAGIAN 3: MENAMPILKAN PESAN KESALAHAN -->

    <?php if ($error): ?>

        <h3>Terjadi Kesalahan:</h3>

        <?php foreach ($error as $pesan): ?>
            <p><?= htmlspecialchars($pesan, ENT_QUOTES, "UTF-8") ?></p>
        <?php endforeach; ?>

    <?php endif; ?>


    <!-- BAGIAN 4: MENAMPILKAN RINGKASAN DATA -->

    <?php if ($data !== null): ?>

        <h3>Ringkasan Data Mahasiswa</h3>

        <p>Nama: <?= htmlspecialchars($data["nama"], ENT_QUOTES, "UTF-8") ?></p>

        <p>NIM: <?= htmlspecialchars($data["nim"], ENT_QUOTES, "UTF-8") ?></p>

        <p>Program Studi: <?= htmlspecialchars($data["prodi"], ENT_QUOTES, "UTF-8") ?></p>

        <p>Semester: <?= $data["semester"] ?></p>

        <p>Email: <?= htmlspecialchars($data["email"], ENT_QUOTES, "UTF-8") ?></p>

    <?php endif; ?>

</body>
</html>
