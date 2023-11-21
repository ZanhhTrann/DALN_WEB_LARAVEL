@php
    $sizes = array_filter(explode("|end|",$product->Sizes));
    $Images = array_filter(explode("|end|",$product->Images));
    $Colors = array_filter(explode("|end|",$product->Colors));
    $prod=new \App\Http\Controllers\ProductsController();
    if(session('login')){
        $user=new \App\Http\Controllers\UsersController();
        $cart=$user->getCart();
        $favorite=$user->getFavorite();
        $check=false;
        foreach($favorite as $item){
            if($item->Pid==$product->Pid){
                $check=true;
            }
        }
    }

@endphp
<div class="overlay_quick_view">
    <div class="container">
        <div class="quick_view_content">
            <div class="close_quick_view">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="quick_view_content-detail">
                <!-- detail_img -->
                <div class="detail_img swiper">
                    <div class="swiper-wrapper">
                        <div class="slide_banner swiper-slide">
                            <img alt="" src="{{$product->Main_image}}">
                        </div>
                        @foreach($Images as $url)
                        <div class="slide_banner swiper-slide">
                            <img alt="" src="{{$url}}">
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <!-- detail_info -->
                <div class="detail_info">
                    <div class="name" style="text-transform:capitalize;">{{$product->Product_name}}</div>
                    <div class="price"><span>{{"$ ".$product->Price}}</span>
                        <a href="{{route('updateFavorite',['Pid'=>$product->Pid])}}" class="icon {{ (session('login') && $check ? 'active' : '')}}">
                            <i class="fa-solid fa-heart"></i>
                        </a>
                    </div>
                    <div class="description">{{$product->Description}}</div>
                    <form action="{{ route('updateCart',['Pid'=>$product->Pid]) }}" method="POST" id="addToCartForm" required>
                        @csrf
                        <div class="size">
                            <p>Size</p>
                            <select name="size_id" id="">
                                <option value="#">--Choose your size--</option>
                                @if(count($sizes)>0)
                                    @foreach ($sizes as $item)
                                        @if($item!="dc")
                                            <option value="{{$item}}">
                                                {{$item}}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="null" selected>
                                        Null
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="color">
                            <p>Color</p>
                            <select name="color_id" required id="">
                                <option value="#">--Choose your color--</option>
                                @if(count($Colors)>0)
                                    @foreach ($Colors as $item)
                                        @if($item!="dc")
                                            <option value="{{$item}}">
                                                {{$item}}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="null" selected>
                                        Null
                                    </option>
                                @endif
                            </select>
                        </div>
                        <button class="btn" type="submit">ADD TO CART</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('addToCartForm').onsubmit = function() {
        var sizeSelect = document.getElementsByName('size_id')[0];
        var colorSelect = document.getElementsByName('color_id')[0];

        if (sizeSelect.value === '#' || colorSelect.value === '#') {
            alert('Vui lòng chọn kích thước và màu trước khi thêm vào giỏ hàng.');
            return false; // Ngăn chặn gửi form nếu thông tin không hợp lệ
        }

        // Tiếp tục gửi form nếu màu và kích thước đã được chọn
        return true;
    };
</script>


