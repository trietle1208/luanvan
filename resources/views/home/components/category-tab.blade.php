<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach($categories as $category)
            <li class="{{ $loop->first ? 'active' : '' }}"><a href="#_{{ $category->dm_id }}" data-toggle="tab">{{ $category->dm_ten }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        @foreach($categories as $Cateproduct)
        <div class="tab-pane fade {{ $loop->first ? 'active in' : '' }}" id="_{{ $Cateproduct->dm_id }}" >
            @foreach($Cateproduct->productCheck as $product)
                <a href="{{ route('product.detail', ['ncc' => $product->ncc_id ,'slug' => $product->sp_slug]) }}">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            @if(isset($product->discount->km_hinhanh))
                                <img class="img-fluid" src="{{ $product->discount->km_hinhanh }}" style="height: 30px; width: 50px; float: right" alt="" />
                                <img src="{{ $product->sp_hinhanh }}" class="img-fluid" style="height: 200px" alt="" />
                                <h2><del>{{ number_format($product->sp_giabanra) }} VND</del></h2>
                                <?php
                                    $new_price = $product->sp_giabanra - ($product->sp_giabanra*$product->discount->km_giamgia)/100
                                ?>
                                <h2>{{ number_format($new_price) }} VND</h2>
                                <p>{{ Str::words($product->sp_ten,2,'...') }}</p>
                                <button
                                    data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                    class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                    </i>Thêm giỏ hàng
                                </button>
                            @else
                                <img src="{{ $product->sp_hinhanh }}" class="img-fluid" style="height: 200px" alt="" />
                                <h2>{{ number_format($product->sp_giabanra) }} VND</h2>
                                <p>{{ Str::words($product->sp_ten,2,'...') }}</p>
                                <button
                                    data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                    class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                    </i>Thêm giỏ hàng
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
                </a>
            @endforeach
        </div>
        @endforeach
    </div>
</div><!--/category-tab-->
