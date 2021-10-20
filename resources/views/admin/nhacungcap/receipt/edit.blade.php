@extends('admin.layout')

@section('title')
    Phiếu nhập hàng
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">CẬP NHẬT PHIẾU NHẬP HÀNG</h2>
                <?php
                $message = Session::get('message');
                if($message)
                {
                    echo '<span class="text-primary">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <form class="form-horizontal" action="{{ route('sup.receipt.update',['id' => $receipt->pnh_id]) }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập tên phiếu nhập: </label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   value="{{ $receipt->pnh_ten }}"
                                   placeholder="Nhập vào tên phiếu nhập muốn tạo">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Danh sách sản phẩm trong phiếu: </label>
                        <div class="col-8 col-xl-9">
                            <button class="btn btn-success listProductReceipt" data-id="{{ $receipt->pnh_id }}" data-url="{{ route('sup.receipt.listProductReceipt') }}">Danh sách sản phẩm</button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Tổng tiền của phiếu: </label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control sum_after_update" id="inputPassword5"
                                   readonly
                                   value="{{ $receipt->pnh_tongcong }}"
                                   placeholder="Nhập vào mô tả của loại">
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-8 col-xl-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Cập nhật</button>
                        </div>
                    </div>
                </form>

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>  <!-- end col -->
    <div class="modal fade" id="chitietdanhsach" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
@endsection
