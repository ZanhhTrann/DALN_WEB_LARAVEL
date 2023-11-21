<form id="categoryForm" method="POST" action="{{ route('getChilCategory') }}">
    @csrf
    <ul class="categories">
        <li value="All Products" class="category-item active">All Products</li>
        <!-- Danh sách các danh mục -->
        @foreach ($perCats as $perCat)
            <li value="{{$perCat->Api_value}}" class="category-item">{{ $perCat->Categories_name }}</li>
        @endforeach
    </ul>
</form>
