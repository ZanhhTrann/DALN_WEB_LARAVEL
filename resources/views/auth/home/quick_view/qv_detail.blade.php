@php
    $sizes = array_filter(explode("|end|",$product->Sizes));
    $Images = array_filter(explode("|end|",$product->Images));
    $Colors = array_filter(explode("|end|",$product->Colors));
@endphp
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
    <div class="name" style="text-transform:capitalize;">{{$product->Product_name}}</div>
    <div class="price">$ <span>{{$product->Price}}</span></div>
    <div class="description">{{$product->Description}}</div>
    <form action="" method="POST">
        <div class="size">
            <p>Size</p>
            <select name="size_id" id="">
                <option value="#">--Choose your size--</option>
                @foreach ($sizes as $item)
                    <option value="{{$item}}">
                        Size {{$item}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="color">
            <p>Color</p>
            <select name="color_id" required id="">
                <option value="#">--Choose your color--</option>
                @foreach ($Colors as $item)
                    <option value="{{$item}}">
                        {{$item}}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn" type="submit">ADD TO CART</button>
    </form>
</div>
