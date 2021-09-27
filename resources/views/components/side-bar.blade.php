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

        <div class="price-range"><!--price-range-->
            <h2>LỌC GIÁ</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->



    </div>
</div>
