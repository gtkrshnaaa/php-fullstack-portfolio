<?php
session_start();
include '../../includes/config.php';

// Pastikan user telah login sebelum mengakses halaman dashboard
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_POST['submit'])) {
    $githubrepo = $_POST['githubrepo'];
    $repostar = $_POST['repostar'];
    $clientt = $_POST['clientt'];

    // Handle image upload
    $imageData = file_get_contents($_FILES['image']['tmp_name']); // Read image data

    // Prepare the image data for database insertion
    $escapedImageData = mysqli_real_escape_string($conn, $imageData);

    // Insert the data into the database
    $sql = "INSERT INTO gtkprofileCardHeroTable (cardphoto_blob, githubrepo, repostar, clientt) VALUES ('$escapedImageData', '$githubrepo', '$repostar', '$clientt')";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Card Hero</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container mt-5">
        <h2>Add New Card Hero</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>

            <div class="form-group">
                <label for="githubrepo">Number GitHub Repo</label>
                <input type="text" class="form-control" id="githubrepo" name="githubrepo">
            </div>

            <div class="form-group">
                <label for="repostar">Number Repo Star</label>
                <input type="text" class="form-control" id="repostar" name="repostar">
            </div>
            
            <div class="form-group">
                <label for="clientt">Number Client</label>
                <input type="text" class="form-control" id="clientt" name="clientt">
            </div>

            <div class="form-group">
                <a href="../dashboard.php" class="btn btn-outline-dark">Cancel</a>
                <input type="submit" class="btn btn-dark" name="submit" value="Save">
            </div>
        </form>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
