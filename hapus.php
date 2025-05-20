<?php
include 'db.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM barang_rusak WHERE id_barang=$id");
header("Location: index.php");

?>