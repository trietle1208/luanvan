<div class="modal-dialog modal-xl">
    <div class="modal-content modalchitietdonhang">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="exampleModalLabel">Chi tiết đơn hàng</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="header-title mb-3">Track Order</h4> -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h5 class="mt-0">Đơn hàng ID:</h5>
                                    <p>#{{ $order->dhncc_id }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h5 class="mt-0">Mã đơn hàng:</h5>
                                    <p>{{ $order->orderAdmin->dh_madonhang }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="track-order-list">
                            <ul class="list-unstyled">
                                <li class="{{ $order->trangthai == 1 || $order->trangthai == 3 || $order->trangthai == 4 || $order->trangthai == 5  ? 'completed' : '' }}">
                                    @if ($order->trangthai == 0)
                                    <span class="active-dot dot"></span>
                                    @endif
                                    <h5 class="mt-0 mb-1">Đặt hàng</h5>
                                    <p class="text-muted">{{ $order->created_at->format('d-m-Y') }} </p>
                                </li>
                                <li class="{{ $order->trangthai == 1 || $order->trangthai == 3 || $order->trangthai == 4 || $order->trangthai == 5 ? 'completed' : '' }}">
                                    @if ($order->trangthai == 1)
                                    <span class="active-dot dot"></span>
                                    @endif
                                    <h5 class="mt-0 mb-1">Xác nhận đơn hàng</h5>
                                </li>
                                <li class="{{ $order->trangthai == 4 || $order->trangthai == 5 ? 'completed' : '' }}">
                                    @if ($order->trangthai == 3)
                                    <span class="active-dot dot"></span>
                                    @endif
                                    <h5 class="mt-0 mb-1">Giao hàng</h5>
                                    <p class="text-muted">{{ $order->thoigiangiaohang ?? 'Chưa cập nhật' }} </p>
                                </li>
                                <li class="{{ $order->trangthai == 5 ? 'completed' : '' }}">
                                    @if ($order->trangthai == 5)
                                    <span class="active-dot dot"></span>
                                    @endif
                                    <h5 class="mt-0 mb-1"> Hoàn thành đơn</h5>
                                    <p class="text-muted">{{ $order->thoigiannhanhang ?? 'Chưa cập nhật' }}</p>
                                </li>
                            </ul>

                            <!-- <div class="text-center mt-4">
                                <a href="#" class="btn btn-primary">Show Details</a>
                            </div> -->
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Các sản phẩm của đơn hàng</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tên</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details as $detail)
                                    <tr>
                                        <th scope="row">{{ $detail->product->sp_ten}}</th>
                                        <td><img src="{{ $detail->product->sp_hinhanh}}" alt="product-img" height="80"></td>
                                        <td>{{ $detail->soluong }}</td>
                                        @if($detail->km_id != null)
                                        <td>
                                            {{ number_format($detail->gia) }}VND
                                            <p class="text-success">({{ $detail->discount->km_ten }})</p>
                                        </td>
                                        <td>{{ number_format($detail->gia*$detail->soluong) }}VND</td>
                                        @else
                                        <td>{{ number_format($detail->gia) }}VND</td>
                                        <td>{{ number_format($detail->gia*$detail->soluong) }}VND</td>
                                        @endif
                                        
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row" colspan="4" class="text-end">Tạm tính : </th>
                                        <td><div class="fw-bold">{{ number_format($subtotal) }} VNĐ</div></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="4" class="text-end">Phí vận chuyện :</th>
                                        <td>{{ number_format($fee_ship) }} VNĐ</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="4" class="text-end">Số tiền được giảm :</th>
                                        <td>{{ number_format($voucher_price) }} VNĐ</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="4" class="text-end">Tổng tiền :</th>
                                        <td><div class="fw-bold">{{ number_format($total) }} VNĐ</div></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Thông tin người nhận</h4>

                        <p class="mb-2"><span class="fw-semibold me-2">Họ và tên:</span>{{ $order->orderAdmin->address->customer->kh_hovaten }}</p>
                        <p class="mb-2"><span class="fw-semibold me-2">Địa chỉ:</span>{{ $order->orderAdmin->address->customer->kh_email }}</p>
                        <p class="mb-2"><span class="fw-semibold me-2">Email:</span>{{ $order->orderAdmin->address->dc_sonha }}</p>
                        <p class="mb-2"><span class="fw-semibold me-2">Số điện thoại:</span>{{ $order->orderAdmin->address->customer->kh_sdt }}</p>

                    </div>
                </div>
            </div> <!-- end col -->
        
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Thông tin người giao</h4>

                        <p class="mb-2"><span class="fw-semibold me-2">Họ và tên:</span>{{ $order->shipper->name ?? 'Chưa cập nhật'}}</p>
                        <p class="mb-2"><span class="fw-semibold me-2">Địa chỉ:</span>{{ $order->shipper->info->tt_diachi ?? 'Chưa cập nhật'}}</p>
                        <p class="mb-2"><span class="fw-semibold me-2">Email:</span>{{ $order->shipper->email ?? 'Chưa cập nhật'}}</p>
                        <p class="mb-2"><span class="fw-semibold me-2">Số điện thoại:</span>{{ $order->shipper->info->tt_sdt ?? 'Chưa cập nhật'}}</p>

                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Phương thức thanh toán</h4>

                        <div class="text-center">
                            <i class="mdi mdi-truck-fast h2 text-muted"></i>
                            <h5><b>{{ $order->orderAdmin->typepayment->ht_ten }}</b></h5>
                            <p class="mb-2"><span class="fw-semibold">Ngày giao hàng :</span> {{ $order->thoigiangiaohang ?? 'Chưa cập nhật' }}</p>
                            <p class="mb-2"><span class="fw-semibold">Ngày nhận hàng :</span> {{ $order->thoigiannhanhang ?? 'Chưa cập nhật' }}</p>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
    </div>
</div>
