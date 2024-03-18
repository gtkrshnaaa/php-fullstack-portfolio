<?php
// pages/itemabcd2/itemabcd2_detail.php

session_start();
include '../../includes/config.php';

// Pastikan user telah login sebelum mengakses halaman dashboard
// if (!isset($_SESSION['username'])) {
//     header('Location: ../login.php');
//     exit();
// }

if(isset($_GET['id'])) {
    $itemabcd2_id = $_GET['id'];

    // Ambil detail proyek dari database
    $sql = "SELECT * FROM gtkprofileProjectTable WHERE id = $itemabcd2_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $descript = $row['descript'];
        $imageData = $row['image_blob'];
        $techstack = $row['techstack'];
        $projectlink = $row['projectlink'];
    } else {
        echo "Proyek tidak ditemukan.";
    }
} else {
    echo "ID proyek tidak diberikan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Detail - item</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand">Item Detail</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="../../../index.php" class="nav-link">Home</a>
                </li>
            </ul>
        </div>
    </nav>


    <main class="container mt-5 mb-5">
        <section class="mt-5">
            <h2><?php echo $title; ?></h2>
            <?php
            // Convert binary image data to base64 format
            $imageDataEncoded = base64_encode($imageData);
            $imageSrc = 'data:image/jpeg;base64,' . $imageDataEncoded;
            ?>
            <img src="<?php echo $imageSrc; ?>" alt="<?php echo $title; ?>" class="img-fluid mb-3">
            <p><?php echo $descript; ?></p>
            <p class="techstack"><?php echo $techstack; ?></p>
            <a href="<?php echo $projectlink; ?>" target="_blank"><?php echo $projectlink; ?></a>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

