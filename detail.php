<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen">
    <header class="bg-gray-900 py-4 px-4 md:px-16">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-3xl font-bold text-white">Perpustakaan</a>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out">Kembali ke daftar buku</a>
            </div>
        </div>
    </header>
    <main class="container mx-auto mt-16">
        <h2 class="text-3xl font-bold text-center mb-8">Detail Buku</h2>
        <div class="flex flex-wrap -mx-4">
            <div class="w-full mb-4">
                <label for="search-input" class="text-sm font-semibold">Cari Buku:</label>
                <div class="flex">
                    <input type="text" id="search-input" class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mr-2" placeholder="Masukkan kata kunci">
                    <button id="search-button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Cari</button>
                </div>
            </div>
            <div class="w-full">
                <label for="book-select" class="text-sm font-semibold">Pilih Judul Buku:</label>
                <select id="book-select" class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mt-1 mb-4">
                    <!-- Options will be dynamically added here -->
                </select>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                <img src="" alt="" class="w-full h-full object-cover rounded-md" id="book-image">
            </div>
            <div class="w-full md:w-1/2 xl:w-2/3 p-4" id="book-details">
                <!-- Book details will be dynamically filled here -->
            </div>
        </div>
    </main>

    <script>
        // Function to populate the select element with book titles
        function populateSelect(data) {
            const select = document.getElementById('book-select');
            // Clear existing options
            select.innerHTML = '';

            data.items.forEach(book => {
                const option = document.createElement('option');
                option.value = book.id;
                option.textContent = book.volumeInfo.title;
                select.appendChild(option);
            });

            // Trigger display of first book initially
            if (data.items.length > 0) {
                const firstBookId = data.items[0].id;
                displayBookDetails(firstBookId);
            }
        }

        // Function to display book details based on selected book ID
        function displayBookDetails(bookId) {
            fetch(`https://www.googleapis.com/books/v1/volumes/${bookId}?key=YOUR_API_KEY`)
                .then(response => response.json())
                .then(data => {
                    const book = data.volumeInfo;
                    const img = document.getElementById('book-image');
                    img.src = book.imageLinks.thumbnail || 'https://via.placeholder.com/150'; // Fallback image if thumbnail is not available
                    img.alt = book.title;

                    const detailsContainer = document.getElementById('book-details');
                    detailsContainer.innerHTML = `
                        <h3 class="text-lg font-bold text-gray-800 mb-2">${book.title}</h3>
                        <p class="text-sm text-gray-600 mb-4"><strong>Penulis:</strong> ${book.authors ? book.authors.join(', ') : 'Tidak ada informasi'}</p>
                        <p class="text-sm text-gray-600 mb-4"><strong>Deskripsi:</strong> ${book.description ? book.description : 'Tidak ada deskripsi'}</p>
                        <p class="text-sm text-gray-600 mb-4"><strong>Kategori:</strong> ${book.categories ? book.categories.join(', ') : 'Tidak ada informasi'}</p>
                        <p class="text-sm text-gray-600 mb-4"><strong>Penerbit:</strong> ${book.publisher ? book.publisher : 'Tidak ada informasi'}</p>
                        <p class="text-sm text-gray-600 mb-4"><strong>Tahun Terbit:</strong> ${book.publishedDate ? book.publishedDate : 'Tidak ada informasi'}</p>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Pinjam Buku</button>
                    `;
                })
                .catch(error => console.error(error));
        }

        // Function to handle search button click
        document.getElementById('search-button').addEventListener('click', function () {
            const searchQuery = document.getElementById('search-input').value.trim();
            if (searchQuery !== '') {
                const url = `https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(searchQuery)}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => populateSelect(data))
                    .catch(error => console.error(error));
            }
        });

        // Fetch book titles from Google Books API initially (default query: programming)
        fetch('https://www.googleapis.com/books/v1/volumes?q=programming&key=YOUR_API_KEY')
            .then(response => response.json())
            .then(data => populateSelect(data))
            .catch(error => console.error(error));

        // Event listener for when a book is selected
        document.getElementById('book-select').addEventListener('change', function () {
            const selectedBookId = this.value;
            displayBookDetails(selectedBookId);
        });
    </script>
</body>
</html>
