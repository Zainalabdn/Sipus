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

<body class="bg-gray-100 h-screen flex flex-col">


    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="assets/dist/img/logo.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Library</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a type="button" href="login.php" id="loginButton"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get
                    Login</a>
                <button data-collapse-toggle="navbar-cta" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#"
                            class="block py-2 px-3 md:p-0 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:dark:text-blue-500"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <main class="container mx-auto mt-16 py-8 px-4 flex-grow">
        <h2 class="text-3xl font-bold text-center mb-8">Temukan Buku Anda!</h2>
        <div class="flex justify-center mb-8">
            <div class="flex items-center space-x-4">
                <input type="search" id="search" placeholder="Cari buku"
                    class="bg-gray-800 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button id="searchButton"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">Cari</button>
            </div>
        </div>
        <div id="book-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach ($books as $book) : ?>
            <div
                class="bg-white rounded-md overflow-hidden shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                <div class="book-image-container">
                    <img src="<?= $book['img']; ?>" alt="<?= $book['judul_buku']; ?>" class="book-image">
                </div>
                <h3 class="text-lg font-bold text-gray-800 p-2"><?= $book['judul_buku']; ?></h3>
                <p class="text-sm text-gray-600 p-2"><?= $book['pengarang']; ?></p>
                <a href="detail.php?id=<?= $book['id_buku']; ?>"
                    class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Detail
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="bg-white w-full shadow dark:bg-gray-900 mt-auto">
        <div class="max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                </a>
                <ul
                    class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                    href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
        </div>
    </footer>

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
                        bookCard.className =
                            'bg-white rounded-md overflow-hidden shadow-md hover:shadow-lg transition duration-300 ease-in-out';
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
                        detailButton.className =
                            'bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500';
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