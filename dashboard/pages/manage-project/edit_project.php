<?php
// pages/Project/edit_Project.php

session_start();
include '../../includes/config.php';

// Pastikan user telah login sebelum mengakses halaman dashboard
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $descript = $_POST['descript'];
    $techstack = $_POST['techstack'];
    $projectlink = $_POST['projectlink'];

    // Periksa apakah ada file yang diunggah
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Hapus gambar lama dari server
        $oldImage = $row['image_blob'];
        if(!empty($oldImage)) {
            unlink($oldImage);
        }

        // Upload gambar baru
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $escapedImageData = mysqli_real_escape_string($conn, $imageData);
        $sql = "UPDATE gtkprofileProjectTable SET title='$title', descript='$descript', image_blob='$escapedImageData', techstack='$techstack', projectlink='$projectlink' WHERE id='$id'";
    } else {
        // Jika tidak ada gambar baru diunggah, gunakan gambar lama
        $sql = "UPDATE gtkprofileProjectTable SET title='$title', descript='$descript', techstack='$techstack', projectlink='$projectlink' WHERE id='$id'";
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
$sql = "SELECT * FROM gtkprofileProjectTable WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="edit-itemabcd1 base-mt container">
        <h2 class="mt-5">Edit Project</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="descript">Description</label>
                <textarea class="form-control" id="descript" name="descript"><?php echo $row['descript']; ?></textarea>
            </div>
            <?php
                // Convert binary image data to base64 format
                $imageData = base64_encode($row['image_blob']);
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            ?>
            <div class="form-group">
                <label>Current Image:</label><br>
                <!-- Tampilkan gambar menggunakan base64 -->
                <img src="<?php echo $imageSrc; ?>" alt="Current Image" width="250px" class="img-thumbnail"><br>
                <!-- Tambahkan input file untuk memungkinkan pengguna memilih gambar baru -->
                <label for="image">New Image</label><br>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="techstack">Tech Stack</label>
                <input type="text" class="form-control" id="techstack" name="techstack" value="<?php echo $row['techstack']; ?>">
            </div>
            <div class="form-group">
                <label for="projectlink">Project Link</label>
                <input type="text" class="form-control" id="projectlink" name="projectlink" value="<?php echo $row['projectlink']; ?>">
            </div>
            <div class="ep-btn">
                <a href="../dashboard.php" class="btn btn-outline-dark">Cancel</a>
                <button type="submit" class="btn btn-dark" name="submit">Save</button>
            </div>
        </form>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
