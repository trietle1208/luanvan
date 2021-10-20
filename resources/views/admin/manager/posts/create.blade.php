@extends('admin.layout')

@section('title')
Bài viết
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM BÀI VIẾT</h2>
            <?php
            $message = Session::get('message');
            if($message)
            {
                echo '<span class="text-danger">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
            <form class="form-horizontal" action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nhập tên bài viết:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword3"
                               name="bv_ten"
                               required
                               class="@error('bv_ten') is-invalid @enderror"
                               placeholder="Nhập vào tên bài viết muốn tạo">
                        @error('bv_ten')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn danh mục bài viết:</label>
                    <div class="col-8 col-xl-9">
                        <select class="form-select required" name="parent">
                            class="@error('parent') is-invalid @enderror"
                            <option value="">--- Chọn danh mục ---</option>
                            @foreach($cateposts as $cate)
                                <option value="{{ $cate['dmbv_id'] }}">{{ $cate['dmbv_ten'] }}</option>
                            @endforeach
                        </select>
                        @error('parent')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Tóm tắt bài viết:</label>
                    <div class="col-8 col-xl-9">
                            <textarea
                                name="desc"
                                id="desc_posts"
                                value="{{ old('desc') }}"
                                placeholder="Nhập vào tóm tắt của bài viết">
                            </textarea>
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nội dung bài viết:</label>
                    <div class="col-8 col-xl-9">
                            <textarea
                                name="contentpost"
                                id="content_posts"
                                value="{{ old('contentpost') }}"
                                placeholder="Nhập vào nội dung của bài viết">
                            </textarea>
                        @error('contentpost')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Hình ảnh bài viết:</label>
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
