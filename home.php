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
        .pixel-menu {
    color: #ffcc00; /* Bright yellow */
    font-family: 'Press Start 2P', cursive; /* Pixel art style font */
    font-size: 24px; /* Make it bold and noticeable */
    text-transform: uppercase;
    display: inline-block;
    padding: 10px;
    border: 4px solid #BD8F6E; /* Pixelated border in brown */
    background-color: #00483C; /* Dark green background */
    margin: 10px 0; 
  }
    </style>
</head>
<body>
 
<!-- Menu Section -->
<section class="page-section" id="menu">
<div class="pixel-menu">
  Menu
</div> 
    <div class="d-flex justify-content-center">
        <hr class="border-dark" width="5%">
    </div>
    <div id="menu-field" class="row mt-4 justify-content-center">
        <?php 
            $limit = 10;
            $page = (isset($_GET['_page']) && $_GET['_page'] > 0) ? $_GET['_page'] - 1 : 0;
            $offset = $page * $limit;  // Fixed offset calculation

            // Count total products for pagination
            $all_menu = $conn->query("SELECT COUNT(id) AS total FROM product_list")->fetch_assoc();
            $page_btn_count = ceil($all_menu['total'] / $limit);

            // Get the products for the current page
            $qry = $conn->query("SELECT * FROM product_list ORDER BY `name` ASC LIMIT $limit OFFSET $offset");
            while ($row = $qry->fetch_assoc()):
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card menu-item shadow-sm rounded-3 overflow-hidden">
            <div class="position-relative overflow-hidden" id="item-img-holder">
    <img src="assets/img/<?php echo htmlspecialchars($row['img_path']); ?>" class="card-img-top" alt="...">
    <?php if (isset($row['featured']) && $row['featured'] == 1): ?>
        <div class="badge badge-warning position-absolute top-0 end-0 m-3">Featured</div>
    <?php endif; ?>
</div>

                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                    <p class="card-text text-muted"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                    <div class="text-center">
                        <button class="view_prod" data-id="<?php echo $row['id']; ?>"><i class="fa fa-eye"></i> View</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
<br>
    <!-- Pagination Buttons Block -->
    <div class="w-100 mx-4 d-flex justify-content-center" align="center">
        <div class="pagination">
            <a class="btn btn-primary" <?php echo ($page == 0) ? 'disabled' : ''; ?> href="./?_page=<?php echo ($page); ?>">Prev</a>
            <?php for ($i = 1; $i <= $page_btn_count; $i++): ?>
                <a class="btn <?php echo ($i == ($page + 1)) ? 'active' : ''; ?>" href="./?_page=<?php echo $i ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <a class="btn btn-primary" <?php echo (($page + 1) == $page_btn_count) ? 'disabled' : ''; ?> href="./?_page=<?php echo ($page + 2); ?>">Next</a>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.view_prod').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            uni_modal_right('Product Details', 'view_prod.php?id=' + productId);
        });
    });

    // Scroll to menu section if the page is loaded with a page number
    <?php if (isset($_GET['_page'])): ?>
        document.querySelector('html').scrollTop = document.getElementById('menu').offsetTop - 100;
    <?php endif; ?>
</script>


</body>
</html>
