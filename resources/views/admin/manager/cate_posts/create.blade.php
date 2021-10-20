@extends('admin.layout')

@section('title')
Danh mục sản phẩm
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM DANH MỤC SẢN PHẨM</h2>
            <?php
            $message = Session::get('message');
            if($message)
            {
                echo '<span class="text-danger">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
{{--            <div class="row mb-3">--}}
{{--                @if ($errors->any())--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <ul>--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
            <form class="form-horizontal" action="{{ route('admin.cate.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nhập tên danh mục:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control name-cate" id="inputPassword3"
                               name="dm_ten"
                               required
                               class="@error('dm_ten') is-invalid @enderror"
                               placeholder="Nhập vào tên danh mục muốn tạo">
                        @error('dm_ten')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn danh mục cha:</label>
                    <div class="col-8 col-xl-9">
                        <select class="form-select" name="parent">
                            <option value="0">--- Chọn danh mục cha ---</option>
                            {!! $htmlOption !!}
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Mô tả danh mục:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword5"
                               name="desc"
                               required
                               class="@error('desc') is-invalid @enderror"
                               placeholder="Nhập vào mô tả của danh mục">
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="justify-content-end row">
                    <div class="col-8 col-xl-9">
                        <button type="submit" class="btn btn-lg btn-info waves-effect waves-light">Lưu</button>
                    </div>
                </div>
            </form>

        </div>  <!-- end card-body -->
    </div>  <!-- end card -->
</div>  <!-- end col -->
@endsection
