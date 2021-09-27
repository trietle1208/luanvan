@extends('admin.layout')

@section('title')
    Tài khoản
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                        <h2 class="header-title text-center">THÊM TÀI KHOẢN NHÂN VIÊN</h2>
                <?php
                $message = Session::get('message');
                if($message)
                {
                    echo '<span class="text-primary">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <form class="form-horizontal" action="{{ route('sup.account.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào họ và tên:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   placeholder="Nhập vào tên chương trình khuyến mãi muốn tạo">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào email:</label>
                        <div class="col-8 col-xl-9">
                            <input type="email" class="form-control" id="inputPassword5"
                                   name="email"
                                   placeholder="Nhập vào hình ảnh của thương hiệu">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào mật khẩu:</label>
                        <div class="col-8 col-xl-9">
                            <input type="password" class="form-control" id="inputPassword5"
                                   name="password"
                                   placeholder="Nhập vào mô tả của chương trình khuyến mãi">
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
