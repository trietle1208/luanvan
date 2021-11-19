<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Meta tag Keywords -->
    <!-- css files -->
    <link rel="stylesheet" href="{{ asset('login1/css/style.css') }}" type="text/css" media="all" /> <!-- Style-CSS -->
    <link rel="stylesheet" href="{{ asset('login1/css/font-awesome.css') }}"> <!-- Font-Awesome-Icons-CSS -->
    <!-- //css files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- //online-fonts -->
</head>
<body>
<!-- main -->
<div class="center-container">
    <!--header-->
    <div class="header-w3l text-center">
        <h1>Đăng nhập vào hệ thống</h1>
    </div>
    <!--//header-->
    <div class="main-content-agile register" style="display: none">
        <div class="sub-main-w3">
            <form action="{{ route('customer.register') }}" method="POST">
                @csrf
                <div class="pom-agile">
                    <input placeholder="Điền vào họ và tên" name="name" class="user" type="text" >
                </div>
                <div class="pom-agile">
                    <input  placeholder="Điền vào địa chỉ email" name="email" class="pass" type="email" >
                </div>
                <div class="pom-agile">
                    <input placeholder="Điền vào mật khẩu" name="pass" class="user" type="password" >
                </div>
                <div class="pom-agile">
                    <input  placeholder="Điền vào số điện thoại" name="phone" class="pass" type="text" >
                </div>
                <div class="pom-agile">
                    <select name="sex" required>
                        <option value="">--- Chọn giới tính ---</option>
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                </div>
                <div class="pom-agile">
                    <input type="date" name="date" placeholder="Điền vào số điện thoại"/>
                </div>

                <div class="sub-w3l">
                    <div class="right-w3l">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" value="Đăng ký">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="main-content-agile login" style="display: block">
        <div class="sub-main-w3">
            <form action="{{ route('customer.login') }}" method="POST">
                @csrf
                <div class="pom-agile">
                    <input placeholder="E-mail" name="name" class="user" type="email" >
                    <span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                </div>
                <div class="pom-agile">
                    <input  placeholder="Mật khẩu" name="password" class="pass" type="password" >
                    <span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
                </div>
                <br>
                <div>
                    <a href="" class="btn btn-dark"><img alt="Đăng nhập bằng Google" src="{{ asset('assets/images/gmail.png') }}" style="width: 30px ; height: 30px"> Google</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="" class="btn btn-dark"><img alt="Đăng nhập bằng Google" src="{{ asset('assets/images/fb.png') }}" style="width: 30px ; height: 30px"> Facebook</a>
                </div>
                <div class="sub-w3l">
                    <div class="right-w3l">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" value="Đăng nhập">
                    </div>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="" class="registerCustomer" style="color: wheat">Đăng kí tài khoản</a>
            </form>
        </div>
    </div>
    <script src="{{ asset('Eshopper/js/jquery.js') }}"></script>
    <script>
        $(document).on('click','.registerCustomer',function (e){
            e.preventDefault();
            $('.register').css('display','block');
            $('.login').css('display','none');
        })
    </script>
    <!--//main-->
    <!--footer-->
    <!--//footer-->
</div>

</body>

</html>
