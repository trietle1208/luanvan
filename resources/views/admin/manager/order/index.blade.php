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
                        <table class="table table-bordered table-hover mb-0 text-center" id="basic-datatable">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @if($order['dh_trangthai'] != 4)
                                <tr>
                                    <th scope="row">{{ $order['dh_id'] }}</th>
                                    <td>{{ $order->dh_madonhang }}</td>
                                    
                                    <td>{{ number_format($order['dh_tongtien']) }} VNĐ</td>
                                    <td>{{ $order['dh_thoigiandathang'] }}</td>
                            
                                    @if($order['dh_trangthai'] == 0)
                                        <td class="text-center"><strong class="text-danger">Chưa duyệt</strong></td>
                                        <td><a data-id="{{ $order->dh_id }}" data-url="{{ route('admin.order.orderDetail') }}" class="btn btn-primary order-detail-admin">Chi tiết</a></td>
                                    @elseif($order['dh_trangthai'] == 1)
                                        <td class="text-center"><strong class="text-info">Đã duyệt</strong></td>
                                        <td>
                                            <a data-id="{{ $order->dh_id }}" data-url="{{ route('admin.order.orderDetail') }}" class="btn btn-primary order-detail-admin">Chi tiết</a>
                                            <a class="btn btn-secondary listShipper" data-id="{{ $order['dh_id'] }}" data-url="{{ route('admin.order.listShipper') }}">Chọn shipper</a>
                                        </td>
                                    @elseif($order['dh_trangthai'] == 2)
                                        <td class="text-center"><strong class="text-primary">Đang giao hàng</strong></td>
                                        <td>
                                            <a data-id="{{ $order->dh_id }}" data-url="{{ route('admin.order.orderDetail') }}" class="btn btn-primary order-detail-admin">Chi tiết</a>
                                        </td>
                                    @elseif($order['dh_trangthai'] == 3)
                                        <td class="text-center"><strong class="text-secondary">Đã giao</strong></td>
                                        <td>
                                            <a data-id="{{ $order->dh_id }}" data-url="{{ route('admin.order.orderDetail') }}" class="btn btn-primary order-detail-admin">Chi tiết</a>
                                        </td>
                                    @else($order['dh_trangthai'] == 5)
                                        <td class="text-center"><strong class="text-success">Đã hoàn thành</strong></td>
                                        <td>
                                            <a data-id="{{ $order->dh_id }}" data-url="{{ route('admin.order.orderDetail') }}" class="btn btn-primary order-detail-admin">Chi tiết</a>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH ĐƠN HÀNG BỊ HỦY</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @if($order['dh_trangthai'] == 4)
                                    <tr>
                                        <th scope="row">{{ $order['dh_id'] }}</th>
                                        <td>{{ $order->dh_madonhang }}</td>
                                       
                                        <td>{{ number_format($order['dh_tongtien']) }} VNĐ</td>
                                        <td>{{ $order['dh_thoigiandathang'] }}</td>
                                        <td class="text-center"><strong class="text-danger">Đã hủy</strong></td>
                                    </tr>
                                @endif
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

    <div class="modal fade" id="danhsachshipper" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
    </div>
@endsection
