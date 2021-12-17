@extends('admin.layout')

@section('title')
    Tài khoản
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">THÊM TÀI KHOẢN NHÂN VIÊN</h2>
                
                {!! Toastr::message() !!}
                <form class="form-horizontal" action="{{ route('sup.account.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào họ và tên:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control"
                                   name="name"
                                   class="@error('name') is-invalid @enderror"
                                   placeholder="Nhập vào tên tài khoản muốn tạo">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào email:</label>
                        <div class="col-8 col-xl-9">
                            <input type="email" class="form-control inputEmail"     
                                   name="email"
                                   data-url="{{ route('sup.account.checkEmail') }}"
                                   class="@error('email') is-invalid @enderror"
                                   placeholder="Nhập vào email">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào địa chỉ:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" 
                                   name="address"
                                   class="@error('address') is-invalid @enderror"
                                   placeholder="Nhập vào địa chỉ">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào số điện thoại:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" 
                                   name="phone"
                                   class="@error('phone') is-invalid @enderror"
                                   placeholder="Nhập vào số điện thoại">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Ngày sinh:</label>
                        <div class="col-8 col-xl-9">
                            <input type="date" class="form-control" 
                                   name="date"
                                   class="@error('date') is-invalid @enderror"
                                   placeholder="Nhập vào số điện thoại">
                            @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập vào mật khẩu:</label>
                        <div class="col-8 col-xl-9">
                            <input type="password" class="form-control" 
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
