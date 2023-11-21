@php
    // session_start();
    // dd(session('login'));
    $userC=new \App\Http\Controllers\UsersController();
    $user=$userC->getUser();
    $prod=new \App\Http\Controllers\ProductsController();
    $shipC=new \App\Http\Controllers\ShippingController();

    $payC=new \App\Http\Controllers\PaymentController();
    $citys=$payC->getCity();
    // dd(session('payment'));
    // Session::forget('payment');
    $cartOrders=$userC->getCartOrder();
    $payMets=$payC->getPayMethod();
    // dd($cartOrders);
    $ship=$shipC->getShipbyId();
    $sum_total=0;
    $cart=$userC->getCart();
    $uAddress=$user->Address;
@endphp
<form action="{{route('payment')}}" method="POST" id="section" class="section_features-pay">
    @csrf
        <div class="container">
            <div class="bill_info">
                <h4>BILLING INFORMATION</h4>
                <div class="Recipient_name">
                    <p for="">Recipient's name:</p>
                    <input type="text" id="RecName" name="name" required value="{{$user->Name}}">
                </div>
                <div class="phone_number">
                    <label for="phone">Enter your phone number:</label>
                    <input id="phone" type="text"  name="phone" required value={{$user->Phone_number}}>
                </div>
                <div class="delivery_address">
                    <span>Delivery address</span>
                    <div class="delivery_address-item">
                        <div class="address_item city">
                            <div>Province/City:</div>
                            <select name="id_tp" id="city"  onchange="changeCity()"  {{ ($uAddress != "") ? 'required' : '' }} onchange="AddressChange()">
                                <option value="">--Choose your option--</option>
                                @if(count($citys)>0)
                                    @foreach ($citys as $key => $value)
                                        <option value="{{$value->id_tp}}">
                                            {{$value->name_tp}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="address_item district">
                            <div>District:</div>
                            <select name="id_qh" id="district"  {{ ($uAddress != "") ? 'required' : '' }} onchange="AddressChange()">
                                <option value="">--Choose your option--</option>
                            </select>
                        </div>
                        <div class="address_item town">
                            <div>Town/commune/ward:</div>
                            <select name="id_xp" id="town"  {{ ($uAddress != "") ? 'required' : '' }} onchange="AddressChange()">
                                <option value="">--Choose your option--</option>
                            </select>
                        </div>
                        <div class="address_item street">
                            <div>Street:</div>
                            <input type="text" id="street" name="street" placeholder="--Your Street--" {{ ($uAddress != "") ? 'required' : '' }} onchange="AddressChange()">
                        </div>
                        <div class="address_item address">
                            <div>Address detail:</div>
                            <textarea name="address" id="detail">{{$uAddress}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="notes">
                    <label for="">Notes</label>
                    <textarea name="note" id=""></textarea>
                </div>
            </div>
            <div class="order_info">
                <h4>YOUR ORDER</h4>
                <div class="order_title">
                    <div>Product <span>(Sản phẩm)</span></div>
                    <div>Provisional <span>(tạm tính)</span></div>
                </div>
                <div class="order_product">
                    @if($cartOrders)
                        @foreach($cartOrders as $item)
                            @php
                                $product=$prod->getProductbyId($item->Pid);
                                $sum_total+=$product->Price*$item->quantity;
                            @endphp
                            <div class="order_product-item">
                                <div class="name_quantity">
                                    <span>{{$product->Product_name}}</span>
                                    <b>x {{$item->quantity}}</b>
                                </div>
                                <div>$ {{$product->Price*$item->quantity}}</div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="order_shipping">
                    <div>Shipping</div>
                    <div>{{$ship->Shipping_methods_name.": $".$ship->price}}</div>
                </div>
                <div class="order_total">
                    <div>Total:</div>
                    <div>${{($sum_total+$ship->price)}}</div>
                </div>
                @foreach($payMets as $key=>$item)
                    <div class="order_radio">
                        <input id="cash_{{$item->PMid}}}" name="payment_method" type="radio" {{($key==0)?'checked':''}} value="{{$item->PMid}}">
                        <label for="cash">{{$item->Payment_method_name.": ".$item->Discription}}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn">CHECKOUT</button>
            </div>
        </div>
    </form>
    <script>

        function AddressChange() {
            // Lấy giá trị của thành phố (city), quận huyện (district), xã phường (town), và đường (street)
            var city = $('#city option:selected').text().trim();
            if(city==='--Choose your option--'){
                city=''
            }
            var district = $('#district option:selected').text().trim();
            if(district==='--Choose your option--'){
                district=''
            }
            var town = $('#town option:selected').text().trim();
            if(town==='--Choose your option--'){
                town=''
            }
            var street = $('#street').val().trim();

            // Tạo một mảng chứa các thành phần không rỗng
            var addressComponents = [street, town, district, city].filter(function (component) {
                return component !== "";
            });

            // Cập nhật chi tiết địa chỉ
            $('#detail').val(addressComponents.join(", "));
        }

        function changeCity() {
            var cityId = $('#city').val();
            // console.log(cityId);
            if (cityId) {
                $.ajax({
                    url: "{{ route('getDistrict') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cityId: cityId
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#district').html(data);
                        AddressChange();
                    }
                });
            } else {
                // Xử lý khi không có thành phố được chọn
                $('#town').html('<option value="">-- Chọn quận/huyện --</option>');
            }
        }
        $(document).ready(function () {

        // Lắng nghe sự kiện khi một danh mục được chọn
        $('body').on('change', '#district', function() {
            var districtId = $('#district').val();
            if (districtId) {
                $.ajax({
                    url: "{{ route('getTown') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        districtId: districtId
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#town').html(data);
                        AddressChange();
                    }
                });
            } else {
                // Xử lý khi không có thành phố được chọn
                $('#town').html('<option value="">-- Chọn quận/huyện --</option>');
            }
        });
        $('body').on('change', '#town', function() {
            AddressChange();
        });

    });
    </script>

