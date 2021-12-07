@extends('admin.layout')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="header-title text-center">CẬP NHẬT SẢN PHẨM</h2>
                <form class="form-horizontal" action="{{ route('sup.product.update',['id' => $products->sp_id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Nhập tên sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword3"
                                   name="name"
                                   value="{{ $products->sp_ten }}"
                                   placeholder="Nhập vào tên sản phẩm muốn tạo">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Hình ảnh sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="file" class="form-control" id="inputPassword5"
                                   name="image"
                                   placeholder="Nhập vào hình ảnh của sản phẩm">
                            <img src="{{ $products->sp_hinhanh }}" style="height: 180px; width: 250px">
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Hình ảnh chi tiết sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="file" class="form-control" id="inputPassword5"
                                   multiple
                                   name="image_detail[]"
                                   placeholder="Nhập vào hình ảnh chi tiết của sản phẩm">
                            @foreach($productImages as $image)
                                <img src="{{ $image->ha_duongdan }}" style="height: 180px; width: 250px">
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Mô tả sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <textarea type="text" class="form-control" id="desc_product"
                                name="desc"
                                placeholder="Nhập vào mô tả của sản phẩm">
                                {{ $products->sp_mota }}
                            </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Chi tiết sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <textarea name="detail" id="detail_product" placeholder="Nhập vào chi tiết của sản phẩm">
                            {{ $products->sp_chitiet }}
                            </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Giá bán ra của sản phẩm:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="price"
                                   value="{{ $products->sp_giabanra }}"
                                   placeholder="Nhập vào giá bán ra của sản phẩm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-4 col-xl-3 col-form-label">Thời gian bảo hành:</label>
                        <div class="col-8 col-xl-9">
                            <input type="text" class="form-control" id="inputPassword5"
                                   name="insurance"
                                   value="{{ $products->sp_thoigianbaohanh }}"
                                   placeholder="Nhập vào thời gian bảo hành của sản phẩm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn danh mục:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select" name="cate">
                                <option value="0">--- Chọn danh mục ---</option>
                                {!! $htmlCate !!}
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn thương hiệu:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select" name="brand">
                                <option value="0">--- Chọn thương hiệu ---</option>
                                {!! $htmlBrand !!}
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn thương hiệu:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select" name="discount">
                                <option value="">--- Chọn khuyến mãi ---</option>
                                @foreach($discounts as $discount)
                                    <option value="{{ $discount->km_id }}">{{ $discount->km_ten }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">Chọn loại:</label>
                        <div class="col-8 col-xl-9">
                            <select class="form-select select_type select_type_product" data-id="{{ $products->sp_id }}" name="type">
                                <option value="0">--- Chọn loại ---</option>
                                {!! $htmlType !!}
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
                            <button type="submit" class="btn btn-info waves-effect waves-light">Cập nhật</button>
                        </div>
                    </div>
                </form>

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>  <!-- end col -->
@endsection
