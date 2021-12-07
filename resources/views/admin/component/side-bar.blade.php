<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="../assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            @if(auth()->user()->loaitaikhoan == 0)
            <ul id="side-menu">
                <li>
                    <a href="#sidebarLayouts" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Quản Lý Tài Khoản </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.account.create_shipper') }}">Thêm tài khoản shipper</a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.account.list') }}">Danh sách tài khoản</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="list"></i>
                        <span> Quản Lý Danh Mục</span>
                        <span class="menu-arrow"></span>

                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.cate.create') }}">Thêm danh mục</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.cate.list') }}">Danh sách danh mục</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarMultilevel" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Quản Lý Bài Viết </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMultilevel">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sidebarMultilevel2" data-bs-toggle="collapse">
                                    Danh mục bài viết <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel2">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.cate_posts.create') }}">Thêm danh mục</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.cate_posts.list') }}">Danh sách danh mục</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarMultilevel2" data-bs-toggle="collapse">
                                    Bài viết <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel2">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('admin.posts.create') }}">Thêm bài viết</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.posts.list') }}">Danh sách bài viết</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i data-feather="flag"></i>
                        <span> Quản Lý Thương Hiệu </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.brand.create') }}">Thêm thương hiệu</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.brand.list') }}">Danh sách thương hiệu</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                        <i data-feather="grid"></i>
                        <span> Quản Lý Slide </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.slide.create') }}">Thêm Slide</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.slide.list') }}">Danh sách Slide</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="server"></i>
                        <span> Quản Lý Hình Thức </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('admin.ship.create') }}">Thêm hình thức</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ship.list') }}">Danh sách hình thức</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li>
                    <a href="#sidebarMaps" data-bs-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Quản Lý Phí Vận Chuyển </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.cost.list') }}">Danh sách thành phố</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <a href="#sidebarCharts" data-bs-toggle="collapse">
                        <i data-feather="user-check"></i>
                        <span> Quản Lý Phân Quyền </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCharts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.role.list') }}">Danh sách vai trò</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.role.create') }}">Thêm vai trò</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.permission.list') }}">Danh sách quyền</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.permission.create') }}">Thêm quyền</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarProjects" data-bs-toggle="collapse">
                        <i data-feather="info"></i>
                        <span>Quản Lý Loại/Thông Số</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProjects">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.type.create') }}">Thêm loại sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.type.list') }}">Danh sách loại sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.para.create') }}">Thêm thông số sản phẩm</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTasks" data-bs-toggle="collapse">
                        <i data-feather="clipboard"></i>
                        <span> Quản Lý Phiếu Nhập </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTasks">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.receipt.list') }}">Danh sách phiếu nhập</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTables" data-bs-toggle="collapse">
                        <i data-feather="truck"></i>
                        <span> Quản Lý Đơn Hàng</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTables">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.order.list') }}">Danh sách đơn hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarMaps" data-bs-toggle="collapse">
                        <i data-feather="bar-chart"></i>
                        <span> Thống kê </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.statistical.list') }}">Thống kê đơn hàng</a>
                            </li>
                            

                        </ul>
                    </div>
                </li>
            </ul>
            @else
            @if(auth()->user()->email_verified_at != null && auth()->user()->loaitaikhoan != 2)
            <ul id="side-menu">
            @hasanyrole('Admin nhà cung cấp')
                <li>
                    <a href="#sidebarIcons" data-bs-toggle="collapse">
                        <i data-feather="bar-chart"></i>
                        <span> Thống kê </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarIcons">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('sup.receipt.statistical') }}">Thống kê nhập hàng</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.order.statistical') }}">Thống kê đơn hàng</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.sales.statistical') }}">Thống kê doanh thu</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.product.statistical') }}">Thống kê sản phẩm</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endhasanyrole
                @hasanyrole('Quản Lý Sản Phẩm|Admin nhà cung cấp')
                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="box"></i>
                        <span> Quản Lý Sản Phẩm </span>
                        <span class="menu-arrow"></span>

                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('sup.product.create') }}">Thêm sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.product.list') }}">Danh sách sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.product.listComment')}}">Danh sách bình luận</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endhasanyrole
                @hasanyrole('Quản Lý Khuyến Mãi|Admin nhà cung cấp')
                <li>
                    <a href="#sidebarLayouts" data-bs-toggle="collapse">
                        <i data-feather="gift"></i>
                        <span> Quản Lý Khuyến Mãi </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('sup.discount.create') }}">Thêm khuyến mãi</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.discount.list') }}">Danh sách khuyến mãi</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endhasanyrole
                @hasanyrole('Quản Lý Kho|Admin nhà cung cấp')
                <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                        <i data-feather="clipboard"></i>
                        <span> Quản Lý Phiếu Nhập </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('sup.receipt.create') }}">Thêm phiếu nhập</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.receipt.list') }}">Danh sách phiếu nhập</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endhasanyrole
                @hasanyrole('Quản Lý Khuyến Mãi|Admin nhà cung cấp')
                <li>
                    <a href="#sidebarTickets" data-bs-toggle="collapse">
                        <i data-feather="gift"></i>
                        <span> Quản Lý Mã Giảm Giá </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTickets">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('sup.voucher.create') }}">Thêm mã giảm</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.voucher.list') }}">Danh sách mã giảm</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endhasanyrole
                
                <li>
                    <a href="#sidebarTables" data-bs-toggle="collapse">
                        <i data-feather="truck"></i>
                        <span> Quản Lý Đơn Hàng </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTables">
                        <ul class="nav-second-level">
                            @hasanyrole('Quản Lý Đơn Hàng|Admin nhà cung cấp')
                            <li>
                                <a href="{{ route('sup.order.list') }}">Danh sách đơn hàng</a>
                            </li>
                            @endhasanyrole
                            @hasrole('Quản Lý Giao Hàng')
                            <li>
                                <a href="{{ route('sup.order.listOrderShipper') }}">Danh sách giao hàng</a>
                            </li>
                            @endhasrole
                        </ul>
                    </div>
                </li>
                
                @hasanyrole('Quản Lý Tài Khoản|Admin nhà cung cấp')
                <li>
                    <a href="#sidebarMaps" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Quản Lý Tài Khoản </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('sup.account.create') }}">Thêm tài khoản</a>
                            </li>
                            <li>
                                <a href="{{ route('sup.account.list') }}">Danh sách tài khoản</a>
                            </li>

                        </ul>
                    </div>
                </li>
                @endhasanyrole
            </ul>
            @elseif(auth()->user()->loaitaikhoan == 2)
            <ul>
                <li>
                    <a href="#sidebarTables" data-bs-toggle="collapse">
                        <i data-feather="grid"></i>
                        <span> Quản Lý Đơn Hàng </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTables">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.order.listOrderShipper') }}">Danh sách giao hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            @else
            <ul id="side-menu">

                <li class=>
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Kích hoạt tài khoản ngay !!!') }}</button>.
                    </form>
                </li>

            </ul>
            @endif
            @endif
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>