<?php
include "../config/koneksi.php";

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM buku WHERE judul_buku LIKE '%$search%' OR pengarang LIKE '%$search%'";
} else {
    $query = "SELECT * FROM buku";
}

$result = $koneksi->query($query);
$books = [];

while ($book = $result->fetch_assoc()) {
    $books[] = $book;
}

echo json_encode($books);
?>
