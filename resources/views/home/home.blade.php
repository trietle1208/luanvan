@extends('layouts.master')
@section('title')
    <title>Home | E-Shopper</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home1/home.css') }}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('home1/home.js') }}">
@endsection

@section('content')


    @include('home.components.slider')

    <section>
        <div class="container">
            <div class="row">
            @include('components.side-bar')

                <div class="col-sm-9 padding-right">

                    @include('home.components.feature-item')

                    @include('home.components.category-tab')

                    @include('home.components.recomment')

                </div>
            </div>
        </div>
    </section>


@endsection

