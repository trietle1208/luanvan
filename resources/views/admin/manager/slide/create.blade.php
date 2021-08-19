@extends('admin.layout')

@section('title')
Slide
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM SLIDE</h2>
            <?php
            $message = Session::get('message');
            if($message)
            {
                echo '<span class="text-primary">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
            <form class="form-horizontal" action="{{ route('admin.slide.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nhập tên Slide:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword3"
                               name="name"
                               placeholder="Nhập vào tên Slide muốn tạo">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Hình ảnh Slide:</label>
                    <div class="col-8 col-xl-9">
                        <input type="file" class="form-control" id="inputPassword5"
                               name="image"
                               placeholder="Nhập vào hình ảnh của Slide">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Mô tả Slide:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword5"
                                   name="desc"
                               placeholder="Nhập vào mô tả của Slide">
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
