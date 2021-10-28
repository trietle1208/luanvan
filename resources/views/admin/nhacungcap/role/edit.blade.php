@extends('admin.layout')

@section('title')
    Vai trò
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">CẬP NHẬT VAI TRÒ</h2>
                
                <form class="form-horizontal" action="{{ route('sup.role.update',['id' => $role->id]) }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập tên vai trò:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   value="{{ $role->name }}"
                                   class="@error('name') is-invalid @enderror"
                                   placeholder="Nhập vào tên vai trò muốn tạo">
                            @error('name')
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
