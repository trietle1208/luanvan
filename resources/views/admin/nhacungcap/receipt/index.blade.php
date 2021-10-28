@extends('admin.layout')

@section('title')
    Phiếu nhập hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH PHIẾU NHẬP HÀNG</h4>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table align-middle">
                            <tr>
                                <th>ID</th>
                                <th>Tên phiếu</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày duyệt</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody class="table-striped" >
                            @foreach($receipts as $receipt)
                                <tr>
                                    <th scope="row">{{ $receipt['pnh_id'] }}</th>
                                    <td>{{ $receipt['pnh_ten'] }}</td>

                                    <td>{{ number_format($receipt['pnh_tongcong']) }} VND</td>
                                    @if($receipt['pnh_trangthai'] == 0)
                                    <td class="text-danger">Chưa duyệt</td>
                                    <td class="text-danger">Chưa duyệt</td>
                                    <td>
                                        <a href="" data-id="{{ $receipt->pnh_id }}" class="btn btn-primary detail">Chi tiết</a>
                                        <a href="{{ route('sup.receipt.edit', ['id' => $receipt->pnh_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a href="" data-id="{{ $receipt->pnh_id }}" data-url="{{ route('sup.receipt.delete') }}" class="btn btn-danger deleteReceipt">Xóa</a>
                                    </td>
                                    @else
                                    <td class="text-success">Đã duyệt</td>
                                    <td class="text-success">{{ $receipt['pnh_ngayduyet'] }}</td>
                                    <td>
                                        <a href="" data-id="{{ $receipt->pnh_id }}" class="btn btn-primary detail">Chi tiết</a>
                                    </td>
                                    @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>
    <div class="modal fade" id="chitietphieu" tabindex="-1">

    </div>
@endsection
