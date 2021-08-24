@extends('admin.layout')

@section('title')
Phiếu nhập hàng
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM PHIẾU NHẬP HÀNG</h2>
            <?php
            $message = Session::get('message');
            if($message)
            {
                echo '<span class="text-primary">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
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
                    <label class="col-4 col-xl-3 col-form-label">Chọn các sản phẩm cho phiếu:</label>
                    <div class="col-8 col-xl-9">
                        <select class="form-select select-cate"  name="type">
                            <option value="">--- Tìm theo danh mục ---</option>
                            @foreach($categories as $category)
                                <option class="select-cate" value="{{ $category->dm_id }}" data-id="{{$category->dm_id }}">{{ $category->dm_ten }}</option>
                            @endforeach
                        </select><br>
                        <select class="form-select select-brand" name="type">
                            <option value="">--- Tìm theo thương hiệu ---</option>
                            @foreach($brands as $brand)
                                <option class="select-brand" value="{{ $brand->th_id }}" data-id="{{$brand->th_id }}">{{ $brand->th_ten }}</option>
                            @endforeach
                        </select><br>

                    </div>

                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Sản phẩm được lọc:</label>
                    <div class="col-8 col-xl-9 result-product" style="max-height: 300px; overflow: auto">

                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Các sản phẩm được chọn:</label>
                    <div class="col-8 col-xl-9 select-product">

                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Tổng tiền của phiếu:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control sum" id="inputPassword3"
                               name="sum"
                               placeholder="Tổng số tiền của tất cả sản phẩm được chọn"
                        readonly>
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
@endsection
