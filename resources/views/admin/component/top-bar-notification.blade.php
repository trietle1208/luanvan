<a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
    <i class="fe-bell noti-icon"></i>
    <span class="badge bg-danger rounded-circle noti-icon-badge">{{ $notifications->count() }}</span>
</a>
<div class="dropdown-menu dropdown-menu-end dropdown-lg">

    <!-- item-->
    <div class="dropdown-item noti-title">
        <h5 class="m-0">
            <span class="float-end">
                <a href="" class="text-dark">
                    <small>Đã xem tất cả</small>
                </a>
            </span>Thông bBáo Đơn Hàng
        </h5>
    </div>

    <div class="noti-scroll" data-simplebar>
        @foreach ($notifications as $notification)
            <a href="{{ route('seen.notitication',['id' => $notification->id ]) }}" class="dropdown-item notify-item active">
                <div class="notify-icon">
                    <img src="../assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" /> 
                </div>
                <p class="notify-details"><strong>Mã đơn hàng</strong> : {{ $notification['data']['order']['dh_madonhang'] }}</p>
                <p class="notify-details"><strong>Khách hàng</strong> : {{ $notification['data']['order']['address']['customer']['kh_hovaten'] }}</p>
                <p class="notify-details"><strong>Tổng tiền</strong> : {{ number_format($notification['data']['order']['dh_tongtien']) }} VNĐ</p>
                <p class="text-muted mb-0 user-msg">
                    <small>Ngày đặt : {{ $notification['data']['order']['dh_thoigiandathang'] }}</small>
                </p>
            </a> 
        @endforeach
        
    </div>

    <!-- All-->
    

</div>