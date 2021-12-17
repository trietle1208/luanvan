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
                @php
                    $quantity =  $product->receipt()->first();
                    $price = $product->price()->first();
                @endphp
                <a href="{{ route('product.detail', ['ncc' => $product->ncc_id ,'slug' => $product->sp_slug]) }}">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            @if(isset($product->discount->km_hinhanh))
                                <img class="img-fluid" src="{{ $product->discount->km_hinhanh }}" style="height: 30px; width: 50px; float: right" alt="" />
                                <img src="{{ $product->sp_hinhanh }}" class="img-fluid" style="height: 200px" alt="" />
                                <h2><del>{{ number_format($price->pivot->giabanra) }} VND</del></h2>
                                <?php
                                    $new_price = $price->pivot->giabanra - ($price->pivot->giabanra*$product->discount->km_giamgia)/100
                                ?>
                                <h2>{{ number_format($new_price) }} VND</h2>
                                <p>{{ Str::words($product->sp_ten,2,'...') }}</p>
                                <!-- <button
                                    data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                    class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                    </i>Thêm giỏ hàng
                                </button> -->
                                @if($quantity->pivot->soluong > 0)
                                <button
                                    data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                    class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                    </i>Thêm giỏ hàng
                                </button>
                                @else
                                <button
                                    class="btn btn-danger add-to-cart disable" style="background-color : red; color : white"><i class="fa fa-shopping-cart">
                                    </i>Hết hàng
                                </button>
                                @endif
                            @else
                                <img src="{{ $product->sp_hinhanh }}" class="img-fluid" style="height: 200px" alt="" />
                                <h2>{{ number_format($price->pivot->giabanra) }} VND</h2>
                                <p>{{ Str::words($product->sp_ten,2,'...') }}</p>
                                <!-- <button
                                    data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                    class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                    </i>Thêm giỏ hàng
                                </button> -->
                                @if($quantity->pivot->soluong > 0)
                                <button
                                    data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                    class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                    </i>Thêm giỏ hàng
                                </button>
                                @else
                                <button
                                    class="btn btn-danger add-to-cart disable" style="background-color : red; color : white"><i class="fa fa-shopping-cart">
                                    </i>Hết hàng
                                </button>
                                @endif
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
