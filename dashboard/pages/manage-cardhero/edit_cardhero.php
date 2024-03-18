<?php
// pages/itemabcd1/edit_itemabcd1.php

session_start();
include '../../includes/config.php';

// Pastikan user telah login sebelum mengakses halaman dashboard
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $githubrepo = $_POST['githubrepo'];
    $repostar = $_POST['repostar'];
    $clientt = $_POST['clientt'];

    // Cek apakah ada file gambar yang diunggah
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Handle image upload
        $imageData = file_get_contents($_FILES['image']['tmp_name']); // Read image data

        // Prepare the image data for database insertion
        $escapedImageData = mysqli_real_escape_string($conn, $imageData);
        $sql = "UPDATE gtkprofileCardHeroTable SET cardphoto_blob='$escapedImageData', githubrepo='$githubrepo', repostar='$repostar', clientt='$clientt' WHERE id='$id'";
    } else {
        // Jika tidak ada file gambar yang diunggah, lakukan update tanpa memperbarui gambar
        $sql = "UPDATE gtkprofileCardHeroTable SET githubrepo='$githubrepo', repostar='$repostar', clientt='$clientt' WHERE id='$id'";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ../dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Mendapatkan data proyek berdasarkan ID
$id = $_GET['id'];
$sql = "SELECT * FROM gtkprofileCardHeroTable WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Card Hero</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container edit-itemabcd1 mt-5">
        <h2>Edit Card Hero</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <?php
                // Convert binary image data to base64 format
                $imageData = base64_encode($row['cardphoto_blob']);
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            ?>
            <div class="form-group">
                <label for="image">Image</label><br>
                <img src="<?php echo $imageSrc; ?>" alt="Current Image" width="300px" class="mb-3"><br>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="githubrepo">GitHub Repo</label>
                <input type="text" class="form-control" id="githubrepo" name="githubrepo" value="<?php echo $row['githubrepo']; ?>">
            </div>

            <div class="form-group">
                <label for="repostar">Repo Star</label>
                <input type="text" class="form-control" id="repostar" name="repostar" value="<?php echo $row['repostar']; ?>">
            </div>
            
            <div class="form-group">
                <label for="clientt">Client</label>
                <input type="text" class="form-control" id="clientt" name="clientt" value="<?php echo $row['clientt']; ?>">
            </div>

            <div class="ep-btn">
                <a href="../dashboard.php" class="btn btn-outline-dark">Cancel</a>
                <input type="submit" class="btn btn-dark" name="submit" value="Save">
            </div>
        </form>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
