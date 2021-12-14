<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <style>
            .lSSlideOuter .lSPager .lSGallery img {
                display: block;
                height: 140px;
                max-width: 100%;
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
            <button type="button" class="btn btn-primary image-360" data-toggle="modal" data-target="#exampleModal" data-image="{{ asset('assets/images/3d1.jpg') }}">
                Launch demo image 3D
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
                    @if($voucher->isEmpty() != true)
                        <p><b>Nhận các khuyến mãi đặc biệt</b></p>
                        @foreach ($voucher as $item )
                            <p><i class="fa fa-check" style="color: green"></i> <b>{{ $item->mgg_ten }}({{ $item->mgg_macode  }})</b>.{{ $item->mgg_mota }}</p>
                        @endforeach
                    @endif
            </div>
           
            
        </div><!--/product-information-->
        
    </div>
</div><!--/product-details-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="wrapper">
        <h1>ThreeSixty.js</h1>
        <div id="threesixty"></div>
        <div class="buttons-wrapper">
            <button class="button" id="prev">Prev</button>
            <button class="button" id="next">Next</button>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addWishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>