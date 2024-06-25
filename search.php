<?php
include "config/koneksi.php";

$q = $_GET['q'];
$sql = "SELECT * FROM buku WHERE judul_buku LIKE '%$q%'";
$result = mysqli_query($koneksi, $sql);

if ($result) {
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $books = [];
}

$colors = [
    'bg-red-500',
    'bg-green-500',
    'bg-blue-500',
    'bg-yellow-500',
    'bg-purple-500',
    'bg-pink-500',
    'bg-indigo-500',
    'bg-teal-500'
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-screen h-svh">
        <?php if (!empty($books)): ?>
            <div class="pt-10 flex w-full h-auto">
                <span class="text-xl font-black text-center justify-center w-full flex">Pencarian : <?php echo $q ?></span>
            </div>
            <div class="p-1 flex flex-wrap items-start justify-center">
                <?php foreach ($books as $book): ?>
                    <?php
                    $randomColor = $colors[array_rand($colors)];
                    ?>
                    <div
                        class="flex-shrink-0 m-6 relative overflow-hidden <?= $randomColor ?> rounded-lg max-w-xs shadow-lg w-[230px] h-auto">
                        <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                            style="transform: scale(1.5); opacity: 0.1;">
                            <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                                fill="white" />
                            <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
                        </svg>
                        <div class="relative pt-5 px-5 flex items-center justify-center">
                            <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                                style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                            </div>
                            <img class="relative w-full h-[250px] bg-none rounded-2xl" src="<?= $book['img']; ?>"
                            alt="<?= $book['judul_buku']; ?>">
                        </div>
                        <div class="flex flex-col relative text-white px-6 pb-6 mt-6 gap-3">
                            <span class="block opacity-75 text-sm -mb-1"><?= $book['pengarang']; ?></span>
                            <span class="flex font-semibold text-md line-clamp-2 h-auto break-words"><?= $book['judul_buku']; ?></span>
                            <a href="detail.php?id=<?= $book['id_buku']; ?>"
                                class="block bg-black/50 hover:bg-black/90 hover:scale-105 duration-200 text-white font-bold py-2 px-4 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Detail
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No books found.</p>
        <?php endif; ?>
    </div>
</body>

</html>