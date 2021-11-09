<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="quickView">Chi Tiết Sản Phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <style type="text/css">
                @media screen and(min-width: 992px) {
                    .modal-lg {
                        width: 950px;
                    }
                }

                .name_product {
                    color: #FE980F;
                }

                .price_product {
                    color: #FE980F;
                }
                .para {
                    padding-top: 20px;
                }
            </style>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ $product->sp_hinhanh }}" style="width: 250px ; height: 250px" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h3 class="name_product">{{ $product->sp_ten }}</h3>
                        <span>Mã số ID : {{ $product->sp_id}}</span>
                        <ul class="list-inline" title="Average Rating">
                            @php
                                $rating = $product->comment()->avg('bl_sosao');
                                $quantity =  $product->receipt()->first();
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
                        @if(isset($product->discount->km_hinhanh))
                            <?php
                            $new_price = $product->sp_giabanra - ($product->sp_giabanra*$product->discount->km_giamgia)/100
                            ?>
                            <h3 class="price_product"><strong>{{ number_format($new_price) }} VND</strong></h3>
                        @else
                            <h3 class="price_product"><strong>{{ number_format($product->sp_giabanra) }} VND</strong></h3>
                        @endif
                        @if($quantityProduct > 0)
                            <strong>Tình trạng : </strong> Còn {{ $quantityProduct }} sản phẩm<br>
                        @else
                            <strong>Tình trạng: </strong>Hết hàng<br>
                        @endif
                        <strong>Thương hiệu : </strong> {{ $product->brand->th_ten }}
                    </div>
                </div>
                <div class="row para">
                    <div class="col-md-6">
                        <div class="row">
                            <h5><strong>Thông tin nhà cung cấp</strong></h5>
                            <span><b>Tên nhà cung cấp :</b> {{ $product->ncc->ncc_ten }}</span><br>
                            <span><b>Địa chỉ :</b>  {{ $product->ncc->ncc_diachi }}</span><br>
                            <span><b>Mô tả :</b> {{ $product->ncc->ncc_mota }}</span><br>
                            <span><b>Số điện thoại liên hệ :</b> {{ $product->ncc->ncc_sdt }}</span><br>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-2"> 
                                    <h1>{{round($product->comment()->avg('bl_sosao'))}}.0</h1>
                                    <h4>/5.0</h4>
                                    <ul class="list-inline" title="Average Rating">
                                        @php
                                            $rating = $product->comment()->avg('bl_sosao');
                                            $quantity =  $product->receipt()->first();
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
                                                style="cursor:pointer; {{$color}} font-size: 10px;">
                                                &#9733;
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                                <div class="col-4">
                                    <h1>{{round($product->comment()->avg('bl_sosao'))}}.0</h1>
                                    <h4>/5.0</h4>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5><strong>Thông số kỹ thuật</strong></h5>
                        <span><b>Bảo hành :</b> {{ $product->sp_thoigianbaohanh }} tháng.</span><br><hr>
                        @foreach($product->para as $para)
                            @foreach($product->detail as $detail)
                                @if($para->ts_id == $detail->ts_id)
                                    <span class=""><b>{{ $para->ts_tenthongso }} :</b>{{ $detail->chitietthongso }}</span><br><hr>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            @if($quantity->pivot->soluong > 0)
            <button
                data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                class="btn btn-success add-to-cartAjax"><i class="fa fa-shopping-cart">
                </i>Thêm giỏ hàng
            </button>
            @endif
        </div>
    </div>
</div>
