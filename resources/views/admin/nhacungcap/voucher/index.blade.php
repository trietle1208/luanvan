@extends('admin.layout')

@section('title')
Mã giảm giá
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">DANH SÁCH MÃ GIẢM GIÁ</h4>
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
                            <th>Tên mã</th>
                            <th>Mã code</th>
                            <th>Mô tả</th>
                            <th>Điều kiện</th>
                            <th>Hình thức</th>
                            <th>Số lượng</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vouchers as $voucher)
                        <tr>
                            <th scope="row">{{ $voucher['mgg_id'] }}</th>
                            <td>{{ $voucher['mgg_ten'] }}</td>
                            <td>{{ $voucher['mgg_macode'] }}</td>
                            <td>{{ $voucher['mgg_mota'] }}</td>
                            <td>{{ $voucher['mgg_dieukien'] }}</td>
                            @if($voucher['mgg_hinhthuc'] == 0)
                            <td>Giảm theo số tiền</td>
                            @else
                            <td>Giảm theo %</td>
                            @endif
                            <td>{{ $voucher['mgg_soluong'] }}</td>
                            <td>
                                <a href="{{ route('sup.voucher.edit',['id' => $voucher->mgg_id ]) }}" class="btn btn-info">Chỉnh sửa</a>
                                <a href="" class="btn btn-danger delete-type">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
{{--        {{ $types->links() }}--}}
    </div> <!-- end col -->

</div>
<div class="modal fade" id="chitietthongso" tabindex="-1">

</div>
@endsection
