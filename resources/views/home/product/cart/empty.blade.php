@extends('layouts.master')
@section('title')
    <title>Giỏ hàng</title>
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

                <div class="col-sm-9 padding-right">
                    <div class="row">
                        <section id="cart_items">
                            <div class="container">
                                <div class="breadcrumbs">
                                    <ol class="breadcrumb">
                                        <li><a href="{{ route('trangchu') }}">Trang chủ</a></li>
                                        <li class="active">Giỏ hàng</li>
                                    </ol>
                                </div>
                                <h3 class="text-center">Giỏ hàng của bạn hiện đang trống, hãy mua sắm thôi nào!</h3>
                                <img src="{{ asset('assets/images/cart1.png') }}" style="width: 400px; height: 400px; margin-left: 350px;" class="img-fluid">
                            </div>
                        </section>
                    </div>
                </div>
            </div>
         </div>
    </section>
@endsection

