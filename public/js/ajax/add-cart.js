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
            }else if(data.code == 400) {
                if(data.count == 0){
                    Swal.fire(
                        'Cảnh báo',
                        'Đã vượt quá số lượng trong kho, hiện tại bạn không thể tiếp tục thêm sản phẩm này vào giỏ hàng!',
                        'error',
                    )
                }else {
                    Swal.fire(
                        'Cảnh báo',
                        'Đã vượt quá số lượng trong kho, hiện bạn chỉ có thể thêm được ' + data.count + ' sản phẩm nữa vào giỏ hàng!',
                        'error',
                    )
                }
                
            }
        },
    })
})

$(document).on('click','.add-to-cartAjax', function (e) {
    e.preventDefault();
    var qty = $(this).data('qty');
    var id = $(this).data('id');
    var ncc_id = $(this).data('key');
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
                Swal.fire({
                    title: 'Đã thêm sản phẩm vào giỏ hàng',
                    text: "Bạn có thể tiếp tục mua hàng hoặc tiến hành thanh toán",
                    showCancelButton: true,
                    cancelButtonText: "Xem tiếp",
                    confirmButtonColor: 'btn-success',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đi đến giỏ hàng!',
                    closeOnConfirm: false,
                },
                function (){
                   window.location.href = "/giohang";
                });
            }else if(data.code == 400){
                Swal.fire(
                    'Cảnh báo',
                    'Đã vượt quá số lượng trong kho, hiện tại bạn không thể tiếp tục thêm sản phẩm này vào giỏ hàng!',
                    'error',
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
    var qty_has = $('#valueQty_' + id).data('qty_has');
    var url = $('#valueQty_' + id).data('url');
    var that = $(this);
    if($(this).hasClass('inc'))
    {
        if(qty == qty_has){
            Swal.fire(
                'Cảnh báo',
                'Không thể mua quá số lượng còn lại trong kho',
                'danger'
            )
        }
        else{
            $('#valueQty_' + id).val(parseInt(qty)+1);
            updateQtyCart(id,$('#valueQty_' + id).val(),ncc_id,url,that);
        }
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

$(document).on('click', '.showVoucher', function(e) {
    var key = $(this).data('key');
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'key' : key,
        },
        success: function(data) {
            if(data.code == 200) {
                $('#danhsachvoucher').html(data.output);
                $('#danhsachvoucher').modal('show');
            }
        }
    })
})

$(document).on('click','.addVoucher',function(e) {
    var key = $(this).data('key');
    var url = $(this).data('url');
    var id = $("input[name='voucher']:checked").val();
    var that = $(this);
    if(id == null){
        Swal.fire(
            'Cảnh báo',
            'Vui lòng chọn một mã giảm giá mà bạn mong muốn',
            'error'
          )
    }else{
        $.ajax({
            type : 'GET',
            url : url,
            data : {
               'id' : id,
               'key' : key, 
            },
            success : function (data) {
                if(data.code == 200) {
                    $('.voucher1 span').html(data.total_discount + ' VND');
                    $('.total span').html(data.total + ' VND');
                    $('.delete_' + key).css('display', 'block');
                    $('.add_' + key).css('display', 'none');
                    $('#danhsachvoucher').modal('hide');
                    $('.name_' + key).html('<span>Tên mã : ' + data.name + '</span>');
                    $('.code_' + key).html('<span>CODE : ' + data.code_voucher + '</span>');
                    $('.desc_' + key).html('<span>Mỗ tả : ' + data.desc + '</span>');
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

$(document).on('click','.deleteVoucher',function(e) {
    var key = $(this).data('key');
    var url = $(this).data('url');
    var that = $(this);
    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'key' : key,
        },
        success: function (data) {
            if(data.code == 200) {
                $('.voucher1 span').html(data.total_discount + ' VND');
                $('.total span').html(data.total + ' VND');
                that.parents('.choose-voucher').find('.delete').css('display', 'none');
                that.parents('.choose-voucher').find('.add').css('display', 'block');
                Swal.fire(
                    'Thành công',
                    data.message,
                    'success'
                )
            }
        }
    })
})

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
                        if(data.check == 0){
                            $('#choose-voucher_' + idNCC).css('display', 'none');
                            $('#name_' + idNCC).css('display', 'none');
                        }
                        Swal.fire(
                            'Đã xóa',
                            'Sản phẩm bạn chọn đã được xóa',
                            'success'
                        )
                    }else if(data.code == 400)
                    {
                        location.href = data.url;
                    }
                    else if(data.code == 500){
                        Swal.fire(
                            'Cảnh báo',
                            'Bạn vui lòng xóa mã giảm giá đang chọn trước khi xóa sản phẩm khỏi giỏ hàng',
                            'error'
                        ) 
                    }
                    
                },
                error : function () {

                }
            })
        }
    })
})

