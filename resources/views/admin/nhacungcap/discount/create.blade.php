@extends('admin.layout')

@section('title')
Khuyến mãi
@endsection

@section('content')
<div class="col-lg-12 pt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="header-title text-center">THÊM KHUYẾN MÃI CHO SẢN PHẨM</h2>
            <?php
            $message = Session::get('message');
            if($message)
            {
                echo '<span class="text-primary">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
            <form class="form-horizontal" action="{{ route('sup.discount.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Nhập tên chương trình khuyến mãi:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword3"
                               name="name"
                               placeholder="Nhập vào tên chương trình khuyến mãi muốn tạo">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Hình ảnh chương trình khuyến mãi:</label>
                    <div class="col-8 col-xl-9">
                        <input type="file" class="form-control" id="inputPassword5"
                               name="image"
                               placeholder="Nhập vào hình ảnh của thương hiệu">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Mô tả chương trình khuyến mãi:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword5"
                                   name="desc"
                               placeholder="Nhập vào mô tả của chương trình khuyến mãi">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Hình thức chương trình khuyến mãi:</label>
                    <div class="col-8 col-xl-9">
                        <select class="form-select" name="type">
                            <option value="">--- Chọn hình thức ---</option>
                            <option value="0">Giảm theo giá tiền</option>
                            <option value="1">Giảm theo %</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Giá được giảm của chương trình khuyến mãi:</label>
                    <div class="col-8 col-xl-9">
                        <input type="text" class="form-control" id="inputPassword5"
                               name="price"
                               placeholder="Nhập vào số tiền(hoặc %) của chương trình khuyến mãi">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-4 col-xl-3 col-form-label">Trạng thái chương trình khuyến mãi:</label>
                    <div class="col-8 col-xl-9">
                        <select class="form-select" name="status">
                            <option value="">--- Chọn trạng thái ---</option>
                            <option value="0">Tắt</option>
                            <option value="1">Hiển thị</option>
                        </select>
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
