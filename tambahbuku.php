<form id="book-form" class="flex flex-wrap -mx-4" action="tambah-buku-action.php" method="post"
    enctype="multipart/form-data">
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
        <select id="book-select" class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mt-1 mb-4">
            <!-- Options will be dynamically added here -->
        </select>
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-4">
        <label for="book-image-file" class="text-sm font-semibold">Gambar Buku:</label>
        <input type="file" name="bookImage" id="book-image-file" class="block w-full mb-2" accept="image/*"
            onchange="previewImage(event)">
        <img src="" alt="" class="w-full h-full object-cover rounded-md" id="book-image-preview">
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

<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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
<script>
    function tambahBuku() {
        $('#modalTambahBuku').modal('show');
    }
</script>
<!-- jQuery 3 -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../assets/dist/js/sweetalert.min.js"></script>
<!-- Pesan Berhasil Edit -->
<script>
    < ? php
    if (isset($_SESSION['berhasil']) && $_SESSION['berhasil']) {
        echo "swal({
        icon: 'success',
            title: 'Berhasil',
            text: '$_SESSION[berhasil]'
    })
    ";
    }
    $_SESSION['berhasil'] = ''; ?
    >
</script>
<!-- Notif Gagal -->
<script>
    < ? php
    if (isset($_SESSION['gagal']) && $_SESSION['gagal']) {
        echo "swal({
        icon: 'error',
            title: 'Gagal',
            text: '$_SESSION[gagal]'
    })
    ";
    }
    $_SESSION['gagal'] = ''; ?
    >
</script>
<!-- Swal Hapus Data -->
<script>
    $('.btn-del').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Apakah anda yakin ingin menghapus data buku ini ?',
                buttons: true,
                dangerMode: true,
                buttons: ['Tidak, Batalkan !', 'Iya, Hapus']
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = href;
                } else {
                    swal({
                        icon: 'error',
                        title: 'Dibatalkan',
                        text: 'Data buku tersebut aman !'
                    })
                }
            });
    })
</script>