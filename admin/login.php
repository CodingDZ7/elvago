<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Elvago Snack</title>

	<link rel="icon" href="./images/elvago.jpg" type="image/x-icon">
    <?php include('./header.php'); ?>
    <?php include('./db_connect.php'); ?>
    <?php 
    session_start();
    if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");

    $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach ($query as $key => $value) {
        if(!is_numeric($key))
            $_SESSION['setting_'.$key] = $value;
    }
    ?>

    <!-- Pixel Font -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Press Start 2P', sans-serif;
            background-color: #00483C; /* Dark background color */
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        main#main {
            width: 100%;
            height: 100%;
            display: flex;
        }

        #login-right {
            width: 40%;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        #login-left {
            width: 60%;
            background: #00000061;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background-image: url(./../assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        #login-left:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            backdrop-filter: brightness(0.7);
            z-index: 1;
        }

        .logo {
            font-size: 5rem;
            text-align: center;
            background: white;
            border-radius: 50%;
            width: 15vw;
            height: 25vh;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }

        .logo img {
            height: 80%;
            width: 80%;
        }

        #login-left h1 {
            font-size: 3em;
            font-weight: bolder;
            color: #fff;
            text-shadow: 2px 2px 5px #000;
            z-index: 2;
        }

        #login-right .card {
            width: 80%;
            background-color: #BD8F6E;
            border: 2px solid #333;
            border-radius: 8px;
            padding: 20px;
        }

        .form-group label {
            font-size: 1.2em;
            color: #fff;
        }

        .form-control {
            border-radius: 5px;
            border: 2px solid #333;
            padding: 10px;
            font-size: 1rem;
            background-color: #00483C;
            color: #fff;
        }

        .form-control:focus {
            background-color: #BD8F6E;
            color: #000;
            box-shadow: 0 0 5px rgba(255, 204, 0, 0.8);
        }

        .btn-dark {
            background-color: #00483C;
            border: 2px solid #FFCC00;
            color: #FFCC00;
            font-size: 1.2rem;
            padding: 12px 30px;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #FFCC00;
            color: #00483C;
        }

        .alert-danger {
            background-color: #ff6666;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        a.text-dark {
            font-size: 1.1rem;
            color: #FFCC00;
            text-decoration: none;
        }

        a.text-dark:hover {
            color: #fff;
        }

        @media (max-width: 768px) {
            #login-right {
                width: 100%;
            }

            #login-left {
                width: 100%;
                height: 60%;
            }

            .logo {
                width: 30vw;
                height: 20vh;
            }

            #login-left h1 {
                font-size: 2em;
            }
        }
    </style>
</head>

<body>

    <main id="main">
        <div id="login-left">
            <div class="h-100 w-100 d-flex justify-content-center align-items-center">
                <h1 class="text-center"><?= $_SESSION['setting_name'] ?> - Admin Login</h1>
            </div>
        </div>
        <div id="login-right">
            <div class="card">
                <div class="card-body">
                    <form id="login-form">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" autofocus class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="./../" class="text-dark">Back to Website</a>
                        </div>
                        <center><button class="btn-dark" type="submit">Login</button></center>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        $('#login-form').submit(function (e) {
            e.preventDefault();
            $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
            if ($(this).find('.alert-danger').length > 0)
                $(this).find('.alert-danger').remove();
            $.ajax({
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    console.log(err)
                    $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
                },
                success: function (resp) {
                    if (resp == 1) {
                        location.href = 'index.php?page=home';
                    } else {
                        $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                        $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
                    }
                }
            });
        })
    </script>
</body>

</html>
