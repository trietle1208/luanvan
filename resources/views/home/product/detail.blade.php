@extends('layouts.master')
@section('title')
    <title>Chi tiết sản phẩm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home1/home.css') }}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('home1/home.js') }}">
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('components.side-bar-basic')

                <div class="col-sm-9 padding-right">

                    @include('home.components.product.detail')

                    @include('home.components.product.detail-tab')

                    @include('home.components.product.desc')

                    @include('home.components.product.recommnet')
                </div>
            </div>
        </div>
    </section>


@endsection

