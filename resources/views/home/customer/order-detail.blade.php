<div class="modal-dialog" role="document" style="width: 70vw">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="chitietdonhang">CHI TIẾT ĐƠN HÀNG</h5>
            <h4 class="text-center">Mã Đơn Hàng : {{ $order->dh_madonhang }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <style type="text/css">
                .container {
                    width: 90%;
                    padding-bottom: 50px;
                }

                .progressbar {
                    counter-reset: step;
                }

                .progressbar li{
                    list-style-type: none;
                    float : left;
                    width: 25%;
                    position: relative;
                    text-align: center;
                }

                .progressbar li:before {
                    content: counter(step);
                    counter-increment: step;
                    width: 30px;
                    height: 30px;
                    line-height: 30px;
                    display: block;
                    border: 1px solid #ddd;
                    text-align: center;
                    margin: 0 auto 10px auto;
                    border-radius: 50px;
                    background-color: white;
                }

                .progressbar li:after{
                    content : '';
                    position: absolute;
                    width: 100%;
                    height: 1px;
                    background-color: #ddd;
                    top: 15px;
                    left: -50%;
                    z-index: -1;
                }

                .progressbar li:first-child:after{
                    content: none;
                }

                .progressbar li.active {
                    color : #43D018;
                }

                .progressbar li.active:before {
                    background-color: #43D018;
                    color: white;
                }

                .progressbar li.active + li:after {
                    background-color: #43D018;
                }

                .fw-bold {
                    color : #F74545;
                }

                .fw-bold1 {
                    color : #0D5BB5;
                }
                
                .subtotal {
                    color : #0D5BB5;
                }

                .order-subtotal {
                    color : #F74545;
                }

                .fee-ship {
                    color : #E65516;
                }
            </style>
            <div class="container">
                <ul class="progressbar">
                    <li class="{{ $order->dh_trangthai == 0 || $order->dh_trangthai == 1 || $order->dh_trangthai == 3 || $order->dh_trangthai == 2 || $order->dh_trangthai == 5 ? 'active' : '' }}"">
                        Đặt hàng
                        <i class="{{ $order->dh_trangthai == 0 || $order->dh_trangthai == 1 || $order->dh_trangthai == 3 || $order->dh_trangthai == 2 || $order->dh_trangthai == 5 ? 'fa fa-check' : 'fa fa-times' }}"></i><br>
                        <img src="{{asset('assets/images/icon1.jpg') }}" style="width: 100; height: 100" class="img-fluid"><br>
                    </li>
                    <li class="{{ $order->dh_trangthai == 1 || $order->dh_trangthai == 3 || $order->dh_trangthai == 2 || $order->dh_trangthai == 5 ? 'active' : '' }}">
                        Xác nhận đơn hàng
                        <i class="{{ $order->dh_trangthai == 1 || $order->dh_trangthai == 2 || $order->dh_trangthai == 3 || $order->dh_trangthai == 5 ? 'fa fa-check' : 'fa fa-times' }}"></i><br>
                        <img src="{{asset('assets/images/icon-2.jpg') }}" style="width: 100; height: 100" class="img-fluid"><br>
                    </li>
                    <li class="{{ $order->dh_trangthai == 2 || $order->dh_trangthai == 3 || $order->dh_trangthai == 5 ? 'active' : '' }}">
                        Giao hàng
                        <i class="{{ $order->dh_trangthai == 3 || $order->dh_trangthai == 5 ? 'fa fa-check' : 'fa fa-times' }}"></i><br>
                        <img src="{{asset('assets/images/icon-3.jpg') }}" style="width: 100; height: 100" class="img-fluid"><br>
                    </li>
                    <li class="{{ $order->dh_trangthai == 5 ? 'active' : '' }}">
                        Hoàn thành đơn
                        <i class="{{ $order->dh_trangthai == 5 ? 'fa fa-check' : 'fa fa-times' }}"></i><br>
                        <img src="{{asset('assets/images/icon-4.jpg') }}" style="width: 100; height: 100" class="img-fluid"><br>
                    </li>
                </ul>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Khuyến mãi</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->orderNCC as $orderNCC)
                    @foreach($orderNCC->orderDetail as $item)
                        <tr class="order">
                            <th>{{ $item->product->sp_ten }}</th>
                            <td><img src="{{ $item->product->sp_hinhanh }}" style="width: 200px ; height: 150px" class="img-fluid"></td>
                            @if( isset($item->discount->km_ten))
                            <td class="text-success"><strong>{{ $item->discount->km_ten }}</strong></td>
                            @else
                            <td class="text-danger"><strong>Không sử dụng khuyến mãi</strong></td>
                            @endif
                            <td class="subtotal"><b>{{ number_format($item->gia) }} VNĐ</b></td>
                            <input class="price_{{ $item->product->sp_id }}" type="hidden" value="{{ $item->gia }}">
                            @if($orderNCC->dh_trangthai == 0 && $order->ht_id == 2)
                                <td class="text-center">
                                    <span class="qty_{{ $item->product->sp_id }}"><b>{{ $item->soluong }}</b></span>
                                </td>
                            @else
                                <td class="text-center"><b>{{ $item->soluong }}</b></td>
                            @endif
                            <td class="order-subtotal"><b>{{ number_format($item->soluong * $item->gia)  }} VNĐ</b></td>
                        </tr>
                    @endforeach
                    
                @endforeach
                <tr>
                    <th scope="row" colspan="1" class="text-end">Tạm tính : </th>
                    <td><div class="fw-bold1"><b>{{ number_format($subtotal) }} VNĐ</b></div></td>
                </tr>
                <tr>
                    <th scope="row" colspan="1" class="text-end">Phí vận chuyện :</th>
                    <td class="fee-ship"><b>{{ number_format($fee) }} VNĐ</b></td>
                </tr>
                <tr>
                    <th scope="row" colspan="1" class="text-end">Số tiền được giảm :</th>
                    <td class="fw-bold1"><b>{{ number_format($voucher) }} VNĐ</b></td>
                </tr>
                <tr>
                    <th scope="row" colspan="1" class="text-end">Tổng tiền :</th>
                    <td><div class="fw-bold"><b>{{ number_format($order->dh_tongtien) }} VNĐ</b></div></td>
                </tr>
                </tbody>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Ngày đặt hàng: </label> {{ $order->dh_thoigiandathang }} <br>
                            <label>Ngày giao hàng: </label> {{ $order->dh_thoigiangiaohang ?? 'Chưa xác định' }} <br>
                            <label>Ngày nhận hàng: </label> {{ $order->dh_thoigiannhanhang ?? 'Chưa xác định' }} <br>
                        </div>
                        <div class="col-md-4">
                            <label>Người nhận hàng: </label> {{ $order->address->dc_tennguoinhan }} <br>
                            <label>Giao đến địa chỉ: </label> {{ $order->address->dc_sonha }} <br>
                            <label>Số điện thoại: </label> {{ $order->address->dc_sdt }} <br>
                        </div>
                        <div class="col-md-4">
                            <!-- <?php
                            $voucher_price = 0;
                            ?>
                            @foreach($order->orderNCC as $orderNCC )
                                @if(isset($orderNCC->voucher->mgg_ten))
                                <label>Sử dụng mã giảm giá : </label><strong class="text-success"> {{ $orderNCC->voucher->mgg_ten  }}</strong><br>
                                    <?php
                                    $voucher_price += $orderNCC->voucher->mgg_sotiengiam;
                                    ?>
                                @endif
                            @endforeach
                            <input class="order_voucher" type="hidden" value="{{ $voucher_price }}">
                            <label>Tạm tính : </label> <span class="order_total">{{ number_format($subtotal) }} VNĐ</span><br>
                            <label>Số tiền giảm : </label> <span class="order_total">{{ number_format($voucher) }} VNĐ</span><br>
                            <label>Phí vận chuyển : </label> <span class="order_total">{{ number_format($fee) }} VNĐ</span><br>
                            <label>Tổng cộng : </label> <span class="order_total">{{ number_format($order->dh_tongtien) }} VNĐ</span>
                            <input type="hidden" class="total" value="{{ $order->dh_tongtien }}"> -->
                            <label>Người giao hàng: </label> {{ $order->shipper->name ?? 'Chưa cập nhật'}} <br>
                            <label>Email: </label> {{ $order->shipper->email ?? 'Chưa cập nhật' }} <br>
                            <label>Số điện thoại: </label> {{ $order->shipper->info->tt_sdt ?? 'Chưa cập nhật' }} <br>
                        </div>
                    </div>
                </div>
            </table>

        </div>
        <div class="modal-footer">
            @if($order->dh_trangthai == 3)
                <button type="button" class="btn btn-success confirmFinishOder"
                        data-id="{{ $order->dh_id }}"
                        data-url="{{ route('customer.confirmFinishOrder') }}"
                        data-dismiss="modal">Xác nhận nhận hàng
                </button>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
    </div>
</div>
