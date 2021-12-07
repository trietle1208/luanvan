<div class="features_items"><!--features_items-->
    <h2 class="title text-center">KẾT QUẢ LỌC SẮP XẾP</h2>
    @foreach($products as $product)
        @php
            $last_id = $product->sp_id;
            $quantity =  $product->receipt()->first();
        @endphp
        <a href="{{ route('product.detail', ['ncc' => $product->ncc_id ,'slug' => $product->sp_slug]) }}">
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products responsive">
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
                                <ul class="list-inline" title="Average Rating">
                                    @php
                                        $rating = $product->comment()->avg('bl_sosao');
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
                                <!-- <button data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                        class="btn btn-default add-to-cart add-to-cartAjax">
                                    <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng
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
                                <img src="{{ $product->sp_hinhanh }}" style="height: 300px; width: 300px" alt="" />
                                <h2>{{ number_format($product->sp_giabanra) }} VND</h2>
                                <p>{{ $product->sp_ten }}</p>
                                <ul class="list-inline" title="Average Rating">
                                    @php
                                        $rating = $product->comment()->avg('bl_sosao');
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
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                        @if(Session::get('customer_id'))
                                <li>
                                    <a class="addWishlist" data-id="{{ $product->sp_id }}" data-value="{{ $customer->product_wishlist->contains($product->sp_id) ? '1' : '0' }}" style="cursor : pointer">
                                        @if($customer->product_wishlist->contains($product->sp_id))
                                            <i class="fa fas fa-heart " style="cursor : pointer ; color : red">
                                            </i>Đã thêm
                                        @else
                                            <i class="fa fas fa-heart" style="cursor : pointer">
                                            </i>Thêm yêu thích
                                        @endif                                
                                    </a>
                                </li>
                            @else
                                <li><a href=""><i class="fa fas fa-heart"></i>Thêm yêu thích</a></li>
                            @endif
                                <li><a href="" class="quickView" data-id="{{ $product->sp_id }}" data-url="{{ route('customer.quickView') }}"><i class="fa fa-search-plus"></i>Xem nhanh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    <div class="modal fade" id="addWishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
    <div class="modal fade" id="quickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
</div>
