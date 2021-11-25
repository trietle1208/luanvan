@extends('admin.layout')

@section('title')
    Thống kê đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">THỐNG KÊ ĐƠN HÀNG</h4>
                    
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
                    <h4 class="header-title mb-0">Thống kê tình trạng đơn hàng</h4>

                    <div id="" class="collapse pt-3 show">
                        <div id="chartAdminStatusOrder" class="" 
                            data-count="{{ $arr_count_order }}"
                            data-name="{{ $arr_name_order }}"
                            data-color="{{ $arr_color_order }}"
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
                    <h4 class="header-title mb-0">Thống kê tình trạng thanh toán đơn hàng</h4>

                    <div id="" class="collapse pt-3 show">
                        <div id="chartAdminTotalOrder" class=""
                        data-count="{{ $arr_count_type_order }}"
                        data-name="{{ $arr_name_type_order }}"
                        data-color="{{ $arr_color_type_order }}" 
                        >
                        </div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
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
                        <div class="col-6">
                            <h4>Thống kê theo tháng</h4>
                            <div class="row">
                                <div class="col-4">
                                    <input type="month" class="form-control month">
                                    <hr>
                                    <button class="btn btn-success fillAdminOrderByMonth" data-url="{{ route('admin.statistical.fillOrderByMonth') }}">Lọc</button>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="date" class="form-control dateStart">
                                        </div>
                                        <div class="col-6">
                                            <input type="date" class="form-control dateEnd">
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-success fillAdminOrderByDate" data-url="{{ route('admin.statistical.fillOrderByDate') }}">Lọc</button>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-6">
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
                                    <input type="number" class="form-control year" value="2021" min="2021">
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-success fillAdminOrderBy3Month" data-url="{{ route('admin.statistical.fillOrderBy3Month') }}">Lọc</button>
                        </div>
                        <div class="col-2 resultOrderByMonth" style="display : none">
                            <h4>Kết quả thống kê</h4>
                            <strong class="text-success">Hoàn thành : </strong><p class="resultOrderByMonthSuccess"></p>
                            <strong class="text-danger">Đã hủy : </strong><p class="resultOrderByMonthDelete"></p>
                        </div>
                    </div>

                    
                    <div id="cardCollpase5" class="collapse pt-3 show">
                        <div id="chartAdminOrderByMonth" 
                            data-new="{{ $arr_count_new_month_order }}"
                            data-check="{{ $arr_count_check_month_order }}"
                            data-delete="{{ $arr_count_delete_month_order }}"
                            data-ship="{{ $arr_count_ship_month_order }}"
                            data-confirm="{{ $arr_count_confirm_month_order }}"
                            data-success="{{ $arr_count_success_month_order }}"
                        ></div>
                    </div> <!-- collapsed end -->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
                      
@endsection
