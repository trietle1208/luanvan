@extends('layouts.master')
@section('title')
    <title>Home | E-Shopper</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('home/home.js') }}">
@endsection

@section('content')



    <section>
        <div class="container">
            <div class="row">


                <div class="col-sm-9 padding-right">

                    <section id="cart_items">
                        <div class="container">
                            <div class="breadcrumbs">
                                <ol class="breadcrumb">
                                    <li><a href="{{ route('trangchu') }}">Trang chủ</a></li>
                                    <li class="active">Thanh toán giỏ hàng</li>
                                </ol>
                            </div><!--/breadcrums-->
                            @if(Session::get('customer_id'))
                                <div class="register-req">
                                    <span>Vui lòng điền đầy đủ thông tin cá nhân!!!</span>
                                </div><!--/register-req-->
                                <form action="{{ route('checkout.payment') }}" method="POST">
                                    @csrf
                                    <div class="shopper-informations">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="shopper-info">
                                                        <p>Thông Tin Cá Nhân</p>
                                                        
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <label>Họ và tên : </label>
                                                            <input class="form-control name fullname" name="name1" data-url="{{ route('checkout.payment') }}" type="text" placeholder="Nhập vào họ và tên">
                                                            <label>Chọn địa chỉ giao hàng : </label>
                                                            <style>
                                                                .chooseAddress {
                                                                    padding: 10px 0px 10px 10px;
                                                                    margin-bottom: 10px;
                                                                    border: solid 1px;
                                                                    border-color: #ccc;
                                                                    border-radius: 50px;
                                                                }

                                                                .chooseAddress span {
                                                                    font-weight: 600;
                                                                }
                    
                                                                .labelAddress {
                                                                    padding-left: 20px;
                                                                }
                                                            </style>
                                                            <div class="allAddress">
                                                                @foreach($address as $key => $add)
                                                                    <div class="chooseAddress">
                                                                        <input type="radio" data-id="{{ $add->dc_id }}" data-url="{{ route('checkout.addShip') }}" name="address" {{ $key == 0 ? 'checked' : '' }}>
                                                                        <span class="labelAddress">{{ $add->dc_sonha }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <br>
                                                            <button class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong">
                                                                Thêm địa chỉ giao hàng
                                                            </button>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="shopper-info">
                                                        <p>Hình Thức Thanh Toán</p>
                                                        <div class="row">
                                                            @foreach($shipping as $ship)
                                                            <div class="col-sm-5">
                                                                <input class="shipping shipping_{{ $ship->ht_id }}" type="radio" value="{{ $ship->ht_id }}" name="ship">
                                                                <strong>{{ $ship->ht_ten }}</strong><br><br>
                                                                <img src="{{ $ship->ht_hinhanh }}" class="img-fluid" style="height: 200px; width: 200px; text-align: center"><br>

                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <div id="paypal-button" class="paypal col-sm-7" style="float: right">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="order-message">
                                                    <p>Ghi chú đơn hàng</p>
                                                    <br>
                                                    <textarea class="form-control" name="note" id="note"  placeholder="Thêm ghi chú cho đơn hàng" rows="16"></textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                            <div class="register-req">
                                <p>Vui lòng đăng nhập vào hệ thống để được thanh toán, nếu chưa có tài khoản hãy đăng kí !!!</p>
                                <a href="{{ route('customer.index') }}">Đăng kí tại đây</a>
                            </div><!--/register-req-->
                            @endif
                            @if(Session::get('cart'))
                                <div class="review-payment">
                                    <h2>Kiểm tra lại giỏ hàng</h2>
                                </div>

                                <div class="table-responsive cart_info">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr class="cart_menu">
                                            <td class="image">Hình ảnh</td>
                                            <td class="description"></td>
                                            <td class="price">Giá</td>
                                            <td class="quantity">Số lượng</td>
                                            <td class="total1">Thành tiền</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($carts as $key => $cart)
                                            @foreach($cart as $key2 => $item)
                                                @if($key2 != 0)
                                                    <tr class="product">
                                                        <td class="cart_product">
                                                            <a href=""><img class="img-fluid" src="{{ $item['image'] }}" style="height: 100px ; width: 100px" alt=""></a>
                                                        </td>
                                                        <td class="cart_description">
                                                            <h4><a href="">{{ $item['name'] }}</a></h4>
                                                        </td>
                                                        <td class="cart_price">
                                                            <p>{{ number_format($item['price_discount']) }} VNĐ</p>
                                                        </td>
                                                        @php
                                                            $receiptdetail = \App\Models\ReceiptDetail::where('sp_id',$key2)->orderBy('created_at','DESC')->first();
                                                            $quantityProduct = $receiptdetail->soluong;
                                                        @endphp
                                                        <td class="cart_quantity">
                                                            <div class="cart_quantity_button">
                                                                <a class="cart_quantity_down cart_qty dec" href="" data-id="{{ $key2 }}" data-key="{{ $key }}"> - </a>
                                                                <input readonly class="cart_quantity_input" id="valueQty_{{ $key2 }}"
                                                                       data-url = "{{ route('product.updateCart') }}"
                                                                       data-qty_has = "{{ $quantityProduct }}"
                                                                       name="quantity" value="{{ $item['qty'] }}" autocomplete="off" size="2" min="1">
                                                                <a class="cart_quantity_down cart_qty inc" href="" data-id="{{ $key2 }}" data-key="{{ $key }}"> + </a>
                                                            </div>
                                                        </td>
                                                        <td class="cart_total">
                                                            <p class="cart_total_price">{{ number_format($item['total']) }} VNĐ</p>
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                <table class="table table-condensed">
                                                    <tr>
                                                        <td><h4 class="text-success">Các Mã Giảm Giá Đang Sử Dụng</h4></td>
                                                    </tr>
                                                    @foreach($carts as $key => $cart)
                                                        @foreach($cart as $key2 => $item)
                                                            @if($key2 == 0 && count($item) > 0)
                                                                @php
                                                                    $voucher = \App\Models\Voucher::where('mgg_id',(int)$item['id'])->first();
                                                                @endphp
                                                                <tr>
                                                                    <td><strong>Tên mã giảm :</strong> {{ $voucher->mgg_ten }} </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td colspan="3">
                                                <table class="table table total-result">
                                                    <tr>
                                                        <td>Tổng tiền sản phẩm:</td>
                                                        <td class="subtotal"><span>{{ number_format($subtotal) }} VNĐ</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Số tiền được giảm:</td>
                                                        <td>{{ number_format($discount) ?? 0 }} VNĐ</td>
                                                    </tr>
                                                    <tr class="shipping-cost">
                                                        <td>Phí vận chuyển:</td>
                                                        <td class="fee">{{ number_format($fee_ship) }} VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tổng tiền:</td>
                                                        <td class="total"><span>{{ number_format($total) }} VNĐ</span></td>
                                                        <td class="total1"><span style="display: none">{{ $total }}</span></td>
    {{--                                                    <td><input class="total1" type="hidden" name="total" value="{{ $total }}"></td>--}}
                                                    </tr>
                                                    <tr>
                                                        @if(Session::get('customer_id'))
                                                        <td>
                                                            <a href="{{ route('trangchu') }}" class="btn btn-default">Trang chủ</a>
                                                        </td>

                                                        <td>
                                                            <button type="submit" class="btn btn-success confirmCheckout">Thanh toán</button>
                                                        </td>
                                                        @endif
                                                    </form>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="review-payment">
                                    <h2>Vui lòng thêm sản phẩm vào giỏ hàng!</h2>
                                </div>
                            @endif
                        </div>
                    </section> <!--/#cart_items-->
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm địa chỉ giao hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_address" method="POST" action="{{ route('checkout.saveAdd') }}">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <label>Tên người nhận : </label>
                        <input  type="text" name="name" class="form-control">
                        <div class="error name"></div>
                        <label>Số điện thoại : </label>
                        <input required type="text" name="phone" class="form-control">
                        <div class="error phone"></div>
                        <label>Số nhà :</label>
                        <input required type="text" name="address" class="form-control">
                        <div class="error address"></div>
                        <br>
                        <label>Thuộc thành phố :</label>
                        <select  class="form-control choose city" name="city" id="city">
                            <option value="0">--- Chọn thành phố ---</option>
                            @foreach($city as $key => $item)
                                <option value="{{ $item->tp_id }}">{{ $item->tp_ten }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label>Thuộc quận huyện :</label>
                        <select class="form-control choose province" name="province" id="province">
                            <option value="0">--- Chọn quận huyện ---</option>

                        </select>
                        <br>
                        <label>Thuộc xã phường :</label>
                        <select class="form-control ward" name="ward" id="ward">
                            <option value="0">--- Chọn xã phường ---</option>

                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info add-address">Lưu địa chỉ</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addWishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
@endsection

