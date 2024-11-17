
<link rel="icon" href="images/elvago.jpg" type="image/x-icon">
<nav id="sidebar" class="sidebar bg-dark">
    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home">
            <span class="icon-field"><i class="fa fa-home"></i></span> Home
        </a>
        <a href="index.php?page=orders" class="nav-item nav-orders">
            <span class="icon-field"><i class="fa fa-table"></i></span> Orders
        </a>
        <a href="index.php?page=menu" class="nav-item nav-menu">
            <span class="icon-field"><i class="fa fa-pizza-slice"></i></span> Menu
        </a>
        <a href="index.php?page=categories" class="nav-item nav-categories">
            <span class="icon-field"><i class="fa fa-list"></i></span> Category List
        </a>
        
        <?php if ($_SESSION['login_type'] == 1): ?>
            <a href="index.php?page=users" class="nav-item nav-users">
                <span class="icon-field"><i class="fa fa-users"></i></span> Users
            </a> 
        <?php endif; ?>
    </div>
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<script>
    // Toggle the sidebar visibility and hamburger icon animation
    const hamburger = document.querySelector('.hamburger');
    const menu = document.querySelector('.sidebar-list');

    hamburger.addEventListener('click', () => {
        menu.classList.toggle('active'); // Toggle menu visibility
        hamburger.classList.toggle('active'); // Toggle hamburger animation
    });

    // Highlight the active menu item based on the page
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');
</script>

<style>
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