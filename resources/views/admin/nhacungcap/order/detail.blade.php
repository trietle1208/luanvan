<div class="modal-dialog modal-lg">
    <div class="modal-content modalchitietdonhang">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="exampleModalLabel">Chi tiết đơn hàng</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h3 class="text-center">ĐƠN HÀNG {{ $order->orderAdmin->dh_madonhang }}</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Khuyến mãi</th>
                    <th>Giá</th>
                </tr>
                </thead>
                <tbody>
                @foreach($details as $detail)
                    <tr>
                        <td>
                            {{ $detail->product->sp_ten}}
                        </td>
                        <td>
                            <img src="{{ $detail->product->sp_hinhanh}}" style="width: 200px; height: 150px">
                        </td>
                        <td>
                            {{ $detail->soluong }}
                        </td>
                        @if($detail->km_id == null)
                        <td class="text-danger">
                            <strong>Không có khuyến mãi</strong>
                        </td>
                        @else
                        <td class="text-success">
                            <strong>{{ $detail->discount->km_ten }}</strong>
                        </td>
                        @endif
                        <td>
                                {{ number_format($detail->gia) }}VND
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                <ul>
                    <li><strong>Người đặt hàng :</strong> {{ $order->orderAdmin->address->customer->kh_hovaten }}</li>
                    <li><strong>Email :</strong> {{ $order->orderAdmin->address->customer->kh_email }}</li>
                    <li><strong>Địa chỉ :</strong> {{ $order->orderAdmin->address->dc_sonha }}</li>
                    <li><strong>Số điện thoại :</strong> {{ $order->orderAdmin->address->customer->kh_sdt }}</li>
                </ul>
            </div>
            <div class="col-6">
                <ul>
                    <li><strong>Người giao hàng :</strong> {{ $order->shipper->name ?? 'Chưa cập nhật'}}</li>
                    <li><strong>Thời gian giao hàng :</strong> {{ $order->thoigiangiaohang ?? 'Chưa cập nhật' }} </li>
                    <li><strong>Thời gian nhận hàng :</strong> {{ $order->thoigiannhanhang ?? 'Chưa cập nhật' }}</li>
                </ul>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
