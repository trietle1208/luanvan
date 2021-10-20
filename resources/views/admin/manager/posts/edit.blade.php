@extends('admin.layout')

@section('title')
    Danh mục sản phẩm
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">CẬP NHẬT DANH MỤC BÀI VIẾT</h2>
                <?php
                $message = Session::get('message');
                if($message)
                {
                    echo '<span class="text-primary">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <div class="row mb-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form class="form-horizontal" action="{{ route('admin.cate_posts.update', ['id' => $category->dmbv_id]) }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập tên danh mục:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="dm_ten"
                                   required
                                   value="{{ $category['dmbv_ten'] }}"
                                   placeholder="Nhập vào tên danh mục muốn tạo">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Mô tả danh mục:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="desc"
                                   required
                                   value="{{ $category['dmbv_mota'] }}"
                                   placeholder="Nhập vào mô tả của danh mục">
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-8 col-xl-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Cập nhật</button>
                        </div>
                    </div>
                </form>

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>  <!-- end col -->
@endsection
