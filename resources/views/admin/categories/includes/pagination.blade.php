@php

    $page=session('Admin_Cat')['page'];
    $pages=session('Admin_Cat')['pages'];
    // dd($page);
@endphp
@if(!empty($pages))
        <div>
            <ul class="pagination">
                <li>
                    @if($page>1)
                        <a class="page-link" data-page="{{$page-1}}" href=""><</a>
                    @else
                        <a class="page-link" aria-disabled="true"><</a>
                    @endif
                </li>
                @if($page>3)
                    <li class="page">
                        <a class="page-link" data-page="{{1}}" href="">1</a>
                    </li>
                @endif
                @if($page>4)
                    <li class="page">...</li>
                @endif
                @for($i=(($page>=3)? $page-2:1); $i <= ((($page+3)<=$pages?$page+2:$pages)); $i++)
                    <li class="page {{ ($i == $page) ? 'active' : '' }}">
                        <a class="page-link" data-page="{{$i}}" href="">{{ $i }}</a>
                    </li>
                @endfor
                @if($page<$pages-4)
                    <li class="page">...</li>
                @endif
                @if($page<$pages-3)
                    <li class="page">
                        <a class="page-link" data-page="{{$pages}}" href="">{{$pages}}</a>
                    </li>
                @endif
                <li class="page">
                    @if($page<$pages)
                        <a class="page-link" data-page={{$page+1}} href="">></a>
                    @else
                        <a class="page-link" aria-disabled="true">></a>
                    @endif
                </li>
            </ul>
        </div>
@endif
    <script>
        // Lắng nghe sự kiện khi người dùng ấn vào liên kết chuyển trang
        document.querySelectorAll(".page-link").forEach(function(link) {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                var newPage = link.getAttribute("data-page");
                axios.post('/updatePageCatAdmin', { newPage: newPage })
                    .then(function(response) {
                        // Sau khi cập nhật session, bạn có thể thực hiện việc chuyển hướng trang hoặc làm bất kỳ việc gì khác.
                        window.location.href = response.data.redirectUrl;
                        console.log(newPage);
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            });
        });
    </script>
