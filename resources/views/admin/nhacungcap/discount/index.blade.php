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
                                <th>Tên khuyến mãi</th>
                                <th>Hinh ảnh khuyến mãi</th>
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

                                    @if( $discount['km_trangthai'] == 1)
                                        <td>
                                            <button class="btn btn-success changeStatusDiscountOff" style="display : block" data-type="1" data-id="{{ $discount->km_id }}" data-url="{{ route('sup.discount.changeStatus') }}">Hiển thị</button>
                                            <button class="btn btn-danger changeStatusDiscountShow" style="display : none" data-type="0" data-id="{{ $discount->km_id }}" data-url="{{ route('sup.discount.changeStatus') }}">Tắt</button>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-danger changeStatusDiscountShow" style="display : block" data-type="0" data-id="{{ $discount->km_id }}" data-url="{{ route('sup.discount.changeStatus') }}">Tắt</button>
                                            <button class="btn btn-success changeStatusDiscountOff" style="display : none" data-type="1" data-id="{{ $discount->km_id }}" data-url="{{ route('sup.discount.changeStatus') }}">Hiển thị</button>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="" data-id="{{ $discount->km_id }}" class="btn btn-primary product-discount">Chọn</a>
                                        <a href="{{ route('sup.discount.edit', ['id' => $discount->km_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a href="" class="btn btn-danger delete-discount" data-url="{{ route('sup.discount.delete', ['id' => $discount->km_id]) }}" >Xóa</a>
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
    <div class="modal fade" id="danhsachsp" tabindex="-1">

    </div>
@endsection
