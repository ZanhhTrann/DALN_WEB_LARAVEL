<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>CATEGORIES</h4>
                <ul>
                    <li><a href="{{route('shopList',['value'=>'ladies'])}}">Women</a></li>
                    <li><a href="{{route('shopList',['value'=>'men'])}}">Men</a></li>
                    <li><a href="{{route('shopList',['value'=>'kids'])}}">Kids</a></li>
                    <li><a href="{{route('shopList',['value'=>'home'])}}">Home</a></li>
                </ul>
            </div>
            <div class="col">
                <h4>HELP</h4>
                <ul>
                    <li clash="{{ (session('head_pages') == 'track') ? 'active' : '' }}"><a  href="{{route('helps',['page'=>'track'])}}">Track Order</a></li>
                    <li clash="{{ (session('head_pages') == 'returns') ? 'active' : '' }}"><a href="{{route('helps',['page'=>'returns'])}}">Returns</a></li>
                    <li clash="{{ (session('head_pages') == 'shipping') ? 'active' : '' }}"><a  href="{{route('helps',['page'=>'shipping'])}}">Shipping</a></li>
                    <li clash="{{ (session('head_pages') == 'faqs') ? 'active' : '' }}"><a  href="{{route('helps',['page'=>'faqs'])}}">FAQs</a></li>
                </ul>
            </div>
            <div class="col">
                <h4>GET IN TOUCH</h4>
                <p>Any questions?
                    Let us know in store at <br>
                    Trường Đại học Phenikaa: <br>
                    P. Nguyễn Trắc, Yên Nghĩa,Hà Đông, Hà Nội
                    (+84)372***568 </p>
                <div class="follow">
                    <a class="icon" target="_blank"
                    href="https://www.facebook.com/TCZnn.02/">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a class="icon" target="_blank"
                    href="" >
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a class="icon" target="_blank"
                    href="https://github.com/ZanhhTrann/DALN_WEB_LARAVEL">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
            </div>
            <div class="col">
                <h4>NEWSLETTER</h4>
                <form action="" method="">
                    <div class="input_nav">
                        <input name="email" type="email" placeholder="email@example.com">
                        <div class="input_nav-focus"></div>
                    </div>
                    <button class="btn" type="submit">SUBSCRIBE</button>
                </form>
            </div>
        </div>

        <div class="footer_rights">
            <p>Đồ án liên ngành 2023 Trường Đại học Phenikaa | Made with ❤️ by
                <a target="_blank"
                href="https://www.facebook.com/TCZnn.02/">
                    Danh
                </a>
                &
                <a target="_blank"
                href="https://www.facebook.com/TCZnn.02/">
                    Quang
                </a>
            </p>
        </div>
    </div>
</footer>
<div class="btn_back-to-top">
    <div class="icon">
        <i class="fa-solid fa-angle-up"></i>
    </div>
</div>

