<section>
    <form class="catDetail" action="{{route('changeProd')}}" method="post">
        @csrf
        <label for="categoriesCid">{{"Pid: #000".$product->Pid}}</label>
        <input type="hidden" name="pid" value="{{$product->Pid}}">
        <label for="categoriesCid">Cid:</label>
        <input type="text" class="casSearch" name="cid" value="{{$product->Cid}}" required>
        <label for="categoriesCid">Product_name:</label>
        <input type="text" class="casSearch" name="name" value="{{$product->Product_name}}" required>
        <label for="categoriesCid">Main Img:</label>
        <div class="avatar">
            <span id="changeAvatar" class="change-icon">
                @if($product->Main_image != null)
                    <img id="avatarImage" height="300px" src="{{$product->Main_image}}" alt="">
                @else
                <input type="text" id="fileInput" class="casSearch" name="imgChanges" placeholder="enter link img"  onchange="previewImage()">
                @endif
            </span>
            <span id="changeIcon"><img class="change_icon" src="{{asset('imgs/refresh.png')}}" onclick="openFileInput()"></span>
            <input type="text" id="fileInput" class="casSearch" name="imgChanges" placeholder="enter link img" style="display: none" onchange="previewImage()">
        </div>
        <label for="categoriesCid">Price:</label>
        <input type="text" class="casSearch" name="price" value="{{$product->Price}}" required>
        <label for="categoriesCid">Imgs:</label>
        <textarea type="text" class="casSearch long" name="imgs"  required>{{$product->Images}}</textarea>
        <label for="categoriesCid">Colors:</label>
        <textarea type="text" class="casSearch long" name="colors" required>{{$product->Colors}}</textarea>
        <label for="categoriesCid">Sizes:</label>
        <textarea class="casSearch long" name="sizes" required>{{$product->Sizes}}</textarea>
        <label for="categoriesCid">Description:</label>
        <textarea  class="casSearch long" name="des" required>{{$product->Description}}</textarea>
        <label for="categoriesCid">Quantit:</label>
        <input type="text" class="casSearch" name="quantit" value="{{$product->Quantit_in_stock}}" required>
        <label for="categoriesCid">Api_code:</label>
        <input type="text" class="casSearch" name="Api_code" value="{{$product->Api_code}}" required>
        <div class="btns_div">
            <button type="submit" class="admin_btns">Save</button>
        </div>
    </form>
</section>
<script>
    function openFileInput() {
        // Hiển thị input file khi người dùng nhấp vào nút thay đổi
        document.getElementById('fileInput').style.display = 'block';
    }

    function previewImage() {
        // Hiển thị ảnh được chọn trong thẻ img khi người dùng chọn file
        var fileInput = document.getElementById('fileInput');
        var avatarImage = document.getElementById('avatarImage');

        // Kiểm tra xem người dùng đã chọn file hay chưa
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Hiển thị ảnh được chọn trong thẻ img
                avatarImage.src = e.target.result;
            };

            // Đọc dữ liệu ảnh từ file
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
