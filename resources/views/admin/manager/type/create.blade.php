@extends('admin.layout')

@section('title')
Loại sản phẩm
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM LOẠI SẢN PHẨM</h2>
            <?php
            $message = Session::get('message');
            if($message)
            {
                echo '<span class="text-primary">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
            <form class="form-horizontal" action="{{ route('admin.type.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nhập tên loại:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control name-type" id="inputPassword3"
                               name="loaisp_ten"
                               class="@error('loaisp_ten') is-invalid @enderror"
                               placeholder="Nhập vào tên loại muốn tạo">
                        @error('loaisp_ten')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn danh mục cho loại:</label>
                    <div class="col-8 col-xl-9">
                        <select class="form-select required" name="parent">
                            class="@error('parent') is-invalid @enderror"
                            <option value="">--- Chọn loại ---</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['dm_id'] }}">{{ $category['dm_ten'] }}</option>
                            @endforeach
                        </select>
                        @error('parent')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Mô tả loại:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword5"
                                   name="desc"
                               class="@error('desc') is-invalid @enderror"
                               placeholder="Nhập vào mô tả của loại">
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
