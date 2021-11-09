//Duyệt đơn hàng
$(document).on('click','.changeStatusOrder',function (e){
    e.preventDefault();
    var id = $(this).data('id');
    var key = $(this).data('key');
    var url = $(this).data('url');
    var idNCC = $(this).data('idncc');
    var that = $(this);
    $.ajax({
        url : url,
        type : 'GET',
        data : {
            'id' : id,
            'key' : key,
            'idNCC' : idNCC,
        },
        success : function (data) {
             if(data.code == 200) {
                 that.removeClass('btn-danger changeStatusOrder').addClass('btn-success');
                 $('.icon_' + id).removeClass().addClass('fe-thumbs-up');
                 that.parents('tr').find('.shipper').css('display','inline-block');
                 $('.count_order_notify').html(data.count);
                 $('.notify-order_' + id).remove();
             }
        }
    })
 });
