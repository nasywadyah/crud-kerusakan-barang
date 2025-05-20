<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Barang Rusak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<div class="container mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Data Barang Rusak</h1>
    <a href="tambah.php" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Data</a>

    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Barang</th>
                <th class="border px-4 py-2">Type Kerusakan</th>
                <th class="border px-4 py-2">Lokasi</th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Keterangan</th> <!-- kolom baru -->
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $koneksi->query("SELECT * FROM barang_rusak");
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='border px-4 py-2'>{$no}</td>";
                echo "<td class='border px-4 py-2'>{$row['barang']}</td>";
                echo "<td class='border px-4 py-2'>{$row['kerusakan']}</td>";
                echo "<td class='border px-4 py-2'>{$row['lokasi']}</td>";
                echo "<td class='border px-4 py-2'>{$row['tanggal']}</td>";
                echo "<td class='border px-4 py-2'>{$row['keterangan']}</td>";
                echo "<td class='border px-4 py-2'>
                        <a href='edit.php?id={$row['id_barang']}' class='bg-blue-500 text-white px-3 py-1 ml-5 rounded '>Edit</a>
                        <a href='hapus.php?id={$row['id_barang']}' class='bg-red-500 text-white px-2 py-1 rounded ml-2' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>
                    </td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
