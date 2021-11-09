$.ajax({
    type : 'GET',
    url : '/thongbao',
    success : function (data) {
        $('#notification-list').html(data);
    }
})