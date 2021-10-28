@extends('admin.layout')

@section('title')
Phiếu nhập hàng
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM PHIẾU NHẬP HÀNG</h2>
            <form class="form-horizontal" action="{{ route('sup.receipt.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nhập tên phiếu nhập:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword3"
                               name="name"
                               placeholder="Nhập vào tên phiếu muốn tạo">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Chọn sản phẩm vào phiếu nhập :</label>
                    <div class="col-8 col-xl-9">
                        <button class="btn btn-success selectReceipt" data-id="{{ auth()->user()->ncc_id }}" data-url="{{ route('sup.receipt.select') }}">Danh sách sản phẩm</button>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Tổng tiền của phiếu:</label>
                    <div class="col-8 col-xl-9">
                        @if(Session::get('product'))
                            @php
                                $sum = 0;
                            @endphp
                            @foreach(Session::get('product') as $item)
                                @php
                                    $sum += $item['total'];
                                @endphp
                            @endforeach
                            <input type="text" class="form-control sum" id="inputPassword3"
                                   name="sum"
                                   value="{{ $sum }}"
                                   placeholder="Tổng số tiền của tất cả sản phẩm được chọn"
                                   readonly>
                        @else
                        <input type="text" class="form-control sum" id="inputPassword3"
                               name="sum"
                               placeholder="Tổng số tiền của tất cả sản phẩm được chọn"
                               readonly>
                        @endif


                    </div>
                </div>
                <div class="justify-content-end row">
                    <div class="col-8 col-xl-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Lưu</button>
                    </div>
                </div>
            </form>

        </div>  <!-- end card-body -->
    </div>  <!-- end card -->
</div>  <!-- end col -->
<div class="modal fade" id="danhsachsanpham">

</div>
@endsection
