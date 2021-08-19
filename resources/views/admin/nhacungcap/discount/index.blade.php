@extends('admin.layout')

@section('title')
    Khuyến mãi
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH KHUYẾN MÃI</h4>
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
                                <th>Tên thương hiệu</th>
                                <th>Hinh ảnh thương hiệu</th>
                                <th>Mô tả</th>
                                <th>Hình thức</th>
                                <th>Giảm giá</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discounts as $discount)
                                <tr>
                                    <th scope="row">{{ $discount['km_id'] }}</th>
                                    <td>{{ $discount['km_ten'] }}</td>
                                    <td>
                                        <img src="{{ $discount['km_hinhanh'] }}" style="width: 180px ; height: 120px">
                                    </td>
                                    <td>{{ $discount['km_mota'] }}</td>
                                    @if( $discount['km_hinhthuc'] == 0)
                                    <td>Giảm giá theo tiền</td>
                                    <td>{{ number_format($discount['km_giamgia']) }} VNĐ</td>
                                    @else
                                    <td>Giảm giá theo %</td>
                                    <td>{{ $discount['km_giamgia'] }} %</td>
                                    @endif

                                    @if( $discount['km_trangthai'] == 0)
                                    <td>Tắt</td>
                                    @else
                                    <td>Hiển thị</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('sup.discount.edit', ['id' => $discount->km_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa khuyến mãi này không?')" href="{{ route('sup.discount.delete', ['id' => $discount->km_id]) }}" class="btn btn-danger">Xóa</a>
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

@endsection