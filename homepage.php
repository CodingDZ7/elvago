<?php
include 'admin/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elvago Snack</title>
    <link rel="icon" href="images/elvago.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet"> <!-- Pixel Font -->
    
    <style>
       #path {
    position: relative;
    width: 90%; /* Reduced to fit smaller screens */
    height: 400px; /* Reduced height */
    margin: 0 auto;
    border: 4px solid #AC2121;
    background: #00483C;
    background-size: cover;
    background-position: center;
    image-rendering: pixelated;
    transition: background 0.3s ease-in-out;
}

body {
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
    font-family: 'Press Start 2P', sans-serif;
    background-color: #00483C;
    color: #fff;
    image-rendering: pixelated;
    padding: 0 10px; /* Added padding for smaller screens */
}

.pepper {
    position: absolute;
    width: 25px;  /* Smaller pepper size */
    height: 18px; /* Smaller pepper size */
    background-image: url('images/red-pepper.png');
    background-size: contain;
    background-repeat: no-repeat;
}

.cart {
    position: absolute;
    bottom: 10px; /* Reduced bottom space */
    width: 50px;  /* Smaller cart icon */
    height: 40px; /* Smaller cart icon */
    background-image: url('images/elvago-cart.png');
    background-size: contain;
    background-repeat: no-repeat;
}

#score {
    color: #ff4d4d;
    text-align: center;
    font-size: 16px; /* Reduced font size */
}

#gameover {
    display: none;
    text-align: center;
    font-size: 28px; /* Reduced font size */
    color: #ff4d4d;
}

#replay {
    display: block;
    margin: 10px auto; /* Reduced margin */
    padding: 8px; /* Reduced padding */
    background-color: #BD8F6E;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 14px; /* Smaller font size */
}

#replay:hover {
    background-color: #e40000;
}

header {
    background-color: #EADBBA;
    text-align: center;
    padding: 15px; /* Reduced padding */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
}

h1 {
    color: #00483C;
    font-size: 2rem; /* Smaller heading font size */
    margin: 0;
}

h1 img {
    width: 150px; /* Smaller logo */
    height: auto;
    image-rendering: pixelated;
}

/* Navbar Styles */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 15px; /* Reduced padding */
    background-color: #BD8F6E;
    border-bottom: 3px solid #333;
}

.navbar .logo {
    font-size: 1.2rem; /* Reduced font size */
    color: #ffcc00;
    text-decoration: none;
}

.navbar .menu {
    display: flex;
    gap: 15px; /* Reduced gap */
}

.navbar .menu a {
    text-decoration: none;
    color: #fff;
    font-size: 0.9rem; /* Reduced font size */
}

.navbar .menu a:hover {
    color: #ffcc00;
}

.navbar .hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    gap: 4px; /* Reduced gap between lines */
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
        gap: 8px; /* Reduced gap */
        background-color: #BD8F6E;
        padding: 8px;
        position: absolute;
        top: 50px;
        right: 10px;
        border: 3px solid #333;
        width: 180px; /* Reduced menu width */
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
    border: 3px solid #333;
    padding: 8px; /* Reduced padding */
    margin: 8px; /* Reduced margin */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
}

.card:hover {
    transform: translateY(-2px); /* Slightly less translation */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5); /* Smaller shadow */
}

.card-img-top {
    height: 120px; /* Reduced image height */
    object-fit: cover;
    border: 3px solid #333;
}

.card-title {
    font-size: 1rem; /* Reduced title font size */
    color: #ffcc00;
    margin: 8px 0; /* Reduced margin */
}

.card-text {
    font-size: 0.7rem; /* Reduced text font size */
    color: #fff;
}

/* Button Styles */
button {
    font-family: 'Press Start 2P', sans-serif;
    background: #ffcc00;
    border: 3px solid #333;
    color: #333;
    padding: 8px 16px; /* Reduced padding */
    cursor: pointer;
    transition: transform 0.1s ease;
    font-size: 14px; /* Smaller button font size */
}

button:hover {
    transform: scale(1.05); /* Slightly smaller scale */
    background: #fff;
    color: #ffcc00;
}

/* Pagination */
.pagination a {
    margin: 0 4px; /* Reduced margin */
    padding: 6px 10px; /* Reduced padding */
    border: 3px solid #333;
    text-decoration: none;
    font-size: 0.7rem; /* Reduced font size */
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
<body>
    <!-- Navbar -->
<nav class="navbar">
    <a href="index.php?page=home" class="logo">Elvago Snack </a>
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
@media (max-width: 568px) { 
 
    /* Hamburger icon adjustment */
    .hamburger {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        cursor: pointer;
        gap: 5px;
    }

    .hamburger span {
        width: 25px; /* Smaller width for mobile */
        height: 3px;
        background-color: #fff;
        transition: all 0.3s ease; /* Smooth transitions for the hamburger icon */
    }

    .hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .hamburger.active span:nth-child(2) {
        opacity: 0; /* Hide the middle span when active */
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

<br>
    <h1 style="text-align:center; color: #ffcc00;">Adventures of Elvago</h1>
<br>
    <!-- Game Path and Cart -->
    <div id="path" class="path">
        <div id="cart" class="cart"></div>
    </div>
<br>
    <!-- Score and Game Over Message -->
    <div id="gameover" style="display: none;">GAME OVER!</div>
    <h3 id="score">Score: 0</h3>
    <br>
    <!-- Replay Button -->
    <button id="replay" onclick="replayGame()">Replay</button>

    <script>
    const path = document.getElementById('path');
    const cart = document.getElementById('cart');
    const scoreDisplay = document.getElementById('score');
    const gameOver = document.getElementById('gameover');

    let score = 0;
    let peppers = [];
    let isMovingLeft = false;
    let isMovingRight = false;
    let cartSpeed = 5;
    let pepperInterval, gameLoopInterval;

    // Initialize cart position
    cart.style.left = `${(path.clientWidth - cart.clientWidth) / 2}px`;

    // Create falling pepper
    function createPepper() {
        const pepper = document.createElement('div');
        pepper.classList.add('pepper');
        pepper.style.left = `${Math.random() * (path.clientWidth - 20)}px`;
        pepper.style.top = '0px';
        path.appendChild(pepper);
        peppers.push(pepper);
    }

    // Move peppers down
    function movePeppers() {
        peppers.forEach((pepper, index) => {
            const top = parseFloat(pepper.style.top) + 2;
            pepper.style.top = `${top}px`;

            // Collision detection
            const cartRect = cart.getBoundingClientRect();
            const pepperRect = pepper.getBoundingClientRect();

            if (
                pepperRect.bottom > cartRect.top &&
                pepperRect.right > cartRect.left &&
                pepperRect.left < cartRect.right
            ) {
                path.removeChild(pepper);
                peppers.splice(index, 1);
                updateScore();
            }

            // Remove pepper if it falls out
            if (top > path.clientHeight) {
                path.removeChild(pepper);
                peppers.splice(index, 1);
                endGame();
            }
        });
    }

    // Update score
    function updateScore() {
        score++;
        scoreDisplay.textContent = `Score: ${score}`;
    }

    // End game
    function endGame() {
        gameOver.style.display = 'block';
        clearInterval(pepperInterval);
        clearInterval(gameLoopInterval);
    }

    // Move cart
    function moveCart() {
        let cartLeft = parseFloat(cart.style.left);
        if (isMovingLeft && cartLeft > 0) {
            cart.style.left = `${cartLeft - cartSpeed}px`;
        }
        if (isMovingRight && cartLeft < path.clientWidth - cart.clientWidth) {
            cart.style.left = `${cartLeft + cartSpeed}px`;
        }
    }

    // Controls
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') isMovingLeft = true;
        if (e.key === 'ArrowRight') isMovingRight = true;
    });

    document.addEventListener('keyup', (e) => {
        if (e.key === 'ArrowLeft') isMovingLeft = false;
        if (e.key === 'ArrowRight') isMovingRight = false;
    });

    // Touch controls for mobile
    document.addEventListener('touchstart', (e) => {
        const touchX = e.touches[0].clientX;
        const cartCenter = cart.getBoundingClientRect().left + cart.clientWidth / 2;
        if (touchX < cartCenter) isMovingLeft = true;
        if (touchX > cartCenter) isMovingRight = true;
    });

    document.addEventListener('touchend', () => {
        isMovingLeft = false;
        isMovingRight = false;
    });

    // Game loop
    gameLoopInterval = setInterval(() => {
        movePeppers();
        moveCart();
    }, 20);

    // Spawn peppers every 1.5 seconds
    pepperInterval = setInterval(createPepper, 1500);

    // Replay game function
    function replayGame() {
        // Reset the score
        score = 0;
        scoreDisplay.textContent = `Score: ${score}`;

        // Clear the "Game Over" message
        gameOver.style.display = 'none';

        // Clear existing peppers
        peppers.forEach(pepper => path.removeChild(pepper));
        peppers = [];

        // Reset cart position
        cart.style.left = `${(path.clientWidth - cart.clientWidth) / 2}px`;

        // Restart game loop
        clearInterval(pepperInterval);
        clearInterval(gameLoopInterval);

        // Start a new game
        startGame();
    }

    // Start game function
    function startGame() {
        // Spawn peppers and move them
        pepperInterval = setInterval(createPepper, 1500);
        gameLoopInterval = setInterval(() => {
            movePeppers();
            moveCart();
        }, 20);
    }

    // Function to change background image of the game path
    function changeBackground(imageURL) {
        path.style.backgroundImage = `url(${imageURL})`;
    }

    // Example of changing background
    // You can call this function dynamically based on user input, button click, etc.
    changeBackground('images/8-bit-graphics-pixels-scene-with-desert.jpg');  // Replace with the path to your image
    </script>
    
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
</body>
</html>
