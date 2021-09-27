$(document).on('click','.add-cart', function () {
    var qty = $('.qty-product').val(), id = $('.id-product').val(), ncc_id = $('.id-ncc').val();
    var url = $(this).data('url');
    $.ajax({
        url : url,
        type : 'GET',
        data : {
            'qty' : qty,
            'id' : id,
            'ncc_id' : ncc_id,
        },
        success : function (data) {
            if(data.code == 200) {
                Swal.fire(
                    'Thêm giỏ hàng thành công!',
                    'Xin chúc mừng',
                    'success',
                )
            }
        },
    })
})

$(document).on('click','.cart_qty',function (e){
    e.preventDefault();
    var id = $(this).data('id');
    var ncc_id = $(this).data('key');
    var qty = $('#valueQty_' + id).val();
    var url = $('#valueQty_' + id).data('url');
    var that = $(this);
    if($(this).hasClass('inc'))
    {
        $('#valueQty_' + id).val(parseInt(qty)+1);
        updateQtyCart(id,$('#valueQty_' + id).val(),ncc_id,url,that);

    }
    else
    {
        if(qty >= 2) {
            $('#valueQty_' + id).val(parseInt(qty)-1);
            updateQtyCart(id,$('#valueQty_' + id).val(),ncc_id,url,that);
        }
    }
    var qtyNew = $('#valueQty_' + id).val();



});

function updateQtyCart(id,qty,ncc_id,url,that) {
    $.ajax({
        type : 'GET',
        url : url,
        data :
            {
                'id' : id,
                'qty' : qty,
                'id_ncc' : ncc_id,
            },
        success : function (data) {
            if(data.code == 200) {
                that.parents('.product').find('.cart_total_price').text(data.total_product + ' VND');
                $('.subtotal span').html(data.subtotal + ' VND');
                $('.total span').html(data.total + ' VND');
                $('.total1 span').html(data.total1);
                Swal.fire(
                    'Thành công',
                    'Giỏ hàng của bạn đã được cập nhật',
                    'success'
                )
            }
        }
    });
}

$(document).on('click','.voucher',function () {
    var select = $('.select-voucher');
    var arrId = new Array();
    var arrIdNCC = new Array();
    var url = $(this).data('url');
    for (let i = 0; i < select.length; i++) {
        // console.log($(select[i]).val())
        arrId.push($(select[i]).val());
        arrIdNCC.push($(select[i]).data('id'));
    }
    var idNCC = $(this).data('key');
    var that = $(this);
    if(that.val() == 1){
        $.ajax({
            type : 'GET',
            url : './addVoucher',
            data :
                {
                    'idNCC' : idNCC,
                    'arrId' : arrId,
                    'arrIdNCC' : arrIdNCC,
                },
            success : function (data) {
                if(data.code == 200) {
                    $('.voucher1 span').html(data.total_discount + ' VND');
                    $('.total span').html(data.total + ' VND');
                    that.removeClass('btn-success').addClass('btn-danger').val(0).text('Xóa mã');
                    Swal.fire(
                        'Thành công',
                        data.message,
                        'success'
                    )
                }
            }
        })
    }else{
        $.ajax({
            type : 'GET',
            url : "./deletedVoucher",
            data :
                {
                    'idNCC' : idNCC,
                },
            success : function (data) {
                if(data.code == 200) {
                    $('.voucher1 span').html(data.total_discount + ' VND');
                    $('.total span').html(data.total + ' VND');
                    that.parent().find('.select-voucher').html(data.html);
                    that.removeClass('btn-danger').addClass('btn-success').val(1).text('Áp dụng mã');
                    Swal.fire(
                        'Thành công',
                        data.message,
                        'success'
                    )
                }
            }
        })
    }

})

