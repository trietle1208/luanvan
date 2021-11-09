
   <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-end mb-0">
                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>
                       
                        <!-- <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-bell noti-icon"></i>
                                @if(isset($count))
                                    @if($count!=0)
                                    <span class="badge bg-danger rounded-circle noti-icon-badge count_order_notify">{{ $count }}</span>
                                    @endif
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                            <span class="float-end">
                            </span>Thông báo
                                    </h5>
                                </div>
                                @if(isset($comments_0))
                                <div class="noti-scroll" data-simplebar>
                                    @foreach($comments_0 as $item)
                                        <div class="notify-comment_{{ $item->bl_id }}">
                                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                                <div class="notify-icon">
                                                    <img src="{{ $item->product->sp_hinhanh  }}" class="img-fluid rounded-circle" alt="" />
                                                </div>
                                                <p class="notify-details"><strong>Người đăng tải :</strong> {{ $item->customer->kh_hovaten }}</p>
                                                <p class="notify-details"><strong>Nội dung :</strong> {{ $item->bl_noidung }} </p>
                                                <p style="color : #ffcc00; font-size : 15px" class="notify-details"><strong>Sao đánh giá :</strong> 
                                                @for($i = 0 ; $i < $item->bl_sosao ; $i++)
                                                    &#9733;
                                                @endfor 
                                                </p>
                                                <p class="text-muted mb-0 user-msg">
                                                    <small>{{ $item->created_at }}</small>
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                @endif

                                @if(isset($orders_0))
                                <div class="noti-scroll" data-simplebar>
                                    @foreach($orders_0 as $item)
                                        <div class="notify-order_{{ $item->dhncc_id }}">
                                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                                <div class="notify-icon">
                                                    <img src="{{ $item->orderAdmin->address->customer->kh_hinhanh ?? asset('assets/images/avt_null.jpg') }}" class="img-fluid rounded-circle" alt="" />
                                                </div>
                                                <p class="notify-details"><strong>Khách hàng :</strong> {{ $item->orderAdmin->address->customer->kh_hovaten }}</p>
                                                <p class="notify-details"><strong>Ghi chú :</strong> {{ $item->orderAdmin->dh_ghichu ?? 'Không có ghi chú' }} </p>
                                                </p>
                                                <p class="notify-details"><strong>Tổng tiền :</strong> {{ number_format($item->tongtien) }} VNĐ</p>
                                                </p>
                                                <p class="text-muted mb-0 user-msg">
                                                    <small>{{ $item->created_at }}</small>
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                               

                            </div>
                        </li> -->
                        <li class="dropdown notification-list topbar-dropdown" id="notification-list">
                        </li>
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                     <i class="mdi mdi-chevron-down"></i>
                                </span>
                                {{ Auth::user()->name ?? '' }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Xin chào !</h6>
                                </div>

                                <!-- item-->
                                <a href="{{ route('sup.account.index') }}" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>Thông tin cá nhân</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings"></i>
                                    <span>Cài đặt</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock"></i>
                                    <span>Khóa màn hình</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="{{ route('home') }}" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="20">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>

                        <a href="{{ route('home') }}" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="20">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
<!-- end Topbar -->
