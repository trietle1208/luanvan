@extends('admin.layout')

@section('title')
    Thống kê đơn hàng
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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count_product }}</span></h3>
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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup"></span>{{ $count_comment }}</h3>
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
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count_view }}</span></h3>
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
                                        <th>Giá</th>
                                        <th>Loại</th>
                                        <th>Bảo hành</th>
                                        <th>Action</th>
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
                                            <p class="mb-0 text-muted"><small>{{ $product->created_at }}</small></p>
                                        </td>

                                        <td>
                                            {{ number_format($product->sp_giabanra) }} VNĐ
                                        </td>

                                        <td>
                                        {{ $product->type->loaisp_ten }}
                                        </td>

                                        <td>
                                            {{ $product->sp_thoigianbaohanh }} tháng
                                        </td>

                                        <td>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-minus"></i></a>
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

        
    </div>  
</div>
@endsection
