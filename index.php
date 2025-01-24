<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Architectural Services</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="icon" type="image/x-icon" href="./img/archi_logo.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    .btn-primary:hover {
        background-color: #008080;
        border-color: #ffffff;
    }
</style>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "archi";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $query = "SELECT archiaddress, architel, fb_link, twitter_link, ig_link, linkedin_link FROM architect LIMIT 1";
    $result = $conn->query($query);

    // Check if data is fetched
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No data found";
    }
    // Close the connection
    $conn->close();
    ?>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small><?php echo $row['archiaddress']; ?></small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small><?php echo $row['architel']; ?></small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="<?php echo $row['fb_link']; ?>"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1"
                        href="<?php echo $row['twitter_link']; ?>"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1"
                        href="<?php echo $row['linkedin_link']; ?>"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href="<?php echo $row['ig_link']; ?>"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->



    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <style>
            .navbar-logo {
                width: 50px;
                height: auto;
                display: inline-block;
            }
        </style>
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="./img/archi_logo.png" alt="Website Logo" class="navbar-logo">
            <h2 class="m-0 text-primary ms-2">Architectural Services</h2>
        </a>

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a class="nav-item nav-link" href="#home">Home</a>
                <a class="nav-item nav-link" href="#about">About</a>
                <a class="nav-item nav-link" href="#project">Project</a>
                <a class="nav-item nav-link" href="#contact">Contact</a>
            </div>
            <!-- <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Get A Quote<i class="fa fa-arrow-right ms-3"></i></a> -->
        </div>
    </nav>
    <!-- Navbar End -->
    <style>
        .owl-carousel-item img {
            width: 100%;
            height: 800px;
            object-fit: cover;
        }
    </style>
    <section id="home" class="welcome-hero">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "archi";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch carousel data
        $carouselQuery = "SELECT carousel_image1, carousel_image2, carousel_image3 FROM carousel WHERE archiid = 1 LIMIT 1";
        $carouselResult = $conn->query($carouselQuery);

        if ($carouselResult->num_rows > 0) {
            $carouselRow = $carouselResult->fetch_assoc();
        } else {
            echo "No carousel data found";
        }

        // Close the connection
        $conn->close();
        ?>

        <!-- Carousel Start -->
        <div class="container-fluid p-0 pb-5">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="uploads/<?php echo $carouselRow['carousel_image1']; ?>" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(53, 53, 53, .7);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-8 text-center">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Welcome to</h5>
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Architectural Services
                                    </h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">We believe that architecture is more
                                        than just designing buildings; it's about creating spaces that inspire,
                                        innovate, and transform.</p>
                                    <a href="login.php"
                                        class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Book Your
                                        Appointment Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="uploads/<?php echo $carouselRow['carousel_image2']; ?>" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(53, 53, 53, .7);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-8 text-center">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Welcome to</h5>
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Architectural Services
                                    </h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Already have an account?</p>
                                    <a href="login.php"
                                        class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Log In Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="uploads/<?php echo $carouselRow['carousel_image3']; ?>" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(53, 53, 53, .7);">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-8 text-center">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Welcome to</h5>
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Architectural Services
                                    </h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Didn't Register Yet?</p>
                                    <a href="signup.php"
                                        class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Register
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

    </section>

    <section id="about">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "archi";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch about data
        $aboutQuery = "SELECT about_description, about_image, service_1, service_2, service_3, service_4, service_icon1, service_icon2, service_icon3, service_icon4 FROM about WHERE archiid = 1 LIMIT 1";
        $aboutResult = $conn->query($aboutQuery);

        if ($aboutResult->num_rows > 0) {
            $aboutRow = $aboutResult->fetch_assoc();
        } else {
            echo "No about data found";
        }

        // Close the connection
        $conn->close();
        ?>

        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                style="width: 60px; height: 60px;">
                                <i class="<?php echo $aboutRow['service_icon1']; ?> fa-2x text-primary"></i>
                            </div>
                            <h1 class="display-1 text-light mb-0">01</h1>
                        </div>
                        <h5><?php echo $aboutRow['service_1']; ?></h5>
                    </div>
                    <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                style="width: 60px; height: 60px;">
                                <i class="<?php echo $aboutRow['service_icon2']; ?> fa-2x text-primary"></i>
                            </div>
                            <h1 class="display-1 text-light mb-0">02</h1>
                        </div>
                        <h5><?php echo $aboutRow['service_2']; ?></h5>
                    </div>
                    <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                style="width: 60px; height: 60px;">
                                <i class="<?php echo $aboutRow['service_icon3']; ?> fa-2x text-primary"></i>
                            </div>
                            <h1 class="display-1 text-light mb-0">03</h1>
                        </div>
                        <h5><?php echo $aboutRow['service_3']; ?></h5>
                    </div>
                    <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                style="width: 60px; height: 60px;">
                                <i class="<?php echo $aboutRow['service_icon4']; ?> fa-2x text-primary"></i>
                            </div>
                            <h1 class="display-1 text-light mb-0">04</h1>
                        </div>
                        <h5><?php echo $aboutRow['service_4']; ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Start -->

        <!-- About Start -->
        <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
            <div class="container about px-lg-0">
                <div class="row g-0 mx-lg-0">
                    <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute img-fluid w-100 h-100"
                                src="img/<?php echo $aboutRow['about_image']; ?>" style="object-fit: cover;" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                        <div class="p-lg-5 pe-lg-0">
                            <div class="section-title text-start">
                                <h1 class="display-5 mb-4">About Us</h1>
                            </div>
                            <p class="mb-4 pb-2"><?php echo $aboutRow['about_description']; ?></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- About End -->
    </section>

    <section id="project">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "archi";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        ?>
        <style>
            .portfolio-item img {
                width: 100%;
                height: 300px;
                object-fit: cover;
            }
        </style>
        <!-- Services Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="section-title text-center">
                    <h1 class="display-5 mb-5">Our Services</h1>
                </div>
                <div class="row g-4 portfolio-container">
                    <?php
                    $query = "SELECT service_name, service_description, service_image, service_cost, service_date FROM project";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        $delay = 0.1;
                        while ($row = $result->fetch_assoc()) {
                            // Calculate the cost breakdown
                            $cost_30 = $row['service_cost'] * 0.3;
                            $cost_70 = $row['service_cost'] * 0.7;
                            $total_cost = $row['service_cost'];
                            $service_date = date("M d, Y", strtotime($row["service_date"]));
                            ?>
                            <div class="col-lg-4 col-md-6 portfolio-item wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                                <div class="rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="uploads/<?php echo $row['service_image']; ?>" alt="">
                                        <div class="portfolio-overlay">
                                            <a class="btn btn-square btn-outline-light mx-1"
                                                href="uploads/<?php echo $row['service_image']; ?>" data-lightbox="portfolio"><i
                                                    class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="border border-5 border-light border-top-0 p-4">
                                        <p class="text-primary fw-medium mb-2"><?php echo $row['service_name']; ?></p>
                                        <h5 class="lh-base mb-0"><?php echo $row['service_description']; ?></h5>
                                        <p class="text-secondary mb-0">Initial Payment: ₱<?php echo $cost_30; ?></p>
                                        <p class="text-secondary mb-0">Remaining Payment: ₱<?php echo $cost_70; ?></p>
                                        <p class="text-secondary mb-0">Service Total Cost: ₱<?php echo $total_cost; ?></p>
                                        <!-- <p class="text-secondary mb-0">Date: <?php echo $service_date ?></p> -->
                                    </div>
                                </div>
                            </div>
                            <?php
                            $delay += 0.2; // Increase the delay for the next item
                        }
                    } else {
                        echo "<p>No services found.</p>";
                    }

                    $conn->close();
                    ?>

                </div>
            </div>
        </div>
        <!-- Services End -->

    </section>


    <section id="feature">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "archi";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $chooseusQuery = "SELECT chooseus_description, chooseus_image, feature_1, feature_2, feature_3, feature_4,featuretitle_1, featuretitle_2, featuretitle_3, featuretitle_4, feature_icon1, feature_icon2, feature_icon3, feature_icon4 FROM chooseus WHERE archiid = 1 LIMIT 1";
        $chooseusResult = $conn->query($chooseusQuery);

        if ($chooseusResult->num_rows > 0) {
            $chooseusRow = $chooseusResult->fetch_assoc();
        } else {
            echo "No chooseus data found";
        }

        $conn->close();
        ?>
        <!-- Feature Start -->
        <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
            <div class="container feature px-lg-0">
                <div class="row g-0 mx-lg-0">
                    <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.5s">
                        <div class="p-lg-5 ps-lg-0">
                            <div class="section-title text-start">
                                <h1 class="display-5 mb-4">Why Choose Us</h1>
                            </div>
                            <p class="mb-4 pb-2"><?php echo $chooseusRow['chooseus_description']; ?></p>
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-check fa-2x text-primary"></i>
                                        </div>
                                        <div class="ms-4">
                                            <p class="mb-2"><?php echo $chooseusRow['feature_1']; ?></p>
                                            <h5 class="mb-0"><?php echo $chooseusRow['featuretitle_1']; ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-user-check fa-2x text-primary"></i>
                                        </div>
                                        <div class="ms-4">
                                            <p class="mb-2"><?php echo $chooseusRow['feature_2']; ?></p>
                                            <h5 class="mb-0"><?php echo $chooseusRow['featuretitle_2']; ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-drafting-compass fa-2x text-primary"></i>
                                        </div>
                                        <div class="ms-4">
                                            <p class="mb-2"><?php echo $chooseusRow['feature_3']; ?></p>
                                            <h5 class="mb-0"><?php echo $chooseusRow['featuretitle_3']; ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-headphones fa-2x text-primary"></i>
                                        </div>
                                        <div class="ms-4">
                                            <p class="mb-2"><?php echo $chooseusRow['feature_4']; ?></p>
                                            <h5 class="mb-0"><?php echo $chooseusRow['featuretitle_4']; ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute img-fluid w-100 h-100"
                                src="img/<?php echo $chooseusRow['chooseus_image']; ?>" style="object-fit: cover;"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End -->
    </section>

    <section id="project">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "archi";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        ?>
        <style>
            .portfolio-item img {
                width: 100%;
                height: 300px;
                object-fit: cover;
            }
        </style>
        <!-- Projects Done Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="section-title text-center">
                    <h1 class="display-5 mb-5">Finished Projects</h1>
                </div>
                <div class="row g-4 portfolio-container">
                    <?php
                    $query = "SELECT project_name, project_description, project_image, project_cost, project_startdate , project_enddate FROM finished_project";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        $delay = 0.1;
                        while ($row = $result->fetch_assoc()) {
                            $project_startdate = date("M d, Y", strtotime($row["project_startdate"]));
                            $project_enddate = date("M d, Y", strtotime($row["project_enddate"]));
                            ?>
                            <div class="col-lg-4 col-md-6 portfolio-item wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                                <div class="rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="uploads/<?php echo $row['project_image']; ?>" alt="">
                                        <div class="portfolio-overlay">
                                            <a class="btn btn-square btn-outline-light mx-1"
                                                href="uploads/<?php echo $row['project_image']; ?>" data-lightbox="portfolio"><i
                                                    class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="border border-5 border-light border-top-0 p-4">
                                        <p class="text-primary fw-medium mb-2"><?php echo $row['project_name']; ?></p>
                                        <h5 class="lh-base mb-0"><?php echo $row['project_description']; ?></h5>
                                        <h6 class="lh-base mb-0">Client Name</h6>
                                        <p class="text-secondary mb-0">Cost: ₱<?php echo $row['project_cost']; ?></p>
                                        <p class="text-secondary mb-0">Start Date: <?php echo $project_startdate ?></p>
                                        <p class="text-secondary mb-0">Finished Date: <?php echo $project_enddate ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $delay += 0.2; // Increase the delay for the next item
                        }
                    } else {
                        echo "<p>No projects found.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
        <!-- Projects Done End -->
    </section>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "archi";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Team Members</h1>
            </div>
            <div class="row g-3">
                <?php
                $query = "SELECT name, role, profile_image, social_media_1, social_media_2, social_media_3 FROM team";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $delay = 0.1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                            <div class="team-item">
                                <div class="overflow-hidden position-relative">
                                    <img style="width: 100%; height: 400px; object-fit: cover;" class="img-fluid"
                                        src="img/<?php echo $row['profile_image']; ?>" alt="">
                                    <div class="team-social">
                                        <a class="btn btn-square" href="<?php echo $row['social_media_1']; ?>"><i
                                                class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-square" href="<?php echo $row['social_media_2']; ?>"><i
                                                class="fab fa-twitter"></i></a>
                                        <a class="btn btn-square" href="<?php echo $row['social_media_3']; ?>"><i
                                                class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="text-center border border-5 border-light border-top-0 p-4">
                                    <h5 class="mb-0"><?php echo $row['name']; ?></h5>
                                    <small><?php echo $row['role']; ?></small>
                                </div>
                            </div>
                        </div>
                        <?php
                        $delay += 0.2; // Increase the delay for the next item
                    }
                } else {
                    echo "<p>No team members found.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Feedback Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Feedback</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <?php
                include("connection.php");

                // Fetch feedback from the database
                $sql = "SELECT client_name, client_profession, feedback_message, client_image FROM feedback ORDER BY feedback_date DESC";
                $result = $database->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $client_name = $row['client_name'];
                        $client_profession = $row['client_profession'];
                        $feedback_message = $row['feedback_message'];
                        $client_image = $row['client_image'];

                        echo '
                    <div class="testimonial-item text-center">
                        <img class="img-fluid bg-light p-2 mx-auto mb-3" src="./uploads/' . $client_image . '" style="width: 90px; height: 90px;">
                        <div class="testimonial-text text-center p-4">
                            <p>' . $feedback_message . '</p>
                            <h5 class="mb-1">' . $client_name . '</h5>
                            <span class="fst-italic">' . $client_profession . '</span>
                        </div>
                    </div>';
                    }
                } else {
                    echo '<p class="text-center">No feedback available yet.</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Feedback End -->


    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "archi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT archiaddress, archiemail, architel, fb_link, twitter_link, ig_link, linkedin_link FROM architect LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No data found";
    }
    $conn->close();
    ?>
    <section id="contact">
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div style="margin: auto;width: 300px;" class="col-lg-3 col-md-6">
                        <!-- <h4 class="text-light mb-4">Address</h4> -->
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?php echo $row['archiaddress']; ?></p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?php echo $row['architel']; ?></p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i><?php echo $row['archiemail']; ?></p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="<?php echo $row['twitter_link']; ?>"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="<?php echo $row['fb_link']; ?>"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="<?php echo $row['ig_link']; ?>"><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href="<?php echo $row['linkedin_link']; ?>"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Architectural Services</a>, All Right Reserved.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </section>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>