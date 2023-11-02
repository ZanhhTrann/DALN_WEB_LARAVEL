
<div class="overview_product">
    <div class="products container">
        <h1>PRODUCT OVERVIEW</h1>

        <div class="products_menu">
            <form id="categoryForm" method="POST" action="{{ route('getChilCategory') }}">
                @csrf
                <ul class="categories">
                    <li class="active">All Products</li>
                    <!-- Danh sách các danh mục -->
                    @foreach ($perCats as $perCat)
                        <li value="{{ $perCat->Api_value}}" class="category-item">{{ $perCat->Categories_name }}</li>
                    @endforeach
                </ul>
            </form>

            <div class="filter">
                <div class="filter_item">
                    <div class="filter_item-icon">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>
                    </div>
                    Filter
                </div>
            </div>
            @php

            @endphp

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
<script>
    let selectedCategory = '';
    let formData = new FormData(); // Khai báo formData ở đầu script

    // Thêm sự kiện click cho các danh mục
    const categoryItems = document.querySelectorAll('.category-item');
    categoryItems.forEach(function(item) {
        item.addEventListener('click', function() {
            // Lấy giá trị data-category
            selectedCategory = item.getAttribute('data-category'); // Cập nhật giá trị biến
            document.getElementById('selectedCategory').value = selectedCategory; // Cập nhật giá trị input ẩn

            // Cập nhật giá trị category trong formData
            formData.set('Api_value', selectedCategory);

            // Rest of your code
            // Lấy giá trị data-category

            // Gửi dữ liệu bằng AJAX
            fetch('/getProductsByCategory', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Xử lý kết quả trả về từ Controller ở đây
                console.log(data);
            })
            .catch(error => {
                console.error(error);
            });
        });
    });
</script>

