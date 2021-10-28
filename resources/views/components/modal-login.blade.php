<!-- CSS modal -->
<style>
    .social_login {
        text-align: center;
    }
    .social_log{
        list-style: none;
        display: flex;
        padding: 0;
        justify-content: center;

    }
    .social_log li {
        margin : 0 6px;
    }
    .social_log li img{
        height: 40px;
        width: 40px;
    }

    .social_login p {
        color: #8c8c8c;
    }

    .signin_modal .nav-tabs .nav-link {
        background-color: #e5e5e5;
        border-radius: 0;
        font-weight: 400;
        border-color: #fff;
    }

    .signin_modal .nav-tabs .nav-item {
        width: 50%;
        margin-bottom: 1rem;
        text-align: center;
    }

    .signin_modal .nav-tabs {
        border-bottom: none;
    }
    .signin_tab {
        padding: 0 3rem;
    }
    .signin_tab input.form-control {
        font-size: 12px;
        color: #8c8c8c;
        height : 40px;
    }

    .signin_link {
        text-align: center;
        color: #8c8c8c;
        margin-top: 0.5rem;
    }
</style>
<!-- CSS modal -->
<!-- Modal Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="modalLogin">Đăng nhập vào hệ thống</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body signin_modal">    
                <div class="social_login">
                    <p>Đăng nhập với các tài khoản mạng xã hội</p>
                    <ul class="social_log">
                        <li><a href="{{ route('customer.loginGoogle') }}"><img src="{{ asset('assets/images/gmail.png') }}"></a></li>
                        <li><a href="{{ route('customer.loginFacebook') }}"><img src="{{ asset('assets/images/fb.png') }}"></a></li>
                        <li><img src="{{ asset('assets/images/gmail.png') }}"></li>
                    </ul>
                    <p>Hoặc</p>
                </div>
                <div class="signin_tab">
                    <div id="loginForm" style="display: block ; cursor : pointer">
                        <form action="{{ route('customer.login') }}" method="POST" id="btnLogin">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tài khoản Email</label>
                                <input type="email" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập vào tài khoản Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập vào mật khẩu">
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Đăng nhập</button>
                            <p class="signin_link">Bạn chưa có tài khoản? <a class="toRegister">Đăng kí tại đây</a></p> 
                        </form>
                    </div>
                    <div id="regiterForm" style="display: none ; cursor : pointer">
                        <style>
                            .alert-error {
                                background-color : #f8d7da;
                            }
                        </style>
                        <div class="errors">

                        </div>
                        <form action="{{ route('customer.register') }}" method="POST" id="btnRegister">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Họ và tên</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập vào họ và tên">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tài khoản Email</label>
                                <input type="email" name="kh_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập vào tài khoản Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Nhập vào mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập vào số điện thoại">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Giới tính</label>
                                <select class="form-control" name="sex" required>
                                    <option value="">--- Chọn giới tính ---</option>
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ngày sinh</label>
                                <input type="date" name="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập vào tài khoản Email">
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Đăng kí</button>
                            <p class="signin_link">Bạn đã có tài khoản? <a class="toLogin">Đăng nhập tại đây</a></p> 
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal Login -->