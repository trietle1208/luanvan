@extends('layouts.master')
@section('title')
    <title>Loại sản phẩm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('home/home.js') }}">
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('components.side-bar')

                <div class="col-sm-9 padding-right">

                    <div class="row">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">SẢN PHẨM THEO LOẠI</h2>
                            <style>
                                .para_detail {
                                    padding: 10px;
                                    margin: 5px 10px 5px 0px;
                                    border-style: solid;
                                    border-color: #E8E8E8;
                                    border-width: 1px;
                                    border-radius: 10px;
                                    display: inline-block;
                                    cursor: pointer;
                                }

                                .para_detail:hover {
                                    background-color: #D2CECE;
                                }

                                .para_detail_choose {
                                    padding: 10px;
                                    margin: 5px 10px 5px 0px;
                                    border-style: solid;
                                    border-color: #E8E8E8;
                                    border-width: 1px;
                                    border-radius: 10px;
                                    display: inline-block;
                                    cursor: pointer;
                                    background-color: #AEBEEA;
                                }
                            </style>
                            @if(!empty($products))
                                <div class="type" data-type="{{ $id }}" style="padding-left: 15px">
                                    <strong style="color: #1d75b3" >BỘ LỌC SẢN PHẨM</strong>
                                    @foreach($type->parameter as $para)
                                        <h5><strong style="color: #1b4b72">{{ $para->ts_tenthongso }}</strong></h5>
                                        @foreach($para->detail_para->unique('chitietthongso') as $detail)
                                            <div class="para_detail" data-url="{{ route('fillterPara') }}" >
                                                <input type="checkbox" hidden class="value_para" value="{{ $detail->chitietthongso }}">
                                                <span>{{ $detail->chitietthongso }}</span>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                                <div class="all_product_type">
                                    @foreach($products as $product)
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
                                                                <button
                                                                    data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                                                    class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                                                    </i>Thêm giỏ hàng
                                                                </button>
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
                                                                <button
                                                                    data-id="{{ $product->sp_id }}" data-key="{{ $product->ncc->ncc_id }}" data-qty="1" data-url="{{ route('product.addCart') }}"
                                                                    class="btn btn-default add-to-cart add-to-cartAjax"><i class="fa fa-shopping-cart">
                                                                    </i>Thêm giỏ hàng
                                                                </button>
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
                                </div>
                        </div><!--features_items-->
                    </div>
{{--                    <div class="row text-center">--}}
{{--                        <ul class="pagination">--}}
{{--                            <li class="active"><a href="">1</a></li>--}}
{{--                            <li><a href="">2</a></li>--}}
{{--                            <li><a href="">3</a></li>--}}
{{--                            <li><a href="">&raquo;</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                    @else
                        <div class="row text-center">
                            <p>Hiện chưa có sản phẩm!!!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addWishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
    <div class="modal fade" id="quickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    </div>
@endsection

