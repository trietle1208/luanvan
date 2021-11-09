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
                                <th>Mã giảm giá</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @if($order['trangthai'] != 2)
                                <tr>
                                    <th scope="row">{{ $order['dhncc_id'] }}</th>
                                    <td>{{ $order->orderAdmin->dh_madonhang }}</td>
                                    @if($order['mgg_id'] == null)
                                        <td class="text-danger"><strong>Không sử dụng mã</strong></td>
                                    @else
                                        <td class="text-success"><strong>{{ $order->voucher->mgg_ten }}</strong></td>
                                    @endif
                                    <td>{{ number_format($order['tongtien']) }} VNĐ</td>
                                    <td>{{ $order['created_at'] }}</td>
                                    <style>
                                        .chooseShipper {
                                            background-color: #6CB4FD;
                                            color: white;
                                        }
                                    </style>
                                    @if($order['trangthai'] == 0)
                                        <td class="text-center">
                                            <button data-id="{{ $order->dhncc_id }}"
                                                    data-key="{{ $order->orderAdmin->dh_id }}"
                                                    data-idNCC="{{ $order->ncc_id }}"
                                                    data-url ="{{ route('sup.order.changeStatus') }}"
                                                    class="btn btn-sm btn-danger changeStatusOrder">
                                                    <i class="fe-thumbs-down text-center icon_{{ $order->dhncc_id }}"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <!-- <a href="" data-id="{{ $order->dhncc_id }}" class="btn btn-primary order-detail">Chi tiết</a> -->
                                            <a href="" data-id="{{ $order->dhncc_id }}" class="btn btn-primary order-detail">Chi tiết</a>
                                        </td>
                                    @elseif($order['trangthai'] == 1)
                                        <td class="text-center"><button class="btn btn-sm btn-success "><i class="fe-thumbs-up text-center"></i></button></td>
                                        <td>
                                            <a href="" data-id="{{ $order->dhncc_id }}" class="btn btn-primary order-detail">Chi tiết</a>
                                            
                                        </td>
                                    @elseif($order['trangthai'] == 3)
                                        <td class="text-center"><strong class="text-primary">Đang giao hàng</strong></td>
                                        <td>
                                            <a href="" data-id="{{ $order->dhncc_id }}" class="btn btn-primary order-detail">Chi tiết</a>
                                        </td>
                                    @elseif($order['trangthai'] == 4)
                                        <td class="text-center"><strong class="text-secondary">Đã giao</strong></td>
                                        <td>
                                            <a href="" data-id="{{ $order->dhncc_id }}" class="btn btn-primary order-detail">Chi tiết</a>
                                        </td>
                                    @else($order['trangthai'] == 5)
                                        <td class="text-center"><strong class="text-success">Đã hoàn thành</strong></td>
                                        <td>
                                            <a href="" data-id="{{ $order->dhncc_id }}" class="btn btn-primary order-detail">Chi tiết</a>
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
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Mã giảm giá</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @if($order['trangthai'] == 2)
                                    <tr>
                                        <th scope="row">{{ $order['dhncc_id'] }}</th>
                                        <td>{{ $order->orderAdmin->dh_madonhang }}</td>
                                        @if($order['mgg_id'] == null)
                                            <td class="text-danger"><strong>Không sử dụng mã</strong></td>
                                        @else
                                            <td class="text-success"><strong>{{ $order->voucher->mgg_ten }}</strong></td>
                                        @endif
                                        <td>{{ number_format($order['tongtien']) }} VNĐ</td>
                                        <td>{{ $order['created_at'] }}</td>
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
    <div class="modal fade" id="chitietdonhang" tabindex="-1">

    </div>

    <div class="modal fade" id="chitietdonhangUblod" tabindex="-1">

    </div>
@endsection
