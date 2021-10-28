<div class="modal-dialog" role="document" style="width: 80vw">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="chitietdonhang">CHI TIẾT ĐƠN HÀNG</h5>
            <h4 class="text-center">Mã Đơn Hàng : {{ $order->dh_madonhang }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
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
                            <td>{{ number_format($item->gia) }} VNĐ</td>
                            <input class="price_{{ $item->product->sp_id }}" type="hidden" value="{{ $item->gia }}">
                            @if($orderNCC->trangthai == 0 && $order->ht_id == 2)
                                <td class="text-center">
                                    <button class="btn btn-sm order_detail_qty dec" data-url="{{ route('customer.updateOrder') }}" data-id="{{ $item->product->sp_id }}" data-key="{{ $item->ctdh_id }}"> - </button>
                                    <span class="qty_{{ $item->product->sp_id }}">{{ $item->soluong }}</span>
                                    <button class="btn btn-sm order_detail_qty inc" data-url="{{ route('customer.updateOrder') }}" data-id="{{ $item->product->sp_id }}" data-key="{{ $item->ctdh_id }}" style="display: inline"> + </button>
                                </td>
                            @else
                                <td class="text-center">{{ $item->soluong }}</td>
                            @endif
                            <td class="order-subtotal">{{ number_format($item->soluong * $item->gia)  }} VNĐ</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Ngày đặt hàng: </label> {{ $order->dh_thoigiandathang }} <br>
                            <label>Ngày giao hàng: </label> {{ $order->dh_thoigiangiaohang ?? 'Chưa xác định' }} <br>
                            <label>Ngày nhận hàng: </label> {{ $order->dh_thoigiannhanhang ?? 'Chưa xác định' }} <br>
                        </div>
                        <div class="col-md-4">
                            <label>Giao đến địa chỉ: </label> {{ $order->address->dc_sonha }} <br>
                            <label>Người nhận hàng: </label> {{ $order->address->dc_tennguoinhan }} <br>
                            <label>Số điện thoại: </label> {{ $order->address->dc_sdt }} <br>
                        </div>
                        <div class="col-md-4">
                            <label>Các mã giảm giá có sử dụng:</label><br>
                            <?php
                            $voucher_price = 0;
                            ?>
                            @foreach($order->orderNCC as $orderNCC )
                                @if(isset($orderNCC->voucher->mgg_ten))
                                    <strong class="text-success">{{ $orderNCC->voucher->mgg_ten  }}</strong><br>
                                    <?php
                                    $voucher_price += $orderNCC->voucher->mgg_sotiengiam;
                                    ?>
                                @endif
                            @endforeach
                            <input class="order_voucher" type="hidden" value="{{ $voucher_price }}">
                            <br>
                            <label>Tổng tiền: </label> <span class="order_total">{{ number_format($order->dh_tongtien) }} VNĐ</span>
                            <input type="hidden" class="total" value="{{ $order->dh_tongtien }}">
                        </div>
                    </div>
                </div>
            </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
