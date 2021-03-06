@extends('layouts.master')
@section('title')
    <title>Home | E-Shopper</title>
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

                    <section id="form"><!--form-->
                        <div class="container">
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="signup-form"><!--sign up form-->
                                        <h2>Tạo tài khoản mới</h2>
                                        <form action="{{ route('customer.register') }}" method="POST">
                                            @csrf
                                            <input type="text" name="name" required placeholder="Điền vào họ và tên"/>
                                            <input type="email" name="email" required placeholder="Điền vào địa chỉ email"/>
                                            <input type="password" name="pass" required placeholder="Điền vào mật khẩu"/>
                                            <input type="text" name="phone" required placeholder="Điền vào số điện thoại"/>
                                            <select name="sex" required>
                                                <option value="">--- Chọn giới tính ---</option>
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                            </select>
                                            <input type="date" name="date" placeholder="Điền vào số điện thoại"/>

                                            <button type="submit" class="btn btn-default mt-3">Đăng kí</button>
                                        </form>
                                    </div><!--/sign up form-->
                                </div>

                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="login-form"><!--login form-->
                                        <h2>Đăng nhập với tài khoản của bạn</h2>
                                        <form action="{{ route('customer.login') }}" method="POST">
                                            @csrf
                                            <input type="email" name="name" required placeholder="Tên tài khoản email" />
                                            <input type="password" required name="password" placeholder="Mật khẩu" />

                                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                                            <style type="text/css">
                                                ul.list-login {
                                                    margin-top: 10px;
                                                    padding: 0;
                                                }

                                                ul.list-login li{
                                                    display: inline;
                                                    margin: 5px;
                                                }
                                            </style>
                                            <ul class="list-login">
                                                <li>
                                                    <a href="{{ route('customer.loginGoogle') }}"><img alt="Đăng nhập bằng Google" src="{{ asset('assets/images/gmail.png') }}" style="width: 40px ; height: 40px"></a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('customer.loginFacebook') }}"><img alt="Đăng nhập bằng Facebook" src="{{ asset('assets/images/fb.png') }}"style="width: 40px ; height: 40px"></a>
                                                </li>
                                            </ul>


                                        </form>
                                    </div><!--/login form-->
                                </div>
                            </div>
                        </div>
                    </section><!--/form-->

                </div>
            </div>
        </div>
    </section>


@endsection

