<form class="cart_info" action="" method="GET">
    <table class="cart_info-table">
        <tr class="table_head">
            <th class="column-1">Product</th>
            <th class="column-2"></th>
            <th class="column-3">Price</th>
            <th class="column-4">Quantity</th>
            <th class="column-5">Total</th>
        </tr>
        <?php if(mysqli_num_rows($show_cart_detail) > 0) {
            while($row = mysqli_fetch_assoc($show_cart_detail)) {
                $tmp_total = $row['product_price']*$row['quantity'];
                $total = $tmp_total-(int)$tmp_total!=0? $tmp_total : $tmp_total.".00";
                array_push($arr_total, $tmp_total);?>
        <tr class="table_row">
            <th class="column-1">
                <a class="img_item"
                href="<?php echo $url_folder."cart/cart_delete.php?product_id=".$row['product_id']?>">
                    <img alt="" width="60px" height="80px"
                    src="<?php echo $url_base."admin/uploads/".$row['product_img']?>">
                </a>
                <p style=" margin-top: 4px;
                width: 165px;
                white-space: nowrap;
                overflow: hidden !important;
                text-overflow: ellipsis;">
                    <?php echo $row['product_name']?>
                </p>
            </th>
            <th class="column-2">
                <span style=" display: inline-block;
                width: 165px;
                white-space: nowrap;
                overflow: hidden !important;
                text-overflow: ellipsis;">
                    <?php echo $row['product_name'] ?>
                </span>
            </th>
            <th class="column-3"><?php echo $row['product_price'] ?></th>
            <th class="column-4">
                <div class="num_product">
                    <div class="btn_num_product-down">
                        <i class="fa-solid fa-minus"></i>
                    </div>
                    <input name="<?php echo $row['product_id']?>"
                    value="<?php echo $row['quantity']?>"
                    type="number" class="input_num_product">
                    <div class="btn_num_product-up">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
            </th>
            <th class="column-5"><?php echo $total?></th>
        </tr>
        <?php }}?>
    </table>
    <div class="cart_interact">
        <div class="cart_interact_coupon">
            <input type="text" placeholder="Coupon Code"
            class="coupon_input" name="coupon">
            <button type="submit" class="coupon_btn btn">
                APPLY COUPON
            </button>
        </div>
        <div class="cart_interact_update">
            <button type="submit" class="update_btn btn">
                UPDATE CART
            </button>
        </div>
    </div>
</form>
