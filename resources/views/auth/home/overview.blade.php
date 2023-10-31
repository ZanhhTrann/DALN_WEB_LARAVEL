<div class="overview_product">
    <div class="products container">
        <h1>PRODUCT OVERVIEW</h1>
        <div class="products_menu">
            <ul class="categories">
                <li class="active">All Products</li>
                <!-- Category -->
                <?php
                if(mysqli_num_rows($show_category)>0) {
                    while($row_category = mysqli_fetch_assoc($show_category)) {
                ?>
                <li class=""><?php echo $row_category['category_name'] ?></li>
                <?php }} ?>
            </ul>
            <div class="filter">
                <div class="filter_item">
                    <div class="filter_item-icon">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>
                    </div>
                    Filter
                </div>
            </div>
            <div class="products_sort">
                <div class="row">
                    <div class="col sort_by">
                        <div class="text">Sort By</div>
                        <ul class="sort_list">
                        <li class="sort_list-item default">
                                <a class="active">Default</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="">Popularity</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="">Average rating</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="">Newness</a>
                            </li>
                            <li class="sort_list-item increase">
                                <a class="">Price: Low to High</a>
                            </li>
                            <li class="sort_list-item decrease">
                                <a class="">Price: High to Low</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col price">
                        <div class="text">Price</div>
                        <ul class="sort_list">
                            <li class="sort_list-item">
                                <a class="active">All</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="">$0.00 - $50.00</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="">$50.00 - $100.00</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="">$100.00 - $150.00</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="">$150.00 - $200.00</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="">$200.00+</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col color">
                        <div class="text">Color</div>
                        <ul class="sort_list">
                            <li class="sort_list-item">
                                <a class="active" href="">Black</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="" href="">Blue</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="" href="">Grey</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="" href="">Green</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="" href="">Red</a>
                            </li>
                            <li class="sort_list-item">
                                <a class="" href="">Green</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="products_list">
            <!-- BEGINNING: ITEM PRODUCT -->
            <?php
            if(mysqli_num_rows($show_product_litmit) > 0) {
                while($row_product = mysqli_fetch_assoc($show_product_litmit)) {
            ?>
            <div class="products_list-item <?php echo $row_product['category_name'] ?>">
                <div class="item_img">
                    <img alt=""
                    src="<?php echo $url_base."admin/uploads/".$row_product['product_img'] ?>">
                    <button value="<?php echo $row_product['product_id']?>"
                    class="btn btn_view">Quick View</button>
                </div>
                <div class="item_detail">
                    <div class="item_detail-name">
                        <a href="<?php echo $url_folder."pg_shop/product-detail.php?product_id=".$row_product['product_id']?>"
                        style="text-transform:capitalize;">
                            <?php echo $row_product['product_name']?>
                        </a>
                        <a href="<?php
                        echo $url_folder."wishlist/wishlist_insert.php?product_id=".$row_product['product_id']
                        ?>"
                        class="icon
                        <?php
                        if(isset($email) || $email!=NULL) {
                            $show_wishlist_detail_UI = $wishlist->show_wishlist_detail($id);
                            if(mysqli_num_rows($show_wishlist_detail_UI) > 0) {
                                while($row_wishlist = mysqli_fetch_assoc($show_wishlist_detail_UI)) {
                                    if($row_wishlist['product_id'] == $row_product['product_id']) {
                                        echo "active";
                                        break;
                                    }
                                }
                            }
                        }
                        ?>"> <!-- active -->
                            <i class="fa-solid fa-heart"></i>
                        </a>
                    </div>
                    <div class="item_detail-price">
                        $<span>
                        <?php $price_result = $row_product['product_price'] - floor($row_product['product_price']);
                        $result = $price_result != 0? $row_product['product_price'] : $row_product['product_price'].".00";
                        echo $result?>
                        </span>
                    </div>
                </div>

            </div>
            <?php }}?>
            <!-- ENDING: ITEM PRODUCT -->

            <!-- overlay quick view -->
            <div class="overlay_quick_view">
                <div class="container">
                    <div class="quick_view_content">
                        <div class="close_quick_view">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div class="quick_view_content-detail">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
