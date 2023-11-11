@php
    $CatController=new \App\Http\Controllers\CategoriesController();
    $secCat=$CatController->__getCats(session('selected'));
    $childCat=[];
    foreach ($secCat as $item){
        $childCat[]=$CatController->__getCats($item->Api_value);
    }
@endphp
<form id="categoryForm" method="POST" action="{{ route('changeCatList') }}">
    @csrf
    <input type="hidden" name="selectedValue" id="selectedValue" value="">
    <ul class="categories">
        <li data-value="all" class="category-item {{ ("all" == session('selected')) ? 'active' : '' }} ">All Products</li>
        <!-- Danh sách các danh mục -->
        @foreach ($perCats as $perCat)
            <li data-value="{{ $perCat->Api_value }}" class="category-item  {{ ($perCat->Api_value == session('selected')) ? 'active' : '' }}">{{ $perCat->Categories_name }}</li>
        @endforeach
    </ul>
</form>

<script>
    // Sử dụng JavaScript để xử lý sự kiện khi một <li> được chọn
    document.querySelectorAll('.category-item').forEach(function(item) {
        item.addEventListener('click', function() {
            var selectedValue = item.getAttribute('data-value');
            document.getElementById('selectedValue').value = selectedValue;
            // Gửi yêu cầu POST khi danh mục được chọn
            document.getElementById('categoryForm').submit();
        });
    });
</script>
