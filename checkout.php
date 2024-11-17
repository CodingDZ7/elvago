<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'admin/db_connect.php';

// var_dump($_SESSION);
$chk = $conn->query("SELECT * FROM cart where user_id = {$_SESSION['login_user_id']} ")->num_rows;
if ($chk <= 0) {
    echo "<script>alert('You don\\'t have an Item in your cart yet.'); location.replace('./')</script>";
}
?>
        <div class="container">
    <div class="card">
        <div class="card-body">
            <form action="" id="checkout-frm">
                <h4>Confirm Delivery Information</h4>
                <div class="form-group">
                    <label for="" class="control-label">Firstname</label>
                    <input type="text" name="first_name" required="" class="form-control" 
                           value="<?php echo isset($_SESSION['login_first_name']) ? $_SESSION['login_first_name'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Last Name</label>
                    <input type="text" name="last_name" required="" class="form-control" 
                           value="<?php echo isset($_SESSION['login_last_name']) ? $_SESSION['login_last_name'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Contact</label>
                    <input type="text" name="mobile" required="" class="form-control" 
                           value="<?php echo isset($_SESSION['login_mobile']) ? $_SESSION['login_mobile'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Address</label>
                    <textarea cols="30" rows="3" name="address" required="" class="form-control"><?php echo isset($_SESSION['login_address']) ? $_SESSION['login_address'] : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="email" name="email" required="" class="form-control" 
                           value="<?php echo isset($_SESSION['login_email']) ? $_SESSION['login_email'] : '' ?>">
                </div>  
                <div class="text-center">
                    <button class="btn btn-block btn-outline-dark">Place Order</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script>
    $(document).ready(function(){
          $('#checkout-frm').submit(function(e){
            e.preventDefault()
          
            start_load()
            $.ajax({
                url:"admin/ajax.php?action=save_order",
                method:'POST',
                data:$(this).serialize(),
                success:function(resp){
                    if(resp==1){
                        alert_toast("Order successfully Placed.")
                        setTimeout(function(){
                            location.replace('index.php?page=home')
                        },1500)
                    }
                }
            })
        })
        })
    </script>