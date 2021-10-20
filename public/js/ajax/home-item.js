$(document).on('click','.quickView',function (e){
    e.preventDefault();
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
                $('#quickView').html(data.product);
                $('#quickView').modal('show');
            }
        }
    })
})

$(document).on('click','.showPosts',function (){
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
                $('#baiviet1').html(data.output);
                $('#baiviet1').modal('show');
            }
        }
    })
})

$(document).on('click','.fillterRating',function (e){
    e.preventDefault();
    var rating = $(this).data('rating');
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'rating' : rating,
        },

        success : function (data) {
            if(data.code == 200) {
                $('.fill').html(data.output);
            }else{
                $('.fill').html(data.none);
            }
        }
    })
})

$(document).on('click','.fillterSort',function (){
    var type = $('.selectSort').val();
    var cate = $('.selectCateSort').val();
    var brand = $('.selectBrandSort').val();
    var url = $(this).data('url');
    if(type == ''){
        Swal.fire(
            'Bạn đang muốn sắp xếp các sản phẩm?',
            'Vui lòng chọn loại mà bạn muốn sắp xếp!',
            'question'
        )
    }else{
        $.ajax({
            type : 'GET',
            url : url,
            data : {
              'type' :  type,
              'cate' : cate,
              'brand' : brand,
            },
            success : function (data) {
                if(data.code == 200) {
                    $('.fill').html(data.output);
                }
            }
        })
    }
})

$(document).on('click','.para_detail',function (){
    $(this).find('.value_para').prop('checked',true);
    var that = $(this);
    var url = $(this).data('url');
    var value = $('.para_detail span').html();
    var arr_value = new Array();
    var span = $('.value_para');
    for(let i = 0; i <= span.length; i++){
        if($(span[i]).prop('checked')){
            arr_value.push($(span[i]).val());
        }
    }
    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'arr_value' : arr_value,
        },
        success : function (data) {
            if(data.code == 200){
                that.removeClass('para_detail').addClass('para_detail_choose');
                $('.all_product_type').html(data.output);
            }
        }
    })

})

$(document).on('click','.para_detail_choose',function (){
    $(this).find('.value_para').prop('checked',false);
    var that = $(this);
    var id_type = $('.type').data('type');
    var url = $(this).data('url');
    var value = $('.para_detail span').html();
    var arr_value = new Array();
    var span = $('.value_para');
    for(let i = 0; i <= span.length; i++){
        if($(span[i]).prop('checked')){
            arr_value.push($(span[i]).val());
        }
    }
    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'arr_value' : arr_value,
            'id_type' : id_type,
        },
        success : function (data) {
            if(data.code == 200){
                that.removeClass('para_detail_choose').addClass('para_detail');
                $('.all_product_type').html(data.output);
            }
        }
    })

})


