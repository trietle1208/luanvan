<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Thông số chi tiết</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Thông tin nhà cung cấp</a></li>
            <li><a href="#tag" data-toggle="tab">Tag</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá sản phẩm</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details" >
            <div class="col-sm-6">
                <h4 class="text-center">THÔNG SỐ KỸ THUẬT</h4>

                <span><b>THƯƠNG HIỆU :</b> {{ $product->brand->th_ten }}.</span><br><br>
                <span><b>BẢO HÀNH :</b> {{ $product->sp_thoigianbaohanh }} tháng.</span><br><br>
                <span><b>CẤU HÌNH CHI TIẾT</b></span><br><br>
                @foreach($product->para as $para)
                    @foreach($product->detail as $detail)
                        @if($para->ts_id == $detail->ts_id)
                        <span class=""><b>{{ $para->ts_tenthongso }} :</b>{{ $detail->chitietthongso }}</span><br><br>
                        @endif
                    @endforeach
                @endforeach
{{--                @foreach($product->detail as $detail)--}}
{{--                    --}}
{{--                @endforeach--}}
            </div>

        </div>

        <div class="tab-pane fade" id="companyprofile" >
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <span><b>Tên nhà cung cấp :</b> {{ $product->ncc->ncc_ten }}</span><br>
                    <span><b>Địa chỉ :</b>  {{ $product->ncc->ncc_diachi }}</span><br>
                    <span><b>Mô tả :</b> {{ $product->ncc->ncc_mota }}</span><br>
                    <span><b>Số điện thoại liên hệ :</b> {{ $product->ncc->ncc_sdt }}</span><br>
                </div>
                <div class="col-sm-6">
                    <img src="{{ $product->ncc->ncc_hinhanh }}" class="img-fluid" style="width: 300px; height: 150px">
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="tag" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div><!--/category-tab-->
