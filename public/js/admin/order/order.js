//Chi tiết đơn hàng
$(document).on('click','.order-detail-admin',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var url = $(this).data('url');
    $.ajax({
        type : 'GET',
        url : url,
        data : 
        {
            'id' : id,
        },
        success: function(data){
            if(data.code == 200){
                $('#chitietdonhangAdmin').html(data.output);
                $('#chitietdonhangAdmin').modal('show');
            }
        }
    })
})

//Danh sách shipper
$(document).on('click','.listShipper',function(e){
    var id = $(this).data('id');
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'id' : id,
        },
        success: function(data){
            if(data.code == 200){
                $('#danhsachshipper').html(data.output);
                $('#danhsachshipper').modal('show');
            }
        }
    })
})

//Lưu shipper
$(document).on('click','.chooseShipper',function(e){
    var id_order = $(this).data('id');
    var url = $(this).data('url');
    var id_shipper = $("input[name='shipper']:checked").val();
    if(id_shipper == null){
        Swal.fire(
            'Cảnh báo',
            'Vui lòng chọn một shipper mà bạn mong muốn',
            'error'
        )
    }else{
        $.ajax({
            type : 'GET',
            url : url,
            data : {
                'id_order' : id_order,
                'id_shipper' : id_shipper,
            },
            success: function (data) {
                if(data.code == 200){
                    toastr.success(data.message,data.title);
                    $('#danhsachshipper').modal('hide');
                }
                
            }
        })
    }
})

//Shipper nhận đơn hàng
$(document).on('click','.selectShipOrderAdmin',function(e){
    var id_shipper = $(this).data('id');
    var id_order = $(this).data('key');
    var url = $(this).data('url');
    var that = $(this);

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'id_shipper' : id_shipper,
            'id_order' : id_order,
        },
        success: function(data){
            if(data.code == 200){
                that.removeClass().addClass('btn btn-success').text('Xác nhận giao hàng');
                toastr.success(data.message,data.title);
            }
        }
    })
})

//Xác nhận đã giao hàng
$(document).on('click','.finishOrderAdmin',function(e){
    var id_order = $(this).data('key');
    var url = $(this).data('url');
    var that = $(this);

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'id_order' : id_order,
        },
        success : function(data){
            if(data.code == 200){
                that.removeClass().addClass('btn btn-secondary disabled').text('Chờ xác nhận');
                toastr.success(data.message,data.title);
            }
        }
    })
})