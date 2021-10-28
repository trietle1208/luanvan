@extends('admin.layout')

@section('title')
Trang chủ
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Trang quản trị</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
    <div class="row">
        <div class="col-md-6 col-xl-3">
        <a href="{{ route('sup.order.list') }}">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fe-truck font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count_order }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Đơn hàng</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
            </a>
        </div> <!-- end col-->
       
        <div class="col-md-6 col-xl-6">
        <a href="{{ route('sup.order.list') }}">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ number_format($total_order) }}</span>VNĐ</h3>
                                <p class="text-muted mb-1 text-truncate">Doanh thu</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </a>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
        <a href="{{ route('sup.order.list') }}">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <i class="fe-eye font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">78.41</span>k</h3>
                                <p class="text-muted mb-1 text-truncate">Lượt truy cập</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </a>
        </div> <!-- end col-->
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3">
        <a href="{{ route('sup.product.list') }}">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-box font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count_product }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Sản phẩm</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </a>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
        <a href="{{ route('sup.receipt.list') }}">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fe-clipboard font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count_receipt }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Phiếu nhập</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </a>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
        <a href="{{ route('sup.voucher.list') }}">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-gift font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count_voucher }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Khuyến mãi</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </a>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
        <a href="{{ route('sup.account.list') }}">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <i class="fe-user font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count_account }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Tài khoản</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </a>
        </div> <!-- end col-->
    </div>
@endsection