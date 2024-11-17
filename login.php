<?php 
include 'admin/db_connect.php'; 

// Start the session
session_start();

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    $stmt = $conn->prepare("SELECT * FROM users u INNER JOIN user_info ui ON u.id = ui.user_id WHERE ui.email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['login_user_id'] = $user['user_id'];
        $_SESSION['login_first_name'] = $user['first_name'];
        $_SESSION['login_last_name'] = $user['last_name'];
    
        // Redirect to the homepage or dashboard
        header("Location: index.php"); // Update as needed
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
    <title>Elvago Snack | Login</title>
    <link rel="icon" href="images/elvago.jpg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Press Start 2P', sans-serif;
            background-color: #00483C;
            color: white;
            text-align: center;
        }
        .login-container {
            background-color: #BD8F6E;
            border: 2px solid #333;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
            margin-top: 100px;
        }
        input {
            padding: 10px;
            margin: 10px 0;
            width: 80%;
            border: none;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #ffcc00;
            border: 2px solid #333;
            cursor: pointer;
            font-family: 'Press Start 2P', sans-serif;
        }
        button:hover { 
            color: #ffcc00;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
	<!-- Navbar -->
<nav class="navbar">
    <a href="index.php?page=home" class="logo">Elvago</a>
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

</head>
<body>
	
    <div class="login-container">
        <h2>Login to Elvago Snack</h2>
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
