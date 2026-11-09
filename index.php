<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar PHP</title>
</head>
<body>
    <h1>belajar php</h1>
    <?php
    echo "<p>PHP berhasil dijalankan</p>";
    echo "<p>Waktu server: " . date("d-m-Y H:i:s") . "</p>";
    ?>

<?php
//Latihan 2
    $nama = "ADHYT";
    $tugas = 88;
    $uts = 80;
    $uas = 90;
    $nilaiAkhir = ($tugas*0.30)+($uts*0.30)+($uas*0.40);

    if ($nilaiAkhir >= 85) {
        $predikat = "A";
    } elseif ($nilaiAkhir >= 75) {
        $predikat = "B";
    } elseif ($nilaiAkhir >= 60) {
        $predikat = "C";
    } else {
        $predikat = "D";
    }

    echo "Nama: " . htmlspecialchars($nama) . "<br>";
    echo "Nama akhir: " . number_format($nilaiAkhir, 2) . "<br>";
    echo "Predikat: " . $predikat;
    ?>


<?php
//Latihan 3
$mahasiswa = ["Alya", "Bima", "Citra", "Doni", "ADHYT", "UCUP", "GENJOR"];
echo "<h3>Daftar Mahasiswa</h3><ol>";
foreach ($mahasiswa as $nama) {
    echo "<li>" . htmlspecialchars($nama) . "</li>";
}
echo "</ol>";
?>


<?php
// Latihan 4
// function menghitung diskon 
function hitungDiskon($harga, $persen) {
    $potongan = $harga * ($persen / 100);
    return $harga - $potongan;
}
$hargaAkhir = hitungDiskon(150000, 10);
echo "Harga setelah diskon: Rp" . number_format($hargaAkhir, 0, ",", ".");
echo "<br>";

//function menghitung luas persegi
function hitungLuas($panjang, $lebar) {
    $luas = $panjang * $lebar;
    return $luas;
}
$hasilLuas = hitungLuas(10, 5);
echo "Luas persegi panjang: " . $hasilLuas . "cm2";
?>


<?php//Lathihan 5?>
<form method="GET" action="">
    <label for="kata">Kata kunci:</label>
    <input id="kata" name="kata" type="text">
    <button type="submit">Cari</button>
</form>
<?php
if (isset($_GET["kata"])) {
    $kata = trim($_GET["kata"]);
    echo "Kata kunci: " . htmlspecialchars($kata, ENT_QUOTES, "UTF-8");
}
?>



<!-- index.php -->
<!-- Latihan 6 -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Mahasiswa</title>
 </head>
 <body>
    <h2>Form Data Mahasiswa</h2>

    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input id="nama" name="nama" type="text" required>

        <br><br>

        <label for="prodi">Program Studi:</label>
        <input id="prodi" name="prodi" type="text" required>

        <br><br>

        <button type="submit" name="kirim">Kirim Data</button>
    </form>
 </body>
 </html>
<form method="POST" action="">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    if ($nama === "" || $prodi === "") {
        echo "<p>Semua kolom wajib diisi.</p>";
    } else {
        echo "<h3>Data diterima</h3>";
        echo "Nama: " . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "<br>";
        echo "Program Studi: " . htmlspecialchars($prodi, ENT_QUOTES, "UTF-8");
    }
}
?>

<!-- Latihan 7 -->

<?php
$hasil = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $barang = trim($_POST["barang"] ?? "");
    $hargaInput = $_POST["harga"] ?? "";
    $jumlahInput = $_POST["jumlah"] ?? "";

    if (
        $barang === "" ||
        !is_numeric($hargaInput) ||
        !ctype_digit((string)$jumlahInput) ||
        (float)$hargaInput < 0 ||
        (int)$jumlahInput < 1
    ) {
        $error = "Periksa kembali nama barang, harga, dan jumlah.";
    } else {
        $harga = (float)$hargaInput;
        $jumlah = (int)$jumlahInput;
        $subtotal = $harga * $jumlah;
    }
}
?>

<h2>Kalkulator Belanja</h2>

<form method="POST">
    <label>
        Nama barang
        <input name="barang" required>
    </label>
    <br><br>

    <label>
        Harga
        <input name="harga" type="number" min="0" step="0.01" required>
    </label>
    <br><br>

    <label>
        Jumlah
        <input name="jumlah" type="number" min="1" step="1" required>
    </label>
    <br><br>

    <button type="submit">Hitung</button>
</form>

<?php
if (isset($error)) {
    echo "<p>" . htmlspecialchars($error) . "</p>";
} elseif (isset($subtotal)) {
    echo "<h3>Hasil Perhitungan</h3>";
    echo "<p>Barang: " . htmlspecialchars($barang) . "</p>";
    echo "<p>Subtotal: Rp" . number_format($subtotal, 0, ",", ".") . "</p>";
}
?>


</body>
</html>