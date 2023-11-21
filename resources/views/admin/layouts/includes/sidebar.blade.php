<div class="sidebar">
    <h2><a href="{{route('dashboard')}}">Store Management</a></h2>
    <ul>
        <li><a href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li><a href="{{route('CasMPageView')}}">Categories</a>
            <div class="dropdown-content">
                <ul>
                    <li><a href="{{route('CasAddView')}}">Add</a></li>
                    <li><a href="{{route('CasMPageView')}}">Management</a></li>
                    <li><a href="{{route('AddformApiView')}}">Add form API</a></li>
                </ul>
                <!-- Thêm các mục menu khác nếu cần -->
            </div>
        </li>
        <li><a href="{{route('Admin_MProducts_Pages',['page'=>'all'])}}">Products</a>
            <div class="dropdown-content">
                <ul>
                    <li><a href="{{route('addProdView')}}">Add</a></li>
                    <li><a href="{{route('Admin_MProducts_Pages',['page'=>'all'])}}">Management</a></li>
                    <li><a href="{{route('addProductFormApi',['Cid'=>'Home'])}}">Add form API</a></li>
                </ul>
                <!-- Thêm các mục menu khác nếu cần -->
            </div>
        </li>
        <li><a href="{{route('getOrder')}}">Orders</a></li>
        <!-- Add more menu items here -->
    </ul>
</div>
