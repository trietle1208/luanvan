@extends('admin.layout')

@section('title')
   Sản phẩm
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">THÊM SẢN PHẨM</h2>
                <?php
                $message = Session::get('message');
                if($message)
                {
                    echo '<span class="text-primary">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <form class="form-horizontal" action="{{ route('sup.product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập tên sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   placeholder="Nhập vào tên sản phẩm muốn tạo">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Hình ảnh sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="file" class="form-control" id="inputPassword5"
                                   name="image"
                                   placeholder="Nhập vào hình ảnh của sản phẩm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Hình ảnh chi tiết sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="file" class="form-control" id="inputPassword5"
                                   multiple
                                   name="image_detail[]"
                                   placeholder="Nhập vào hình ảnh chi tiết của sản phẩm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Mô tả sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="desc_product"
                                   name="desc"
                                   placeholder="Nhập vào mô tả của sản phẩm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Chi tiết sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <textarea name="detail" id="detail_product" placeholder="Nhập vào chi tiết của sản phẩm">

                            </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Số lượng sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="quantity"
                                   placeholder="Nhập vào số lượng của sản phẩm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Giá bán ra của sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="price"
                                   placeholder="Nhập vào giá bán ra của sản phẩm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Thời gian bảo hành:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="insurance"
                                   placeholder="Nhập vào thời gian bảo hành của sản phẩm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn danh mục:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select" name="cate">
                                <option value="0">--- Chọn danh mục ---</option>
                                {!! $htmlOption !!}
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn thương hiệu:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select" name="brand">
                                <option value="0">--- Chọn thương hiệu ---</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->th_id }}">{{ $brand->th_ten }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn loại:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select select_type" name="type">
                                <option value="0">--- Chọn loại ---</option>
                                @foreach($types as $type)
                                    <option
                                            data-id="{{ $type->loaisp_id }}"
                                            value="{{ $type->loaisp_id }}">{{ $type->loaisp_ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn thông số:</label>
                        <div class="col-8 col-xl-9 para">

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
