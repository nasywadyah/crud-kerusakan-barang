<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Validasi hanya huruf & spasi
        function allowLettersOnly(e) {
            let char = String.fromCharCode(e.which);
            if (!/[a-zA-Z\s]/.test(char)) {
                e.preventDefault();
            }
        }
    </script>
</head>
<body class="bg-gray-100 p-10">
<div class="container mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Tambah Data Barang Rusak</h1>

    <?php
    $errors = [];

    if (isset($_POST['simpan'])) {
        $barang = $_POST['barang'];
        $kerusakan = $_POST['kerusakan'];
        $lokasi = $_POST['lokasi'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];

        // Validasi server-side: hanya huruf dan spasi
        if (!preg_match("/^[a-zA-Z\s]+$/", $barang)) {
            $errors[] = "Nama barang hanya boleh huruf dan spasi.";
        }
        if (!preg_match("/^[a-zA-Z\s]+$/", $lokasi)) {
            $errors[] = "Lokasi hanya boleh huruf dan spasi.";
        }
        if (!empty($keterangan) && !preg_match("/^[a-zA-Z\s]+$/", $keterangan)) {
            $errors[] = "Keterangan hanya boleh huruf dan spasi.";
        }

        if (empty($errors)) {
            $koneksi->query("INSERT INTO barang_rusak (barang, kerusakan, lokasi, tanggal, keterangan) 
                             VALUES ('$barang', '$kerusakan', '$lokasi', '$tanggal', '$keterangan')");
            echo "<script>window.location='index.php';</script>";
        }
    }
    ?>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>• <?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4">
        <input type="text" name="barang" placeholder="Nama Barang"
               class="w-full p-2 border rounded" required
               pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi" onkeypress="allowLettersOnly(event)">

        <!-- Dropdown Type Kerusakan -->
        <select name="kerusakan" class="w-full p-2 border rounded" required>
            <option value="" disabled selected hidden>Type Kerusakan</option>
            <option value="Rusak Ringan">Rusak Ringan</option>
            <option value="Rusak Sedang">Rusak Sedang</option>
            <option value="Rusak Berat">Rusak Berat</option>
        </select>

        <input type="text" name="lokasi" placeholder="Lokasi"
               class="w-full p-2 border rounded" required
               pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi" onkeypress="allowLettersOnly(event)">

        <input type="date" name="tanggal" class="w-full p-2 border rounded" required>

        <textarea name="keterangan" placeholder="Keterangan tambahan (opsional)"
                  class="w-full p-2 border rounded"
                  pattern="[A-Za-z\s]*" title="Hanya huruf dan spasi" onkeypress="allowLettersOnly(event)"></textarea>

        <button type="submit" name="simpan" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="index.php" class="ml-4 text-black-500">Kembali</a>
    </form>
</div>
</body>
</html>
