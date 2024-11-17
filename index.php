<?php ob_start(); ?>
<?php  
// Start the session
session_start();

include('header.php');
include('admin/db_connect.php');

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['login_user_id'] = $user['id'];
        $_SESSION['login_first_name'] = $user['first_name'];
        $_SESSION['login_last_name'] = $user['last_name'];

        // Redirect to the homepage or dashboard
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elvago Snack</title>
    <link rel="icon" href="images/elvago.jpg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: 'Press Start 2P', sans-serif;
            background-color: #00483C;
            color: #fff;
            image-rendering: pixelated;
        }

        header {
            background-color: #EADBBA;
            text-align: center;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: #00483C;
            font-size: 2.5rem;
            margin: 0;
        }

        h1 img {
            width: 200px;
            height: auto;
            image-rendering: pixelated;
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #BD8F6E;
            border-bottom: 4px solid #333;
        }

        .navbar .logo {
            font-size: 1.5rem;
            color: #ffcc00;
            text-decoration: none;
        }

        .navbar .menu {
            display: flex;
            gap: 20px;
        }

        .navbar .menu a {
            text-decoration: none;
            color: #fff;
            font-size: 1rem;
        }

        .navbar .menu a:hover {
            color: #ffcc00;
        }

        .navbar .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
        }

        .navbar .hamburger div {
            width: 25px;
            height: 3px;
            background-color: #fff;
        }

        /* Responsive Navbar */
        @media (max-width: 768px) {
            .navbar .menu {
                display: none;
                flex-direction: column;
                gap: 10px;
                background-color: #BD8F6E;
                padding: 10px;
                position: absolute;
                top: 50px;
                right: 20px;
                border: 3px solid #333;
            }

            .navbar .menu.active {
                display: flex;
            }

            .navbar .hamburger {
                display: flex;
            }
        }

        /* Card Styles */
        .card {
            background-color: #AC2121;
            border: 4px solid #333;
            padding: 10px;
            margin: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        }

        .card-img-top {
            height: 150px;
            object-fit: cover;
            border: 4px solid #333;
        }

        .card-title {
            font-size: 1.2rem;
            color: #ffcc00;
            margin: 10px 0;
        }

        .card-text {
            font-size: 0.8rem;
            color: #fff;
        }

        /* Button Styles */
        button {
            font-family: 'Press Start 2P', sans-serif;
            background: #ffcc00;
            border: 3px solid #333;
            color: #333;
            padding: 10px 20px;
            cursor: pointer;
            transition: transform 0.1s ease;
        }

        button:hover {
            transform: scale(1.1);
            background: #fff;
            color: #ffcc00;
        }

        /* Pagination */
        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            border: 3px solid #333;
            text-decoration: none;
            font-size: 0.8rem;
            font-family: 'Press Start 2P', sans-serif;
            color: #ffcc00;
            background: #444;
            transition: background 0.3s ease;
        }

        .pagination a:hover, .pagination .active {
            background-color: #ffcc00;
            color: #333;
        }
    </style>
</head>
<body  id="page-top"> 
<!-- Navbar -->
<nav class="navbar">
    <a href="index.php?page=home" class="logo">Elvago Snack</a>
    <div class="menu">
        <a href="index.php?page=home">Home</a>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">Categories</a>
            <div class="dropdown-menu">
                <?php 
                $categories = $conn->query("SELECT * FROM `category_list` ORDER BY `name` ASC");
                while ($row = $categories->fetch_assoc()): ?>
                    <a href="index.php?page=category&id=<?= $row['id'] ?>"><?= $row['name'] ?></a>
                <?php endwhile; ?>
            </div>
        </div>
        <a href="index.php?page=cart_list">
            <span class="cart-icon">
                <i class="fa fa-shopping-cart"></i> 
                Cart <span class="badge badge-danger item_count">0</span>
            </span>
        </a>
        <!-- Inside your navbar -->
<?php if (isset($_SESSION['login_user_id'])): ?>
    <a href="admin/ajax.php?action=logout2" class="user-info">
        Welcome, <?= $_SESSION['login_first_name'] ?> <?= $_SESSION['login_last_name'] ?>
        <i class="fa fa-power-off"></i>
    </a>
<?php else: ?>
    <a href="login.php">Login</a> 
<?php endif; ?>

    </div>
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>


<!-- CSS Styles -->
<style>
/* General Navbar Styles */
/* General Navbar Styles */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #BD8F6E;
    padding: 10px 20px;
    border-bottom: 4px solid #333;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar .logo {
    font-size: 1.5rem;
    color: #ffcc00;
    text-decoration: none;
}

.menu {
    display: flex;
    align-items: center;
    gap: 20px;
}

.menu a {
    text-decoration: none;
    color: #fff;
    font-size: 1rem;
    transition: color 0.3s;
}

.menu a:hover {
    color: #ffcc00;
}

.dropdown {
    position: relative;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #BD8F6E;
    border: 3px solid #333;
    padding: 10px;
    flex-direction: column;
    gap: 10px;
}

.dropdown:hover .dropdown-menu {
    display: flex;
}

.cart-icon {
    display: flex;
    align-items: center;
    gap: 5px;
}

.cart-icon .badge {
    background: #ff0000;
    color: #fff;
    font-size: 0.8rem;
    padding: 2px 6px;
    border-radius: 50%;
}

.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    gap: 5px;
}

.hamburger span {
    width: 25px;
    height: 3px;
    background-color: #fff;
    transition: all 0.3s ease;
}

@media (max-width: 768px) {
    .menu {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        right: 20px;
        background-color: #BD8F6E;
        border: 3px solid #333;
        padding: 10px;
        width: 200px;
    }

    .menu.active {
        display: flex;
    }

    .hamburger {
        display: flex;
    }

    .hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }
}

</style>

<!-- JavaScript -->
<script>
const hamburger = document.querySelector('.hamburger');
const menu = document.querySelector('.menu');

hamburger.addEventListener('click', () => {
    menu.classList.toggle('active'); // Toggle menu visibility
    hamburger.classList.toggle('active'); // Toggle hamburger animation
});

</script>


    <!-- Masthead -->
    <header class="masthead">
        <h1>
            <a style="text-decoration: none; color: white;">
                <img src="images/elvago.jpg" alt="Pixel Logo">
            </a>
        </h1>
    </header>  
       
         <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>
       
<!-- Confirmation Modal -->
<div class="modal fade" id="confirm_modal" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirm" onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- General Modal -->
<div class="modal fade" id="uni_modal" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="submit" onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Right Modal -->
<div class="modal fade" id="uni_modal_right" role="dialog">
  <div class="modal-dialog modal-sm modal-dialog-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<!-- Custom CSS for Mobile Optimization -->
<style>
  /* Modal size adjustments for mobile */
  .modal-dialog {
    max-width: 90%;
    margin: 1.75rem auto;
  }

  /* Adjust modal header text */
  .modal-header h5 {
    font-size: 1.25rem;
    font-family: 'Press Start 2P', cursive; /* Pixel Art Font */
    text-align: center;
  }

  /* Adjust modal footer buttons */
  .modal-footer button {
    font-size: 0.85rem;
    padding: 10px 15px;
    font-family: 'Press Start 2P', cursive;
  }

  /* Right Modal styling */
  .modal-dialog-right {
    position: absolute;
    right: 0;
    top: 0;
    width: 100%;
    max-width: 300px;
    margin: 0;
  }

  /* Close button icon in the right modal */
  .modal-header .close {
    font-size: 1.5rem;
    color: #AC2121;
  }
  
  @media (min-width: 576px) {
    .modal-sm {
      max-width: 80%;
    }
  }

  @media (min-width: 768px) {
    .modal-sm {
      max-width: 60%;
    }
  }

  @media (min-width: 992px) {
    .modal-sm {
      max-width: 50%;
    }
  }
</style>

        
       <?php include('footer.php') ?>
    </body>
    <?php $conn->close() ?> 
</html> 