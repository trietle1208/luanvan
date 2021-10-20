@extends('layouts.master')
@section('title')
    <title>Tìm kiếm sản phẩm</title>
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
                        <div class="features_items fill"><!--features_items-->
                            <h2 class="title text-center">KẾT QUẢ TÌM KIẾM</h2>
                            @if(isset($products))
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
                                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                                        @else
                                                            <img src="{{ $product->sp_hinhanh }}" style="width: 250px; height: 250px" alt="" />
                                                            <h2>{{ number_format($product->sp_giabanra) }} VND</h2>
                                                            <p>{{ $product->sp_ten }}</p>
                                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="choose">
                                                    <ul class="nav nav-pills nav-justified">
                                                        <li><a href=""><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                                                        <li><a href=""><i class="fa fa-plus-square"></i>So sánh</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                                <div class="row text-center">
                                    <ul class="pagination">
                                        <li class="active"><a href="">1</a></li>
                                        <li><a href="">2</a></li>
                                        <li><a href="">3</a></li>
                                        <li><a href="">&raquo;</a></li>
                                    </ul>
                                </div>
                        </div><!--features_items-->
                    </div>
                    @else
                        <div class="row text-center">
                            <p>Hiện chưa có sản phẩm!!!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


@endsection

