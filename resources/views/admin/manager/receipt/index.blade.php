@extends('admin.layout')

@section('title')
    Phiếu nhập
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH PHIẾU NHẬP</h4>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên phiếu nhập</th>
                                <th>Tổng số tiền</th>
                                <th>Người lập phiếu</th>
                                <th>Ngày tạo phiếu</th>
                                <th>Nhà cung cấp</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($receipts as $receipt)
                                <tr>
                                    <th scope="row">{{ $receipt['pnh_id'] }}</th>
                                    <td>{{ $receipt['pnh_ten'] }}</td>
                                    <td>{{ $receipt['pnh_tongcong'] }} VND</td>
                                    <td>{{ $receipt->userNhap->name }}</td>
                                    <td>{{ $receipt['created_at'] }}</td>
                                    <td>{{ $receipt->ncc->ncc_ten }}</td>
                                    @if($receipt['pnh_trangthai'] == 0)
                                        <td>
                                            <button class="btn btn-primary detail" data-id= "{{ $receipt->pnh_id }}">Chi tiết</button>

                                            <button class="btn btn-info changeReceipt" data-id= "{{ $receipt->pnh_id }}">Duyệt</button>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-primary detail" data-id= "{{ $receipt->pnh_id }}">Chi tiết</button>

                                            <a href="" class="btn btn-success disabled">Đã duyệt</a>
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
