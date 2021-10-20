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
                    <?php
                    $message = Session::get('message');
                    if($message)
                    {
                        echo '<span class="text-primary">'.$message.'</span>';
                        Session::put('message',null);
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Mã đơn hàng</th>
                                <th>Mã giảm giá</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
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
                                    <td>
                                        <a href="" data-id="{{ $order->dhncc_id }}" class="btn btn-primary order-detail">Chi tiết</a>
                                        @if($order['trangthai'] == 1)
                                            <button class="btn btn-info selectShipOrder"
                                                    data-id="{{ auth()->id() }}"
                                                    data-key="{{ $order->dhncc_id }}"
                                                    data-url="{{ route('sup.order.selectShipOrder') }}">Giao hàng</button>
                                        @elseif($order['trangthai'] == 3)
                                            <button class="btn btn-success finishOrder"
                                                    data-id="{{ auth()->id() }}"
                                                    data-key="{{ $order->dhncc_id }}"
                                                    data-url="{{ route('sup.order.finishShipOrder') }}">Xác nhận đã giao</button>
                                        @elseif($order['trangthai'] == 4)
                                            <button class="btn btn-secondary">
                                                Chờ xác nhận
                                            </button>
                                        @else
                                            <button class="btn btn-default">
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
            {{--                    {{ $orders->links() }}--}}
        </div> <!-- end col -->

    </div>
    <div class="modal fade" id="chitietdonhang" tabindex="-1">

    </div>
@endsection
