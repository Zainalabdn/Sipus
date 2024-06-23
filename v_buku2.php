<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="bg-gray-900 ">
        <div class="mx-auto flex justify-between items-center">
            <a href="#" class="text-3xl font-bold text-white">Perpustakaan</a>
            <div class="flex items-center space-x-4">
                <a href="home.php" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out">Kembali
                    ke daftar buku</a>
            </div>
        </div>
    </header>
    <!-- Existing HTML structure -->
    <main class="mx-auto mt-16 max-w-[80vw] flex flex-col items-center justify-center">
        <h2 class="text-3xl font-bold text-center mb-8">Detail Buku</h2>
        <form id="book-form" class="flex flex-wrap -mx-4">
            <div class="w-full mb-4">
                <label for="search-input" class="text-sm font-semibold">Cari Buku:</label>
                <div class="flex">
                    <input type="text" id="search-input"
                        class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mr-2"
                        placeholder="Masukkan kata kunci">
                    <button id="search-button" type="button"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Cari</button>
                </div>
            </div>
            <div class="w-full">
                <label for="book-select" class="text-sm font-semibold">Pilih Judul Buku:</label>
                <select id="book-select"
                    class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mt-1 mb-4">
                    <!-- Options will be dynamically added here -->
                </select>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                <img src="" alt="" class="w-full h-full object-cover rounded-md" id="book-image">
            </div>
            <div class="w-full md:w-1/2 xl:w-2/3 p-4" id="book-details">
                <!-- Book details will be dynamically filled here -->
                <input type="hidden" id="book-id" name="bookId">
                <input type="text" id="book-title" name="bookTitle"
                    class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mb-2"
                    placeholder="Judul Buku">
                <input type="text" id="book-author" name="bookAuthor"
                    class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mb-2"
                    placeholder="Penulis">
                <input type="text" id="book-isbn" name="bookIsbn"
                    class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mb-2" placeholder="ISBN">

                <textarea id="book-description" name="bookDescription"
                    class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mb-2" rows="4"
                    placeholder="Deskripsi"></textarea>
                <input type="text" id="book-publisher" name="bookPublisher"
                    class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mb-2"
                    placeholder="Penerbit">
                <input type="text" id="book-published-date" name="bookPublishedDate"
                    class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mb-2"
                    placeholder="Tahun Terbit">
                <input type="text" id="book-categories" name="bookCategories"
                    class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mb-4"
                    placeholder="Kategori">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan</button>
            </div>
        </form>
    </main>


    <script>
        // Function to populate form fields with book data
        function populateFormFields(book) {
            document.getElementById('book-id').value = book.id;
            document.getElementById('book-title').value = book.title || '';
            document.getElementById('book-author').value = book.authors ? book.authors.join(', ') : '';
            document.getElementById('book-description').value = book.description || '';
            document.getElementById('book-publisher').value = book.publisher || '';
            document.getElementById('book-published-date').value = book.publishedDate || '';
            document.getElementById('book-categories').value = book.categories ? book.categories.join(', ') : '';
            document.getElementById('book-isbn').value = book.industryIdentifiers ? book.industryIdentifiers[0]
                .identifier : '';
        }


        function populateSelect(data) {
            const selectElement = document.getElementById('book-select');
            selectElement.innerHTML = ''; // Clear existing options

            // Iterate through each book item in the data and create an option element
            data.items.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.volumeInfo.title;
                selectElement.appendChild(option);
            });

            // Trigger display of details for the first book in the list
            if (data.items.length > 0) {
                displayBookDetails(data.items[0].id);
            }
        }


        // Function to display book details based on selected book ID
        function displayBookDetails(bookId) {
            fetch(`https://www.googleapis.com/books/v1/volumes/${bookId}?key=AIzaSyBlMHZTsYUnzlxgpG8faz3_Db8iMN6eZKA`)
                .then(response => response.json())
                .then(data => {
                    const book = data.volumeInfo;
                    const img = document.getElementById('book-image');
                    img.src = book.imageLinks ? (book.imageLinks.thumbnail || 'https://via.placeholder.com/150') :
                        'https://via.placeholder.com/150'; // Fallback image if thumbnail is not available
                    img.alt = book.title;

                    populateFormFields(book); // Populate form fields with book data
                })
                .catch(error => console.error(error));
        }

        // Event listener for when a book is selected
        document.getElementById('book-select').addEventListener('change', function () {
            const selectedBookId = this.value;
            displayBookDetails(selectedBookId);
        });

        // Event listener for form submission
        document.getElementById('book-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            // Example: Post data to your server-side endpoint (replace with your actual implementation)
            const formData = new FormData(this);
            fetch('your-server-endpoint-url', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    alert('Data berhasil disimpan!'); // Example success message
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data.'); // Example error message
                });
        });

        // Remaining code for search button and initial data fetch remains unchanged


        // Function to handle search button click
        document.getElementById('search-button').addEventListener('click', function () {
            const searchQuery = document.getElementById('search-input').value.trim();
            if (searchQuery !== '') {
                const url =
                    `https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(searchQuery)}&key=AIzaSyBlMHZTsYUnzlxgpG8faz3_Db8iMN6eZKA`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => populateSelect(data))
                    .catch(error => console.error(error));
            }
        });


        // Fetch book titles from Google Books API initially (default query: programming)
        fetch('https://www.googleapis.com/books/v1/volumes?q=&key=AIzaSyBlMHZTsYUnzlxgpG8faz3_Db8iMN6eZKA')
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