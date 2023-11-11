<?php
session_start();
$url_folder='';
$url_base='';
$islogged=false;
// dd(session('pages'));
?>

<header id="header" class="header_home ">
    <div class="container">
        <a href="{{ route('pages.index', ['page' => 'home']) }}" class="header_logo">
            <b>H&M</b>STORE
        </a>
        <ul class="header_menu">
            <li class="item products {{ (session('head_pages') == 'home') ? 'active' : '' }}">
                <a href="{{ route('pages.index', ['page' => 'home']) }}">Home</a>
            </li>
            <li class="item products {{ (session('head_pages') == 'shop') ? 'active' : '' }}">
                <a href="{{ route('pages.index', ['page' => 'shop']) }}">Shop</a>
            </li>
            <li class="item features {{ (session('head_pages') == 'features') ? 'active' : '' }}">
                <a href="{{route('pages.index',['page'=>'features'])}}">Features</a>
            </li>
            <li class="item about {{ (session('head_pages') == 'about') ? 'active' : '' }}">
                <a href="{{route('pages.index',['page'=>'about'])}}">About</a>
            </li>
            <li class="item contact {{ (session('head_pages') == 'contact') ? 'active' : '' }}">
                <a href="{{route('pages.index',['page'=>'contact'])}}">Contact</a>
            </li>
            <li>
                <?php
                if($islogged == false) { ?>
                <a href="{{route('pages.index',['page'=>'signup'])}}" class="login">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    LOGIN
                </a>
                <?php } else {?>
                <div class="user_info">
                    <div class="user_info-img">
                        <img src="<?php echo $url_base."admin/uploads/avatar/".$row['avatar']?>" alt="">
                    </div>
                    <div class="user_info-name">Corny</div>
                    <ul class="user_nav">
                        <li><a href="#">
                            <div class="icon">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            Your profile
                        </a></li>
                        <li><a href="<?php echo $url_folder?>UI_user/logout.php">
                            <div class="icon">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>
                            Sign out
                        </a></li>
                    </ul>
                </div>
                <?php }?>
            </li>
        </ul>

        <div class="header_nav">
            <?php
            if($islogged == false) { ?>
            <a href="{{route('pages.index',['page'=>'signup'])}}" class="login">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                LOGIN
            </a>
            <?php } else {?>
            <div class="user_info">
                <div class="user_info-img">
                    <img src="<?php echo $url_base."admin/uploads/avatar/".$row['avatar']?>" alt="">
                </div>
                <div class="user_info-name">Corny</div>
                <ul class="user_nav">
                    <li><a href="#">
                        <div class="icon">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        Your profile
                    </a></li>
                    <li><a href="<?php echo $url_folder?>UI_user/logout.php">
                        <div class="icon">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </div>
                        Sign out
                    </a></li>
                </ul>
            </div>
            <?php }?>

            <!-- ============== -->
            <div class="icon search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="icon cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <div class="icon_quantity">
                    <?php if($islogged) {
                        echo $cart_number['number'];
                    } else { echo "0";}?>
                </div>
            </div>
            <div class="icon heart">
                <i class="fa-solid fa-heart"></i>
                <div class="icon_quantity">
                    <?php if($islogged) {
                        echo $row_count_wishlist['number'];
                    } else { echo "0";}?>
                </div>
            </div>
            <div class="icon bars">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </div>

    <div class="header_search">
        <form class="container" method="POST" id="searchForm" action="{{ route('search') }}">
            @csrf
            <div class="icon-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <button class="btn_icon-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <input type="text" id="searchInput" name="search" placeholder="Search..." required>
        </form>

    </div>
</header>

<!-- overlay -->
<div class="header_cart overlay">
    <div class="header_cart-container">
        <div class="header_cart-container_title">
            <span>YOUR CART</span>
            <div class="icon">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="container">
            <?php if($islogged && ($cart_number['number'] > 0)) {?>
            <ul class="header_cart-container_list">
                <?php if(mysqli_num_rows($show_cart_detail) > 0) {
                    while($row_cart = mysqli_fetch_assoc($show_cart_detail)) {
                        $total = $total + ($row_cart['product_price'] * $row_cart['quantity'])?>
                <li>
                    <a class="item_img"
                    href=""cart/cart_delete.php?product_id=".$row_cart['product_id']?>">
                        <img alt=""
                        src="<?php echo $url_base."admin/uploads/".$row_cart['product_img'] ?>">
                    </a>
                    <div class="item_info">
                        <a href=""pg_shop/product-detail.php?product_id=".$row_cart['product_id']?>"
                        class="info_name"><?php echo $row_cart['product_name']?></a>
                        <div class="info_number">
                            <span class="quantity"><?php echo $row_cart['quantity']?></span> X
                            <span class="price">$<?php echo $row_cart['product_price']?></span>
                        </div>
                    </div>
                </li>
                <?php }}?>
            </ul>
            <div class="interact">
                <div class="header_cart-container_total">
                    Total: $
                    <span>
                        <?php
                        $total_show = $total-(int)$total!=0?$total : $total."00";
                        echo $total_show;?>
                    </span>
                </div>
                <div class="header_cart-container_btns">
                    <a href=""pg_features/index.php"" class="btn">VIEW CART</a>
                    <a href=""pg_features/pay.php"" class="btn">CHECK OUT</a>
                </div>
            </div>
            <?php } else{?>
            <div class="no_cart">
                <h3>🛒 <i>Your cart is empty</i> 🛒</h3>
                <img src="{{asset('imgs/empty_cart.png')}}" alt="">
            </div>
            <?php }?>
        </div>
    </div>
</div>

<!-- wishlist -->
<div class="wishlist overlay">
    <div class="wishlist-container">
        <div class="wishlist-container_title">
            <span>YOUR WISHLIST</span>
            <div class="icon">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="container">
            <?php if($islogged) {?>
            <ul class="wishlist-container_list">
                <li>
                    <a class="item_img"
                    href="">
                        <img alt=""
                        src="<?php echo $url_base."admin/uploads/".$row_wishlist_ori['product_img']?>">
                    </a>
                    <div class="item_info">
                        <a href=""
                        class="info_name"><?php echo $row_wishlist_ori['product_name']?></a>
                        <div class="info_number">
                            <span class="price">$
                                <?php echo $row_wishlist_ori['product_price']?>
                            </span>
                        </div>
                    </div>
                </li>
                <?php ?>
            </ul>
            <?php } else{?>
            <div class="no_cart">
                <h3>🛒 <i>Your wishlist is empty</i> 🛒</h3>
                <img src="{{asset('imgs/empty_cart.png')}}" alt="">
            </div>
            <?php }?>
        </div>
    </div>
</div>
