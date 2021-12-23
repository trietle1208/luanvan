<a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
    <i class="fe-bell noti-icon"></i>
    @if($notifications->count() > 0)
        <span class="badge bg-danger rounded-circle noti-icon-badge">
            {{ $notifications->count() }}
        </span>
    @endif
</a>
<div class="dropdown-menu dropdown-menu-end dropdown-lg">

    <!-- item-->
    <div class="dropdown-item noti-title">
        <h5 class="m-0">
            <span class="float-end">
                <a href="" class="text-dark">
                    <small>Đã xem tất cả</small>
                </a>
            </span>Thông Báo
        </h5>
    </div>

    <div class="noti-scroll" data-simplebar>
        @foreach ($notifications as $notification)
            @if($notification->type == 'App\Notifications\OrderNotification')
                <a href="{{ route('seen.notitication',['id' => $notification->id ]) }}" class="dropdown-item notify-item active">
                    <div class="notify-icon">
                        <img src="{{ $notification['data']['order']['address']['customer']['kh_hinhanh'] ?? asset('assets/images/avt_null.jpg') }}" class="img-fluid rounded-circle" alt="" /> 
                    </div>
                    <p class="notify-details"><strong>Mã đơn hàng</strong> : {{ $notification['data']['order']['dh_madonhang'] }}</p>
                    <p class="notify-details"><strong>Khách hàng</strong> : {{ $notification['data']['order']['address']['customer']['kh_hovaten'] }}</p>
                    <p class="notify-details"><strong>Tổng tiền</strong> : {{ number_format($notification['data']['order']['dh_tongtien']) }} VNĐ</p>
                    <p class="text-muted mb-0 user-msg">
                        <small>Ngày đặt : {{ $notification['data']['order']['dh_thoigiandathang'] }}</small>
                    </p>
                </a>
            @elseif($notification->type == 'App\Notifications\OrderNCCNotification')
                <a href="{{ route('seen.notitication',['id' => $notification->id ]) }}" class="dropdown-item notify-item active">
                    <div class="notify-icon">
                    <img src="{{ $notification['data']['order']['order_admin']['address']['customer']['kh_hinhanh'] ?? asset('assets/images/avt_null.jpg') }}" class="img-fluid rounded-circle" alt="" /> 
                    </div>
                    <p class="notify-details"><strong>Mã đơn hàng</strong> : {{ $notification['data']['order']['order_admin']['dh_madonhang'] }}</p>
                    <p class="notify-details"><strong>Khách hàng</strong> : {{ $notification['data']['order']['order_admin']['address']['customer']['kh_hovaten'] }}</p>
                    <p class="notify-details"><strong>Tổng tiền</strong> : {{ number_format($notification['data']['order']['tongtien']) }} VNĐ</p>
                    <p class="text-muted mb-0 user-msg">
                        <small>Ngày đặt : {{ $notification['data']['order']['order_admin']['dh_thoigiandathang'] }}</small>
                    </p>
                </a>
            @elseif($notification->type == 'App\Notifications\ShipperNotification')
                <a href="{{ route('seen.notitication',['id' => $notification->id ]) }}" class="dropdown-item notify-item active">
                    <div class="notify-icon">
                    <img src="{{ $notification['data']['order']['address']['customer']['kh_hinhanh'] ?? asset('assets/images/avt_null.jpg') }}" class="img-fluid rounded-circle" alt="" /> 
                    </div>
                    <p class="notify-details"><strong>Mã đơn hàng</strong> : {{ $notification['data']['order']['dh_madonhang'] }}</p>
                    <p class="notify-details"><strong>Khách hàng</strong> : {{ $notification['data']['order']['address']['customer']['kh_hovaten'] }}</p>
                    <p class="notify-details"><strong>Địa chỉ</strong> : {{ $notification['data']['order']['address']['dc_sonha'] }}</p>
                    <p class="notify-details"><strong>Tổng tiền</strong> : {{ number_format($notification['data']['order']['dh_tongtien']) }} VNĐ</p>
                    <p class="text-muted mb-0 user-msg">
                        <small>Ngày đặt : {{ $notification['data']['order']['dh_thoigiandathang'] }}</small>
                    </p>
                </a>
            
            @else
                <a href="{{ route('seen.notitication',['id' => $notification->id ]) }}" class="dropdown-item notify-item active">
                    <div class="notify-icon">
                        <img src="{{ $notification['data']['comment']['product']['sp_hinhanh'] }}" class="img-fluid rounded-circle" alt="" /> 
                    </div>
                    <p class="notify-details"><strong>Người đằng tải</strong> : {{ $notification['data']['comment']['customer']['kh_hovaten'] }}</p>
                    <p class="notify-details"><strong>Nội dung</strong> : {{ $notification['data']['comment']['bl_noidung'] }}</p>
                    <p style="color : #ffcc00; font-size : 15px" class="notify-details"><strong>Sao đánh giá :</strong> 
                    @for($i = 0 ; $i < $notification['data']['comment']['bl_sosao'] ; $i++)
                        &#9733;
                    @endfor 
                    </p>
                    <p class="text-muted mb-0 user-msg">
                        <small>Ngày đăng tải : {{ $notification['data']['comment']['created_at'] }}</small>
                    </p>
                </a>
            @endif
        @endforeach
        
    </div>

    <!-- All-->
    

</div>