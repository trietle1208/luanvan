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
                                <th>Trạng thái</th>
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
                                    @if($order['trangthai'] == 0)
                                        <td class="text-center"><button data-id="{{ $order->dhncc_id }}" data-key="{{ $order->orderAdmin->dh_id }}" class="btn btn-sm btn-danger changeStatusOrder"><i class="fe-thumbs-down text-center icon_{{ $order->dhncc_id }}"></i></button></td>
                                    @else
                                        <td class="text-center"><button class="btn btn-sm btn-success "><i class="fe-thumbs-up text-center"></i></button></td>
                                    @endif
                                    <td>
                                        <a href="" data-id="{{ $order->dhncc_id }}" class="btn btn-primary order-detail">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
                    {{ $orders->links() }}
        </div> <!-- end col -->

    </div>
    <div class="modal fade" id="chitietdonhang" tabindex="-1">

    </div>
@endsection
