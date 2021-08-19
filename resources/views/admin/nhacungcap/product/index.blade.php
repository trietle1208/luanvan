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
                    <?php
                    $message = Session::get('message');
                    if($message)
                    {
                        echo '<span class="text-primary">'.$message.'</span>';
                        Session::put('message',null);
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Hinh ảnh sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Giá bán ra</th>
                                <th>Số lượng</th>
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
                                    <td>{{ $product['sp_mota'] }}</td>
                                    <td>{{ number_format($product['sp_giabanra']) }} VNĐ</td>
                                    <td>{{ $product['sp_soluong'] }}</td>
                                    <td>{{ $product['sp_thoigianbaohanh'] }}</td>
                                    @if($product['sp_trangthai'] == 0)
                                    <td>Chưa duyệt</td>
                                    @else
                                    <td>Duyệt</td>
                                    @endif
                                    <td>
                                        <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#chitiet_{{ $product->sp_id }}">Chi tiết</a>
                                        <a href="{{ route('sup.product.edit', ['id' => $product->sp_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" href="{{ route('sup.product.delete', ['id' => $product->sp_id]) }}" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
        <div class="col-2">
            <a href="{{ route('admin.cate.hasdelete') }}" class="btn btn-blue">Đã xóa</a>
        </div>
    </div>
   @foreach($products as $product)
    <div class="modal fade" id="chitiet_{{ $product->sp_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="exampleModalLabel">Chi tiết thêm về sản phẩm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Thuộc danh mục</th>
                            <th scope="col">Thuộc thương hiệu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $product->cate->dm_ten }}</td>
                            <td>{{ $product->brand->th_ten }}</td>
                        </tr>

                        </tbody>
                    </table>

                    <table class="table">
                        <thead>
                        <tr>
                            @foreach($product->para as $para)
                            <th scope="col">{{ $para->ts_tenthongso }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($product->detail as $detail)
                            <td>{{ $detail->chitietthongso }}</td>
                            @endforeach
                        </tr>

                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
   @endforeach
@endsection
