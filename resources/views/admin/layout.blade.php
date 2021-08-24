<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- Plugins css -->
        <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('assets/css/config/default/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('assets/css/config/default/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="{{ asset('assets/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="{{ asset('assets/css/config/default/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

        <!-- icons -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <!-- body start -->
    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">
             <!-- Topbar Start -->
            @include('admin.component.top-bar')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.component.side-bar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                    @yield('content')
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                @include('admin.component.footer')
                <!-- end Footer -->
            </div>
        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        @include('admin.component.right-bar')

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- Plugins js-->
        <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>

        <!-- Dashboar 1 init js-->
        <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>

        <!-- App js-->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace('detail_product');
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--        CHANGE-STATUS-USER--}}
        <script>
            $(document).ready(function (){
                $('.change-status').click(function (){
                    var id = $(this).data('id');
                    var that = $(this);
                    var status = $('#status_' + id).val();
                    $.ajax({
                        url : '{{ route('admin.account.ajax') }}',
                        method : 'GET',
                        data :{
                            'id':id,
                            // '_token':$('input[name="_token"]').val()
                        },
                        success:function (data){
                            if(data == 'Đã duyệt'){
                                that.removeClass('btn-info').addClass('btn-success').html(data);
                            }
                            else if(data == 'Duyệt'){
                                that.removeClass('btn-success').addClass('btn-info').html(data);
                            }
                        }
                    })
                })
            })
        </script>
{{--    FILLTER BY TYPE--}}
        <script>
            var id = $('.select_type_product').val();
            var idProduct = $('.select_type_product').data('id');
            load_type(id, idProduct);
            function load_type(id, idProduct)
            {
                $.ajax({
                    url: '{{ route('sup.product.ajax') }}',
                    method : 'GET',
                    data : {
                        'id':id,
                        'idProduct':idProduct
                    },
                    success:function (data)
                    {
                        $('.para').html(data);
                    }
                })
            }
            $(document).ready(function (){
                $('.select_type').change(function (){
                    var id = $(this).val();
                    var idProduct = $('.select_type_product').data('id');
                    load_type(id, idProduct);
                })
            })
        </script>
{{--    FILLTER BY TYPE--}}

{{--    CHECKBOX PARA--}}
        <script>
            $(document).ready(function (){
                $(document).on('click','.thongso', function () {
                    var key_check = $(this).data('key');
                    var chitiet = $('.chitiet');
                        if(this.checked) {
                            for (let i = 0; i < chitiet.length; i++) {
                                if (key_check == $(chitiet[i]).data('key')) {
                                    $(chitiet[i]).removeAttr('readonly');
                                }
                            }
                        }
                        else {
                            for (let i = 0; i < chitiet.length; i++) {
                                if (key_check == $(chitiet[i]).data('key')) {
                                    $(chitiet[i]).attr('readonly','readonly');
                                    $(chitiet[i]).val('');
                                }
                            }
                        }
                })
            })
        </script>

{{--    CHECKBOX PARA--}}

{{--    FILTER PRODUCT--}}
        <script>
            $(document).ready(function (){
                $('.select-cate').change(function (){
                    var id = $(this).val();
                    $.ajax({
                        url: '{{ route('sup.receipt.selectCate', ['param' => 'cate']) }}',
                        method : 'GET',
                        data : {
                            'id' : id,
                        },
                        success:function (data)
                        {
                            $('.result-product').html(data);
                        }
                    })
                });
                $('.select-brand').change(function (){
                    var id = $(this).val();
                    $.ajax({
                        url: '{{ route('sup.receipt.selectCate', ['param' => 'brand']) }}',
                        method : 'GET',
                        data : {
                            'id' : id,
                        },
                        success:function (data)
                        {
                            $('.result-product').html(data);
                        }
                    })
                })
            })
        </script>
{{--    FILTER PRODUCT--}}

{{--    CHECKBOX PRODUCT--}}
        <script>
            $(document).ready(function (){
                $(document).on('click','.product', function (){
                    var key_check = $(this).data('id');
                    var quantity = $('.quantity');
                    var price = $('.price');
                    if(this.checked){
                        for (let i = 0; i < quantity.length; i++) {
                            if(key_check == $(quantity[i]).data('id')) {
                                $(quantity[i]).removeAttr('readonly');

                            }
                        }
                        for (let i = 0; i < price.length; i++) {
                            if(key_check == $(price[i]).data('id')) {
                                $(price[i]).removeAttr('readonly');
                            }
                        }
                    }else {
                        for (let i = 0; i < quantity.length; i++) {
                            if(key_check == $(quantity[i]).data('id')) {
                                $(quantity[i]).attr('readonly','readonly');
                                $(quantity[i]).val('');
                            }
                        }

                        for (let i = 0; i < price.length; i++) {
                            if(key_check == $(price[i]).data('id')) {
                                $(price[i]).attr('readonly','readonly');
                                $(price[i]).val('');
                            }
                        }
                    }
                })
            })
        </script>

{{--    CHECKBOX PRODUCT--}}

{{--    ADD PRODUCT--}}
        <script>
            $(document).on('click','.addProduct', function () {
                var key_check = $('.product:checked');
                var arr_quantity = new Array();
                var arr_price = new Array();
                var arr_idsp = new Array();
                for (let i = 0; i < key_check.length; i++) {
                    arr_idsp.push($(key_check[i]).parent().find('input[name="product[]"]').val());
                    arr_quantity.push($(key_check[i]).parent().find('input[name="quantity[]"]').val());
                    arr_price.push($(key_check[i]).parent().find('input[name="price[]"]').val());
                }
                $.ajax({
                    url: '{{ route('sup.receipt.addProduct') }}',
                    method : 'GET',
                    data : {
                        'arr_idsp' : arr_idsp,
                        'arr_quantity' : arr_quantity,
                        'arr_price' : arr_price,
                    },
                    success:function (data)
                    {
                        $('.sum').val(data);
                        $('.result-product').html("");
                        $('.select-cate option').removeAttr('selected');
                        $('.select-cate option:first-child').attr('selected','selected');
                    }
                })
            })
        </script>

{{--    ADD PRODUCT--}}

{{--    CHECK QUANTITY--}}
        <script>
            $(document).on('change','.quantity', function (){
                var soluong = $(this).val();
                var idsp = $(this).parent().find('input[name="product[]"]').val();

                $.ajax({
                    url: '{{ route('sup.receipt.checkQuantity') }}',
                    method : 'GET',
                    data : {
                        'soluong' : soluong,
                        'idsp' : idsp,
                    },
                    success:function (data)
                    {
                        if(data == 0) {
                            alert('Vui lòng nhập số lượng nhỏ hơn số lượng còn lại trong kho!!!');
                        }
                    }
                })
            })
        </script>
{{--    CHECK QUANTITY--}}

{{--        CHECK NAME CATE--}}
        <script>
            $(document).on('change','.name-cate', function () {
                var name = $(this).val();
                $.ajax({
                    url: '{{ route('admin.cate.check') }}',
                    method : 'GET',
                    data : {
                        'name' : name,
                    },
                    success:function (data)
                    {
                        if(data == 1) {
                            alert('Tên danh mục đã được sử dụng');
                            $('.name-cate').val('');
                        }
                    }
                })
            })
        </script>
{{--        CHECK NAME CATE--}}
{{--        DELETE AJAX CATE--}}
    <script>
        function deleteCate(e) {
            e.preventDefault();
            var urlRequest = $(this).data('url');
            var that = $(this);
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa danh mục này không?',
                text: "Bạn sẽ không thể khôi phục lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, tôi đồng ý!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type : 'GET',
                        url : urlRequest,
                        success : function (data) {
                            if(data.code == 200) {
                                that.parent().parent().remove();
                                Swal.fire(
                                    'Đã xóa',
                                    'Danh mục bạn chọn đã được xóa',
                                    'success'
                                )
                            }
                        },
                        error : function () {

                        }
                    })
                }
            })
        }

        $(function () {
            $(document).on('click','.delete-cate',deleteCate);
        })
    </script>
{{--        DELETE AJAX CATE--}}
{{--        DELETE AJAX BRAND--}}
    <script>
        function deleteBrand(e) {
            e.preventDefault();
            var urlRequest = $(this).data('url');
            var that = $(this);
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa thương hiệu này không?',
                text: "Bạn sẽ không thể khôi phục lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, tôi đồng ý!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type : 'GET',
                        url : urlRequest,
                        success : function (data) {
                            if(data.code == 200) {
                                that.parent().parent().remove();
                                Swal.fire(
                                    'Đã xóa',
                                    'Thương hiệu bạn chọn đã được xóa',
                                    'success'
                                )
                            }
                        },
                        error : function () {

                        }
                    })
                }
            })
        }

        $(function () {
            $(document).on('click','.delete-brand',deleteBrand);
        })
    </script>
{{--        DELETE AJAX BRAND--}}
    </body>
</html>
