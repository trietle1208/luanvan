<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">sản phẩm liên quan</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
                @foreach($productRecomments as $key => $productRecomment)

                    @if($key % 3 == 0)
                    <div class="item {{$key == 0 ? 'active' : '' }}">
                    @endif
                        <a href="{{ route('product.detail', ['ncc' => $productRecomment->ncc_id ,'slug' => $productRecomment->sp_slug]) }}">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ $productRecomment->sp_hinhanh }}" style="height: 250px ; width: 250px" alt="" />
                                            <h2>{{ number_format($productRecomment->sp_giabanra) }} VND</h2>
                                            <p>{{ $productRecomment->sp_ten }}</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @if($key % 3 == 2)
                    </div>
                    @endif
                @endforeach
        </div>


        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div><!--/recommended_items-->
