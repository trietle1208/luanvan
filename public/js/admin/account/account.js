$(document).ready(function (){
    $('.change-status').click(function (){
        var id = $(this).data('id');
        var that = $(this);
        var url = $(this).data('url');
        Swal.fire({
        title: 'Bạn có chắc chắn muốn duyệt tài khoản không?',
        text: "Tài khoản sẽ được cấp quyền hoạt động!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có, tôi đồng ý!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : url,
                    method : 'GET',
                    data :{
                        'id':id,
                    },
                    success : function (data) {
                        if(data.code == 200) {
                            that.removeClass().addClass('btn btn-success').text('Đã duyệt');

                            Swal.fire(
                                'Thành công',
                                'Đã cấp quyền tài khoản được chọn',
                                'success'
                            )
                        }
                    }
                })
            }
        })
    })
})
