@extends('admin.layout')

@section('title')
Thương hiệu sản phẩm
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM THƯƠNG HIÊU SẢN PHẨM</h2>
            <?php
            $message = Session::get('message');
            if($message)
            {
                echo '<span class="text-primary">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
            <form class="form-horizontal" action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nhập tên thương hiệu:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control name-brand" id="inputPassword3"
                               name="th_ten"
                               class="@error('th_ten') is-invalid @enderror"
                               placeholder="Nhập vào tên thương hiệu muốn tạo">
                        @error('th_ten')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Hình ảnh thương hiệu:</label>
                    <div class="col-8 col-xl-9">
                        <input type="file" class="form-control" id="inputPassword5"
                               name="image"
                               class="@error('image') is-invalid @enderror"
                               placeholder="Nhập vào hình ảnh của thương hiệu">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Mô tả thương hiệu:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword5"
                                   name="desc"
                               class="@error('desc') is-invalid @enderror"
                               placeholder="Nhập vào mô tả của thương hiệu">
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
