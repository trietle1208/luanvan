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
                    padding-top: 10px;
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
                        @php
                            $price = $product->price()->first();
                        @endphp
                        @if(isset($product->discount->km_hinhanh))
                            <?php
                            $new_price = $price->pivot->giabanra - ($price->pivot->giabanra*$product->discount->km_giamgia)/100
                            ?>
                            <h3 class="price_product"><strong>{{ number_format($new_price) }} VND</strong></h3>
                        @else
                            <h3 class="price_product"><strong>{{ number_format($price->pivot->giabanra) }} VND</strong></h3>
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
                        <style>
                            .card {
                                border-radius: 5px;
                                background-color: #fff;
                                padding-left: 10px;
                                padding-right: 10px;
                                padding-bottom: 10px
                            } 
                            .rating-box {
                                width: 50px;
                                height: 50px;
                                background-color: #FBC02D;
                                color: #fff
                            }
                            .rating-bar {
                                width: 200px;
                                padding: 8px;
                                border-radius: 5px
                            }
                            .rating-label {
                                font-weight: bold;
                                font-size: 14px;
                            }
                            .bar-container {
                                width: 100%;
                                background-color: #f1f1f1;
                                text-align: center;
                                color: white;
                                border-radius: 20px;
                                cursor: pointer;
                                margin-bottom: 5px
                            }

                            .bar-5 {
                                
                                height: 13px;
                                background-color: #FBC02D;
                                border-radius: 20px
                            }

                            .bar-4 {
                                height: 13px;
                                background-color: #FBC02D;
                                border-radius: 20px
                            }

                            .bar-3 {
                                height: 13px;
                                background-color: #FBC02D;
                                border-radius: 20px
                            }

                            .bar-2 {
                                height: 13px;
                                background-color: #FBC02D;
                                border-radius: 20px
                            }

                            .bar-1 {
                                height: 13px;
                                background-color: #FBC02D;
                                border-radius: 20px
                            }
                        </style>
                        <div class="row" style="padding-left:10px;">
                            <h5><strong>Thông tin nhà cung cấp</strong></h5>
                            <span><b>Tên nhà cung cấp :</b> {{ $product->ncc->ncc_ten }}</span><br>
                            <span><b>Địa chỉ :</b>  {{ $product->ncc->ncc_diachi }}</span><br>
                            <span><b>Mô tả :</b> {{ $product->ncc->ncc_mota }}</span><br>
                            <span><b>Số điện thoại liên hệ :</b> {{ $product->ncc->ncc_sdt }}</span><br>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="card">
                            <h5><strong>Đánh giá sản phẩm</strong></h5>
                                <div class="row justify-content-left d-flex">
                                    <!-- <div class="col-md-4 d-flex flex-column">
                                        <div class="rating-box">
                                            <h1 class="pt-4">4.0</h1>
                                            <p class="">out of 5</p>
                                        </div>
                                        <div> <span class="fa fa-star star-active mx-1"></span> <span class="fa fa-star star-active mx-1"></span> <span class="fa fa-star star-active mx-1"></span> <span class="fa fa-star star-active mx-1"></span> <span class="fa fa-star star-inactive mx-1"></span> </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="rating-bar0 justify-content-center">
                                            <table class="text-left mx-auto">
                                                <tr>
                                                    <td class="rating-label">Rất tốt</td>
                                                    <td class="rating-bar">
                                                        <div class="bar-container">
                                                            <div class="bar-5" style="width: {{ ($star_5/$count)*100  }}%;"></div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">{{ $star_5 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="rating-label">Tốt</td>
                                                    <td class="rating-bar">
                                                        <div class="bar-container">
                                                            <div class="bar-4" style="width: {{ ($star_4/$count)*100  }}%;"></div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">{{ $star_4 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="rating-label">Ổn</td>
                                                    <td class="rating-bar">
                                                        <div class="bar-container">
                                                            <div class="bar-3" style="width: {{ ($star_3/$count)*100  }}%;"></div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">{{ $star_3 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="rating-label">Tệ</td>
                                                    <td class="rating-bar">
                                                        <div class="bar-container">
                                                            <div class="bar-2" style="width: {{ ($star_2/$count)*100  }}%;"></div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">{{ $star_2 }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="rating-label">Rất tệ</td>
                                                    <td class="rating-bar">
                                                        <div class="bar-container">
                                                            <div class="bar-1" style="width: {{ ($star_1/$count)*100  }}%;"></div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">{{ $star_1 }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
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
                                    <span class=""><b>{{ $para->ts_tenthongso }} : </b>{{ $detail->chitietthongso }}</span><br><hr>
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
