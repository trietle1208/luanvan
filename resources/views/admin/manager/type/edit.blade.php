@extends('admin.layout')

@section('title')
    Loại sản phẩm
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">CẬP NHẬT LOẠI SẢN PHẨM</h2>
                <?php
                $message = Session::get('message');
                if($message)
                {
                    echo '<span class="text-primary">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <form class="form-horizontal" action="{{ route('admin.type.update', ['id' => $type->loaisp_id]) }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập tên loại:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   value="{{ $type['loaisp_ten'] }}"
                                   placeholder="Nhập vào tên loại muốn tạo">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn danh mục cho loại:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select" name="parent">
                                <option value="0">--- Chọn loại ---</option>
                                @foreach($categories as $category)
                                    @if($category->dm_id == $type->dm_id)
                                        <option selected value = "{{ $category->dm_id }}">{{ $category->dm_ten }}</option>
                                    @else
                                        <option value = "{{ $category->dm_id }}">{{ $category->dm_ten }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Mô tả :</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="desc"
                                   value="{{ $type['loaisp_mota'] }}"
                                   placeholder="Nhập vào mô tả của loại">
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
