@php
    $cats=session('Admin_Cat')['visible_cas'];
@endphp
<section>
    <form action="{{route('adminCatSearch')}}" method="post">
        @csrf
        <label class="search_label">Tìm kiếm:</label>
        <input type="text" class="Search" name="search" required>
        <button type="submit" class="admin_btns" name="addcategories">search</button>
    </form>
    <table class="cart_info-table">
        <thead>
            <tr class="table_head">
                <th class="column-1">
                    Cid
                </th>
                <th class="column-2">Categories Name</th>
                <th class="column-3">Api_value</th>
                <th class="column-4">Api_code</th>
                <th class="column-5">updated_at</th>
                <th class="column-6">created_at</th>
                <th class="column-7">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cats as $item)
            <tr class="table_head">
                <th class="column-1">{{"#00".$item->Cid}}</th>
                <th class="column-2">{{$item->Categories_name}}</th>
                <th class="column-3">{{$item->Api_value}}</th>
                <th class="column-4">{{$item->Api_code}}</th>
                <th class="column-5">{{$item->updated_at}}</th>
                <th class="column-6">{{$item->created_at}}</th>
                <th class="column-7">
                    <div class="admin_container_btns">
                        <div class="ac_btns">
                            <a href="{{route('CatDetail',['Cid'=>$item->Cid])}}" class="admin_btns">Sửa </a>
                        </div>
                        <div class="ac_btns">
                            <a href="{{route('deleteCat',['Cid'=>$item->Cid])}}" class="admin_btns">Xóa</a>
                        </div>

                    </div>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('admin.categories.includes.pagination')
</section>

