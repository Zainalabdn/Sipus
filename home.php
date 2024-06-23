<?php
session_start();
include "config/koneksi.php";

// Query to fetch all books
$sql = "SELECT * FROM buku";
$result = mysqli_query($koneksi, $sql);

$books = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }
}

mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "config/koneksi.php";

    $sql = mysqli_query($koneksi, "SELECT * FROM identitas");
    $row1 = mysqli_fetch_assoc($sql);
    ?>
    <title>Home | <?= $row1['nama_app']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="icon" href="assets/dist/img/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        img {
            overflow-clip-margin: content-box;
            overflow: clip;
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgba(255, 255, 255, var(--tw-bg-opacity));
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgba(243, 244, 246, var(--tw-bg-opacity));
        }

        main {
            background-image: url('path/to/your/image.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen style=background-image: url('assets/img/buku-1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <header class="bg-gray-900 py-4 px-4 md:px-16">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-3xl font-bold text-white">E-Library</a>
            <a href="login.php" id="loginButton" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Login</a>
        </div>
    </header>

    <main class="container mx-auto mt-16 py-8 px-4"">
        <h2 class="text-3xl font-bold text-center mb-8">Temukan Buku Anda!</h2>
        <div class="flex justify-center mb-8">
            <div class="flex items-center space-x-4">
                <input type="search" id="search" placeholder="Cari buku" class="bg-gray-800 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button id="searchButton" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">Cari</button>
            </div>
            <a href="tambahbuku.php">pp</a>
        </div>
        <div id="book-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach ($books as $book) : ?>
                <div class="bg-white rounded-md overflow-hidden shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                    <div class="book-image-container">
                        <img src="<?= $book['img']; ?>" alt="<?= $book['judul_buku']; ?>" class="book-image">
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 p-2"><?= $book['judul_buku']; ?></h3>
                    <p class="text-sm text-gray-600 p-2"><?= $book['pengarang']; ?></p>
                    <a href="detail.php?id=<?= $book['id_buku']; ?>" class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Detail
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
        const searchInput = document.getElementById('search');
        const searchButton = document.getElementById('searchButton');
        const bookGrid = document.getElementById('book-grid');

        searchButton.addEventListener('click', () => {
            const query = searchInput.value.trim();
            if (query === '') {
                alert('Harap masukkan judul buku.');
                return;
            }
            fetch(`https://www.googleapis.com/books/v1/volumes?q=intitle:${query}&maxResults=12`)
                .then(response => response.json())
                .then(data => {
                    const books = data.items;
                    bookGrid.innerHTML = '';
                    books.forEach(book => {
                        const bookCard = document.createElement('div');
                        bookCard.className = 'bg-white rounded-md overflow-hidden shadow-md hover:shadow-lg transition duration-300 ease-in-out';
                        const img = document.createElement('img');
                        img.src = book.volumeInfo.imageLinks.thumbnail;
                        img.alt = book.volumeInfo.title;
                        bookCard.appendChild(img);
                        const title = document.createElement('h3');
                        title.className = 'text-lg font-bold text-gray-800 p-2';
                        title.textContent = book.volumeInfo.title;
                        bookCard.appendChild(title);
                        const author = document.createElement('p');
                        author.className = 'text-sm text-gray-600 p-2';
                        author.textContent = book.volumeInfo.authors.join(', ');
                        bookCard.appendChild(author);
                        const detailButton = document.createElement('button');
                        detailButton.className = 'bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500';
                        detailButton.textContent = 'Detail';
                        detailButton.addEventListener('click', () => {
                            const bookId = book.id;
                            window.location.href = `detail.php?id=${bookId}`;
                        });
                        bookCard.appendChild(detailButton);
                        bookGrid.appendChild(bookCard);
                    });
                })
                .catch(error => console.error(error));
        });
    </script>
</body>

</html>
