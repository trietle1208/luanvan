@extends('admin.layout')

@section('title')
    Đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH ĐƠN HÀNG</h4>
                    
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order['dh_id'] }}</th>
                                    <td>{{ $order->dh_madonhang }}</td>
                                    <td>{{ number_format($order['dh_tongtien']) }} VNĐ</td>
                                    <td>{{ $order['dh_thoigiandathang'] }}</td>
                                    <td>
                                        <a data-id="{{ $order->dh_id }}" data-url="{{ route('admin.order.orderDetail') }}" class="btn btn-primary order-detail-admin">Chi tiết</a>
                                        @if($order['dh_trangthai'] == 1)
                                            <button class="btn btn-info selectShipOrderAdmin"
                                                    data-id="{{ auth()->id() }}"
                                                    data-key="{{ $order->dh_id }}"
                                                    data-url="{{ route('admin.order.selectShipOrder') }}">Giao hàng
                                            </button>
                                        @elseif($order['dh_trangthai'] == 2)
                                            <button class="btn btn-success finishOrderAdmin"
                                                    data-id="{{ auth()->id() }}"
                                                    data-key="{{ $order->dh_id }}"
                                                    data-url="{{ route('admin.order.finishShipOrder') }}">Xác nhận đã giao
                                            </button>
                                        @elseif($order['dh_trangthai'] == 3)
                                            <button class="btn btn-secondary disabled">
                                                Chờ xác nhận
                                            </button>
                                        @else
                                            <button class="btn btn-success disabled">
                                            Hoàn thành đơn hàng
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>

    <div class="modal fade" id="chitietdonhangAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>

@endsection
