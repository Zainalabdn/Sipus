<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen">
    <header class="bg-gray-900 py-4 px-4 md:px-16">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-3xl font-bold text-white">Perpustakaan</a>
            <div class="flex items-center space-x-4">
                <input type="search" id="search" placeholder="Cari buku" class="bg-gray-800 rounded-md px-3 py-2 w-full md:w-96 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button id="searchButton" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">Cari</button>
            </div>
        </div>
    </header>

    <main class="container mx-auto mt-16">
        <h2 class="text-3xl font-bold text-center mb-8">Buku Populer</h2>
        <div id="book-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Book covers will be displayed here -->
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