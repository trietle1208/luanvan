$(document).on('change','.allAddress',function () {
    var id = $('input[name=address]:checked').data('id')
    var url = $('input[name=address]:checked').data('url')
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
    var address = $('input[name=address]:checked').data('id');
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
