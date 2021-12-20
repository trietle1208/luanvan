@extends('admin.layout')

@section('title')
Sản phẩm
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">DANH SÁCH SẢN PHẨM</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                        <thead class="table-light" >
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Hinh ảnh sản phẩm</th>
                                {{-- <th>Mô tả</th>--}}
                                <!-- <th>Giá bán ra</th> -->
                                <th>Thời gian bảo hành</th>
                                <th>Trang thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $product['sp_id'] }}</th>
                                <td>{{ $product['sp_ten'] }}</td>
                                <td>
                                    <img src="{{ $product['sp_hinhanh'] }}" style="width: 180px ; height: 120px">
                                </td>
                                {{-- <td>{{ $product['sp_mota'] }}</td>--}}
                                <!-- <td>{{ number_format($product['sp_giabanra']) }} VNĐ</td> -->
                                <td>{{ $product['sp_thoigianbaohanh'] }}</td>
                                @if($product['sp_trangthai'] == 0)
                                <td>Chưa duyệt</td>
                                @else
                                <td>Duyệt</td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                       Tùy chọn
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" >
                                        <li>
                                            <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#chitiet_{{ $product->sp_id }}">Chi tiết</a>
                                        </li>
                                        <li>
                                            @can('Chỉnh sửa sản phẩm')
                                            <a href="{{ route('sup.product.edit', ['id' => $product->sp_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                            @endcan
                                        </li>
                                        <li>
                                            @can('Xóa sản phẩm')
                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" href="{{ route('sup.product.delete', ['id' => $product->sp_id]) }}" class="btn btn-danger">Xóa</a>
                                            @endcan
                                        </li>
                                    </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
@foreach($products as $product)
<div class="modal fade" id="chitiet_{{ $product->sp_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="exampleModalLabel">Chi tiết sản phẩm</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <p><strong>Thuộc danh mục : </strong>{{ $product->cate->dm_ten }}</p>
                        <p><strong>Thuộc thương hiệu : </strong>{{ $product->brand->th_ten }}</p>
                        <p><strong>Thời gian bảo hành : </strong>{{ $product->sp_thoigianbaohanh }} tháng</p>
                        <!-- <p><strong>Giá : </strong>{{ number_format($product->sp_giabanra) }} VNĐ</p> -->
                        <img src="{{ $product->sp_hinhanh }}" class="img-fuild" style="width:150px ; height:150px">
                    </div>
                    <div class="col-6">
                        @foreach($product->para as $para)
                            @foreach($product->detail as $detail)
                                @if($para->ts_id == $detail->ts_id)
                                <p><strong>{{ $para->ts_tenthongso }} : </strong>{{ $detail->chitietthongso }}</p>
                                <hr>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection