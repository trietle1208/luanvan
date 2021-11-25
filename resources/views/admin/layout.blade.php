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

        <!-- third party css -->
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->


        <!-- App css -->
        <link href="{{ asset('assets/css/config/default/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('assets/css/config/default/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="{{ asset('assets/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="{{ asset('assets/css/config/default/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

        <!-- icons -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
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

        /*       @include('admin.component.right-bar')

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        
        
        <!-- Plugins js-->
        <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
        <!-- Dashboar 1 init js-->
        <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>
        <script src="{{ asset('js/ajax/comment.js') }}"></script>
        <!-- Chart -->

        <!-- App js-->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        <script>
            CKEDITOR.replace('detail_product');
            CKEDITOR.replace('desc_product');
            CKEDITOR.replace('desc_posts');
            CKEDITOR.replace('content_posts');
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('js/chart/order.js') }}"></script>
        <script src="{{ asset('js/chart/receipt.js') }}"></script>
        <script src="{{ asset('js/chart/sales.js') }}"></script>
        <script src="{{ asset('js/chart/product.js') }}"></script>
        <script src="{{ asset('js/chartAdmin/order.js') }}"></script>
        <script src="{{ asset('js/admin/account/account.js') }}"></script>
        <script src="{{ asset('js/ajax/shipper.js') }}"></script>
        <script src="{{ asset('js/admin/order/order.js') }}"></script>
        <script src="{{ asset('js/admin/notification/notify.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- third party js -->
        <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
{{--        CHANGE-STATUS-USER--}}
        <script>
            $(document).ready(function (){
                $('.change-status').click(function (){
                    var id = $(this).data('id');
                    var that = $(this);
                    var url = $(this).data('url');
                    var status = $('#status_' + id).val();
                    $.ajax({
                        url : url,
                        method : 'GET',
                        data :{
                            'id':id,
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

        {{--        CHANGE-STATUS-RECEIPT--}}
        <script>
            $(document).ready(function (){
                $('.changeReceipt').click(function (){
                    var id = $(this).data('id');
                    var url = $(this).data('url');
                    var that = $(this);
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn duyệt phiếu này không?',
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
                                url : url,
                                data :{
                                    'id':id,
                                },
                                success : function (data) {
                                    if(data.code == 200) {
                                        that.removeClass('btn-info').addClass('btn-success disabled');
                                        that.text('Đã duyệt');
                                        Swal.fire(
                                            'Đã duyệt',
                                            'Phiếu bạn chọn đã được duyệt',
                                            'success'
                                        )
                                    }
                                },
                                error : function () {

                                }
                            })
                        }
                    })
                })
            })
        </script>
{{--        CHANGE-STATUS-RECEIPT--}}

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
                $('.select-name').keyup(function (){
                    var name = $(this).val();
                    $.ajax({
                        url: '{{ route('sup.receipt.selectCate', ['param' => 'name']) }}',
                        method : 'GET',
                        data : {
                            'name' : name,
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
                        $('.sum').val(data.sum);
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

{{--        CHECK NAME BRAND--}}
        <script>
        $(document).on('change','.name-brand', function () {
            var name = $(this).val();
            $.ajax({
                url: '{{ route('admin.brand.check') }}',
                method : 'GET',
                data : {
                    'name' : name,
                },
                success:function (data)
                {
                    if(data == 1) {
                        alert('Tên thương hiệu đã được sử dụng');
                        $('.name-brand').val('');
                    }
                }
            })
        })
    </script>
{{--        CHECK NAME BRAND--}}

{{--        CHECK NAME SLIDE--}}
        <script>
    $(document).on('change','.name-slide', function () {
        var name = $(this).val();
        $.ajax({
            url: '{{ route('admin.slide.check') }}',
            method : 'GET',
            data : {
                'name' : name,
            },
            success:function (data)
            {
                if(data == 1) {
                    alert('Tên Slide đã được sử dụng');
                    $('.name-slide').val('');
                }
            }
        })
    })
</script>
{{--        CHECK NAME SLIDE--}}

{{--        CHECK NAME SLIDE--}}
    <script>
        $(document).on('change','.name-type', function () {
            var name = $(this).val();
            $.ajax({
                url: '{{ route('admin.type.check') }}',
                method : 'GET',
                data : {
                    'name' : name,
                },
                success:function (data)
                {
                    if(data == 1) {
                        alert('Tên loại đã được sử dụng');
                        $('.name-type').val('');
                    }
                }
            })
        })
    </script>
{{--        CHECK NAME SLIDE--}}
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

{{--        DELETE AJAX SLIDE--}}
        <script>
    function deleteSlide(e) {
        e.preventDefault();
        var urlRequest = $(this).data('url');
        var that = $(this);
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa Slide này không?',
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
                                'Slide bạn chọn đã được xóa',
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
        $(document).on('click','.delete-slide',deleteSlide);
    })
</script>
{{--        DELETE AJAX SLIDE--}}

{{--        DELETE AJAX TYPE--}}
        <script>
    function deleteType(e) {
        e.preventDefault();
        var urlRequest = $(this).data('url');
        var that = $(this);
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa loại này không?',
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
                                'Loại bạn chọn đã được xóa',
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
        $(document).on('click','.delete-type',deleteType);
    })
</script>
{{--        DELETE AJAX TYPE--}}

{{--        DELETE AJAX PARA--}}
        <script>
    function deletePara(e) {
        e.preventDefault();
        var urlRequest = $(this).data('url');
        var that = $(this);
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa thông số này không?',
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
                                'Thông số bạn chọn đã được xóa',
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
        $(document).on('click','.delete-para',deletePara);
    })
</script>
{{--        DELETE AJAX PARA--}}

{{--        DELETE AJAX DISCOUNT--}}
        <script>
            function deletePara(e) {
                e.preventDefault();
                var urlRequest = $(this).data('url');
                var that = $(this);
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa mã khuyến mãi này không?',
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
                                        'Mã khuyến mãi bạn chọn đã được xóa',
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
                $(document).on('click','.delete-discount',deletePara);
            })
        </script>
{{--        DELETE AJAX DISCOUNT--}}

{{--    MODAL AJAX PHIEU NHAP--}}
        <script>
            $(document).on('click','.detail', function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    url: '{{ route('sup.receipt.modal') }}',
                    method : 'GET',
                    data : {
                        'id' : id,
                    },
                    success:function (data)
                    {
                         // $('.modalphieunhap').html(data);
                         $('#chitietphieu').html(data);
                         $('#chitietphieu').modal('show');
                    }
                })
            })
        </script>
{{--    MODAL AJAX PHIEU NHAP--}}

{{--    MODAL AJAX THONG SO --}}
        <script>
            $(document).on('click','.para-detail', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route('admin.para.modal') }}',
                    method : 'GET',
                    data : {
                        'id' : id,
                    },
                    success:function (data)
                    {
                        $('#chitietthongso').html(data);
                        $('#chitietthongso').modal('show');
                    }
                })
            })
        </script>
{{--    MODAL AJAX THONG SO --}}

{{--    MODAL AJAX KHUYEN MAI --}}
        <script>
            $(document).on('click','.product-discount', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route('sup.discount.modal') }}',
                    method : 'GET',
                    data : {
                        'id' : id,
                    },
                    success:function (data)
                    {
                        $('#danhsachsp').html(data);
                        $('#danhsachsp').modal('show');
                    }
                })
            })
        </script>
        <script>
            $(document).on('click','.add-discount',function (e) {
                e.preventDefault();
                var idProduct = $(this).data('id');
                var that = $(this);
                var idDiscount = $(this).data('key');
                $.ajax({
                    url: '{{ route('sup.discount.addProduct') }}',
                    method : 'GET',
                    data : {
                        'idProduct' : idProduct,
                        'idDiscount' : idDiscount,
                    },
                    success:function (data)
                    {
                        if(data.code == 200) {
                            that.parent().parent().remove();
                            $('#succes').html(data.message);
                            $('.deleteProduct').append(data.output);
                        }
                    }
                })
            })
        </script>
        <script>
            $(document).on('click','.deleteProduct-discount',function (e) {
                e.preventDefault();
                var idProduct = $(this).data('id');
                var that = $(this);
                var idDiscount = $(this).data('key');
                $.ajax({
                    url: '{{ route('sup.discount.deleteProduct') }}',
                    method : 'GET',
                    data : {
                        'idProduct' : idProduct,
                        'idDiscount' : idDiscount,
                    },
                    success:function (data)
                    {
                        if(data.code == 200) {
                            that.parent().parent().remove();
                            $('#succes').html(data.message);
                            $('.addProduct').append(data.output);
                        }
                    }
                })
            })
        </script>
        <script>
            $(document).on('click','.changeStatusDiscountOff',function (){
                var that = $(this);
                var id = $(this).data('id');
                var url = $(this).data('url');
                var type = $(this).data('type');

                $.ajax({
                    type : 'GET',
                    url : url,
                    data : {
                        'id' : id,
                        'type' : type,
                    },
                    success : function (data) {
                        if(data.code == 200) {
                            that.css('display','none');
                            that.parents('tr').find('.changeStatusDiscountShow').css('display','block');
                        }
                    }
                })
            });

            $(document).on('click','.changeStatusDiscountShow',function (){
                var that = $(this);
                var id = $(this).data('id');
                var url = $(this).data('url');
                var type = $(this).data('type');

                $.ajax({
                    type : 'GET',
                    url : url,
                    data : {
                        'id' : id,
                        'type' : type,
                    },
                    success : function (data) {
                        if(data.code == 200) {
                            that.css('display','none');
                            that.parents('tr').find('.changeStatusDiscountOff').css('display','block');
                        }
                    }
                })
            });
        </script>
{{--    MODAL AJAX KHUYEN MAI --}}
{{--    MODAL AJAX DON HANG --}}
<script>
    $(document).on('click','.order-detail', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: '{{ route('sup.order.detail') }}',
            method : 'GET',
            data : {
                'id' : id,
            },
            success:function (data)
            {
                // $('#chitietdonhang').html(data);
                // $('#chitietdonhang').modal('show');
                $('#chitietdonhangUblod').html(data);
                $('#chitietdonhangUblod').modal('show');
            }
        })
    })
</script>
{{--    MODAL AJAX DON HANG --}}
{{--    VALIDATE PRODUCT--}}
        <script>
            $(document).on('submit','#add-product', function (e) {
                e.preventDefault();
                var form = new FormData(this);
                var that = $(this);
                $.ajax({
                    url : $(this).attr('action'),
                    type : 'POST',
                    data : form,
                    cache : false,
                    contentType : false,
                    processData : false,
                    success : function (data) {
                        if(data.code == 200) {
                            $('#success').text(data.message);
                            $('#success1').text(data.message);
                            $('#success').addClass('alert alert-success')
                            that[0].reset();
                            CKEDITOR.instances['detail_product'].setData('');
                            CKEDITOR.instances['desc_product'].setData('');
                        }else {
                            $.each(data.errors, function (key, value) {
                                $('.'+key).text(value);
                               $('.error').addClass('alert alert-danger')
                            });
                        }
                    }
                })
            })
        </script>
        <script>
            $(document).on('click','.add-permission',function (e){
                e.preventDefault();
                $.ajax({
                    url : $(this).attr('href'),
                    type : 'GET',
                    success : function (data) {
                        $('#ganquyen').html(data);
                        $('#ganquyen').modal('show');
                    }
                })
            });
        </script>
{{--    ADD PERMISSION FROM ROLE--}}

{{--    ADD PERMISSION FROM ROLE--}}
        <script>
            $(document).on('click','.add-role-account',function (e){
                e.preventDefault();
                $.ajax({
                    url : $(this).attr('href'),
                    type : 'GET',
                    success : function (data) {
                        $('#ganvaitro').html(data);
                        $('#ganvaitro').modal('show');
                    }
                })
            });
        </script>
{{--    ADD PERMISSION FROM ROLE--}}

{{--    SELECT PRODUCT RECEIPT--}}
    <script>
        $(document).on('click','.selectReceipt',function (e){
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            $.ajax({
                type : 'GET',
                url : url,
                data : {
                    'id' : id,
                },
                success : function (data){
                    if(data.code == 200){
                        $('#danhsachsanpham').html(data.output);
                        // $('#sanphamphieunhap').DataTable();
                        $('#danhsachsanpham').modal('show');
                    }
                }
            })
        })
    </script>
    <script>
        $(document).on('click','.addProductReceipt',function (){
            var id = $(this).data('id');
            var that = $(this);
            var url = $(this).data('url');
            var qty = $('.qty_' + id).val();
            var price = $('.price_' + id).val();
            var qty_old = $('.qty_old_' + id).html();
            var intRegex = /^\d+$/;
            if(qty == '' || price == ''){
                alert('Vui lòng nhập đầy đủ số lượng nhập vào và giá gốc trên sản phẩm!')
            }else if(qty > qty_old){
                alert('Vui lòng nhập số lượng nhập vào nhỏ hơn số lượng tồn kho!')
            }else if(!intRegex.test(price) || !intRegex.test(qty)) {
                alert('Giá nhập vào và số lượng của sản phẩm phải là kiểu số!');
            }
            else{
                $.ajax({
                    type : 'GET',
                    url : url,
                    data : {
                        'id' : id,
                        'qty' : qty,
                        'price' : price,
                    },
                    success : function (data) {
                        if(data.code == 200){
                            that.parent().find('.deleteProductReceipt').css('display','block');
                            that.css('display','none');
                            $('.qty_' + id).attr('readonly',true);
                            $('.price_' + id).attr('readonly',true);
                            $('.sum').val(data.sum);
                            $('.select-product').append(data.name);
                        }
                    }
                })
            }
        })
    </script>

    <script>
        $(document).on('click','.deleteProductReceipt',function (){
            var id = $(this).data('id');
            var url = $(this).data('url');
            var that = $(this);
            $.ajax({
                type : 'GET',
                url : url,
                data : {
                    'id' : id,
                },
                success : function (data){
                    if(data.code == 200){
                        {{--that.removeClass().addClass('btn btn-success addProductReceipt')--}}
                        {{--    .attr('data-url','{{ route('sup.receipt.add') }}')--}}
                        {{--    .attr('value',0).text('Thêm');--}}
                        that.parent().find('.addProductReceipt').css('display','block');
                        $('.qty_' + id).val('').attr('readonly',false);
                        $('.price_' + id).val('').attr('readonly',false);
                        that.css('display','none');
                        $('.sum').val(data.sum);

                    }
                }
            })
        })
    </script>

    <script>
        $(document).on('click','.listProductReceipt',function (e){
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');

            $.ajax({
                type : 'GET',
                url : url,
                data : {
                    'id' : id,
                },
                success : function (data) {
                    if(data.code == 200){
                        $('#chitietdanhsach').html(data.output);
                        $('#chitietdanhsach').modal('show');
                    }
                }
            })
        })
    </script>

    <script>
        $(document).on('click','.changeProductReceipt',function (){
            $(this).parents('tr').find('.price').attr('readonly',false);
            $(this).parents('tr').find('.qty').attr('readonly',false);
            $(this).css('display','none');
            $(this).parents('tr').find('.saveProductReceipt').css('display','block');
        })
    </script>

    <script>
        $(document).on('click','.saveProductReceipt',function (){
            var that = $(this);
            var idProduct = $(this).data('product');
            var idReceiptDetail = $(this).data('id');
            var idReceipt = $(this).data('receipt');
            var url = $(this).data('url');
            var qty = $(this).data('qty');
            var intRegex = /^\d+$/;
            var price_up = $(this).parents('tr').find('.price').val();
            var qty_up = $(this).parents('tr').find('.qty').val();
            if(price_up == '' || qty_up == ''){
                alert('Vui lòng không để trống 1 trống 2 mục số lượng và giá nhập vào!');
            }else if(qty_up > qty){
                alert('Vui lòng nhập số lượng thấp hơn số lượng tồn kho, hiện số lượng tồn kho đang còn ' + qty + ' sản phẩm');
            }else if(!intRegex.test(price_up) || !intRegex.test(qty_up)){
                alert('Giá nhập vào và số lượng của sản phẩm phải là kiểu số!');
            }else{
                $.ajax({
                    type : 'GET',
                    url : url,
                    data : {
                      'idProduct' : idProduct,
                      'idReceiptDetail' : idReceiptDetail,
                      'idReceipt' : idReceipt,
                      'qty' : qty_up,
                      'price' : price_up,
                    },

                    success : function (data) {
                        if(data.code == 200){
                            Swal.fire(
                                'Thành công!',
                                'Chi tiết trong phiếu nhập đã được cập nhật',
                                'success'
                            );
                            that.parents('tr').find('.saveProductReceipt').css('display','none');
                            that.parents('tr').find('.changeProductReceipt').css('display','block');
                            $('.sum_after_update').attr('value',data.sum);
                        }
                    }
                })
            }
        })
    </script>

    <script>
        $(document).on('click','.deleteReceipt',function (e){
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var that = $(this);
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa phiếu nhập này không?',
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
                        url : url,
                        data : {
                            'id' : id,
                        },
                        success : function (data) {
                            if(data.code == 200) {
                                that.parent().parent().remove();
                                Swal.fire(
                                    'Đã xóa',
                                    'Phiếu nhập bạn chọn đã được xóa',
                                    'success'
                                )
                            }
                        }
                    })
                }
            })
        })
    </script>
{{--    SELECT PRODUCT RECEIPT--}}

{{--    CHANGE COST--}}
    <script>
        $(document).on('click','.changeCost',function (e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#cost_' + id).attr('readonly',false);
            $(this).removeClass('btn btn-info changeCost').addClass('btn btn-success saveCost').attr('value',1).text('Lưu');
        })
    </script>
    <script>
        $(document).on('click','.saveCost',function (e){
            e.preventDefault();
            var that = $(this);
            var id = $(this).data('id');
            var url = $(this).data('url');
            var cost = $('#cost_' + id).val();
            var intRegex = /^\d+$/;
            if(cost == '') {
                alert('Vui lòng không để trống mục phí vận chuyển!');
            }else if(!intRegex.test(cost)){
                alert('Mục phí vận chuyển phải là kiểu số nguyên!');
            }else{
                $.ajax({
                    type : 'GET',
                    url : url,
                    data : {
                        'id' : id,
                        'cost' : cost,
                    },

                    success : function (data) {
                        if(data.code == 200){
                            Swal.fire(
                                'Thành công!',
                                'Phí vận chuyển đã được cập nhật',
                                'success'
                            );
                            that.removeClass('btn btn-success saveCost').addClass('btn btn-info changeCost').attr('value',0).text('Chỉnh sửa');
                            that.parents('.city').find('#cost_' + id).attr('readonly',true).attr('value',cost);
                        }
                    }
                })
            }
        })
    </script>
{{--    CHANGE COST--}}

{{--    CHECK EMAIL ACCOUNT --}}
    <script>
        $(document).on('change','.inputEmail',function (){
            var that = $(this);
            var value = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                type : 'GET',
                url : url,
                data : {
                    'value' : value,
                },
                success : function (data) {
                    if(data.code == 200){
                        Swal.fire({
                            icon: 'error',
                            title: 'Cảnh báo!',
                            text: 'Tên email đã được sử dụng, vui lòng dùng 1 tài khoản khác!',
                        })
                        that.val('');
                    }
                }
            })
        });
    </script>
{{--    CHECK EMAIL ACCOUNT --}}
{{--    SELECT SHIPPER ORER --}}
    <script>
        $(document).on('click','.selecteShipper',function (){
            var that = $(this);
            var id = $(this).data('id');
            var key = $(this).data('key')
            var url = $(this).data('url');

            $.ajax({
                type : 'GET',
                url : url,
                data : {
                    'id' : id,
                    'key' : key,
                },
                success : function (data) {
                    if(data.code == 200){
                        that.removeClass('selecteShipper').addClass('chooseShipper');
                        toastr.success(data.message,data.title);
                    }
                }
            })
        })
    </script>

    <script>
        $(document).on('click','.selectShipOrder',function (){
            var that = $(this);
            var id = $(this).data('id');
            var key = $(this).data('key')
            var url = $(this).data('url');
            $.ajax({
                type : 'GET',
                url : url,
                data : {
                    'id' : id,
                    'key' : key,
                },
                success : function (data) {
                    if(data.code == 200){
                        that.removeClass().addClass('btn btn-success finishOrder').attr('data-url',`{{ route('sup.order.finishShipOrder') }}`).text('Xác nhận đã giao');
                        $('.count_order_notify').html(data.count);
                        $('.notify-order_' + key).remove();
                        toastr.success(data.message,data.title);
                    }
                }
            })
        })
    </script>
    <script>
        $(document).on('click','.finishOrder',function (){
            var that = $(this);
            var id = $(this).data('id');
            var key = $(this).data('key')
            var url = $(this).data('url');
            $.ajax({
                type : 'GET',
                url : url,
                data : {
                    'id' : id,
                    'key' : key,
                },
                success : function (data) {
                    if(data.code == 200){
                        that.removeClass().addClass('btn btn-secondary').text('Chờ xác nhận');
                        toastr.success(data.message,data.title);
                    }
                }
            })
        });
    </script>
{{--     SELECT SHIPPER ORER --}}
    <script>
        $(document).on('click','.detailAccount',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');

            $.ajax({
                type : "GET",
                url : url,
                data : 
                {
                    'id' : id
                },
                success : function (data){
                    if(data.code == 200) {
                        $('#chitiettaikhoan').html(data.output);
                        $('#chitiettaikhoan').modal('show');
                    }
                }
            })
        })
    </script>
    <script>
        $(function() {
        var userId = `{{ Auth::id() }}`;
        window.Echo.private(`App.Models.User.${userId}`)
            .notification((notification) => {
                $.get(`{{ route('notitication') }}`, function(data) {
                    $("#notification-list").html(data);
                });
            });
        });
    </script>
   
    <script>
        $(document).on('click','.deleteRole',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var that = $(this);
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa vai trò này không?',
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
                        url : url,
                        data : {
                            'id' : id,
                        },
                        success : function (data) {
                            if(data.code == 200) {
                                that.parent().parent().remove();
                                Swal.fire(
                                    'Đã xóa',
                                    'Vai trò bạn chọn đã được xóa',
                                    'success'
                                )
                            }
                        }
                    })
                }
            })
        })
    </script>

<script>
        $(document).on('click','.deletePermission',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var that = $(this);
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa quyền này không?',
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
                        url : url,
                        data : {
                            'id' : id,
                        },
                        success : function (data) {
                            if(data.code == 200) {
                                that.parent().parent().remove();
                                Swal.fire(
                                    'Đã xóa',
                                    'Quyền bạn chọn đã được xóa',
                                    'success'
                                )
                            }
                        }
                    })
                }
            })
        })
    </script>
    </body>
</html>
