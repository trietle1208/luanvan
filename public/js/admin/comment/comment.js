$(document).on('click','.list-repComment',function(e){
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
            $('#listRepComment').html(data);
            $('#listRepComment').modal('show');
        }
    })
})

$(document).on('click','.repComment',function (e) {
    e.preventDefault();
    $('#formRep_' + $(this).data('id')).css('display', 'block');
});

$(document).on('click','.closeForm',function (e) {
    e.preventDefault();
    $('#formRep_' + $(this).data('id')).css('display', 'none');
});

$(document).on('click','.sendForm',function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var idsp = $(this).data('sp');
    var url = $(this).data('url');
    var text = $('#textForm_' + id).val();

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'id' : id,
            'idsp' : idsp,
            'text' : text,
        },
        success : function (data){
           if(data.code == 200){
                Swal.fire(
                    'Thành công',
                    'Đã gữi phản hồi cho bình luận được chọn',
                    'success'
                );
                $('#textForm_' + id).attr('value','');
                $('#formRep_' + id).css('display', 'none');
           }
        }
    })
});