@extends('auth.layouts.app')
@section('content')
<section id="section" class="section_product">
    <div class="overview_product">
        <div class="products container">
            <div class="products_menu">
                <div class="filter">
                    <div class="filter_item">
                        <div class="filter_item-icon">
                            <i class="fa-solid fa-arrow-down-wide-short"></i>
                        </div>
                        Filter
                    </div>
                </div>
                @include('auth.shop.search.includes.product_sort')
            </div>
            <div class="products_list" id="ListProducts">
                @include('auth.shop.search.includes.list_products',[''])

                <!-- overlay quick view -->
                @include('auth.home.quick_view.quick_view')
            </div>
             @include('auth.shop.includes.pagination',['pages'=>session('pages')])
        </div>
    </div>
</section>
<script src="{{ asset('js/shop.js') }}"></script>
<script>

    $(document).ready(function () {
        // Lắng nghe sự kiện khi một danh mục được chọn
        $('body').on('click', '.quick-view-button', function() {
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
@endsection
