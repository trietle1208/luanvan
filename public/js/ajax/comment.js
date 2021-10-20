function remove_background(product_id){
    for(var count = 1; count <=5 ; count++){
        $('#'+product_id+'-'+count).css('color','#ccc');
    }
}
$(document).on('click','.rating',function (){
    var index = $(this).data('index');
    var product_id = $(this).data('product');
    remove_background(product_id);
    for(var count = 1; count<=index; count++){
        $('#'+product_id+'-'+count).css('color','#ffcc00');
    }
    $('.rating').attr('data-rating',index);
    $('.addRating').attr('value',index);
});
$(document).on('click','.addComment',function (e){
    e.preventDefault();
    var _token = $( "input[type=hidden][name=_token]").val();
    var text = $('.textComment').val();
    var rating = $('.addRating').val();
    var id = $('.rating').data('customer');
    var idsp = $('.rating').data('product');
    var url = $('.rating').data('url');
    if(text == '' || rating == ''){
        alert('Vui lòng điền đầy đủ nội dung đánh giá!');
    }
    $.ajax({
        type : 'POST',
        url : url,
        data : {
            '_token': _token,
            'text': text,
            'rating': rating,
            'id': id,
            'idsp': idsp,
        },

        success : function (data) {
            if(data.code == 200){
                Swal.fire(
                    'Thành công',
                    'Bình luận của bạn đã được đăng tải!',
                    'success'
                );
                $("textarea.textComment").val('');
                $('.addRating').attr('value',0);
                $('.showComment').append(data.output);
            }
        }
    })
})
function closeFromComment(id){
    $('.form-repComment_' + id).css('display','none');
    $("textarea.textRepComment_" + id).val('');
}
$(document).on('click','.repComment',function (e){
    e.preventDefault();
    var id = $(this).data('id');
    $('.form-repComment_' + id).css('display','block');
    $('.textRepComment_' + id).attr('value','d');

});

$(document).on('click','.closeRepcomment',function (e){
    e.preventDefault();
    var id = $(this).data('id');
    // $('.form-repComment_' + id).css('display','none');
    closeFromComment(id);
});



$(document).on('click','.sendComment',function (e){
    e.preventDefault();
    var id = $(this).data('id');
    // var _token = $( "input[type=hidden][name=_token]").val();
    var _token = $('.token_' + id).val();
    var key = $(this).data('key');
    var url = $(this).data('url');
    var idsp = $(this).data('product');
    var idkh = $(this).data('kh');
    var text = $('.textRepComment_' + id).val();
    if(text == ''){
        alert('Vui lòng nhập nội dung bình luận');
    }else{
        $.ajax({
            type : 'POST',
            url : url,
            data : {
                '_token': _token,
                'text': text,
                'idbl': id,
                'id': key,
                'idsp': idsp,
                'kh' : idkh,
            },
            success : function (data){
                Swal.fire(
                    'Thành công',
                    'Phản hồi của bạn đã được đăng tải!',
                    'success'
                );
                closeFromComment(id);
                $('.comnent-rep_' + id).append(data.output);
            }
        })
    }
})

