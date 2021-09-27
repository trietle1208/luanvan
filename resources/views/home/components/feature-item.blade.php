<div class="features_items"><!--features_items-->
    <h2 class="title text-center">SẢN PHẨM NỔI BẬT</h2>
    @foreach($products as $product)
        <a href="{{ route('product.detail', ['ncc' => $product->ncc_id ,'slug' => $product->sp_slug]) }}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @if(isset($product->discount->km_hinhanh))
                        <img class="img-fluid" src="{{ $product->discount->km_hinhanh }}" style="height: 50px; width: 80px; float: right" alt="" />
                        <img src="{{ $product->sp_hinhanh }}" style="height: 300px; width: 300px" alt="" />
                            <h2><del>{{ number_format($product->sp_giabanra) }} VND</del></h2>
                            <?php
                            $new_price = $product->sp_giabanra - ($product->sp_giabanra*$product->discount->km_giamgia)/100
                            ?>
                            <h2>{{ number_format($new_price) }} VND</h2>
                        <p>{{ $product->sp_ten }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        @else
                            <img src="{{ $product->sp_hinhanh }}" style="height: 300px; width: 300px" alt="" />
                            <h2>{{ number_format($product->sp_giabanra) }} VND</h2>
                            <p>{{ $product->sp_ten }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        @endif
                    </div>

                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        </a>
    @endforeach
</div><!--features_items-->
