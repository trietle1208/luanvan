<div class=""><!--price-range-->
            <h2>SẮP XẾP SẢN PHẨM</h2>

            <select class="form-control selectSort">
                <option value="">--- Chọn loại sắp xếp ---</option>
                <option value="1">Sắp xếp theo ký tự A-Z</option>
                <option value="2">Sắp xếp theo ký tự Z-A</option>
                <option value="3">Sắp xếp theo giá tăng dần</option>
                <option value="4">Sắp xếp theo giá giảm dần</option>
            </select>
            <br>
            <select class="form-control selectCateSort">
                <option value="">--- Chọn danh mục ---</option>
                @foreach($categories as $cate)
                <option value="{{ $cate->dm_id }}">{{ $cate->dm_ten }}</option>
                @endforeach
            </select>
            <br>
            <select class="form-control selectBrandSort">
                <option value="">--- Chọn thương hiệu ---</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->th_id }}">{{ $brand->th_ten }}</option>
                @endforeach
            </select>
            <br>
            <button class="btn btn-default fillterSort" data-url="{{ route('fillterSort') }}">
                Lọc
            </button>

</div><!--/price-range-->