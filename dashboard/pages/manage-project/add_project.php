<?php
session_start();
include '../../includes/config.php';

// Pastikan user telah login sebelum mengakses halaman dashboard
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $descript = $_POST['descript'];
    $techstack = $_POST['techstack'];
    $projectlink = $_POST['projectlink'];

    // Handle image upload
    $imageData = file_get_contents($_FILES['image']['tmp_name']); // Read image data

    // Prepare the image data for database insertion
    $escapedImageData = mysqli_real_escape_string($conn, $imageData);

    // Insert the data into the database
    $sql = "INSERT INTO gtkprofileProjectTable (title, descript, image_blob, techstack, projectlink) VALUES ('$title', '$descript', '$escapedImageData', '$techstack', '$projectlink')";
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
    <title>Add New Project - item</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="add-Project base-mt container">
        <h2 class="mt-5">Add New Project</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="descript">Description</label>
                <textarea class="form-control" id="descript" name="descript"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="techstack">Tech Stack</label>
                <input type="text" class="form-control" id="techstack" name="techstack">
            </div>
            <div class="form-group">
                <label for="projectlink">Project Link</label>
                <input type="text" class="form-control" id="projectlink" name="projectlink">
            </div>
            <div class="addp-btn">
                <a href="../dashboard.php" class="btn btn-outline-dark">Cancel</a>
                <button type="submit" class="btn btn-dark" name="submit">Save</button>
            </div>
        </form>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
