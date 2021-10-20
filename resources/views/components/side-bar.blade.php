<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>DANH MỤC SẢN PHẨM</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach($categories as $cate)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->dm_id}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{ $cate->dm_ten }}
                        </a>
                    </h4>
                </div>
                <div id="{{$cate->dm_id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($cate->type as $type)
                            <li><a href="{{ route('type.product',['slug' => $type->loaisp_slug, 'id' => $type->loaisp_id ]) }}">{{ $type->loaisp_ten }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>THƯƠNG HIỆU SẢN PHẨM</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($brands as $brand)
                    <li><a href="{{ route('brand.product',['slug' => $brand->th_slug, 'id' => $brand->th_id ]) }}"> <span class="pull-right">(50)</span>{{ $brand->th_ten }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->
        <hr>
        <div class=""><!--price-range-->
            <h2>LỌC GIÁ SẢN PHẨM</h2>
            <div id="slider-range">

            </div>
            <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"><br>
            <input type="hidden" id="start">
            <input type="hidden" id="end">
            <button class="btn btn-default fillterPrice">
                Lọc
            </button>
        </div><!--/price-range-->
        <hr>
        <div class=""><!--price-range-->
            <h2>LỌC ĐÁNH GIÁ</h2>
            @for($rating = 5; $rating >= 1; $rating--)
                <ul class="list-inline" style="padding-left: 15px" title="Average Rating">
                    @for($count = 1; $count<=5; $count++)
                        @php
                            if($count<=$rating){
                                $color = 'color:#ffcc00;';
                            }else{
                                $color = 'color:#ccc;';
                            }
                        @endphp
                        <li title="đánh giá sao"
                            style="cursor:pointer; {{$color}} font-size: 15px;">
                            &#9733;
                        </li>
                    @endfor
                    @if($rating == 5 || $rating == 4)
                        @php
                        $color_text = 'color: #0b8347';
                        @endphp
                    @elseif($rating == 3 || $rating == 2)
                        @php
                            $color_text = 'color: #E8E055';
                        @endphp
                    @else
                        @php
                            $color_text = 'color: #D43D3D';
                        @endphp
                    @endif
                    <li><h4 style="{{ $color_text }}">{{ $rating }}.0</h4></li>
                    <li style="float: right"><button class="btn btn-sm btn-default fillterRating" data-rating="{{ $rating }}" data-url="{{ route('fillterRating') }}">Chọn</button></li>
                </ul>
            @endfor
        </div><!--/price-range-->

        <hr>
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

    </div>
</div>
