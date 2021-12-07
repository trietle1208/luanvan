$(document).on('change','.allAddress',function () {
    var id = $(this).val();
    var url = $(this).data('url');
    $.ajax({
        url : url,
        type : 'GET',
        data : {
            'id' : id,
        },
        success : function (data) {
            if(data.code == 200) {
                $('.fee').html(data.fee + ' VNĐ');
                $('.total span').html(data.total + ' VND');
                $('.total1 span').html(data.total1);
            }
        }
    });
});

$(document).on('click','.confirmCheckout',function (e){
    e.preventDefault();
    var name = $("input[type=text][name=name1]").val();
    var _token = $( "input[type=hidden][name=_token]").val();
    var ship = $( "input[type=radio][name=ship]:checked").val();
    var address = $('.allAddress').val();
    var note = $('textarea#note').val();
    var total = $('.total1 span').html();
    var url = $('.name').data('url');
    if(name == '' || ship == '' ||
        address == ''){
        Swal.fire(
            'Cảnh báo',
            'Vui lòng điền đầy đủ các thông tin cá nhân vào đơn đặt hàng!',
            'danger'
        )
    }
    else {
        $.ajax({
            url: url,
            type: 'POST',
            data:
                {
                    '_token': _token,
                    'name': name,
                    'ship': ship,
                    'address': address,
                    'note': note,
                    'total': total,
                },
            success: function (data) {
                if(data.code == 200) {
                    Swal.fire(
                        'Đã thanh toán',
                        'Giỏ hàng của bạn đã được thanh toán thành công!',
                        'success'
                    )
                    location.href = data.url;
                }
            }
        })
    }
});

// $(document).on('click','.add-address',function (e){
//     e.preventDefault();
//     var name = $( "input[type=text][name=name]").val();
//     var phone = $( "input[type=text][name=phone]").val();
//     var address = $( "input[type=text][name=address]").val();
//     var id = $('.ward').val();
//     var url = $(this).data('url')
//     var that = $(this);
//     $.ajax({
//         url : url,
//         type : 'POST',
//         data : $('#add_address').serialize(),
//         success : function (data) {
//             if(data.code == 200) {
//                 $('.allAddress').html(data.output);
//                 $( "input[type=text][name=name]" ).val('');
//                 $( "input[type=text][name=phone]" ).val('');
//                 $( "input[type=text][name=address]" ).val('');
//                 $('.city').val(0);
//                 $('.province').val(0);
//                 $('.ward').val(0);
//                 $('.fee').html(data.fee + ' VNĐ');
//                 $('.total span').html(data.total + ' VND');
//                 $('.total1 span').html(data.total1);
//                 Swal.fire(
//                     'Thành công',
//                     'Thêm địa chỉ thành công',
//                     'success'
//                 )
//                 $('#exampleModalLong').modal('hide');
//             }else{
//                 $.each(data.errors, function (key, value) {
//                     $('.'+key).text(value);
//                     $('.error').addClass('alert alert-danger')
//                 });
//             }
//         }

//     })
// });

