@php
    $sizes = array_filter(explode("|end|",$product->Sizes));
    $Colors = array_filter(explode("|end|",$product->Colors));
    $proController=new \App\Http\Controllers\ProductsController();
    $Request=$proController->getReviewsbyId($product->Pid);
    $reviews=$Request['reviews'];
    $users_name=$Request['users_name'];
@endphp

<div class="tab_contents">
    <div class="container contents">
        <ul class="tab_list">
            <li class="active">Description</li>
            <li class="">Additional information</li>
            <li class="">Reviews ({{empty($reviews)?0:count($reviews)}})</li>
        </ul>
        <div class="tab_item-contents">
            <div class="tab_item tab_desc active show">
                <p>
                    Aenean sit amet gravida nisi. Nam fermentum est felis,
                    quis feugiat nunc fringilla sit amet.
                    Ut in blandit ipsum. Quisque luctus dui at ante aliquet,
                    in hendrerit lectus interdum. Morbi elementum sapien
                    rhoncus pretium maximus. Nulla lectus enim, cursus et
                    elementum sed, sodales vitae eros. Ut ex quam, porta
                    consequat interdum in, faucibus eu velit. Quisque
                    rhoncus ex ac libero varius molestie. Aenean tempor
                    sit amet orci nec iaculis. Cras sit amet nulla libero.
                    Curabitur dignissim, nunc nec laoreet consequat,
                    purus nunc porta lacus, vel efficitur tellus augue
                    in ipsum. Cras in arcu sed metus rutrum iaculis.
                    Nulla non tempor erat. Duis in egestas nunc.
                </p>
            </div>
            <div class="tab_item tab_info ">
                <ul>
                    <li>
                        <span class="">Weight</span>
                        <span class="">0.79 kg</span>
                    </li>
                    <li>
                        <span class="">Dimensions</span>
                        <span class="">110 x 33 x 100 cm</span>
                    </li>
                    <li>
                        <span class="">Materials</span>
                        <span class="">60% cotton</span>
                    </li>
                    <li>
                        <span class="">Color</span>
                        <span class="">
                            @foreach($Colors as $key=>$color)
                                @if(($key+1)!=count($Colors))
                                    {{$color.", "}}
                                @else
                                    {{$color}}
                                @endif
                            @endforeach
                        </span>
                    </li>
                    <li>
                        <span class="">Size</span>
                        <span class="">
                            @foreach($sizes as $key=>$size)
                                @if(($key+1)!=count($sizes))
                                    {{$size.", "}}
                                @else
                                    {{$size}}
                                @endif
                            @endforeach
                        </span>
                    </li>
                </ul>
            </div>
            <div class="tab_item tab_reviews">
                <div class="tab_reviews-item">
                    <!-- LIST REVIEW USERS -->
                    <ul class="reviews-list">
                        @if(!empty($reviews))
                            @foreach($reviews as $key=>$review)
                                <li>
                                    <div class="user_img">
                                        <img alt=""
                                        src="{{asset('img/logo_web.png')}}">
                                    </div>
                                    <div class="user_text">
                                        <p class="name">{{$users_name[$key]}}</p>
                                        <p class="comment">{{$review['Review']}}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <!-- FORM POST REVIEW -->
                    <form method="GET"
                    action="">
                        <div class="container">
                            <i class="warnning">🌽 PLEASE LOGIN BEFORE REVIEW 🌽</i>
                            <div class="input_review">
                                <p>Your review</p>
                                <input type="hidden"
                                name="product_id" value="{{$product->Pid}}">
                                <textarea name="contents" id="review" maxlength="100"></textarea>
                            </div>
                            <button class="btn btn_review">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
