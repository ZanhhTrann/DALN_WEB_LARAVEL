
@php
    session_start();
    // dd(session('login'));
    $user=new \App\Http\Controllers\UsersController();
    // dd($user->getAvata());
    $prod=new \App\Http\Controllers\ProductsController();
    if(session('login')){
        $cart=$user->getCart();
        $favorite=$user->getFavorite();
    }
    $total=0;
@endphp

<header id="header" class="{{ (session('head_pages') == 'home') ? 'header_home' : 'headerhome' }}">
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
            <li class="item contact {{ (session('head_pages') == 'orders') ? 'active' : '' }}">
                <a href="{{route('pages.index',['page'=>'orders'])}}">Orders</a>
            </li>
            <li></li>
        </ul>

        <div class="header_nav">
            @if(!session('login'))
            <a href="{{route('pages.index',['page'=>'signup'])}}" class="login">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                LOGIN
            </a>
            @else
                <div class="user_info">
                    <div class="user_info-img">
                        @if($user->getAvata()!=null)
                            <img src="data:image/jpeg;base64,{{$user->getAvata()}}" alt="">
                        @else
                            <img src="{{asset('imgs/logo_website.png')}}" alt="">
                        @endif
                    </div>
                    <div class="user_info-name">
                        {{session('login')['user_name']}}
                    </div>
                    <ul class="user_nav">
                        <li><a href="{{route('pages.index',['page'=>'profile'])}}">
                            <div class="icon">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            Your profile
                        </a></li>
                        <li><a href="{{route('signout')}}">
                            <div class="icon">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>
                            Sign out
                        </a></li>
                    </ul>
                </div>
            @endif
            <!-- ============== -->
            <div class="icon search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="icon cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <div class="icon_quantity">
                    @if(session('login'))
                        {{count($cart)}}
                    @else
                        {{0}}
                    @endif
                </div>
            </div>
            <div class="icon heart">
                <i class="fa-solid fa-heart"></i>
                <div class="icon_quantity">
                    @if(session('login'))
                        {{count($favorite)}}
                    @else
                        {{0}}
                    @endif
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
            @if(session('login') && (count($cart)> 0))
                <ul class="header_cart-container_list">
                    @foreach ($cart as $item)
                        @php
                            $product=$prod->getProductbyId($item->Pid);
                            $total+=($product->Price)*($item->quantity);
                        @endphp
                        <li>
                            <a class="item_img"
                            href="{{route('productDetail',['Pid'=>$product->Pid])}}">
                                <img alt=""
                                src="{{$product->Main_image}}">
                            </a>

                            <div class="item_info">
                                <a href="{{route('productDetail',['Pid'=>$product->Pid])}}"
                                class="info_name">{{$product->Product_name}}</a>
                                <div class="info_size">
                                    <span class="size">{{"Size: ".$item->size}}</span>
                                </div>
                                <div class="info_color">
                                    <span class="color">{{"Color: ".$item->color}}</span>
                                </div>
                                <div class="info_number">
                                    <span class="quantity">{{"Quantity: ".$item->quantity}}</span><br>
                                    <span class="price">{{"Price: $ ".$product->Price." "}}</span><br>
                                    <span class="price">{{"Total: $ ".($product->Price*$item->quantity)}}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
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
                        <a href="{{route('pages.index',['page'=>'features'])}}" class="btn">VIEW CART</a>
                    </div>
                </div>
            @else
                <div class="no_cart">
                    <h3>🛒 <i>Your cart is empty</i> 🛒</h3>
                    <img src="{{asset('imgs/empty_cart.png')}}" alt="">
                </div>
            @endif
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
            @if(session('login') && (count($favorite)> 0))
            <ul class="wishlist-container_list">
                @foreach($favorite as $item)
                    @php
                        $product=$prod->getProductbyId($item->Pid);
                    @endphp
                    <li>
                        <a class="item_img"
                        href="{{route('updateFavorite',['Pid'=>$product->Pid])}}">
                            <img alt=""
                            src="{{$product->Main_image}}">
                        </a>
                        <div class="item_info">
                            <a href="{{route('productDetail',['Pid'=>$product->Pid])}}"
                            class="info_name">{{$product->Product_name}}</a>
                            <div class="info_number">
                                <span class="price">$
                                    {{$product->Price}}
                                </span>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <div class="no_cart">
                    <h3>🛒 <i>Your wishlist is empty</i> 🛒</h3>
                    <img src="{{asset('imgs/empty_cart.png')}}" alt="">
                </div>
            @endif
        </div>
    </div>
</div>
