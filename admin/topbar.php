<style>
    /* Pixel Art Logo */
    .logo {
        margin: auto;
        background: white;
        border-radius: 50% 50%;
        color: #000000b3;
        height: 50px;
        width: 50px;
        position: relative;
        overflow: hidden;
        border: 2px solid #BD8F6E; /* Adding a border to match the color theme */
    }

    .logo > img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        image-rendering: pixelated; /* This makes the image pixelated */
    }

    /* Navbar Styles */
    #topNavBar {
        background-color: #BD8F6E !important;
        background: #BD8F6E !important;
        padding: 0;
    }

    /* Styling for Navbar */
    .navbar {
        font-family: 'Press Start 2P', cursive; /* Pixel-style font */
    }

    /* Text styles for links */
    .navbar a {
        text-decoration: none;
        color: #ffffff;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }

    .navbar a:hover {
        color: #ffcc00; /* Highlight color on hover */
    }

    /* Navbar content styles */
    .navbar .container-fluid {
        padding: 10px 15px;
    }

    .navbar h4 {
        font-family: 'Press Start 2P', cursive !important;
        font-size: 1.2rem;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Adds depth to text */
    }

    /* Navbar links */
    .navbar .text-light {
        font-size: 1rem;
        color: #ffffff;
        text-decoration: none;
    }

    .navbar .text-light:hover {
        color: #ffcc00;
    }

    /* Pixel Art Style Button (Logout) */
    .navbar .fa-power-off {
        font-size: 1.2rem;
        margin-left: 5px;
        transform: scale(1.2);
        transition: transform 0.3s ease;
    }

    .navbar .fa-power-off:hover {
        transform: scale(1.3);
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

<link rel="icon" href="./images/elvago.jpg" type="image/x-icon">
<!-- Pixel Art Navbar HTML -->
<nav class="navbar navbar-dark bg-primary fixed-top" id="topNavBar" style="padding: 0;">
    <div class="container-fluid mt-2 mb-2">
        <div class="col-lg-12">
            <div class="row align-items-center">
                <div class="col-md-1 float-left" style="display: flex;">
                    <div class="logo">
                        <img src="./../images/elvago.jpg" alt="<?php echo $_SESSION['setting_name']; ?> - Brand Logo">
                    </div>
                </div>
                <div class="col-md-9 float-left">
                    <h4 class="text-light"><a href="./../" class="text-reset"><b><?php echo $_SESSION['setting_name']; ?> Elvago Snack Admin Page</b></a></h4>
                </div>
                <div class="col-md-2 float-right">
                    <a href="ajax.php?action=logout" class="text-light"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
                </div>
            </div>
        </div>
    </div>
</nav>
