@extends('admin.layout')

@section('title')
Thông số sản phẩm
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM THÔNG SỐ SẢN PHẨM</h2>
            <form class="form-horizontal" action="{{ route('admin.para.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nhập tên thông số:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword3"
                               name="name"
                               value="{{ old('name') }}"
                               class="@error('name') is-invalid @enderror"
                               placeholder="Nhập vào tên thông số muốn tạo">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn loại của thông số:</label>
                    <div class="col-8 col-xl-9">
                        <select class="form-select required" name="parent">
                            class="@error('parent') is-invalid @enderror"
                            <option value="">--- Chọn loại ---</option>
                            @foreach($types as $type)
                                <option value="{{ $type['loaisp_id'] }}">{{ $type['loaisp_ten'] }}</option>
                            @endforeach
                        </select>
                        @error('parent')
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
