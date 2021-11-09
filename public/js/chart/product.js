$(document).on('change','.selectTypeStatisticalProduct', function(){
    var type = $(this).val();
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'type' : type,
        },
        success: function(data){
            if(data.code == 200){
                $('.fillStatisticalProduct').html(data.output);
            }
        }
    })
})
    
