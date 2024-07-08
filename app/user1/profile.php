<?php 
session_start();

// Ensure the user is logged in before accessing this page
if (!isset($_SESSION['username'])) {
    header("Location: ../../function/Process.php");
    exit();
}

include "../../config/koneksi.php";

// Get the user ID from the session
$id_user = $_SESSION['id_user'];

// Fetch user data from the database
$query = "SELECT * FROM user WHERE id_user = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .card {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card-header {
            font-family: 'Quicksand', sans-serif;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .card-body {
            text-align: left;
        }
    </style>
    <?php @include('head.php');?>
</head>
<body>
<div class="content-wrapper text-center">
    <section class="content-header my-5">
        <div class="card">
            <div class="card-header">
                <h1>
                    Identitas Profile
                </h1>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-sm" id="fullname" value="<?= htmlspecialchars($row['fullname']); ?>" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control form-control-sm" id="nis" value="<?= htmlspecialchars($row['username']); ?>" name="nis" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea class="form-control form-control-sm" style="height: 80px; resize: none;" id="alamat" name="alamat" required><?= htmlspecialchars($row['alamat']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" value="<?= htmlspecialchars($row['email']); ?>" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="notelp">Nomor Telepon</label>
                        <input type="text" class="form-control form-control-sm" id="notelp" value="<?= htmlspecialchars($row['notelp']); ?>" name="notelp" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script src="path/to/plugins.js"></script>
<script src="path/to/script.js"></script>

</body>
</html>
