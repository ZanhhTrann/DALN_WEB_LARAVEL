<div class="cart_totals">
    <div class="cart_totals-contents">
        <h4>CART TOTALS</h4>
        <?php
        $tmp_sum_total = 0;
        for($i=0; $i<count($arr_total);$i++)
        {$tmp_sum_total+=$arr_total[$i]; }
        $sum_total = $tmp_sum_total-(int)$tmp_sum_total!=0?$tmp_sum_total:$tmp_sum_total."00" ?>
        <div class="subtotal">
            <div class="subtotal_title">Subtotal:</div>
            <div class="subtotal_price">$<?php echo $sum_total?></div>
        </div>
        <div class="shipping">
            <div class="shipping_title">Shipping:</div>
            <div class="shipping_price">$1.00</div>
        </div>
        <div class="total">
            <div class="total_title">Total:</div>
            <div class="total_price">$
                <?php $tmp_total_final = $sum_total + $cost_ship;
                $total_final = $tmp_total_final-(int)$tmp_total_final!=0 ?
                $tmp_total_final:$tmp_total_final."00";
                echo $total_final;?>
            </div>
        </div>
        <div>
            <a href="pay.php" class="checkout_btn btn">PROCEED TO CHECKOUT</a>
        </div>
    </div>
</div>
