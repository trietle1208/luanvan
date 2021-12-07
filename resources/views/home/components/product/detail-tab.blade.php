<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Thông số chi tiết</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Thông tin nhà cung cấp</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá sản phẩm</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details">
            <div class="col-sm-6">
                <div style="padding-left: 40px">
                    <span><b>THƯƠNG HIỆU :</b> {{ $product->brand->th_ten }}</span><br><br>
                    <span><b>BẢO HÀNH :</b> {{ $product->sp_thoigianbaohanh }} tháng.</span><br><hr>
                    <span><img src="{{ $product->brand->th_hinhanh }}" style="width: 300px; height: 150px"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <span><strong>CẤU HÌNH CHI TIẾT</strong></span><br><br>
                @foreach($product->para as $para)
                @foreach($product->detail as $detail)
                @if($para->ts_id == $detail->ts_id)
                <span class=""><b>{{ $para->ts_tenthongso }} :</b> {{ $detail->chitietthongso }}</span>
                <hr>
                @endif
                @endforeach
                @endforeach
            </div>

        </div>

        <div class="tab-pane fade" id="companyprofile">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <span><b>Tên nhà cung cấp :</b> {{ $product->ncc->ncc_ten }}</span><br>
                    <span><b>Địa chỉ :</b> {{ $product->ncc->ncc_diachi }}</span><br>
                    <span><b>Mô tả :</b> {{ $product->ncc->ncc_mota }}</span><br>
                    <span><b>Số điện thoại liên hệ :</b> {{ $product->ncc->ncc_sdt }}</span><br>
                </div>
                <div class="col-sm-6">
                    <!-- <img src="{{ $product->ncc->ncc_hinhanh }}" class="img-fluid" style="width: 300px; height: 150px"> -->
                    <span><b>Nhận các khuyến mãi đặc biệt</b></span><br>
                    @foreach ($voucher as $item )
                        <span><i class="fa fa-check" style="color: green"></i> <b>{{ $item->mgg_ten }}({{ $item->mgg_macode  }})</b>.{{ $item->mgg_mota }}</span><br>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="tab-pane fade active in" id="reviews">
            <div class="col-sm-12 showComment">
                <style>
                    .comment {
                        margin-bottom: 20px;
                        padding: 10px 0px 0px 10px;
                        
                    }
                    .comment p{
                       font-size: 17px;
                    }
                    .comnent-rep {
                        padding-left: 50px;

                    }

                    .comnent-rep p {
                        font-size: 17px;
                    }
                    .comnent-rep p {
                        padding-left: 60px;
                    }

                    .form-repComment {
                        padding-left: 50px;
                    }

                    .avatar {
                        border-radius: 50%;
                    }

                    .repComment button {
                        border-radius: 12px;
                    }
                    
                    .card {
                        border-radius: 5px;
                        background-color: #fff;
                        padding-left: 60px;
                        padding-right: 60px;
                    }
                    .rating-box {
                        width: 150px;
                        height: 125px;
                        margin-right: auto;
                        margin-left: auto;
                        background-color: #FBC02D;
                        color: #fff
                    }

                    .rating-box h1{
                        font-size: 50px;
                        padding: 40px;
                        /* margin: 0 auto; */
                    }

                    
                    .rating-label {
                        font-weight: bold
                    }
                    .bar {
                        padding-top : 10px;
                    }
                    .rating-bar {
                        width: 300px;
                        padding: 8px;
                        border-radius: 5px
                    }
                    .bar-star{
                        padding-left: 30px;
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

                    .star-active {
                        font-size: 20px;
                        padding-left: 5px;
                        color: #FBC02D;
                        margin-top: 10px;
                        margin-bottom: 10px
                    }

                    .star-active:hover {
                        color: #F9A825;
                        cursor: pointer
                    }

                    .star-inactive {
                        font-size: 20px;
                        padding-left: 5px;
                        color: #CFD8DC;
                        margin-top: 10px;
                        margin-bottom: 10px
                    }
                    
                </style>
                <div class="card">
                    <div class="row justify-content-left d-flex">
                        <div class="col-md-4 d-flex flex-column">
                            <div class="rating-box">
                                @php
                                    $rating = $product->comment()->avg('bl_sosao');
                                    $rating = round($rating);
                                @endphp
                                <h1 class="pt-4">{{ $rating }}.0</h1>
                                <!-- <p class="">out of 5</p> -->
                            </div>
                            <div class="bar-star"> 
                                <span class="fa fa-star {{ $rating == 1 ||  $rating == 2 ||  $rating == 3 || $rating == 4 || $rating == 5 ? 'star-active' : 'star-inactive' }} mx-1"></span>
                                <span class="fa fa-star {{ $rating == 2 ||  $rating == 3 || $rating == 4 || $rating == 5 ? 'star-active' : 'star-inactive' }} mx-1"></span>
                                <span class="fa fa-star {{ $rating == 3 || $rating == 4 || $rating == 5 ? 'star-active' : 'star-inactive' }} mx-1"></span>
                                <span class="fa fa-star {{ $rating == 4 || $rating == 5 ? 'star-active' : 'star-inactive' }} mx-1"></span>
                                <span class="fa fa-star {{ $rating == 5 ? 'star-active' : 'star-inactive' }} mx-1"></span>
                            </div>
                        </div>
                        <div class="col-md-8 bar">
                            <div class="rating-bar0 justify-content-center">
                                <table class="text-left mx-auto">
                                    <tr>
                                        <td class="rating-label">Rất tốt</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width: {{ $count == 0 ? 0 : ($star_5/$count)*100  }}%;"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">{{ $star_5 }} đánh giá</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Tôt</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-4" style="width: {{ $count == 0 ? 0 : ($star_4/$count)*100  }}%;"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">{{ $star_4 }} đánh giá</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Ổn</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-3" style="width: {{ $count == 0 ? 0 : ($star_3/$count)*100  }}%;"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">{{ $star_3 }} đánh giá</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Tệ</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-2" style="width: {{ $count == 0 ? 0 : ($star_2/$count)*100  }}%;"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">{{ $star_2 }} đánh giá</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Rất tệ</td>
                                        <td class="rating-bar">
                                            <div class="bar-container">
                                                <div class="bar-1" style="width: {{ $count == 0 ? 0 : ($star_1/$count)*100  }}%;"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">{{ $star_1 }} đánh giá</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @if(isset($comments))
                @foreach($comments as $comment)
                <div class="comment comment_{{ $comment->bl_id }}">
                    <ul>
                        <li><img src="{{ $comment->customer->kh_hinhanh ?? asset('assets/images/avt_null.jpg')}}" style="width: 50px; height: 50px" class="img-fluid avatar"></li>
                        <li><a href="">{{ $comment->customer->kh_hovaten }}</a></li>
                        <li><a href=""><i class="fa fa-clock-o"></i>{{ $comment->created_at->diffForHumans() }}</a></li>
                        <li><a href=""><i class="fa fa-calendar-o"></i>{{ $comment->created_at->toDateString() }}</a></li>
                    </ul>
                    <ul class="list-inline" title="Average Rating">
                        @for($count = 1; $count<=5; $count++) 
                            @php 
                            if($count<=$comment->bl_sosao){
                                $color = 'color:#ffcc00;';
                                }
                                else{
                                $color = 'color:#ccc;';
                                }
                            @endphp
                            <li title="đánh giá sao"
                                style="cursor:pointer; {{ $color }} font-size: 20px;">
                                &#9733;
                            </li>
                        @endfor
                    </ul>
                    <p>{{ $comment->bl_noidung }}</p>
                    @if($comment->bl_hinhanh != null)
                    <img src="{{ $comment->bl_hinhanh}}" style="width: 300px; height: 200px"><br>
                    @endif
                    <?php
                    $id = Illuminate\Support\Facades\Session::get('customer_id');
                    ?>
                    @if(isset($id))
                    <button type="button" class="repComment snip1582" data-id="{{ $comment->bl_id }}">Trả lời</button>
                    @endif
                    @php
                    $reps = \App\Models\Comment::where('bl_idcha',$comment->bl_id)->get();
                    @endphp

                    <div class="comnent-rep comnent-rep_{{ $comment->bl_id }}">
                        @if(isset($reps))
                        @foreach($reps as $rep)
                        <ul>
                            <li><img src="{{ $rep->admin->info->tt_hinhanh ?? $rep->customer->kh_hinhanh ?? asset('assets/images/avt_null.jpg') }}" style="width: 50px; height: 50px" class="img-fluid avatar"></li>
                            <li><a href=""></i>{{ $rep->admin->name ?? $rep->customer->kh_hovaten }}</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>{{ $rep->created_at->diffForHumans() }}</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>{{ $rep->created_at->toDateString() }}</a></li>
                        </ul>
                        <p>{{ $rep->bl_noidung }}</p>
                        @endforeach
                        @endif
                    </div>
                    <div class="form-repComment form-repComment_{{ $comment->bl_id }}" style="display : none">
                        <form action="{{ route('customer.repComment') }}" method="POST">
                            @csrf
                            <input type="hidden" class="token_{{ $comment->bl_id }}" name="_token" value="{{ csrf_token() }}">
                            <textarea rows="4" cols="50" class="textRepComment_{{ $comment->bl_id }}" placeholder="Viết bình luận cho sản phẩm"></textarea>
                            <button type="button" class="btn btn-default sendComment" data-id="{{ $comment->bl_id }}" data-url="{{ route('customer.repComment') }}" data-key="{{ Session::get('admin_id') }}" data-product="{{ $product->sp_id }}" data-kh="{{ Session::get('customer_id') }}">
                                Gữi phản hồi
                            </button>
                            <button type="button" class="btn btn-default closeRepcomment" data-id="{{ $comment->bl_id }}">
                                Đóng
                            </button>
                        </form>
                    </div>

                </div>
                @endforeach
                @else
                <strong class="text-center">Sản phẩm hiện chưa có bình luận</strong>
                @endif
            </div>
            <hr>
            <div style="margin-top: 15px";>
                @if(Session::get('customer_id'))
                <form id="addComment" action="{{ route('customer.addComment') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4>Bình Luận Về Sản Phẩm</h4>
                    <input type="hidden" value="{{ csrf_token() }}">
                    <input type="hidden" class="addRating" value="0">
                    <textarea class="textComment" placeholder="Viết bình luận cho sản phẩm"></textarea>
                    <b>Đánh giá sao: </b> <img src="images/product-details/rating.png" alt="" />
                    <ul class="list-inline" title="Average Rating">
                        @for($count = 1; $count<=5; $count++) 
                            @if(isset($rating)) 
                                @php $rating=$rating; 
                                    if($count<=$rating)
                                    { $color='color:#ffcc00;' ; }
                                    else
                                    { $color='color:#ccc;' ; } 
                                @endphp 
                            @else 
                                @php $rating=0; 
                                    if($count<=$rating){ $color='color:#ffcc00;' ; }
                            else{ $color='color:#ccc;' ; } 
                                @endphp 
                            @endif 
                            <li title="đánh giá sao" id="{{ $product->sp_id }}-{{ $count }}" data-index="{{ $count }}" data-rating="{{ $rating }}" data-product="{{ $product->sp_id }}" data-customer="{{ Session::get('customer_id') }}" data-url="{{ route('customer.addComment') }}" class="rating" style="cursor:pointer; {{$color}} font-size: 30px;">
                            &#9733;
                            </li>
                        @endfor
                    </ul>
                    <input type="file" name="image"><br>
                    <button type="submit" class="btn btn-default snip1582">
                        Gữi bình luận
                    </button>
                </form>
                @else
                <strong>Vui lòng đăng nhập vào hệ thống để được bình luận, nếu chưa có tài khoản hãy đăng kí !!!</trong><br>
                <a href="{{ route('customer.index') }}" class="modalLogin">Đăng kí tại đây</a>
                @endif
            </div>
        </div>
    </div>
</div>
<!--/category-tab-->