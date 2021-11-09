@extends('admin.layout')

@section('title')
    Tài khoản
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">THÊM TÀI KHOẢN SHIPPER</h2>
                <form class="form-horizontal" action="{{ route('admin.account.store_shipper') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào họ và tên:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   class="@error('name') is-invalid @enderror"
                                   placeholder="Nhập vào họ và tên muốn tạo">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào email:</label>
                        <div class="col-8 col-xl-9">
                            <input type="email" class="form-control" id="inputPassword5"
                                   name="gh_email"
                                   class="@error('gh_email') is-invalid @enderror"
                                   placeholder="Nhập vào email">
                            @error('gh_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào mật khẩu:</label>
                        <div class="col-8 col-xl-9">
                            <input type="password" class="form-control" id="inputPassword5"
                                   name="password"
                                   class="@error('password') is-invalid @enderror"
                                   placeholder="Nhập vào mật khẩu">
                            @error('password')
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
