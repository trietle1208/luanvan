<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <style>
            .lSSlideOuter .lSPager .lSGallery img {
                display: block;
                height: 140px;
                max-width: 100%;
            }

            .voucher p{
                width: 400px;
            }

            .voucher .voucher-title{
                color: rgb(0, 109, 204);
            }

            .voucher .voucher-name{
                color: rgb(53, 166, 64);
            }
        </style>
        <div class="exzoom" id="exzoom">
            <div class="exzoom_img_box">
                <ul class='exzoom_img_ul'>
                    <li><img src="{{ $product->sp_hinhanh }}"/></li>
                        @foreach($product->images as $key => $image)
                            <li><img src="{{ $image->ha_duongdan }}"/></li>
                        @endforeach
                </ul>
            </div>
            <div class="exzoom_nav"></div>
            <p class="exzoom_btn">
                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
            </p>
        </div>
        <div>
            <p>{!! $product->sp_mota !!}</p>
        </div>
        <div>
            <div class="iamge-array"
                 data-image1="{{ asset('assets/images/m1.jpg') }}"
                 data-image2="{{ asset('assets/images/m2.jpg') }}"
                 data-image3="{{ asset('assets/images/m3.jpg') }}"
                 data-image4="{{ asset('assets/images/m4.jpg') }}"
                 data-image5="{{ asset('assets/images/m5.jpg') }}"
                 data-image6="{{ asset('assets/images/m6.jpg') }}"
                 data-image7="{{ asset('assets/images/m7.jpg') }}"
                 data-image8="{{ asset('assets/images/m8.jpg') }}"
                 data-image9="{{ asset('assets/images/m9.jpg') }}"
                 data-image10="{{ asset('assets/images/m10.jpg') }}"
                 data-image11="{{ asset('assets/images/m11.jpg') }}"
                 data-image12="{{ asset('assets/images/m12.jpg') }}"
                 data-image13="{{ asset('assets/images/m13.jpg') }}"
                 data-image14="{{ asset('assets/images/m14.jpg') }}"
                 >
            </div>
            <button type="button" class="btn btn-default image-360" data-toggle="modal" data-target="#exampleModal" data-image="{{ asset('assets/images/3d1.jpg') }}">
                Hình ảnh 3D
            </button>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <!-- <img src="images/product-details/new.jpg"  alt="" /> -->
            <h2>{{ $product->sp_ten }}</h2>
            <p>Mã số ID: {{ $product->sp_id }}</p><i class="fa fa-eye"> {{ $view }} </i><br>
            <div class="fb-share-button" data-href="{{ $url }}"      data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
            <ul class="list-inline" title="Average Rating">
                @php
                    $rating = $product->comment()->avg('bl_sosao');
                    $price = $product->price()->first();
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
            <img src="images/product-details/rating.png" alt="" />

            <span>
                 @if(isset($product->discount->km_hinhanh))
                    <?php
                    $new_price = $price->pivot->giabanra - ($price->pivot->giabanra*$product->discount->km_giamgia)/100
                    ?>
                    <span>{{ number_format($new_price) }} VND</span>
                @else
                    <span>{{ number_format($price->pivot->giabanra) }} VND</span>
                @endif
                <label>Số lượng:</label>
                <input name="quantity" class="qty-product" type="number" min="1" value="1" /><br>
                <input name="productid_hidden" class="id-product" type="hidden" value="{{ $product->sp_id }}"/><br>
                <input name="nccid_hidden" class="id-ncc" type="hidden" value="{{ $product->ncc->ncc_id }}"/><br>
                @if($quantityProduct > 0)
                <button type="submit" class="btn btn-fefault add-cart" data-url="{{ route('product.addCart') }}" data-qty="{{ $quantityProduct }}">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm giỏ hàng
                </button><br>
                @endif 
                
            </span>
            <div class="row" style="padding-top : 20px; padding-left : 20px">
                    @if($quantityProduct > 0)
                    <p class="text-success"><b>Tình trạng:</b> Còn hàng {{ $quantityProduct }}</p>
                    @else
                    <p class="text-danger"><b>Tình trạng:</b> Hết hàng </p>
                    @endif
                    <p><b>Trạng thái:</b> Mới nhất</p>
                    <p><b>Thương hiệu:</b> {{ $product->brand->th_ten }}</p>
                    <div class="voucher">
                        @if($voucher->isEmpty() != true)
                            <p><b class="voucher-title">Nhận các khuyến mãi đặc biệt</b></p>
                            @foreach ($voucher as $item )
                                <p><i class="fa fa-check" style="color: green"></i> <b class="voucher-name">{{ $item->mgg_ten }}({{ $item->mgg_macode  }})</b>:{{ $item->mgg_mota }}</p>
                            @endforeach
                        @endif
                    </div>
                    
            </div>
           
            
        </div><!--/product-information-->
        
    </div>
</div><!--/product-details-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hình ảnh 3d của sản phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="wrapper">
        <div id="threesixty"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addWishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>