{{-- @extends('layouts.user_layout.app') --}}
@php
    $catController=new \App\Http\Controllers\CategoriesController();
    $perCats=$catController->__getCats('');
    $chilCats='';
    // dd($perCats);
@endphp
@extends('auth.layouts.app')
@section('content')
<section id="section" class="section_home">
    @include('auth.includes.slider')
    @include('auth.includes.banner')
    <div class="overview_product">
        <div class="products container">
            <h1>PRODUCT OVERVIEW</h1>

            <div class="products_menu">
                @include('auth.home.formListCat',['perCats'=>$perCats])
                <div class="filter">
                    <div class="filter_item">
                        <div class="filter_item-icon">
                            <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </div>
                        Filter
                    </div>
                </div>
                @php
                    $getChilCategoryRoute = route('getChilCategory');
                @endphp
                <div class="categories_sort">
                    <div class="row" id="childCategories">
                        {{-- chilCategories --}}
                    </div>
                </div>
                @include('auth.home.product_sort')
            </div>

            <div class="products_list">
                <!-- BEGINNING: ITEM PRODUCT -->

                <!-- ENDING: ITEM PRODUCT -->

                <!-- overlay quick view -->
                <div class="overlay_quick_view">
                    <div class="container">
                        <div class="quick_view_content">
                            <div class="close_quick_view">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <div class="quick_view_content-detail">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('auth.includes.load_more')
</section>
<script src="{{ asset('js/product.js') }}"></script>
<script>
    $(document).ready(function () {
        // Lắng nghe sự kiện khi một danh mục được chọn
        categories_item.forEach(function (item) {
            item.addEventListener('click', function () {
                var item_active = take_one('.products_menu .categories li.active');
                if (item_active) {
                    item_active.classList.remove('active');
                }
                item.classList.add('active'); // Thêm lớp 'active' vào danh mục đang được chọn

                // Rest of your code...
            });
        });

        // Ẩn danh sách con khi trang được tải lần đầu
        $('#childCategories').hide();

        // Lắng nghe sự kiện khi một danh mục được chọn
        $('.category-item').click(function () {
            // Lấy giá trị value từ danh mục đã chọn
            var selectedValue = $(this).attr('value');
            // Sử dụng Ajax để gửi yêu cầu lấy danh sách con dựa trên giá trị đã chọn
            $.ajax({
                url: "{{ route('getChilCategory') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    value: selectedValue
                },
                success: function (data) {
                    // Cập nhật #childCategories với dữ liệu trả về từ Ajax
                    console.log("Selected Value: " + selectedValue);
                    console.log(data);
                    $('#childCategories').html(data);
                    // Hiển thị danh sách con
                    $('#childCategories').show();
                    if(selectedValue=="All Products"){
                    if(categories_sort.classList.contains('active')){
                        categories_sort.classList.remove('active');
                    }
                }else{
                    if(!categories_sort.classList.contains('active')){
                        categories_sort.classList.add('active');
                    }
                }
                }
            });
        });
    });
</script>
@endsection


