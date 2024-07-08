<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: ../../function/Process.php");
    exit();
}

include "../../../config/koneksi.php"; // Adjust path as necessary

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input (you can add more validation as needed)
    $fullname = filter_var($_POST['fullname'], );
    $username = filter_var($_POST['username'], );
    $alamat = filter_var($_POST['alamat'], );
    $email = filter_var($_POST['email'], );
    $notelp = filter_var($_POST['notelp'], );

    // Ensure id_user is set in the session
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        // Prepare and bind the update query
        $query = "UPDATE user SET fullname = ?, username = ?, alamat = ?, email = ?, notelp = ? WHERE id_user = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("sssssi", $fullname, $username, $alamat, $email, $notelp, $id_user);

        // Execute the update query
        if ($stmt->execute()) {
            $_SESSION['updated_berhasil'] = "Profile updated successfully!";
        } else {
            $_SESSION['updated_gagal'] = "Failed to update profile.";
        }

        $stmt->close();
    } else {
        $_SESSION['updated_gagal'] = "User not authenticated.";
    }
} else {
    $_SESSION['updated_gagal'] = "Invalid request method.";
}

// Redirect back to the profile page
header("Location: ../profile.php");
exit();
?>
