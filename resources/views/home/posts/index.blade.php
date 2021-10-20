@extends('layouts.master')
@section('title')
    <title>Tin tức</title>
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
                            <h2 class="title text-center">{{ $posts->dmbv_ten }}</h2>
                        </div>
                    </div>
                    @foreach($posts->posts as $post)
                        <div class="row" style="padding-bottom: 40px">
                            <div class="col-sm-6">
                                <img src="{{ $post->bv_hinhanh }}" style="width: 400px ; height: 250px">
                            </div>
                            <div class="col-sm-6">
                                <h3 style="margin: 0"><strong>{{ $post->bv_ten }}</strong></h3>
                                <p>{!! $post->bv_tomtat !!}</p>
                                <button class="btn btn-default showPosts" data-id="{{ $post->bv_id }}" data-url="{{ route('posts.showPosts') }}">Xem bài viết</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="baiviet1" tabindex="-1" role="dialog" >

    </div>
@endsection

