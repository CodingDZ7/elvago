<?php 
  include 'admin/db_connect.php';
  $qry = $conn->query("SELECT * FROM  product_list where id = ".$_GET['id'])->fetch_array();
?>
<div class="container-fluid">
    <div class="card pixel-card">
        <img src="assets/img/<?php echo $qry['img_path'] ?>" class="card-img-top pixel-img" alt="...">
        <div class="card-body pixel-body">
            <h5 class="card-title pixel-title"><?php echo $qry['name'] ?></h5>
            <p class="card-text truncate pixel-text"><?php echo $qry['description'] ?></p>
            
            <div class="form-group"></div>
            <div class="row">
                <div class="col-md-2">
                    <label class="control-label pixel-label">Qty</label>
                </div>
                <div class="input-group col-md-7 mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary pixel-button" type="button" id="qty-minus"><span class="fa fa-minus"></span></button>
                    </div>
                    <input type="number" readonly value="1" min="1" class="form-control text-center pixel-input" name="qty">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-dark pixel-button" type="button" id="qty-plus"><span class="fa fa-plus"></span></button>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <button class="btn btn-outline-dark btn-sm btn-block pixel-button" id="add_to_cart_modal"><i class="fa fa-cart-plus"></i> Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Pixel Art Design */
    body {
        font-family: 'Press Start 2P', cursive;
        background-color: #00483C;
        color: #EADBBA;
    }

    .pixel-card {
        border: 4px solid #BD8F6E;
        margin-top: 20px;
        background-color: #00483C;
        box-shadow: 8px 8px #AC2121;
    }

    .pixel-img {
        border-bottom: 4px solid #BD8F6E;
    }

    .pixel-body {
        padding: 20px;
        background-color: #00483C;
    }

    .pixel-title {
        color: #FFCC00;
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .pixel-text {
        font-size: 14px;
        color: #EADBBA;
        margin-bottom: 20px;
    }

    .pixel-label {
        color: #EADBBA;
        font-size: 14px;
    }

    .pixel-input {
        background-color: #00483C;
        color: #EADBBA;
        border: 2px solid #BD8F6E;
        font-size: 14px;
        text-align: center;
    }

    .pixel-input:focus {
        border-color: #FFCC00;
        background-color: #00372A;
    }

    .pixel-button {
        background-color: #FFCC00;
        color: #00483C;
        text-transform: uppercase;
        font-size: 12px;
        border: 4px solid #BD8F6E;
        box-shadow: 4px 4px #AC2121;
    }

    .pixel-button:hover {
        background-color: #AC2121;
        color: #EADBBA;
    }

    .text-center .pixel-button {
        margin-top: 10px;
    }

    #uni_modal_right .modal-footer {
        display: none;
    }

    .input-group-prepend button {
        background-color: #FFCC00;
        color: #00483C;
        border: 2px solid #BD8F6E;
        box-shadow: 4px 4px #AC2121;
    }

    .input-group-prepend button:hover {
        background-color: #AC2121;
        color: #EADBBA;
    }

    /* Responsive Design */
    @media (max-width: 576px) {
        .pixel-title {
            font-size: 1.25rem;
        }

        .pixel-text {
            font-size: 12px;
        }

        .pixel-input {
            font-size: 12px;
        }

        .pixel-button {
            font-size: 10px;
            padding: 8px 16px;
        }
    }
</style>

<script>
    $('#qty-minus').click(function(){
        var qty = $('input[name="qty"]').val();
        if(qty == 1){
            return false;
        } else {
            $('input[name="qty"]').val(parseInt(qty) - 1);
        }
    });

    $('#qty-plus').click(function(){
        var qty = $('input[name="qty"]').val();
        $('input[name="qty"]').val(parseInt(qty) + 1);
    });

    $('#add_to_cart_modal').click(function(){
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=add_to_cart',
            method: 'POST', 
            data: {pid: '<?php echo $_GET['id'] ?>', qty: $('[name="qty"]').val()},
            success: function(resp){
                if(resp == 1) {
                    alert_toast("Order successfully added to cart");
                    $('.item_count').html(parseInt($('.item_count').html()) + parseInt($('[name="qty"]').val()));
                    $('.modal').modal('hide');
                    end_load();
                }
            }
        });
    });
</script>
