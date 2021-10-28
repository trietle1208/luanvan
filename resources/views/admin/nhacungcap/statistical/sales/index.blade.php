@extends('admin.layout')

@section('title')
    Thống kê đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">THỐNG KÊ DOANH THU</h4>
                    
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card" id="tooltip-container">
                    <div class="card-body">
                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                        <h4 class="mt-0 font-16">Chi phí nhập hàng</h4>
                        <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ number_format($total_receipt) }}</span> VNĐ</h2>
                        <p class="text-muted mb-0">Total income: $22506 <span class="float-end"><i class="fa fa-caret-up text-success me-1"></i>10.25%</span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card" id="tooltip-container1">
                    <div class="card-body">
                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                        <h4 class="mt-0 font-16">Lợi nhuận</h4>
                        <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ number_format($total_sales) }}</span> VNĐ</h2>
                        <p class="text-muted mb-0"> 
                            <span class="float-end">
                                    @if($percent_sales > 1)
                                        <i class="fa fa-caret-up text-success me-1">

                                        </i>
                                        {{ round($percent_sales,3) }}%
                                    @else
                                        <i class="fa fa-caret-down text-danger me-1">

                                        </i>
                                        {{ round($percent_sales,3) }}%
                                    @endif
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card" id="tooltip-container3">
                    <div class="card-body">
                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                        <h4 class="mt-0 font-16">Tổng doanh thu</h4>
                        <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{ number_format($total_order) }}</span> VNĐ</h2>
                        <p class="text-muted mb-0">Total revenue: $1.2 M <span class="float-end"><i class="fa fa-caret-up text-success me-1"></i>17.48%</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
                      
@endsection
