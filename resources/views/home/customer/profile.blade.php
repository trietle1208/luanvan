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
            <div class="col-sm-12">
                <div class="contact-info">
                    <h2 class="title text-center">Thông tin liên hệ</h2>
                    <style>
                        .info-customer strong{
                            font-size: 18px; 
                        }
                        .info-customer span{
                            font-size: 18px; 
                        }
                    </style>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6" style="padding-left : 50px">
                                <div class="row avt_ajax">
                                    <img src="{{ $user->kh_hinhanh ?? asset('assets/images/avt_null.jpg') }}" style="width: 350px; height: 400px" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                
                                <address class="info-customer">
                                    <p style="padding-bottom : 15px;"><strong>Họ và tên : </strong><span class="fullname">{{ $user->kh_hovaten }}</span></p>
                                    <hr>
                                    <p style="padding-bottom : 15px;"><strong>Số điện thoại : </strong><span class="phone">{{ $user->kh_sdt ?? 'Chưa cập nhật'}}</span></p>
                                    <hr>
                                    <p style="padding-bottom : 15px;"><strong>Email : </strong>{{ $user->kh_email }}</p>
                                    <hr>
                                    <p style="padding-bottom : 15px;"><strong>Địa chỉ : </strong>{{ $address->dc_sonha ?? 'Chưa cập nhật' }}</p>
                                    <hr>
                                    <p style="padding-bottom : 15px;"><strong>Ngày sinh : </strong><span class="date">{{ $user->kh_ngaysinh ?? 'Chưa cập nhật' }}</span></p>
                                    <hr>
                                    <button class="btn btn-sm btn-secondary updateInfo" data-id="{{ $user->kh_id }}" data-url="{{ route('customer.updateInfo') }}">Cập nhật</button>
                                </address> 
                            </div>
                        </div>
                    </div>
                            <!-- <div class="social-networks">
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
                            </div> -->
                </div>
            </div>
            <div class="col-sm-12">
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
                                    <tr class="order">
                                        <th scope="row">{{ $order->dh_id }}</th>
                                        <td>{{ $order->dh_madonhang }}</td>
                                        <td>{{ number_format($order->dh_tongtien)}} VNĐ</td>
                                        <td>{{ $order->dh_ghichu ?? 'Không có ghi chú' }}</td>
                                        @if($order->dh_trangthai == 0)
                                        <td><span class="text-danger statusOrder">Chưa duyệt</span></td>
                                        @elseif($order->dh_trangthai == 1)
                                        <td><span class="text-info statusOrder">Đã xác nhận</span></td>
                                        @elseif($order->dh_trangthai == 2)
                                        <td><span class="text-primary statusOrder">Đang giao hàng</span></td>
                                        @elseif($order->dh_trangthai == 3)
                                        <td><span class="text-secondary statusOrder_{{ $order->dh_id }}">Chờ xác nhận</span></td>
                                        @elseif($order->dh_trangthai == 5)
                                        <td><span class="text-success statusOrder">Đã nhận hàng</span></td>
                                        @else
                                        <td><span class="text-danger statusOrder">Đã hủy</span></td>
                                        @endif
                                        <td>
                                            <style>
                                                .detailOrder {
                                                    background-color: #D7BEBE;
                                                }
                                            </style>
                                            @if($order->dh_trangthai != 4)
                                            <button data-id="{{ $order->dh_id }}" class="btn btn btn-default detailOrder">Chi tiết</button>
                                                @if($order->dh_trangthai == 0)
                                                <button data-id="{{ $order->dh_id }}" data-url="{{ route('customer.deleteOrder') }}" class="btn btn btn-danger deleteOrder">Hủy đơn hàng</button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!--/#contact-page-->
    <div class="modal fade" id="chitietdonhang" tabindex="-1">

    </div>

    <div class="modal fade" id="capnhatthongtin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>

    <div class="modal fade" id="theodoidonhang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
@endsection
