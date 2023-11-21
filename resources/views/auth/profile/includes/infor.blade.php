@php
    $userC=new \App\Http\Controllers\UsersController();
    $user=$userC->getUser();
@endphp
<form method="POST" action="{{route('updataProfile')}}" enctype="multipart/form-data">
    @csrf
    <div class="profile">
        <div class="profile-container">
            <div class="header">
                <div class="user-info">
                    <!-- Trong phần avatar của bạn -->
                    <div class="avatar">
                        <span id="changeAvatar" class="change-icon" onclick="openFileInput()">
                            @if($userC->getAvata()!=null)
                                <img id="avatarImage" src="data:image/jpeg;base64,{{$userC->getAvata()}}" alt="">
                            @else
                                <img id="avatarImage" src="{{asset('imgs/logo_website.png')}}" alt="">
                            @endif
                        </span>
                        <span id="changeIcon" onclick="openFileInput()"><img class="change_icon" src="{{('imgs/refresh.png')}}"></span>
                        <input type="file" id="fileInput" name="imgChanges" style="display: none" onchange="previewImage()">
                    </div>

                    <div class="user-name">
                        <input class="change_data" type="text" name="Name" id="UserName" value="{{$user->Name}}">
                    </div>
                </div>
            </div>
            <div class="info-section">
                <div class="info-item">
                    <label for="phone">Số điện thoại:</label>
                    <!-- User Phone (Replace with user's actual phone number) -->
                    <input class="change_data" type="text" name="phone" id="" value="{{$user->Phone_number}}">
                </div>
                <div class="info-item">
                    <label for="email">Email:</label>
                    <!-- User Email (Replace with user's actual email) -->
                    <p id="email">{{$user->Email}}</p>
                </div>
                <div class="info-item">
                    <label for="address">Địa chỉ:</label>
                    <!-- User Address (Replace with user's actual address) -->
                    <input class="change_data" type="text" name="addrest" id="addrest" value="{{$user->Addrest}}">
                </div>
                <button type="submit" class="update_btn btn">
                    Save
                </button>
            </div>
        </div>
    </div>
</form>
<script>
    function openFileInput() {
        // Mở hộp thoại chọn file khi người dùng nhấp vào biểu tượng change
        document.getElementById('fileInput').click();
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
