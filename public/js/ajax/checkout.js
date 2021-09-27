$(document).on('change','.address',function () {
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
    var name = $( "input[type=text][name=name]").val();
    var _token = $( "input[type=hidden][name=_token]").val();
    var ship = $( "input[type=radio][name=ship]").val();
    var address = $( "select[name=address]" ).val();
    var note = $('textarea#note').val();
    var total = $('.total1 span').html();
    var url = $('.name').data('url');
    if(name == '' || ship == '' ||
        address == '' ||note == ''){
        alert('Vui lòng điền đầy đủ thông tin cá nhân!');
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
