<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    
<link rel="icon" href="./images/elvago.jpg" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Elvago Snack</title>

    <?php
    session_start();
    if (!isset($_SESSION['login_id']))
        header('location:login.php');
    include('./header.php');
    // include('./auth.php');
    ?>

    <!-- Pixel Font -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Press Start 2P', sans-serif;
            
        background-color: #00483C; /* Light gray background */
            margin: 0;
            padding: 0;    f  
    }


        header, footer {
            text-align: center;
            background-color: #333;
            color: #FFCC00;
            padding: 15px;
            font-size: 1.5em;
        }

        #topbar {
            background-color: #333;
            color: #FFCC00;
            padding: 10px;
        }

        #navbar {
            background-color: #00483C;
            color: #FFCC00;
            padding: 10px;
        }

        .toast-body {
            color: #fff;
            font-size: 1.2rem;
        }

        #view-panel {
            padding: 20px;
        }

        .modal-content {
            background-color: #222;
            color: #fff;
        }

        .modal-header {
            background-color: #00483C;
            color: #FFCC00;
            font-size: 1.5rem;
            border-bottom: 2px solid #FFCC00;
        }

        .modal-footer .btn {
            background-color: #00483C;
            color: #FFCC00;
            font-size: 1rem;
            border: 2px solid #FFCC00;
            transition: background-color 0.3s ease;
        }

        .modal-footer .btn:hover {
            background-color: #FFCC00;
            color: #00483C;
        }

        .btn-primary, .btn-secondary {
            background-color: #00483C;
            border: 2px solid #FFCC00;
            color: #FFCC00;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: #FFCC00;
            color: #00483C;
        }

        /* Preloader */
        #preloader2 {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #00483C;
            color: #FFCC00;
            padding: 10px;
            font-size: 1.5rem;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-to-top:hover {
            background-color: #FFCC00;
            color: #00483C;
        }

        @media (max-width: 768px) {
            #topbar, #navbar {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <?php include 'topbar.php' ?>
    <?php include 'navbar.php' ?>
    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white"></div>
    </div>

    <main id="view-panel">
        <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
        <?php include $page . '.php' ?>
    </main>

    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.start_load = function () {
            $('body').prepend('<div id="preloader2"></div>')
        }

        window.end_load = function () {
            $('#preloader2').fadeOut('fast', function () {
                $(this).remove();
            })
        }

        window.uni_modal = function ($title = '', $url = '') {
            start_load()
            $.ajax({
                url: $url,
                error: err => {
                    console.log()
                    alert("An error occured")
                },
                success: function (resp) {
                    if (resp) {
                        $('#uni_modal .modal-title').html($title)
                        $('#uni_modal .modal-body').html(resp)
                        $('#uni_modal').modal('show')
                        end_load()
                    }
                }
            })
        }

        window._conf = function ($msg = '', $func = '', $params = []) {
            $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
            $('#confirm_modal .modal-body').html($msg)
            $('#confirm_modal').modal('show')
        }

        window.alert_toast = function ($msg = 'TEST', $bg = 'success') {
            $('#alert_toast').removeClass('bg-success')
            $('#alert_toast').removeClass('bg-danger')
            $('#alert_toast').removeClass('bg-info')
            $('#alert_toast').removeClass('bg-warning')

            if ($bg == 'success')
                $('#alert_toast').addClass('bg-success')
            if ($bg == 'danger')
                $('#alert_toast').addClass('bg-danger')
            if ($bg == 'info')
                $('#alert_toast').addClass('bg-info')
            if ($bg == 'warning')
                $('#alert_toast').addClass('bg-warning')
            $('#alert_toast .toast-body').html($msg)
            $('#alert_toast').toast({ delay: 3000 }).toast('show');
        }

        $(document).ready(function () {
            $('#preloader').fadeOut('fast', function () {
                $(this).remove();
            })
            $('main#view-panel').css('margin-top', $('#topNavBar').height() + 'px')
            $(window).resize(function () {
                $('main#view-panel').css('margin-top', $('#topNavBar').height() + 'px')
            })
        })
    </script>
</body>

</html> 