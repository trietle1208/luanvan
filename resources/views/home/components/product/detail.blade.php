<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{ $product->sp_hinhanh }}" alt="" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                    <div class="item active">
                        @foreach($product->images as $key => $image)
                        <a href=""><img src="{{ $image->ha_duongdan }}" style="height: 80px; width: 80px" alt=""></a>
                        @endforeach
                    </div>

                </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg"  alt="" />
            <h2>{{ $product->sp_ten }}</h2>
            <p>Mã số ID: {{ $product->sp_id }}</p>
            <img src="images/product-details/rating.png" alt="" />

            <span>
                 @if(isset($product->discount->km_hinhanh))
                    <?php
                    $new_price = $product->sp_giabanra - ($product->sp_giabanra*$product->discount->km_giamgia)/100
                    ?>
                    <span>{{ number_format($new_price) }} VND</span>
                @else
                    <span>{{ number_format($product->sp_giabanra) }} VND</span>
                @endif
                <label>Số lượng:</label>
                <input name="quantity" class="qty-product" type="number" min="1" value="1" /><br>
                <input name="productid_hidden" class="id-product" type="hidden" value="{{ $product->sp_id }}"/><br>
                <input name="nccid_hidden" class="id-ncc" type="hidden" value="{{ $product->ncc->ncc_id }}"/><br>
                <button type="submit" class="btn btn-fefault add-cart" data-url="{{ route('product.addCart') }}">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm giỏ hàng
                </button><br>
            </span>
            @if($quantityProduct > 0)
            <p class="text-success"><b>Tình trạng:</b> Còn hàng {{ $quantityProduct }}</p>
            @else
            <p class="text-danger"><b>Tình trạng:</b> Hết hàng </p>
            @endif
            <p><b>Trạng thái:</b> Mới nhất</p>
            <p><b>Thương hiệu:</b> {{ $product->brand->th_ten }}</p>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
