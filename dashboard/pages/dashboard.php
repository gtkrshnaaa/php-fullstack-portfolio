<?php
// pages/dashboard.php

session_start();
include '../includes/config.php';

// Pastikan user telah login sebelum mengakses halaman dashboard
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Ambil data dari tabel gtkprofileCardHeroTable
$sql_item1 = "SELECT * FROM gtkprofileCardHeroTable";
$result_item1 = mysqli_query($conn, $sql_item1);

// Ambil data dari tabel gtkprofileProjectTable
$sql_item2 = "SELECT * FROM gtkprofileProjectTable";
$result_item2 = mysqli_query($conn, $sql_item2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Card Hero -->
    <section class="itemabcd mt-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Card Hero</h3>
                <a href="manage-cardhero/add_cardhero.php" class="btn btn-dark"><i class="uil uil-plus"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>GitHub Repositories</th>
                            <th>Stars in total</th>
                            <th>Client</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row_item1 = mysqli_fetch_assoc($result_item1)) { ?>
                            <tr>
                                <td><?php echo $row_item1['githubrepo']; ?>+</td>
                                <td><?php echo $row_item1['repostar']; ?>+</td>
                                <td><?php echo $row_item1['clientt']; ?>+</td>
                                <td>
                                    <?php
                                    // Convert binary image data to base64 format
                                    $imageData = base64_encode($row_item1['cardphoto_blob']);
                                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                                    ?>
                                    <img src="<?php echo $imageSrc; ?>" alt="Card Image" style="max-width: 100px;">
                                </td>
                                <td>
                                    <a href="manage-cardhero/edit_cardhero.php?id=<?php echo $row_item1['id']; ?>" class="btn btn-outline-dark"><i class="uil uil-edit"></i></a>
                                    <a href="manage-cardhero/delete_cardhero.php?id=<?php echo $row_item1['id']; ?>" class="btn btn-outline-danger"><i class="uil uil-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Projects -->
    <section class="itemabcd mt-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Projects</h3>
                <a href="manage-project/add_project.php" class="btn btn-dark">Add Project</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Tech Stack</th>
                            <th>Project Link</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row_item2 = mysqli_fetch_assoc($result_item2)) { ?>
                            <tr>
                                <td><?php echo $row_item2['title']; ?></td>
                                <td><?php echo $row_item2['descript']; ?></td>
                                <td><?php echo $row_item2['techstack']; ?></td>
                                <td><?php echo $row_item2['projectlink']; ?></td>
                                <td>
                                    <?php
                                    // Convert binary image data to base64 format
                                    $imageData = base64_encode($row_item2['image_blob']);
                                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                                    ?>
                                    <img src="<?php echo $imageSrc; ?>" alt="Project Image" style="max-width: 100px;">
                                </td>
                                <td class="text-nowrap">
                                    <a href="manage-project/edit_project.php?id=<?php echo $row_item2['id']; ?>" class="btn btn-outline-dark"><i class="uil uil-edit"></i></a>
                                    <a href="manage-project/project_detail.php?id=<?php echo $row_item2['id']; ?>" class="btn btn-outline-dark"><i class="uil uil-eye"></i></a>
                                    <a href="manage-project/delete_project.php?id=<?php echo $row_item2['id']; ?>" class="btn btn-outline-danger"><i class="uil uil-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php mysqli_close($conn); ?>
