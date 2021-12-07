@extends('admin.layout')

@section('title')
    Thống kê doanh thu
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
                        <h2 class="text-primary my-3 text-center"><span data-plugin="counterup" class="total_receipt">{{ number_format($total_receipt) }}</span> VNĐ</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card" id="tooltip-container1">
                    <div class="card-body">
                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                        <h4 class="mt-0 font-16">Lợi nhuận</h4>
                        <h2 class="text-primary my-3 text-center"><span data-plugin="counterup" class="total_sales">{{ number_format($total_sales) }}</span> VNĐ</h2>
                        <!-- <p class="text-muted mb-0"> 
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
                        </p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card" id="tooltip-container3">
                    <div class="card-body">
                        <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                        <h4 class="mt-0 font-16">Tổng doanh thu</h4>
                        <h2 class="text-primary my-3 text-center"><span data-plugin="counterup" class="total_order">{{ number_format($total_order) }}</span> VNĐ</h2>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-xl-12">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase19" role="button" aria-expanded="false" aria-controls="cardCollpase19"><i class="mdi mdi-minus"></i></a>
                    </div>
                        <div class="row">
                            <div class="col-6">
                                <h4>Thống kê theo ngày & tháng </h4>
                                <div class="row">
                                    <div class="col-4">
                                        <input type="month" class="form-control col-4 valMonth" placeholder="">
                                        <hr>
                                        <button class="btn btn-success fillByMonth" data-url="{{ route('sup.sales.fillByMonth') }}">Lọc</button>
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="date" class="form-control col-4 valDateStart" placeholder="">
                                            </div>
                                            <div class="col-6">
                                                <input type="date" class="form-control col-4 valDateEnd" placeholder="">
                                            </div>
                                        </div>
                                        <hr>
                                        <button class="btn btn-success fillByDate" data-url="{{ route('sup.sales.fillByDate') }}">Lọc</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h4>Thống kê theo quý </h4>
                                <div class="row">
                                    <div class="col-6">
                                        <select class="form-control typeOption">
                                            <option value="1">Quý 1</option>
                                            <option value="2">Quý 2</option>
                                            <option value="3">Quý 3</option>
                                            <option value="4">Quý 4</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control col-4 valYear" value="2021" placeholder="" min="2021" max="3000">
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-success fillBy3Month" data-url="{{ route('sup.sales.fillBy3Month') }}">Lọc</button>
                            </div>
                            <div id="" class="collapse pt-3 show">
                                        <div id="chartTotalSales" class="" 
                                        data-order="{{ $arr_order }}"
                                        data-receipt="{{ $arr_receipt }}"
                                        data-sales="{{ $arr_sales }}"
                                        data-month="{{ $arr_month }}">
                            </div>
                        </div>
        

                    
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
                      
@endsection
