@php
    $proController=new \App\Http\Controllers\ProductsController();
    $products = session('visibleSearch');
    $pages = session('pages');
    $prod=new \App\Http\Controllers\ProductsController();
    if(session('login')){
        $user=new \App\Http\Controllers\UsersController();
        $cart=$user->getCart();
        $favorite=$user->getFavorite();
    }
    $total=0;
    // dd($pages);
@endphp
@if(!empty($products))
    @foreach($products as $product)
        @php
            $check=false;
            if(session('login')){

                foreach($favorite as $item){
                    if($item->Pid==$product->Pid){
                        $check=true;
                        break;
                    }
                }
            }
        @endphp
        <div class="products_list-item ">
            <form class="product-form" method="POST" action="{{ route('getQuickView') }}">
                @csrf
                <div class="item_img">
                    <img alt="" src="{{$product->Main_image}}">
                    <button type="button" class="btn btn_view quick-view-button" data-product-id="{{$product->Pid}}">Quick View</button>
                </div>
            </form>
            <div class="item_detail">
                <div class="item_detail-name">
                    <a href= "{{route('productDetail',['Pid'=>$product->Pid])}}" style="text-transform:capitalize;">
                        {{$product->Product_name}}
                    </a>
                    <a href="{{route('updateFavorite',['Pid'=>$product->Pid])}}" class="icon {{ (session('login') && $check ? 'active' : '')}}">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                </div>
                <div class="item_detail-price">
                    $<span>
                    {{$product->Price}}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
    @php
        $check=false;
    @endphp
@else
<div class="empty_cart">
    <img src="{{asset('imgs/empty_list.png')}}" alt="">
</div>
@endif
