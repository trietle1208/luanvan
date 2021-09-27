@extends('admin.layout')

@section('title')
    Mã giảm giá
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">THÊM MÃ GIẢM CHO SẢN PHẨM</h2>
                <?php
                $message = Session::get('message');
                if($message)
                {
                    echo '<span class="text-primary">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <form class="form-horizontal" action="{{ route('sup.voucher.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập tên mã giảm giá:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="@error('name') is-invalid @enderror"
                                   placeholder="Nhập vào tên của mã giảm giá muốn tạo">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập code mã giảm giá:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="mgg_macode"
                                   value="{{ old('mgg_macode') }}"
                                   class="@error('mgg_macode') is-invalid @enderror"
                                   placeholder="Nhập vào code của mã giảm giá muốn tạo">
                            @error('mgg_macode')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Điều kiện của mã giảm giá:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="condition"
                                   value="{{ old('condition') }}"
                                   class="@error('condition') is-invalid @enderror"
                                   placeholder="Nhập vào điều kiện của mã giảm giá">
                            @error('condition')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Mô tả mã giảm giá:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="desc"
                                   value="{{ old('desc') }}"
                                   class="@error('desc') is-invalid @enderror"
                                   placeholder="Nhập vào mô tả của mã giảm giá">
                            @error('desc')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Hình thức chương mã giảm giá:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select" name="type">
                                class="@error('type') is-invalid @enderror"
                                <option value="">--- Chọn hình thức ---</option>
                                <option value="0">Giảm theo giá tiền</option>
                                <option value="1">Giảm theo %</option>
                            </select>
                            @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Giá được giảm của mã giảm giá:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="price"
                                   value="{{ old('price') }}"
                                   class="@error('price') is-invalid @enderror"
                                   placeholder="Nhập vào số tiền(hoặc %) của mã giảm giá">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Số lượng của mã giảm giá:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="qty"
                                   value="{{ old('qty') }}"
                                   class="@error('qty') is-invalid @enderror"
                                   placeholder="Nhập vào số lượng của mã giảm giá">
                            @error('qty')
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
