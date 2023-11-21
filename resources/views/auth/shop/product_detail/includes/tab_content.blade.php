@php
    $sizes = array_filter(explode("|end|",$product->Sizes));
    $Colors = array_filter(explode("|end|",$product->Colors));
    $proController=new \App\Http\Controllers\ProductsController();
    $user=new \App\Http\Controllers\UsersController();
    $Request=$proController->getReviewsbyId($product->Pid);
    $reviews=$Request['reviews'];
    // dd($reviews[0]);
    $users_name=$Request['users_name'];
    $your_name='';
    $your_rev='';
    // dd($users_name[0]);
    $reCheck=false;
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
                                @if(session('login'))
                                    @if($review->Uid==session('login')['user_id'])
                                        @php
                                            $reCheck=true;
                                            $your_name=$users_name[$key]->Name;
                                            $your_rev=$review->reviews;
                                        @endphp
                                    @endif
                                    @if($review->Uid!=session('login')['user_id'])
                                        <li>
                                            <div class="user_img">
                                                @if($proController->getAvata($review->Uid)!=null)
                                                    <img src="data:image/jpeg;base64,{{$proController->getAvata($review->Uid)}}" alt="">
                                                @else
                                                    <img src="{{asset('imgs/logo_website.png')}}" alt="">
                                                @endif
                                            </div>
                                            <div class="user_text">
                                                <p class="name">{{$users_name[$key]->Name}}</p>
                                                <p class="comment">{{$review->reviews}}</p>
                                            </div>
                                        </li>
                                    @endif
                                @else
                                    <li>
                                        <div class="user_img">
                                            @if($proController->getAvata($review->Uid)!=null)
                                                <img src="data:image/jpeg;base64,{{$proController->getAvata($review->Uid)}}" alt="">
                                            @else
                                                <img src="{{asset('imgs/logo_website.png')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="user_text">
                                            <p class="name">{{$users_name[$key]->Name}}</p>
                                            <p class="comment">{{$review->reviews}}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                    <!-- FORM POST REVIEW -->
                        <div class="container">
                            @if(!session('login'))
                                <i class="warnning"> PLEASE LOGIN BEFORE REVIEW </i>
                            @else
                                @php
                                    $payC=new \App\Http\Controllers\PaymentController();
                                    $orderDs=$payC->getOrderDetail();
                                    $check=false;
                                    foreach ($orderDs as $key => $value) {
                                        if($product->Pid==$value->Pid){
                                            $check=true;
                                            break;
                                        }
                                    }
                                @endphp
                                @if($check==true)
                                    @if($reCheck==true)
                                        <i class="warnning"> YOUR REVIEW </i>
                                        <div class="your_review">
                                            <div class="user_img">
                                                @if($user->getAvata()!=null)
                                                    <img src="data:image/jpeg;base64,{{$user->getAvata()}}" alt="">
                                                @else
                                                    <img src="{{asset('imgs/logo_website.png')}}" alt="">
                                                @endif
                                            </div>
                                            <div class="user_text">
                                                <p class="name">{{$your_name}}</p>
                                                <p class="comment">{{$your_rev}}</p>
                                            </div>
                                        </div>
                                    @else
                                        <form method="POST" action="{{route('putReview')}}" >
                                            @csrf
                                            <div class="input_review">
                                                <p>Your review</p>
                                                <input type="hidden"
                                                name="product_id" value="{{$product->Pid}}">
                                                <textarea name="contents" id="review" maxlength="100" required></textarea>
                                                <button type="submit" id="submitReviewBtn" class="btn btn_review">SUBMIT</button>
                                            </div>
                                        </form>
                                    @endif
                                @else
                                <i class="warnning"> YOU NEED TO BUY BEFORE REVIEW </i>
                                @endif
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
