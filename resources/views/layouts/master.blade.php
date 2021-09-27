<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')
    <link href="{{ asset('Eshopper/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Eshopper/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Eshopper/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('Eshopper/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('Eshopper/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('Eshopper/css/main.css') }}" rel="stylesheet">


    @yield('css')
</head>

<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')
</div>

<script src="{{ asset('Eshopper/js/jquery.js') }}"></script>
<script src="{{ asset('Eshopper/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('Eshopper/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('Eshopper/js/price-range.js') }}"></script>
<script src="{{ asset('Eshopper/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('Eshopper/js/main.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/ajax/update-qty-cart.js') }}"></script>
<script src="{{ asset('js/ajax/add-cart.js') }}"></script>
<script src="{{ asset('js/ajax/checkout.js') }}"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
@yield('js')
    <script>
        var total = $('.total1 span').html();
        var usd = (total/23083).toPrecision(3);
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'demo_sandbox_client_id',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: `${usd}`,
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Show a confirmation message to the buyer
                    window.alert('Thank you for your purchase!');
                });
            }
        }, '#paypal-button');

    </script>

{{--    CHECK QTY ADD CART--}}
    <script>
        function checkQty() {
            var qty = $(this).val();
            var that = $(this);
            var id = $('.id-product').val();
            $.ajax({
                url : '{{ route('product.ajaxQty') }}',
                type : 'GET',
                data : {
                    'qty' : qty,
                    'id' : id,
                },
                success : function (data)
                {
                    if(data.code == 400) {
                        that.val(data.qty);
                        // alert(data.message);
                        Swal.fire(
                            'Vui lòng nhập số lượng thấp hơn số lượng còn lại trong kho!',
                            `Hiện tại sản phẩm còn ${data.qty}`,
                            'error',
                        )
                    }
                }
            })
        }
        $(document).on('change','.qty-product',checkQty);
    </script>
{{--    CHECK QTY ADD CART--}}
    {{--    CHECK QTY ADD CART--}}
    <script>
        function checkQty() {
            var qty = $(this).val();
            var that = $(this);
            var id = $(this).data('id');
            $.ajax({
                url : '{{ route('product.ajaxQty') }}',
                type : 'GET',
                data : {
                    'qty' : qty,
                    'id' : id,
                },
                success : function (data)
                {
                    if(data.code == 400) {
                        that.val(data.qty);
                        // alert(data.message);
                        Swal.fire(
                            'Vui lòng nhập số lượng thấp hơn số lượng còn lại trong kho!',
                            'Hiên tại sản phẩm đang còn '+ data.qty,
                            'error',
                        )
                    }
                }
            })
        }
        $(document).on('change','.cart_quantity_input',checkQty);
    </script>
    {{--    CHECK QTY ADD CART--}}

{{--AJAX DELETE CART--}}
    <script>
        $(document).on('click','.cart_quantity_delete',function (e) {
            e.preventDefault();
            var urlRequest = $(this).data('url');
            var idNCC = $(this).data('key');
            var that = $(this);

            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?',
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
                        data : {
                            'idNCC' : idNCC,
                        },
                        success : function (data) {
                            if(data.code == 200) {
                                that.parent().parent().remove();
                                $('.subtotal span').html(data.subtotal + ' VND');
                                $('.total span').html(data.total + ' VND');
                                if(data.output){
                                    $('.voucher1 span').html(data.discount + ' VND');
                                    $('#select-voucher_' + idNCC).html(data.output);
                                    $('#button-voucher_' + idNCC).removeClass('btn-danger').addClass('btn-success').val(1).text('Áp dụng mã');
                                }
                                Swal.fire(
                                    'Đã xóa',
                                    'Sản phẩm bạn chọn đã được xóa',
                                    'success'
                                )
                            }
                            else {
                                location.href = data.url;
                            }
                        },
                        error : function () {

                        }
                    })
                }
            })
        })
    </script>
{{--AJAX DELETE CART--}}
    <script>
        $(document).on('change','.choose',function (){
           var attr = $(this).attr('id');
           var id = $(this).val();
           var result = '';
           if(attr == 'city'){
               result = 'province';
           }else {
               result = 'ward';
           }
           $.ajax({
                url : '{{ route('checkout.selectAdd') }}',
                type : 'GET',
                data :
                {
                    'attr' : attr,
                    'id' : id,
                },
               success : function (data) {
                    $('#' + result).html(data);
               }
           })
        });
    </script>
    <script>
        $("input:checkbox").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
                // the name of the box is retrieved using the .attr() method
                // as it is assumed and expected to be immutable
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    </script>
{{--    <script>--}}
{{--        $(document).on('click','.shipping_3',function () {--}}
{{--            var check = $(this);--}}
{{--            if(check.is(":checked")) {--}}
{{--                $('.paypal').css('display' : 'none'));--}}
{{--            }--}}
{{--        })--}}
{{--    </script>--}}
    <script>
        $(document).on('click','.add-address',function (e){
            e.preventDefault();
            var name = $( "input[type=text][name=name]").val();
            var phone = $( "input[type=text][name=phone]").val();
            var address = $( "input[type=text][name=address]").val();
            var id = $('.ward').val();
            var that = $(this);
            $.ajax({
                url : '{{ route('checkout.saveAdd') }}',
                type : 'POST',
                data : $('#add_address').serialize(),
                success : function (data) {
                    if(data.code == 200) {
                        $('.address').html(data.output);
                        $( "input[type=text][name=name]" ).val('');
                        $( "input[type=text][name=phone]" ).val('');
                        $( "input[type=text][name=address]" ).val('');
                        $('.city').val(0);
                        $('.province').val(0);
                        $('.ward').val(0);
                        $('.fee').html(data.fee + ' VNĐ');
                        $('.total span').html(data.total + ' VND');
                        $('.total1 span').html(data.total1);
                        Swal.fire(
                            'Thành công',
                            'Thêm địa chỉ thành công',
                            'success'
                        )
                        $('#exampleModalLong').modal('hide');
                    }else{
                        $.each(data.errors, function (key, value) {
                            $('.'+key).text(value);
                            $('.error').addClass('alert alert-danger')
                        });
                    }
                }

            })
        });
    </script>
</body>
</html>
