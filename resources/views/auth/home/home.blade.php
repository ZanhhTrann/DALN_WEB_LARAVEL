{{-- @extends('layouts.user_layout.app') --}}
@php
    $catController=new \App\Http\Controllers\CategoriesController();
    $perCats=$catController->__getCats('');
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
                <div class="categories_sort">
                    <div class="row" id="childCategories" >
                        {{-- chilCategories --}}
                    </div>
                </div>
                {{-- @include('auth.home.product_sort') --}}
            </div>

            <div class="products_list" id="ListProducts">

                <!-- overlay quick view -->
                @include('auth.home.quick_view.quick_view')
            </div>
        </div>
    </div>
    @include('auth.includes.load_more')
</section>
<script src="{{ asset('js/home.js') }}"></script>
<script>
    function getListProducts(selectedValue){
        // console.log($('.item').data('page'));
    $.ajax({
            url: "{{ route('getListCategoryLimit') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                value: selectedValue,
                page:$('.item').data('page')
            },
            success: function (data) {
                // console.log(data);

                $('#ListProducts').html(data);
            }
        });
    }
    getListProducts("All Products");
    $(document).ready(function () {
        getListProducts("All Products");
        // Lắng nghe sự kiện khi một danh mục được chọn

        categories_item.forEach(function (item) {
            item.addEventListener('click', function () {
                var item_active = take_one('.products_menu .categories li.active');
                if (item_active) {
                    item_active.classList.remove('active');
                }
                item.classList.add('active');
            });
        });
        $('body').on('click', '.category-item',function () {
            // Lấy giá trị value từ danh mục đã chọn
            var selectedValue = $(this).attr('value');
            // Sử dụng Ajax để gửi yêu cầu lấy danh sách con dựa trên giá trị đã chọn
            if(selectedValue=="All Products"){
                if(categories_sort.classList.contains('active')){
                    categories_sort.classList.remove('active');
                }
            }else{
                $.ajax({
                url: "{{ route('getChilCategory') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    value: selectedValue
                },
                success: function (data) {
                    $('#childCategories').html(data);
                    $('#childCategories').show();
                }
            });
                if(!categories_sort.classList.contains('active')){
                    categories_sort.classList.add('active');
                }
            }
            getListProducts(selectedValue);
        });
        $('body').on('click', '.quick-view-button', function() {
            // Lấy giá trị từ thuộc tính 'data-product-id'
            // var form = $(this).closest('form');
            // event.preventDefault();
            var selectedValue = $(this).data('product-id');
            console.log(selectedValue);
            $.ajax({
                url: "{{ route('getQuickView') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    value: selectedValue
                },
                success: function (data) {
                    // console.log(data);
                    $('#QV').addClass('active');
                    $('#QV_detail').html(data);
                }
            });
        });

        $('body').on('click', '.close_quick_view', function() {
            $('#QV').removeClass('active');
        });
    });
</script>
{{-- <script src="{{asset('js/main.js')}}"></script> --}}
@endsection


