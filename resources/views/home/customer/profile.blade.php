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
                            font-size: 15px; 
                        }
                        .info-customer span{
                            font-size: 15px; 
                        }

                        .info-list li:hover{
                            cursor: pointer;
                            color : red;
                        }
                    </style>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4" style="padding-left : 50px">
                                <div class="row avt_ajax">
                                    <img src="{{ $user->kh_hinhanh ?? asset('assets/images/avt_null.jpg') }}" style="width: 200px; height: 200px; margin-bottom : 20px" class="img-fluid">
                                    
                                </div>
                            </div>
                            <div class="col-sm-8">
                                
                                <address class="info-customer">
                                    <p style="padding-bottom : 15px;"><strong>Họ và tên : </strong><span class="fullname">{{ $user->kh_hovaten }}</span></p>
                                    <p style="padding-bottom : 15px;"><strong>Số điện thoại : </strong><span class="phone">{{ $user->kh_sdt ?? 'Chưa cập nhật'}}</span></p>
                                    <p style="padding-bottom : 15px;"><strong>Email : </strong>{{ $user->kh_email }}</p>
                                    <p style="padding-bottom : 15px;"><strong>Địa chỉ : </strong>{{ $user['address'][0]['dc_sonha'] ?? 'Chưa cập nhật' }}</p>
                                    <p style="padding-bottom : 15px;"><strong>Ngày sinh : </strong><span class="date">{{ $user->kh_ngaysinh ?? 'Chưa cập nhật' }}</span></p>
                                    <button class="btn btn-sm btn-secondary updateInfo" data-id="{{ $user->kh_id }}" data-url="{{ route('customer.updateInfo') }}">Cập nhật</button>
                                </address> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 history">
                <div class="contact-form">
                    <h2 class="title text-center">Lịch sử mua hàng</h2>
                    <!-- <table class="table table-striped" id="table-history">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Ghi chú</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($user['order'] as $order)
                                    <tr class="order">
                                        <th scope="row">{{ $order['dh_id'] }}</th>
                                        <td>{{ $order['dh_madonhang'] }}</td>
                                        <td>{{ number_format($order['dh_tongtien'])}} VNĐ</td>
                                        <td>{{ $order['dh_ghichu'] ?? 'Không có ghi chú' }}</td>
                                        <td>{{ $order['dh_thoigiandathang'] }}</td>
                                        @if($order['dh_trangthai'] == 0)
                                        <td><span class="text-danger statusOrder">Chưa duyệt</span></td>
                                        @elseif($order['dh_trangthai'] == 1)
                                        <td><span class="text-info statusOrder">Đã xác nhận</span></td>
                                        @elseif($order['dh_trangthai'] == 2)
                                        <td><span class="text-primary statusOrder">Đang giao hàng</span></td>
                                        @elseif($order['dh_trangthai'] == 3)
                                        <td><span class="text-secondary statusOrder_{{ $order['dh_id'] }}">Chờ xác nhận</span></td>
                                        @else
                                        <td><span class="text-success statusOrder">Đã nhận hàng</span></td>
                                        @endif
                                        <td>
                                            
                                                <a href="" data-id="{{ $order['dh_id'] }}" class="detailOrder"><i class="fa fa-list" style="color : #14C11F; font-size: 25px;"></i></a>
                                                @if($order->dh_trangthai == 0)
                                                <a href="" data-id="{{ $order['dh_id'] }}" data-url="{{ route('customer.deleteOrder') }}" class="deleteOrder"><i class="fa fa-trash-o" style="color : red; font-size: 25px"></i></a>
                                                @endif
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table> -->
                </div>
				<div class="category-tab"><!--category-tab-->
				<div class="col-12">
					<style>
						.nav-tabs li a{
							padding : 10px 47px;
						}
					</style>
					<ul class="nav nav-tabs">
						<li class="active"><a href="#new" data-toggle="tab">Đơn hàng mới</a></li>
						<li><a href="#check" data-toggle="tab">Đã xác nhận</a></li>
						<li><a href="#ship" data-toggle="tab">Đang giao</a></li>
						<li><a href="#confirm" data-toggle="tab">Chờ xác nhận</a></li>
						<li><a href="#success" data-toggle="tab">Hoàn thành</a></li>
						<li><a href="#delete" data-toggle="tab">Đã hủy</a></li>

					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="new" >
						<table class="table table-striped" id="table-history">
							<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Tổng tiền</th>
								<th scope="col">Ghi chú</th>
								<th scope="col">Ngày đặt</th>
								<th scope="col">Trạng thái</th>
								<th scope="col">Hành động</th>
							</tr>
							</thead>
							<tbody>
								@foreach($user['order'] as $order)
									@if($order->dh_trangthai == 0)
										<tr class="order">
											<th scope="row">{{ $order['dh_id'] }}</th>
											<td>{{ $order['dh_madonhang'] }}</td>
											<td>{{ number_format($order['dh_tongtien'])}} VNĐ</td>
											<td>{{ $order['dh_ghichu'] ?? 'Không có ghi chú' }}</td>
											<td>{{ $order['dh_thoigiandathang'] }}</td>
											<td><span class="text-danger statusOrder">Chưa duyệt</span></td>
											<td>
												<a href="" data-id="{{ $order['dh_id'] }}" class="detailOrder"><i class="fa fa-list" style="color : #14C11F; font-size: 25px;"></i></a>
												@if($order->dh_trangthai == 0)
												<a href="" data-id="{{ $order['dh_id'] }}" data-url="{{ route('customer.deleteOrder') }}" class="deleteOrder"><i class="fa fa-trash-o" style="color : red; font-size: 25px"></i></a>
												@endif
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
					
					<div class="tab-pane fade" id="check" >
						<table class="table table-striped" id="table-history">
							<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Tổng tiền</th>
								<th scope="col">Ghi chú</th>
								<th scope="col">Ngày đặt</th>
								<th scope="col">Trạng thái</th>
								<th scope="col">Hành động</th>
							</tr>
							</thead>
							<tbody>
								@foreach($user['order'] as $order)
									@if($order->dh_trangthai == 1)
										<tr class="order">
											<th scope="row">{{ $order['dh_id'] }}</th>
											<td>{{ $order['dh_madonhang'] }}</td>
											<td>{{ number_format($order['dh_tongtien'])}} VNĐ</td>
											<td>{{ $order['dh_ghichu'] ?? 'Không có ghi chú' }}</td>
											<td>{{ $order['dh_thoigiandathang'] }}</td>
											<td><span class="text-info statusOrder">Đã xác nhận</span></td>
											<td>
												<a href="" data-id="{{ $order['dh_id'] }}" class="detailOrder"><i class="fa fa-list" style="color : #14C11F; font-size: 25px;"></i></a>
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
					
					<div class="tab-pane fade" id="ship" >
						<table class="table table-striped" id="table-history">
							<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Tổng tiền</th>
								<th scope="col">Ghi chú</th>
								<th scope="col">Ngày đặt</th>
								<th scope="col">Trạng thái</th>
								<th scope="col">Hành động</th>
							</tr>
							</thead>
							<tbody>
								@foreach($user['order'] as $order)
									@if($order->dh_trangthai == 2)
										<tr class="order">
											<th scope="row">{{ $order['dh_id'] }}</th>
											<td>{{ $order['dh_madonhang'] }}</td>
											<td>{{ number_format($order['dh_tongtien'])}} VNĐ</td>
											<td>{{ $order['dh_ghichu'] ?? 'Không có ghi chú' }}</td>
											<td>{{ $order['dh_thoigiandathang'] }}</td>
											<td><span class="text-primary statusOrder">Đang giao hàng</span></td>
											<td>
												<a href="" data-id="{{ $order['dh_id'] }}" class="detailOrder"><i class="fa fa-list" style="color : #14C11F; font-size: 25px;"></i></a>
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="tab-pane fade" id="confirm" >
						<table class="table table-striped" id="table-history">
							<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Tổng tiền</th>
								<th scope="col">Ghi chú</th>
								<th scope="col">Ngày đặt</th>
								<th scope="col">Trạng thái</th>
								<th scope="col">Hành động</th>
							</tr>
							</thead>
							<tbody>
								@foreach($user['order'] as $order)
									@if($order->dh_trangthai == 3)
										<tr class="order">
											<th scope="row">{{ $order['dh_id'] }}</th>
											<td>{{ $order['dh_madonhang'] }}</td>
											<td>{{ number_format($order['dh_tongtien'])}} VNĐ</td>
											<td>{{ $order['dh_ghichu'] ?? 'Không có ghi chú' }}</td>
											<td>{{ $order['dh_thoigiandathang'] }}</td>
											<td><span class="text-secondary statusOrder_{{ $order['dh_id'] }}">Chờ xác nhận</span></td>
											<td>
												<a href="" data-id="{{ $order['dh_id'] }}" class="detailOrder"><i class="fa fa-list" style="color : #14C11F; font-size: 25px;"></i></a>
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="tab-pane fade" id="success" >
						<table class="table table-striped" id="table-history">
							<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Tổng tiền</th>
								<th scope="col">Ghi chú</th>
								<th scope="col">Ngày đặt</th>
								<th scope="col">Trạng thái</th>
								<th scope="col">Hành động</th>
							</tr>
							</thead>
							<tbody>
								@foreach($user['order'] as $order)
									@if($order->dh_trangthai == 5)
										<tr class="order">
											<th scope="row">{{ $order['dh_id'] }}</th>
											<td>{{ $order['dh_madonhang'] }}</td>
											<td>{{ number_format($order['dh_tongtien'])}} VNĐ</td>
											<td>{{ $order['dh_ghichu'] ?? 'Không có ghi chú' }}</td>
											<td>{{ $order['dh_thoigiandathang'] }}</td>
											<td><span class="text-success statusOrder">Đã nhận hàng</span></td>
											<td>
												<a href="" data-id="{{ $order['dh_id'] }}" class="detailOrder"><i class="fa fa-list" style="color : #14C11F; font-size: 25px;"></i></a>
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="tab-pane fade" id="delete" >
						<table class="table table-striped" id="table-history">
							<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Tổng tiền</th>
								<th scope="col">Ghi chú</th>
								<th scope="col">Ngày đặt</th>
								<th scope="col">Trạng thái</th>
								<th scope="col">Hành động</th>
							</tr>
							</thead>
							<tbody>
								@foreach($user['order'] as $order)
									@if($order->dh_trangthai == 4)
										<tr class="order">
											<th scope="row">{{ $order['dh_id'] }}</th>
											<td>{{ $order['dh_madonhang'] }}</td>
											<td>{{ number_format($order['dh_tongtien'])}} VNĐ</td>
											<td>{{ $order['dh_ghichu'] ?? 'Không có ghi chú' }}</td>
											<td>{{ $order['dh_thoigiandathang'] }}</td>
											<td><span class="text-delete statusOrder">Đã hủy</span></td>
											
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div><!--/category-tab-->
            </div>

            
        </div>
    </div><!--/#contact-page-->
    <div class="modal fade" id="chitietdonhang" tabindex="-1">

    </div>

    <div class="modal fade" id="capnhatthongtin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>

    <div class="modal fade" id="theodoidonhang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>

    <div class="modal fade" id="addWishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
@endsection
