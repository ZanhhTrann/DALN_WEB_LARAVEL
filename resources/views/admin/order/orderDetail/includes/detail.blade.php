{{-- <link rel="stylesheet" href="{{asset('css/pages/products.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('css/pages/home.css')}}"> --}}

@php
    // dd($orderDetails);
@endphp
<section>
    <form action="{{route('searchProd')}}" method="post">
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
                        ODid
                    </th>
                    <th class="column-1">
                        Oid
                    </th>
                    <th class="column-2">
                        Pid
                    </th>
                    <th class="column-3">color</th>
                    <th class="column-4">size</th>
                    <th class="column-5">Quantily</th>
                    <th class="column-6">Quantily in Stock</th>
                    <th class="column-7">PPatToO</th>
                    <th class="column-8">Status</th>
                    <th class="column-9">Created at</th>
                    <th class="column-10">Updated at</th>
                    <th class="column-11">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $item)
                <tr class="table_head">
                    <th class="column-0">{{"#000".$item['ODid']}}</th>
                    <th class="column-1">{{"#000".$item['Oid']}}</th>
                    <th class="column-2">{{$item['Pid']}}</th>
                    <th class="column-3">{{$item['color']}}</th>
                    <th class="column-4">{{$item['size']}}</th>
                    <th class="column-5">{{$item['Quantily']}}</th>
                    <th class="column-6">{{$item['Quantit_in_stock']}}</th>
                    <th class="column-7">{{$item['PPatToO']}}</th>
                    <th class="column-8">
                        @if((int)($item['Status'])==(0))
                            <span>Chờ duyệt</span>
                        @endif
                        @if((int)($item['Status'])==1)
                            <span>Đã hoàn thành</span>
                        @endif
                        @if((int)($item['Status'])==2)
                            <span>Đã được duyệt</span>
                        @endif
                        @if((int)($item['Status'])==(-1))
                            <span>Đã bị hủy bởi Người dùng</span>
                        @endif
                        @if((int)($item['Status'])==(-2))
                            <span>Đã bị hủy bởi Bạn</span>
                        @endif
                    </th>
                    <th class="column-9">{{$item['created_at']}}</th>
                    <th class="column-10">{{$item['updated_at']}}</th>
                    <th class="column-11">
                        @if((int)($item['Status'])==(0))
                            <div class="admin_container_btns">
                                <div class="ac_btns">
                                    <a href="{{route('accsetOrder',['ODid'=>$item['ODid']])}}" class="admin_btns">Duyệt </a>
                                </div>
                                <div class="ac_btns">
                                    <a href="{{route('cancelOrder',['ODid'=>$item['ODid']])}}" class="admin_btns">Hủy</a>
                                </div>
                            </div>
                        @endif
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
