<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM barang_rusak WHERE id_barang = $id");
$row = $data->fetch_assoc();

$errors = [];

if (isset($_POST['update'])) {
    $barang = $_POST['barang'];
    $kerusakan = $_POST['kerusakan'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];

    // Validasi huruf saja
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
        $koneksi->query("UPDATE barang_rusak SET 
            barang='$barang', 
            kerusakan='$kerusakan', 
            lokasi='$lokasi', 
            tanggal='$tanggal',
            keterangan='$keterangan' 
            WHERE id_barang=$id");

        echo "<script>window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Client-side input filter (opsional tambahan)
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
    <h1 class="text-2xl font-bold mb-4">Edit Data Barang Rusak</h1>

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
        <input type="text" name="barang" value="<?= htmlspecialchars($row['barang']) ?>"
               class="w-full p-2 border rounded" required
               pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi" onkeypress="allowLettersOnly(event)">

        <select name="kerusakan" class="w-full p-2 border rounded" required>
            <option value="" disabled hidden>Type Kerusakan</option>
            <option value="Rusak Ringan" <?= $row['kerusakan'] == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
            <option value="Rusak Sedang" <?= $row['kerusakan'] == 'Rusak Sedang' ? 'selected' : '' ?>>Rusak Sedang</option>
            <option value="Rusak Berat" <?= $row['kerusakan'] == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
        </select>

        <input type="text" name="lokasi" value="<?= htmlspecialchars($row['lokasi']) ?>"
               class="w-full p-2 border rounded" required
               pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi" onkeypress="allowLettersOnly(event)">

        <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" class="w-full p-2 border rounded" required>

        <textarea name="keterangan" class="w-full p-2 border rounded" placeholder="Keterangan tambahan"
                  pattern="[A-Za-z\s]*" title="Hanya huruf dan spasi" onkeypress="allowLettersOnly(event)"><?= htmlspecialchars($row['keterangan']) ?></textarea>

        <button type="submit" name="update" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="index.php" class="ml-4 text-gray-600">Batal</a>
    </form>
</div>
</body>
</html>
