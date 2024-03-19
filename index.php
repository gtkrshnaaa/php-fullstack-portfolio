<?php
session_start();
include 'dashboard/includes/config.php';

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
    <title>Portofolio</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<nav class="navbar">
        <img class="logo" src="assets/img/logo.png" width="60px">
        <button class="nav-btn active mt-2" onclick="scrollToSection('home')" data-target="home"><i class="uil uil-estate"></i> Home</button>
        <button class="nav-btn" onclick="scrollToSection('about')" data-target="about"><i class="uil uil-user"></i> About</button>
        <button class="nav-btn" onclick="scrollToSection('portfolio')" data-target="portfolio"><i class="uil uil-layers"></i> Portfolio</button>
        <button class="nav-btn" onclick="scrollToSection('contact')" data-target="contact"><i class="uil uil-message"></i> Contact</button>
    </nav>

    <main class="main-content">
        <section id="home" class="home">
            <h1 class="home-name">Gilang Teja Krishna</h1>
            <p class="home-dsc mt-2">I am Gilang Teja Krishna, <span>a student and Fullstack Web Developer</span>. I am delighted to share my work and experiences with you here.
            </p>

        <?php $row_item1 = mysqli_fetch_assoc($result_item1) ?>
            <div class="box mt-2">
            <?php
                // Convert binary image data to base64 format
                $imageData = base64_encode($row_item1['cardphoto_blob']);
                $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                ?>
                <img src="<?php echo $imageSrc; ?>">
                <div class="box-dsc">
                    <p class="box-txt"><span><?php echo $row_item1['githubrepo']; ?>+</span> GitHub Repositories</p>
                    <p class="box-txt"><span><?php echo $row_item1['repostar']; ?>+</span> Stars in total</p>
                    <p class="box-txt"><span><?php echo $row_item1['clientt']; ?>+</span> Client</p>
                </div>
            </div>
            <p class="home-dsc mt-2">As a Fullstack Web Developer, I have developed and designed various types of websites involving advanced technologies such as HTML, CSS, JavaScript, and PHP. I am always seeking ways to enhance my skills and explore new technologies that can assist me in creating better solutions.
            </p>
            <div class="home-link mt-2">
                <a href="https://www.linkedin.com/in/gilangtejakrishna/" target="_blank">LinkedIn</a>
                <a href="https://github.com/gtkrshnaaa" target="_blank">GitHub</a>
            </div>
        </section>

        <section id="about" class="about">
            <h2><span class="tags">#  </span> A Junior Web Developer</h2>
            <p>Hello there! I'm Gilang, a passionate Fullstack Web Developer based in Indonesia. With a blend of creativity and technical prowess, I thrive on bringing digital ideas to life through elegant and efficient web solutions.</p>

            <h3>Crafting Digital Experiences</h3>
            <p>My journey in web development has been driven by a relentless curiosity to explore the ever-evolving landscape of technology. From crafting pixel-perfect designs to implementing robust backend systems, I enjoy every aspect of the development process. Whether it's a sleek user interface or a powerful database architecture, I'm committed to delivering excellence in every project I undertake.</p>

            <h3>Continuous Learning and Innovation</h3>
            <p>In the dynamic world of technology, staying ahead means embracing continuous learning. I am constantly honing my skills and staying abreast of the latest trends and frameworks. From mastering the intricacies of JavaScript to delving into the intricacies of backend frameworks like Laravel, I'm always eager to expand my toolkit.</p>

            <h3>Let's Collaborate</h3>
            <p>Beyond the lines of code, I am a firm believer in the power of collaboration. I cherish the opportunity to work alongside visionary entrepreneurs, creative minds, and fellow developers. Together, we can turn ideas into impactful digital experiences that resonate with audiences worldwide.</p>

            <h3>Get in Touch</h3>
            <p>Are you ready to embark on a digital journey? Whether you have a groundbreaking project in mind or simply want to connect, I'd love to hear from you. Feel free to reach out via email or connect with me on LinkedIn</p>

            <p>Let's create something extraordinary together!</p>
        </section>

        <section id="portfolio" class="portfolio">
            <a class="linktodshb" href="dashboard/pages/dashboard.php">
            <h2><span class="tags">#  </span> Portofolio</h2>
            </a>
            <div class="portfolio-list">
                <?php while ($row_item2 = mysqli_fetch_assoc($result_item2)) { ?>
                    <div class="portfolio-card">
                        <?php
                        // Convert binary image data to base64 format
                        $imageData = base64_encode($row_item2['image_blob']);
                        $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                        ?>
                        <img src="<?php echo $imageSrc; ?>" alt="<?php echo $row_item2['title']; ?>">
                        <h3><?php echo $row_item2['title']; ?></h3>
                        <p><?php echo $row_item2['techstack']; ?></p>
                        <a href="dashboard/pages/manage-project/project_detail.php?id=<?php echo $row_item2['id']; ?>" class="btn">View Detail</a>
                    </div>
                <?php } ?>
            </div>
        </section>

        <section id="contact" class="contact">
            <h2><span class="tags">#  </span> Lets Talk</h2>
            <p>I enjoy communicating with fellow developers, entrepreneurs, or individuals who share an interest in technology. Please feel free to contact me through one of the options below.</p>
            <div class="contact-link mt-2">
                <a href="#">WhatsApp</a>
                <a href="#">Telegram</a>
            </div>
        </section>

        <br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br>


    </main>

    <script src="assets/js/script.js"></script>
</body>
</html>
