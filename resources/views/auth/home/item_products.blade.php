{{-- @php
    $products=session('products');
@endphp --}}
@foreach($newReq['products'] as $product)
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
                <a href="{{route('productDetail',['Pid'=>$product->Pid])}}" style="text-transform:capitalize;">
                    {{$product->Product_name}}
                </a>
                <a href="" class="icon">
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
@include('auth.home.quick_view.quick_view')

