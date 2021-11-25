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
    <link href="{{ asset('Eshopper/css/jquery.exzoom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettify.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    @yield('css')
</head>

<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')
    @include('components.modal-login')
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "110983778020603");
        chatbox.setAttribute("attribution", "biz_inbox");

        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v12.0'
            });
        };
        
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script src="{{ asset('Eshopper/js/jquery.js') }}"></script>
<script src="{{ asset('Eshopper/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('Eshopper/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('Eshopper/js/price-range.js') }}"></script>
<script src="{{ asset('Eshopper/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('Eshopper/js/main.js') }}"></script>
<script src="{{ asset('Eshopper/js/jquery.exzoom.js') }}"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/lightgallery-all.min.js') }}"></script>
<script src="{{ asset('js/lightslider.js') }}"></script>
<script src="{{ asset('js/prettify.js') }}"></script>
<script src="{{ asset('js/ajax/update-qty-cart.js') }}"></script>
<script src="{{ asset('js/ajax/add-cart.js') }}"></script>
<script src="{{ asset('js/ajax/checkout.js') }}"></script>
<script src="{{ asset('js/ajax/customer.js') }}"></script>
<script src="{{ asset('js/ajax/search.js') }}"></script>
<script src="{{ asset('js/ajax/home-item.js') }}"></script>
<script src="{{ asset('js/ajax/comment.js') }}"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
{{--    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>--}}
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

@yield('js')

    <script>
        var count = 0;
        $(document).on('click','.shipping',function (){
            var id = $(this).val();

            if (id == 1) {
                count++;
                if (count == 1) {
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
                                document.getElementById('payment').click(); 
                            });
                        }
                    }, '#paypal-button');
                }
            } else {
                $('#paypal-button').html("");
                count = 0;
            }

        })
    </script>
    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <script>
        load_more_product();
        function load_more_product(id = ''){
            $.ajax({
                type : 'GET',
                url : '{{ route('loadProduct') }}',
                data : {
                  'id' : id,
                },
                success : function (data) {
                    if(data.code == 200){
                        $('#all_product').append(data.output);
                        $('#all_button').html(data.button);
                    }else if(data.code == 300)
                    {
                        $('#all_product').append(data.output2);
                        $('#all_button').html(data.button2);
                    }
                    else{
                        $('#all_button').html(data.output2);
                    }
                }
            })
        }
        $(document).on('click','#load_more_button',function (){
            var id = $(this).data('id');
            load_more_product(id);
        })
    </script>
    FILLTER PRICE
    <script>
        $(document).ready(function (){
            $( "#slider-range" ).slider({
                range: true,
                min: 500000,
                max: 15000000,
                values: [ 500000, 4500000 ],
                step: 100000,
                slide: function( event, ui ) {
                    $( "#amount" ).val(ui.values[ 0 ] + "VNĐ - " + ui.values[ 1 ] + "VNĐ" );
                    $('#start').val(ui.values[ 0 ]);
                    $('#end').val(ui.values[ 1 ]);
                }
            });
            $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + "VNĐ - "   + $( "#slider-range" ).slider( "values", 1 ) +
                "VNĐ" );
        })
    </script>
    <script>
        $(document).on('click','.fillterPrice',function (){
            var start = $( "#start" ).val();
            var end = $( "#end" ).val();
            $.ajax({
                type : 'GET',
                url : '{{ route('fillterPrice') }}',
                data : {
                  'start' : start,
                  'end' : end,
                },

                success : function (data){
                    if(data.code == 200){
                        $('.fill').html(data.output);
                    }else if(data.code == 400){
                        $('.fill').html(data.none);
                    }
                }
            })
        })
    </script>
{{--    FILLTER PRICE--}}
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
                        $('.allAddress').html(data.output);
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
    <script type="text/javascript">

    $('.container').imagesLoaded( function() {
    $("#exzoom").exzoom({
        autoPlay: false,
    });
    $("#exzoom").removeClass('hidden')
    });

    </script>
    <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    </script>
</body>
</html>
