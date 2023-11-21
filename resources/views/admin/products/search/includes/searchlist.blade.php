{{-- <link rel="stylesheet" href="{{asset('css/pages/products.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('css/pages/home.css')}}"> --}}

@php
    $catController=new \App\Http\Controllers\CategoriesController();
    $perCats=$catController->__getCats('');
    $products=session('adminProducts')['visibleProducts_search']
    // dd($childCat);
@endphp
<section>
    <ul class="admin_categories">
        <li><a class="admin_category-item  {{ ("all" == session('admin_selected')) ? 'active' : '' }}" href="{{route('Admin_MProducts_Pages',['page'=>'all'])}}">All Products</a></li>
        <!-- Danh sách các danh mục -->
        @foreach ($perCats as $perCat)
            <li><a class="admin_category-item  {{ ($perCat->Api_value == session('admin_selected')) ? 'active' : '' }}" href="{{route('Admin_MProducts_Pages',['page'=>$perCat->Api_value])}}">{{ $perCat->Categories_name }}</a></li>
        @endforeach
    </ul>
    <form action="{{route('searchProd')}}" method="post">
        @csrf
        <label class="search_label">Tìm kiếm:</label>
        <input type="text" class="Search" name="search" required>
        <button type="submit" class="admin_btns" name="addcategories">search</button>
    </form>
    @if(count($products)>0)
        <div class="cart_info_content">
            <table class="cart_info-table">
                <thead>
                    <tr class="table_head">
                        <th class="column-0">
                            Pid
                        </th>
                        <th class="column-1">
                            Cid
                        </th>
                        <th class="column-2">
                            Img
                        </th>
                        <th class="column-3">Products Name</th>
                        <th class="column-4">Price</th>
                        <th class="column-5">Imgs</th>
                        <th class="column-6">Color</th>
                        <th class="column-7">Size</th>
                        <th class="column-8">Description</th>
                        <th class="column-9">Quantit_in_stock</th>
                        <th class="column-10">Api_code</th>
                        <th class="column-11">updated_at</th>
                        <th class="column-12">created_at</th>
                        <th class="column-13">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    @php
                        $sizes = array_filter(explode("|end|",$item->Sizes));
                        $Images = array_filter(explode("|end|",$item->Images));
                        $Colors = array_filter(explode("|end|",$item->Colors));
                    @endphp
                    <tr class="table_head">
                        <th class="column-0">{{"#000".$item->Pid}}</th>
                        <th class="column-1">{{"#00".$item->Cid}}</th>
                        <th class="column-2 mainImgs"> <img width="120px" height="160px" src="{{$item->Main_image}}" alt=""></th>
                        <th class="column-3">
                            <p style=" margin-top: 4px;
                                    width: 100px;
                                    white-space: nowrap;
                                    overflow: hidden !important;
                                    text-overflow: ellipsis;">
                                    {{$item->Product_name}}
                                    </p>

                        </th>
                        <th class="column-4">{{$item->Price}}</th>
                        <th class="column-5">
                            @forEach($Images as $img)
                            <p style=" margin-top: 4px;
                                    width: 165px;
                                    white-space: nowrap;
                                    overflow: hidden !important;
                                    text-overflow: ellipsis;">
                                    {{$img}}
                                    </p>
                            @endforeach
                        </th>
                        <th class="column-6">
                            @forEach($Colors as $color)
                                @if($color!=="dc")
                                    {{$color}},
                                @endif

                            @endforeach
                        </th>
                        <th class="column-7">
                            @php
                                $count=0;
                            @endphp
                            @forEach($sizes as $size)
                                @if($size!=="dc")
                                    {{$size}},
                                    @php
                                        $count++;
                                    @endphp
                                @endif
                            @endforeach
                        </th>
                        <th class="column-8">
                            <p style=" margin-top: 4px;
                                    width: 165px;
                                    white-space: nowrap;
                                    overflow: hidden !important;
                                    text-overflow: ellipsis;">
                                    {{$item->Description}}
                                    </p>
                        </th>
                        <th class="column-9">{{$item->Quantit_in_stock}}</th>
                        <th class="column-10">{{$item->Api_code}}</th>
                        <th class="column-11">{{$item->updated_at}}</th>
                        <th class="column-12">{{$item->created_at}}</th>
                        <th class="column-13">
                            <div class="admin_container_btns">
                                <div class="ac_btns">
                                    <a href="{{route('ProDetail',['Pid'=>$item->Pid])}}" class="admin_btns">Sửa </a>
                                </div>
                                <div class="ac_btns">
                                    <a href="{{route('deletePro',['Pid'=>$item->Pid])}}" class="admin_btns">Xóa</a>
                                </div>

                            </div>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(session('adminProducts')['pages']>1)
            @include('admin.products.includes.pagination')
        @endif
    @else
        @include('admin.products.includes.empty')
    @endif


</section>
