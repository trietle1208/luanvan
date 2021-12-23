@extends('admin.layout')

@section('title')
    Thống kê sản phẩm
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">THỐNG KÊ SẢN PHẨM</h4>
                
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-4">
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
                                <h3 class="text-dark mt-1"><span data-plugin="">{{ $product->count() }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Sản phẩm</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-message-square font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin=""></span>{{ $comment->count() }}</h3>
                                <p class="text-muted mb-1 text-truncate">Bình luận</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
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
                                <h3 class="text-dark mt-1"><span data-plugin="">{{ $view->sum('view_count') }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Lượt truy cập</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center text-uppercase">Top 5 sản phẩm</h4>
                    <select class="form-control text-center selectTypeStatisticalProduct" data-url="{{ route('sup.product.fillGood') }}">
                        <option value="1" class="selected text-center">Bán chạy</option>
                        <option value="2">Lượt xem cao</option>
                        <option value="3">Yêu thích</option>
                        <option value="4">Rating cao</option>
                    </select>
                    <hr>
                    <div class="fillStatisticalProduct">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                <thead class="table-light">
                                    <tr>
                                        <th colspan="2">Hình ảnh</th>
                                        <th>Loại</th>
                                        <th>Bảo hành</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_sell as $product)
                                    <tr>
                                        <td style="width: 36px;">
                                            <img src="{{ $product->sp_hinhanh }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                        </td>

                                        <td>
                                            <h5 class="m-0 fw-normal">{{ $product->sp_ten }}</h5>
                                            <p class="mb-0 text-muted"><small>{{ $product->created_at->format('Y-m-d') }}</small></p>
                                        </td>
                                        <td>
                                        {{ $product->type->loaisp_ten }}
                                        </td>

                                        <td>
                                            {{ $product->sp_thoigianbaohanh }} tháng
                                        </td>
                                    </tr>  
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center text-uppercase">Các bình luận gần đây</h4>
                        
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                <thead class="table-light">
                                    <tr>
                                        <th colspan="2">Hình ảnh</th>
                                        <th>Người đăng tải</th>
                                        <th>Nội dung</th>
                                        <th>Số sao</th>
                                        <th>Ngày đăng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($comments as $comment)
                                    @if($comment['product'] != null &&  $comment['customer'] != null)
                                        <tr>
                                            <td style="width: 36px;">
                                                <img src="{{ $comment['product']['sp_hinhanh'] }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                            </td>

                                            <td>
                                                <h5 class="m-0 fw-normal">{{ $comment['product']['sp_ten'] }}</h5>
                                                <p class="mb-0 text-muted"><small>{{ $comment['product']['created_at']->format('Y-m-d') }}</small></p>
                                            </td>

                                            <td>
                                                {{ $comment['customer']['kh_hovaten'] }} VNĐ
                                            </td>

                                            <td>
                                            {{ $comment->bl_noidung }}
                                            </td>

                                            @if($comment->bl_sosao)
                                                <td style="color : #ffcc00; font-size : 20px">
                                                    @for($i = 0 ; $i < $comment->bl_sosao ; $i++)
                                                        &#9733;
                                                    @endfor
                                                </td>
                                            @else
                                                <td><strong class="text-primary">Bình luận phản hồi</strong></td>
                                            @endif

                                            <td>
                                                {{ $comment->created_at->format('Y-m-d') }}
                                            </td>
                                        </tr>
                                    @endif  
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center text-uppercase">Thống kê biểu đồ sản phẩm bán chạy</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="row" style="padding-bottom : 30px">
                                <div class="col-6">
                                    <h4>Thống kê theo ngày & tháng </h4>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="month" class="form-control month">
                                            <hr>
                                            <button class="btn btn-success fillProductByMonth" data-url="{{ route('sup.product.fillProductByMonth') }}">Lọc</button>
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
                                            <button class="btn btn-success fillProductByDate" data-url="{{ route('sup.product.fillProductByDate') }}">Lọc</button>
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
                                    <button class="btn btn-success fillProductBy3Month" data-url="{{ route('sup.product.fillProductBy3Month') }}">Lọc</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div id="" class="collapse pt-3 show">
                                <div id="chartProductSell" class="" 
                                    data-count="{{ $arr_product_qty }}"
                                    data-name="{{ $arr_product_name }}">
                                </div>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="fillTable">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                        <thead class="table-light">
                                            <tr>
                                                <th colspan="2">Hình ảnh</th>
                                                <th>Đã bán</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product_count as $product)
                                                <tr>
                                                    <td style="width: 36px;">
                                                        <img src="{{ $product->sp_hinhanh }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                    </td>

                                                    <td>
                                                        <h5 class="m-0 fw-normal">{{ $product->sp_ten }}</h5>
                                                    </td>

                                                    <td>
                                                        {{ $product['orderdetail_sum_soluong'] }} sản phẩm
                                                    </td>
                                                </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center text-uppercase">Thống kê biểu đồ doanh thu sản phẩm</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="row" style="padding-bottom : 30px">
                                <div class="col-6">
                                    <h4>Thống kê theo ngày & tháng </h4>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="month" class="form-control monthSales">
                                            <hr>
                                            <button class="btn btn-success fillProductSalesByMonth" data-url="{{ route('sup.product.fillProductSalesByMonth') }}">Lọc</button>
                                        </div>
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="date" class="form-control dateSalesStart">
                                                </div>
                                                <div class="col-6">
                                                    <input type="date" class="form-control dateSalesEnd">
                                                </div>
                                            </div>
                                            <hr>
                                            <button class="btn btn-success fillProductSalesByDate" data-url="{{ route('sup.product.fillProductSalesByDate') }}">Lọc</button>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="col-6">
                                <h4>Thống kê theo quý </h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <select class="form-control typeSales">
                                                <option value="1">Quý 1</option>
                                                <option value="2">Quý 2</option>
                                                <option value="3">Quý 3</option>
                                                <option value="4">Quý 4</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control yearSales" value="2021" min="2021">
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-success fillProductSalesBy3Month" data-url="{{ route('sup.product.fillProductSalesBy3Month') }}">Lọc</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="fillTableSales">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                        <thead class="table-light">
                                            <tr>
                                                <th colspan="2">Hình ảnh</th>
                                                <th>Lợi nhuận</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product_sales as $product)
                                                <tr>
                                                    <td style="width: 36px;">
                                                        <img src="{{ $product->sp_hinhanh }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                    </td>

                                                    <td>
                                                        <h5 class="m-0 fw-normal">{{ $product->sp_ten }}</h5>
                                                    </td>

                                                    <td>
                                                        {{ number_format($product['total']) }} VNĐ
                                                    </td>

                                                    
                                                </tr> 
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div id="" class="collapse pt-3 show">
                                <div id="chartProductSales" class="" 
                                    data-name="{{ $arr_product_name_sales }}"
                                    data-count="{{ $arr_product_sales }}"
                                >
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>   
</div>



<div class="modal fade" id="chitietsanpham" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>
@endsection
