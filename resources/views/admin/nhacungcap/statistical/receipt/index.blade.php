@extends('admin.layout')

@section('title')
    Thống kê đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">THỐNG KÊ PHIẾU NHẬP HÀNG</h4>
                    
                </div>
            </div> 
        </div>
        <div class="col-xl-6">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase19" role="button" aria-expanded="false" aria-controls="cardCollpase19"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <h4 class="header-title mb-0">Thống kê tình trạng phiếu nhập</h4>

                    <div id="" class="collapse pt-3 show">
                        <div id="chartStatusReceipt" class="" 
                            data-count="{{ $arr_count_receipt }}"
                            data-name="{{ $arr_name_receipt }}"
                            data-color="{{ $arr_color_receipt }}"
                        ></div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <!-- Portlet card -->
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase19" role="button" aria-expanded="false" aria-controls="cardCollpase19"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <h4 class="header-title mb-0">Thống kê chi phí nhập hàng</h4>

                    <div id="" class="collapse pt-3 show">
                        <div id="chartTotalOrder" class="" 
                            data-count="{{ $arr_count_total_receipt }}"
                            data-name="{{ $arr_name_total_receipt }}"
                            data-color="{{ $arr_color_total_receipt }}"
                        ></div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-bs-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false" aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <!-- <h4 class="header-title mb-0 pb-20">Thống kê đơn hàng trong năm</h4> -->
                    <div class="row">
                        <div class="col-4">
                            <h4>Thống kê theo ngày & tháng </h4>
                            <div class="row">
                                <div class="col-6">
                                    <input type="month" class="form-control valMonth">
                                    <hr>
                                    <button class="btn btn-success fillByMonth" data-url="{{ route('sup.receipt.fillReceiptByMonth') }}">Lọc</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <h4>Thống kê theo quý </h4>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control type">
                                        <option value="1">Quý 1</option>
                                        <option value="2">Quý 2</option>
                                        <option value="3">Quý 3</option>
                                        <option value="4">Quý 4</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control valYear" value="2021" min="2021">
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-success fillBy3Month" data-url="{{ route('sup.receipt.fillReceiptBy3Month') }}">Lọc</button>
                        </div>
                        <div class="col-4 resultReceiptByMonth" style="display : none">
                            <h4>Kết quả thống kê</h4>
                            <strong class="text-success">Đã duyệt : </strong><p class="resultReceiptByMonthSuccess"></p>
                            <strong class="text-danger">Chưa duyệt : </strong><p class="resultReceiptByMonthDelete"></p>
                            <strong class="">Tổng chi phí : </strong><p class="resultTotalReceiptByMonthDelete"></p>
                        </div>
                    </div>

                    
                    <div id="cardCollpase5" class="collapse pt-3 show">
                        <div id="chartReceiptByMonth" 
                            data-delete="{{ $arr_count_receipt_delete  }}"
                            data-success="{{ $arr_count_receipt_success }}"
                            data-total="{{ $arr_count_total_receipt_success }}"
                        ></div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col--> 
    </div>
                      
@endsection
