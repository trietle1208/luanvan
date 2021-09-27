@extends('layouts.master')
@section('title')
    <title>Thông tin cá nhân</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('home/home.js') }}">
@endsection

@section('content')
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Lịch sử mua hàng</h2>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($add as $ad)
                                    @foreach($ad->order as $order)
                                        <tr>
                                            <th scope="row">{{ $order->dh_id }}</th>
                                            <td>{{ $order->dh_madonhang }}</td>
                                            <td>{{ number_format($order->dh_tongtien)}} VNĐ</td>
                                            <td>{{ $order->dh_ghichu }}</td>
                                            @if($order->dh_trangthai == 0)
                                            <td><button class="btn btn-sm btn-danger">Chưa duyệt</button></td>
                                            @elseif($order->dh_trangthai == 1)
                                            <td><button class="btn btn-sm btn-info">Đã xác nhận</button></td>
                                            @elseif($order->dh_trangthai == 2)
                                            <td><button class="btn btn-sm btn-info">Đang giao hàng</button></td>
                                            @else
                                            <td><button class="btn btn-sm btn-success">Đã nhận hàng</button></td>
                                            @endif

                                            <td>
                                                <button class="btn btn-sm btn-info">Chi tiết</button>
                                                <button class="btn btn-sm btn-danger">Xóa</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Thông tin liên hệ</h2>
                        <address>
                            <p><strong>Họ và tên : </strong>{{ $user->kh_hovaten }}</p>
                            <p><strong>Số điện thoại : </strong>{{ $user->kh_sdt }}</p>
                            <p><strong>Email : </strong>{{ $user->kh_email }}</p>
                            <p><strong>Địa chỉ : </strong>{{ $address->dc_sonha }}</p>
                            <p><strong>Ngày sinh : </strong>{{ $user->kh_ngaysinh }}</p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Mạng xã hội</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/#contact-page-->
@endsection
