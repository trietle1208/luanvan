@foreach($products as $product)
    @php
        $quantity =  $product->receipt()->first();
    @endphp
    <a href="{{ route('product.detail', ['ncc' => $product->ncc_id ,'slug' => $product->sp_slug]) }}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @if(isset($product->discount->km_hinhanh))
                            <img class="img-fluid float-right" src="{{ $product->discount->km_hinhanh }}" style="height: 50px; width: 80px; float: right" alt="" />
                            <img src="{{ $product->sp_hinhanh }}" style="width: 250px; height: 250px" alt="" />
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
                            <img src="{{ $product->sp_hinhanh }}" style="width: 250px; height: 250px" alt="" />
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
                            <li><button class="btn btn-{{ $customer->product_wishlist->contains($product->sp_id) ? 'danger' : 'success' }} addWishlist" style="float: left"
                                        value="{{ $customer->product_wishlist->contains($product->sp_id) ? '1' : '0' }}"
                                        data-id="{{ $product->sp_id }}"><i class="fa fa-plus-square"></i>{{ $customer->product_wishlist->contains($product->sp_id) ? 'Bỏ yêu thích' : 'Thêm yêu thích' }}</button></li>
                        @else
                            <li><button class="btn btn-success" style="float: left"><i class="fa fa-plus-square"></i>Thêm yêu thích</button></li>
                        @endif
                        <li><button class="btn btn-success quickView" data-id="{{ $product->sp_id }}" data-url="{{ route('customer.quickView') }}" style="float: right"><i class="fa fa-plus-square"></i>Xem nhanh</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
@endforeach
