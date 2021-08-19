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
    </body>
</html>
