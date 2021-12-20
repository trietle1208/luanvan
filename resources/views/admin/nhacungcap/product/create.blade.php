@extends('admin.layout')

@section('title')
   Sản phẩm
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">THÊM SẢN PHẨM</h2>
                <div id
                     ="success"></div>
                <form class="form-horizontal" id="add-product" action="{{ route('sup.product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập tên sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Nhập vào tên sản phẩm muốn tạo">
                            <div class="error name"></div>
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
                            <textarea
                                name="desc"
                                id="desc_product"
                                value="{{ old('desc') }}"
                                placeholder="Nhập vào mô tả của sản phẩm">
                            </textarea>
                            @error('desc')
                            <div class="error desc"></div>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Chi tiết sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <textarea
                                name="detail"
                                id="detail_product"
                                value="{{ old('detail') }}"
                                placeholder="Nhập vào chi tiết của sản phẩm"></textarea>
                            <div class="error detail"></div>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Giá bán ra của sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="number" class="form-control price" id="inputPassword5"
                                   name="price"
                                   value="{{ old('price') }}"
                                   placeholder="Nhập vào giá bán ra của sản phẩm">
                            <div class="error price"></div>
                        </div>

                    </div> -->
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Thời gian bảo hành:</label>
                        <div class="col-8 col-xl-9">
                            <input type="number" class="form-control insurance" id="inputPassword5"
                                   name="insurance"
                                   value="{{ old('insurance') }}"
                                   placeholder="Nhập vào thời gian bảo hành của sản phẩm">
                            <div class="error insurance"></div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn danh mục:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select required" name="cate"
                                    value="{{ old('cate') }}"
                            >
                                <option value="">--- Chọn danh mục ---</option>
                                {!! $htmlOption !!}
                            </select>
                            <div class="error cate"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn thương hiệu:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select required" name="brand"
                                    value="{{ old('brand') }}"
                            >
                                <option value="">--- Chọn thương hiệu ---</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->th_id }}">{{ $brand->th_ten }}</option>
                                @endforeach
                            </select>
                            <div class="error brand"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn loại:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select select_type required" name="type"
                                    value="{{ old('type') }}"
                                    >
                                <option value="">--- Chọn loại ---</option>
                                @foreach($types as $type)
                                    <option
                                            data-id="{{ $type->loaisp_id }}"
                                            value="{{ $type->loaisp_id }}">{{ $type->loaisp_ten }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="error type"></div>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn thông số:</label>
                        <div class="col-8 col-xl-9 para">

                        </div>
                        <div class="error chitietthongso"></div>
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
