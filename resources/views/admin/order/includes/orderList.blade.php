{{-- <link rel="stylesheet" href="{{asset('css/pages/products.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('css/pages/home.css')}}"> --}}
<section>
    <form action="{{route('searchOrder')}}" method="post">
        @csrf
        <label class="search_label">Tìm kiếm:</label>
        <input type="text" class="Search" name="search" required>
        <button type="submit" class="admin_btns" name="addcategories">search</button>
    </form>
    <div class="cart_info_content">
        <table class="cart_info-table">
            <thead>
                <tr class="table_head">
                    <th class="column-0">
                        Oid
                    </th>
                    <th class="column-1">
                        Uid
                    </th>
                    <th class="column-2">
                        PMid
                    </th>
                    <th class="column-3">SPid</th>
                    <th class="column-4">Order Name</th>
                    <th class="column-5">Phone number</th>
                    <th class="column-6">Id TP</th>
                    <th class="column-7">Id QH</th>
                    <th class="column-8">Id XP</th>
                    <th class="column-9">Street</th>
                    <th class="column-10">Address</th>
                    <th class="column-11">Note</th>
                    <th class="column-12">Total products</th>
                    <th class="column-13">Total order Price</th>
                    <th class="column-14">Created at</th>
                    <th class="column-15">Updated at</th>
                    <th class="column-16">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                <tr class="table_head">
                    <th class="column-0">{{"#000".$item->Oid}}</th>
                    <th class="column-1">{{"#00".$item->Uid}}</th>
                    <th class="column-2 mainImgs">{{$item->PMid}}</th>
                    <th class="column-3">{{$item->SPid}}

                    </th>
                    <th class="column-4"><p style=" margin-top: 4px;
                                width: 100px;
                                white-space: nowrap;
                                overflow: hidden !important;
                                text-overflow: ellipsis;">
                                {{$item->Order_name}}
                                </p></th>
                    <th class="column-5">{{$item->Phone_number}}</th>
                    <th class="column-6">{{$item->id_tp}}</th>
                    <th class="column-7">
                        {{$item->id_qh}}
                    </th>
                    <th class="column-8">
                        {{$item->id_xp}}
                    </th>
                    <th class="column-9">
                        <p style=" margin-top: 4px;
                                width: 100px;
                                white-space: nowrap;
                                overflow: hidden !important;
                                text-overflow: ellipsis;">
                                {{$item->street}}
                                </p>
                        </th>
                    <th class="column-10"><p style=" margin-top: 4px;
                        width: 100px;
                        white-space: nowrap;
                        overflow: hidden !important;
                        text-overflow: ellipsis;">
                        {{$item->address}}
                        </p></th>
                    <th class="column-11"><p style=" margin-top: 4px;
                        width: 100px;
                        white-space: nowrap;
                        overflow: hidden !important;
                        text-overflow: ellipsis;">
                        {{$item->note}}
                        </p></th>
                    <th class="column-12">{{$item->Total_products}}</th>
                    <th class="column-13">{{$item->Total_order_price}}</th>
                    <th class="column-14">{{$item->created_at}}</th>
                    <th class="column-15">{{$item->updated_at}}</th>
                    <th class="column-16">
                        <div class="admin_container_btns">
                            <div class="ac_btns">
                                <a href="{{route('orderDetails',['Oid'=>$item->Oid])}}" class="admin_btns">Chi tiết</a>
                            </div>
                            <div class="ac_btns">
                                {{-- <a href="{{route('deletePro',['Pid'=>$item->Pid])}}" class="admin_btns">Xóa</a> --}}
                            </div>
                        </div>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
