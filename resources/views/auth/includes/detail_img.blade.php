<!-- detail_img -->
<div class="detail_img swiper">
    <div class="swiper-wrapper">
    <?php
    if(mysqli_num_rows($GetDataImg_desc) > 0) {
        $stt = 1;
        while($row = mysqli_fetch_assoc($GetDataImg_desc)) { ?>
        <div class="slide_banner swiper-slide">
            <img alt="" src="<?php echo $url_base_2."admin/uploads/img_desc/".$row['product_img_desc']?>">
        </div>
    <?php  }}?>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>

<script>
    var swiper = new Swiper('.swiper', {
        // Optional parameters
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

<!-- detail_info -->
<div class="detail_info">
    <?php if(mysqli_num_rows($get_product_only) > 0) {
    $row = mysqli_fetch_assoc($get_product_only); ?>
    <div class="name" style="text-transform:capitalize;"><?php echo $row['product_name']?></div>
    <div class="price">$ <span>
        <?php $price_result = $row['product_price'] - floor($row['product_price']);
        $result = $price_result != 0? $row['product_price'] : $row['product_price'].".00";
        echo $result ?>
    </span>
    </div>
    <div class="description"><?php echo $row['product_desc']?></div>
    <?php } ?>
    <form action="<?php echo $url_base_3?>cart/cart_insert.php?product_id=<?php echo $product_id?>" method="POST">
        <div class="size">
            <p>Size</p>
            <select name="size_id" id="">
                <option value="#">--Choose your size--</option>
                <?php if(mysqli_num_rows($get_product_size) > 0) {
                    while($row = mysqli_fetch_assoc($get_product_size)) { ?>
                <option value="<?php echo $row['size_id'] ?>">
                    Size <?php echo $row['size_name']?>
                </option>
                <?php }}?>
            </select>
        </div>
        <div class="color">
            <p>Color</p>
            <select name="color_id" required id="">
                <option value="#">--Choose your color--</option>
                <?php if(mysqli_num_rows($get_product_color) > 0) {
                    while($row = mysqli_fetch_assoc($get_product_color)) { ?>
                <option value="<?php echo $row['color_id'] ?>"><?php echo $row['color_name']?></option>
                <?php }}?>
            </select>
        </div>
        <button class="btn" type="submit">ADD TO CART</button>
    </form>
</div>
