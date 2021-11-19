//show modal order-detail
$(document).on('click','.detailOrder', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
        url: './chitietdonhang',
        method : 'GET',
        data : {
        'id' : id,
        },
            success:function (data)
        {
            $('#chitietdonhang').html(data);
            $('#chitietdonhang').modal('show');
        }
    })
})
//update qty in modal order-detail
$(document).on('click','.order_detail_qty',function (e){
    e.preventDefault();
    var id = $(this).data('id');
    var key = $(this).data('key');
    var url = $(this).data('url');
    var total = $('.total').val();
    var voucher_price = $('.order_voucher').val();
    var price = $('.price_' + id).val();
    var that = $(this);
    var qty = $('.qty_' + id).html();
    if($(this).hasClass('inc'))
    {
        $('.qty_' + id).html(parseInt(qty)+1);
        updateQtyOrder(id,key,$('.qty_' + id).html(),url,that)
    }
    else
    {
        if(qty >= 2) {
            $('.qty_' + id).html(parseInt(qty)-1);
            updateQtyOrder(id,key,$('.qty_' + id).html(),url,that)
        }
    }

    var qtyNew = $('.qty_' + id).html();
})
//update Qty OrderDetail
function updateQtyOrder(id,key,qty,url,that) {
    $.ajax({
        type : 'GET',
        url : url,
        data :
            {
                'idsp' : id,
                'id_ctdh' : key,
                'qty' : qty,
            },
        success : function (data) {
            if(data.code == 200) {
                that.parents('.order').find('.order-subtotal').text(data.subtotal + ' VND');
                $('.order_total').html(data.total + ' VND');
                Swal.fire(
                    'Thành công',
                    'Đơn hàng của bạn đã được cập nhật',
                    'success'
                )
            }
            if(data.code == 400) {
                    Swal.fire(
                        'Cảnh báo',
                        'Không được vượt quá số lượng còn lại trong kho!',
                        'danger'
                    )
                    that.css("display", "none");
            }
        }
    });
}
//delete Order

$(document).on('click','.deleteOrder',function (e){
    var id = $(this).data('id');
    var url = $(this).data('url');
    var that = $(this);
    Swal.fire({
        title: 'Bạn có chắc chắn muốn hủy đơn hàng này không?',
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
                        that.parents('.order').find('.statusOrder').removeClass().addClass('text-danger statusOrder').text('Đã hủy');
                        that.remove();
                        that.parents('.order').find('.detailOrder').remove();
                        Swal.fire(
                            'Đã hủy',
                            'Đơn hàng bạn chọn đã được hủy',
                            'success'
                        )
                    }
                },
                error : function () {

                }
            })
        }
    })
});
//add Wishlist
$(document).on('click','.addWishlist',function (e){
    e.preventDefault();
    var id = $(this).data('id');
    var that = $(this);
    if($(this).val() == 0){
        addWishlist(id,that);
    }else if($(this).val() == 1){
        deleteWishlist(id,that);
    }
});

function addWishlist(id,that){
    $.ajax({
        type : 'GET',
        url : '/themyeuthich',
        data : {
            'id' : id,
        },
        success : function (data){
            if(data.code == 200){
                that.removeClass('btn btn-success addWishlist').addClass('btn btn-danger addWishlist').val(1).text('Bỏ yêu thích').prepend('<i class="fa fa-plus-square"></i>');
                $('#addWishlist').html(data.wishlist);
                $('#addWishlist').modal('show');
            }
        }
    })
}

function deleteWishlist(id,that){
    $.ajax({
        type : 'GET',
        url : '/xoayeuthich',
        data : {
            'id' : id,
        },
        success : function (data){
            if(data.code == 200){
                that.removeClass('btn btn-danger addWishlist').addClass('btn btn-success addWishlist').val(0).text('Thêm yêu thích').prepend('<i class="fa fa-plus-square"></i>');
                $('#addWishlist').html(data.wishlist);
                $('#addWishlist').modal('show');
            }
        }
    })
}

$(document).on('click','.showWishlist',function (e){
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type : 'GET',
        url : './yeuthich',
        data : {
            'id' : id,
        },
        success : function (data){
            if(data.code == 200){
                $('#addWishlist').html(data.wishlist);
                $('#addWishlist').modal('show');
            }
        }
    })
});

$(document).on('click','.updateInfo',function (e){
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
                $('#capnhatthongtin').html(data.user);
                $('#capnhatthongtin').modal('show');
            }
        }
    })
})

$(document).on('submit','#save-info',function (e){
    e.preventDefault();
    var form = new FormData(this);
    $.ajax({
        url : $(this).attr('action'),
        type : 'POST',
        data : form,
        cache : false,
        contentType : false,
        processData : false,

        success : function (data){
            if(data.code == 200){
                $('#capnhatthongtin').modal('hide');
                $('.fullname').text(data.name);
                $('.phone').text(data.phone);
                $('.date').text(data.date);
                if(data.image != ''){
                    $('.avt_ajax').html(data.image);
                }
            }else{
                $.each(data.errors, function (key, value) {
                    $('.'+key).text(value);
                    $('.error').addClass('alert alert-danger')
                });
            }
        }
    })
})
$(document).on('change','.followOrder',function (e){
    e.preventDefault();
    
    var id = $(this).val();
    var url = $(this).data('url');
    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'id' : id,
        },
        success : function (data){
            if(data.code == 200){
                $('#theodoidonhang').html(data.output);
                $('#theodoidonhang').modal('show');
            }
        }
    })
})

$(document).on('click','.confirmFinishOder',function(e){
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
                $('#theodoidonhang').modal('hide');
                $('.statusOrder_' + id).removeClass().addClass('text-success statusOrder').html('Đã nhận hàng');
                Swal.fire(
                    'Thành công!',
                    'Chúc mừng bạn đã nhận được hàng',
                    'success'
                )
            }
        }
    });
})

$(document).on('click','.modalLogin',function (e){
    e.preventDefault();
    $('#modalLogin').modal('show');
})

$(document).on('click','.toRegister',function (e){
    e.preventDefault();
    var that = $(this);
    $('#loginForm').css('display','none');
    $('#regiterForm').css('display','block');
})
$(document).on('click','.toLogin',function (e){
    e.preventDefault();
    $('#loginForm').css('display','block');
    $('#regiterForm').css('display','none');
})

$(document).on('submit','#btnLogin',function (e){
    e.preventDefault();
    var form = new FormData(this);
    if(form.get('name') == '' || form.get('password') == ''){
        Swal.fire(
            'Cảnh báo',
            'Vui lòng nhập đầy đủ thông tin đăng nhập',
            'error',
        )
    }else{
        $.ajax({
            url : $(this).attr('action'),
            type : 'POST',
            data : form,
            cache : false,
            contentType : false,
            processData : false,
            success : function (data){
                if(data.code == 200){
                   location.href = "/trangchu";
                }else if(data.code == 400){
                    Swal.fire(
                        'Cảnh báo',
                        'Sai tên đăng nhập hoặc mật khẩu',
                        'error',
                    )
                }
            }
        })
    }
    
})

$(document).on('submit','#btnRegister',function (e){
    e.preventDefault();
    var form = new FormData(this);
    if(form.get('name') == '' || form.get('pass') == '' || form.get('kh_email') == '' ||form.get('sex') == '' ||form.get('phone') == '' ||form.get('date') == ''){
        Swal.fire(
            'Cảnh báo',
            'Vui lòng nhập đầy đủ thông tin đăng kí',
            'error',
        )
    }
    else{
        $.ajax({
            url : $(this).attr('action'),
            type : 'POST',
            data : form,
            cache : false,
            contentType : false,
            processData : false,
            success : function (data){
                if(data.code == 200){
                   location.href = "/trangchu";
                }else if(data.code == 400){
                    $(".errors").html('');
                    $.each(data.errors, function (key, value) {
                       $(".errors").append('<div class="alert alert-error"><strong>'+ value +'</strong></div>');
                    });
                }
            }
        })
    }
    
})