@php
    $selected=session('childSelected');
    // dd(session());
    $products = session('visibleProducts_'.$selected,[]);
    $pages = session('pages');
    // dd($pages);
@endphp
@if(!empty($products))
    @foreach($products as $product)
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
@else
<div class="empty_cart">
    <img src="{{asset('imgs/empty_list.png')}}" alt="">
</div>
@endif
