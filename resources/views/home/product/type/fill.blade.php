@foreach($detail_paras->unique('sp_id') as $detail_para)
    @if($detail_para['product'] != null && $detail_para['product']['loaisp_id'] == $id_type)
    <a href="{{ route('product.detail', ['ncc' => $detail_para['product']->ncc_id ,'slug' => $detail_para['product']->sp_slug]) }}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @if(isset($detail_para['product']->discount->km_hinhanh))
                            <img class="img-fluid float-right" src="{{ $detail_para['product']->discount->km_hinhanh }}" style="height: 50px; width: 80px; float: right" alt="" />
                            <img src="{{ $detail_para['product']->sp_hinhanh }}" style="width: 250px; height: 250px" alt="" />
                            <h2><del>{{ number_format($detail_para['product']->sp_giabanra) }} VND</del></h2>
                            <?php
                            $new_price = $detail_para['product']->sp_giabanra - ($detail_para['product']->sp_giabanra*$detail_para['product']->discount->km_giamgia)/100
                            ?>
                            <h2>{{ number_format($new_price) }} VND</h2>
                            <p>{{ $detail_para['product']->sp_ten }}</p>
                            <ul class="list-inline" title="Average Rating">
                                @php
                                    $rating = $detail_para['product']->comment()->avg('bl_sosao');
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
                            <button
                                data-id="{{ $detail_para['product']->sp_id }}" data-key="{{$detail_para['product']->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                </i>Thêm giỏ hàng
                            </button>
                        @else
                            <img src="{{ $detail_para['product']->sp_hinhanh }}" style="width: 250px; height: 250px" alt="" />
                            <h2>{{ number_format($detail_para['product']->sp_giabanra) }} VND</h2>
                            <p>{{ $detail_para['product']->sp_ten }}</p>
                            <ul class="list-inline" title="Average Rating">
                                @php
                                    $rating = $detail_para['product']->comment()->avg('bl_sosao');
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
                            <button
                                data-id="{{ $detail_para['product']->sp_id }}" data-key="{{ $detail_para['product']->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                </i>Thêm giỏ hàng
                            </button>
                        @endif
                    </div>

                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        @if(Session::get('customer_id'))
                            <li><button class="btn btn-{{ $customer->product_wishlist->contains($detail_para['product']->sp_id) ? 'danger' : 'success' }} addWishlist" style="float: left"
                                        value="{{ $customer->product_wishlist->contains($detail_para['product']->sp_id) ? '1' : '0' }}"
                                        data-id="{{ $detail_para['product']->sp_id }}"><i class="fa fa-plus-square"></i>{{ $customer->product_wishlist->contains($detail_para['product']->sp_id) ? 'Bỏ yêu thích' : 'Thêm yêu thích' }}</button></li>
                        @else
                            <li><button class="btn btn-success" style="float: left"><i class="fa fa-plus-square"></i>Thêm yêu thích</button></li>
                        @endif
                        <li><button class="btn btn-success quickView" data-id="{{ $detail_para['product']->sp_id }}" data-url="{{ route('customer.quickView') }}" style="float: right"><i class="fa fa-plus-square"></i>Xem nhanh</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
    @endif
@endforeach
