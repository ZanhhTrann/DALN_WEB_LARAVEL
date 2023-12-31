<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H&M_Store</title>
    <!-- Link Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link animate style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Link script the Carousel && Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <!-- Link script Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <!-- ==========================LINK FILES IN FOLDERS========================== -->
    <!-- Icon -->
    <link rel="icon" type="image/x-icon" href="{{asset('imgs/logo_website.png')}}">
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{asset('css/layouts_css/style.css')}}">
    <link rel="stylesheet" href="{{asset("css/layouts_css/header.css")}}">
    <link rel="stylesheet" href="{{asset('css/layouts_css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/layouts_css/owl.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/products.css')}}">
    <!-- Link Responsive -->
    <link rel="stylesheet" href="{{asset('css/responsive/responsive.css')}}">
    <style>.header_menu .home a{color: var(--blue)}</style>
</head>
<body>
    {{-- app header layouts --}}
    @include('auth.includes.header')
    {{-- main content --}}
    <main>
        @yield('content')
    </main>
    {{-- app footer layouts --}}
    @include('auth.includes.footer')
    <script>
        $(document).ready(function() {
            $('.btn_view').click(function() {
                var product_id = $(this).val();
                $.get("router/detail_img.php", {product_id: product_id}, function(data) {
                    $(".quick_view_content-detail").html(data);
                })
            })
            $('.close_quick_view').click(function(e) {
                e.stopPropagation();
                $(".quick_view_content-detail").html("");
            })
        })
    </script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/product.js')}}"></script>
    <script src="{{asset('js/owl_carousel.js')}}"></script>
</body>
</html>
