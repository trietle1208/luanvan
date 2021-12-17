<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">SẢN PHẨM KHUYÊN DÙNG</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($product_rating as $key => $productRecomment)
                @php
                    $quantity =  $productRecomment->receipt()->first();
                    $price = $productRecomment->price()->first();
                @endphp
                @if($key % 3 == 0)
                    <div class="item {{$key == 0 ? 'active' : '' }}">
                        @endif
                        <a href="{{ route('product.detail', ['ncc' => $productRecomment->ncc_id ,'slug' => $productRecomment->sp_slug]) }}">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ $productRecomment->sp_hinhanh }}" style="height: 250px ; width: 250px" alt="" />
                                            <h2>{{ number_format($price->pivot->giabanra) }} VND</h2>
                                            <p>{{ $productRecomment->sp_ten }}</p>
                                            <ul class="list-inline" title="Average Rating">
                                                @php
                                                    $rating = $productRecomment->comment()->avg('bl_sosao');
                                                @endphp
                                                @for($count = 1; $count<=5; $count++)
                                                    @if(isset($rating))
                                                        @php
                                                            $rating = $rating;
                                                            if($count<=$rating){
                                                                $color = 'color:#ffcc00;';
                                                            }else{
                                                                $color = 'color:#ccc;';
                                                            }
                                                        @endphp
                                                    @else
                                                        @php
                                                            $rating = 0;
                                                            if($count<=$rating){
                                                                $color = 'color:#ffcc00;';
                                                            }else{
                                                                $color = 'color:#ccc;';
                                                            }
                                                        @endphp
                                                    @endif
                                                    <li title="đánh giá sao"
                                                        style="cursor:pointer; {{$color}} font-size: 20px;">
                                                        &#9733;
                                                    </li>
                                                @endfor
                                            </ul>
                                            <!-- <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button> -->
                                            @if($quantity->pivot->soluong > 0)
                                            <button
                                                data-id="{{ $productRecomment->sp_id }}" data-key="{{ $productRecomment->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                                class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                                </i>Thêm giỏ hàng
                                            </button>
                                            @else
                                            <button
                                                class="btn btn-danger add-to-cart disable" style="background-color : red; color : white"><i class="fa fa-shopping-cart">
                                                </i>Hết hàng
                                            </button>
                            @endif
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
