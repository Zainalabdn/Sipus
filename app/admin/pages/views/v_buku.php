<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Data Buku
            <small>
                <script type='text/javascript'>
                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                        'September',
                        'Oktober', 'November', 'Desember'
                    ];
                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth();
                    var thisDay = date.getDay(),
                        thisDay = myDays[thisDay];
                    var yy = date.getYear();
                    var year = (yy < 1000) ? yy + 1900 : yy;
                    document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                    //
                </script>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Buku</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Data Buku
                        </h3>
                        <div class="form-group m-b-2 text-right" style="margin-top: -20px; margin-bottom: -5px;">
                            <button type="button" onclick="tambahBuku()" class="btn btn-info"><i class="fa fa-plus"></i>
                                Tambah Buku</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>ISBN</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Deskripsi</th>
                                    <th>Buku Baik</th>
                                    <th>Buku Rusak</th>
                                    <th>Jumlah Buku</th>
                                    <th>Img</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../../config/koneksi.php";

                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['judul_buku']; ?></td>
                                    <td><?= $row['isbn']; ?></td>
                                    <td><?= $row['pengarang']; ?></td>
                                    <td><?= $row['penerbit_buku']; ?></td>
                                    <td><?= $row['deskripsi']; ?></td>
                                    <td><?= $row['j_buku_baik']; ?></td>
                                    <td><?= $row['j_buku_rusak']; ?></td>
                                    <td><?php
                                            $j_buku_rusak = $row['j_buku_rusak'];
                                            $j_buku_baik = $row['j_buku_baik'];

                                            echo $j_buku_rusak + $j_buku_baik;
                                            ?>
                                    </td>
                                    <td><?= $row['img']; ?></td>
                                    <td>
                                        <a href="#" data-target="#modalEditBuku<?= $row['id_buku']; ?>"
                                            data-toggle="modal" class="btn btn-info btn-sm"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="pages/function/Buku.php?act=hapus&id=<?= $row['id_buku']; ?>"
                                            class="btn btn-danger btn-sm btn-del"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="modalEditBuku<?= $row['id_buku']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="border-radius: 5px;">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"
                                                    style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
                                                    Edit Buku ( <?= $row['judul_buku']; ?> - <?= $row['pengarang']; ?> )
                                                </h4>
                                            </div>
                                            <form action="pages/function/Buku.php?act=edit"
                                                enctype="multipart/form-data" method="POST">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_buku" value="<?= $row['id_buku']; ?>">
                                                    <div class="form-group">
                                                        <label>Judul Buku <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <input type="text" class="form-control"
                                                            value="<?= $row['judul_buku']; ?>" name="judulBuku">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kategori Buku <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <select class="form-control" name="kategoriBuku">
                                                            <option selected value="<?= $row['kategori_buku']; ?>">
                                                                <?= $row['kategori_buku']; ?> ( Dipilih Sebelumnya )
                                                            </option>
                                                            <?php
                                                                include "../../config/koneksi.php";

                                                                $sql = mysqli_query($koneksi, "SELECT * FROM kategori");
                                                                while ($data = mysqli_fetch_array($sql)) {
                                                                ?>
                                                            <option value="<?= $data['nama_kategori']; ?>">
                                                                <?= $data['nama_kategori']; ?></option>
                                                            <?php
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Penerbit Buku <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <select class="form-control select2" name="penerbitBuku">
                                                            <option selected value="<?= $row['penerbit_buku']; ?>">
                                                                <?= $row['penerbit_buku']; ?> ( Dipilih Sebelumnya )
                                                            </option>
                                                            <?php
                                                                include "../../config/koneksi.php";

                                                                $sql = mysqli_query($koneksi, "SELECT * FROM penerbit");
                                                                while ($data = mysqli_fetch_array($sql)) {
                                                                ?>
                                                            <option value="<?= $data['nama_penerbit']; ?>">
                                                                <?= $data['nama_penerbit']; ?> (
                                                                <?= $data['verif_penerbit']; ?> )</option>
                                                            <?php
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pengarang <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <input type="text" class="form-control"
                                                            value="<?= $row['pengarang']; ?>" name="pengarang" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tahun Terbit <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <input type="number" min="2000" max="2100" class="form-control"
                                                            value="<?= $row['tahun_terbit']; ?>" name="tahunTerbit"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ISBN <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <input type="number" class="form-control"
                                                            value="<?= $row['isbn']; ?>" name="iSbn" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi"
                                                            rows="3"><?= $row['deskripsi']; ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jumlah Buku Baik <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <input type="number" class="form-control"
                                                            value="<?= $row['j_buku_baik']; ?>" name="jumlahBukuBaik"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jumlah Buku Rusak <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <input type="number" class="form-control"
                                                            value="<?= $row['j_buku_rusak']; ?>" name="jumlahBukuRusak"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gambar Buku <small style="color: red;">* Wajib
                                                                diisi</small></label>
                                                        <!-- Current image display -->
                                                        <img src="<?= $row['img']; ?>" alt="Gambar Buku" width="100">
                                                        <br><br>
                                                        <!-- File upload input -->
                                                        <label for="imgUpload">Upload Gambar Baru:</label>
                                                        <input type="file" class="form-control" name="img"
                                                            id="imgUpload">
                                                        <!-- Hidden input to store current image -->
                                                        <input type="hidden" name="img_lama"
                                                            value="<?= $row['img']; ?>">
                                                        <br>
                                                        <!-- Input for image link -->
                                                        <label for="imgLink">Atau Masukkan Link Gambar:</label>
                                                        <input type="text" class="form-control" id="imgLink"
                                                            name="img_link" placeholder="Link gambar (opsional)">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /. Modal Edit -->
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modalTambahBuku">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Tambah Buku
                </h4>
            </div>
            <form id="book-form" class="flex flex-wrap -mx-4" action="tambah-buku-action.php" method="post" enctype="multipart/form-data">
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
                        class="block w-full bg-white border border-gray-300 rounded-md py-2 px-3 mb-2"
                        placeholder="ISBN">

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
                    <button type="submit" name="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>

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
    <?php
    if (isset($_SESSION['berhasil']) && $_SESSION['berhasil']) {
        echo "swal({
        icon: 'success',
            title: 'Berhasil',
            text: '$_SESSION[berhasil]'
    })
    ";
    }
    $_SESSION['berhasil'] = ''; 
    ?>
</script>
<!-- Notif Gagal -->
<script>
    <?php
    if (isset($_SESSION['gagal']) && $_SESSION['gagal']) {
        echo "swal({
        icon: 'error',
            title: 'Gagal',
            text: '$_SESSION[gagal]'
    })
    ";
    }
    $_SESSION['gagal'] = ''; 
    ?>
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