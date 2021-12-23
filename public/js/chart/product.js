//Lọc sản phẩm theo các tiêu chí
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

//Chi tiết sản phẩm
$(document).on('click','.detail_product',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'id' : id,
        },
        success : function(data) {
            if(data.code == 200){
                $('#chitietsanpham').html(data.output);
                $('#chitietsanpham').modal('show');
            }
        }
    })
})

//Chart Index
//Chart bán chạy
var count = $('#chartProductSell').attr('data-count');
count_parse = JSON.parse(count);

var name = $('#chartProductSell').attr('data-name');
name_parse = JSON.parse(name);

var options = {
    chart: {
        type: 'donut'
    },
    series: count_parse,
    labels: name_parse,
    
}
chart_product = new ApexCharts(document.querySelector("#chartProductSell"), options);

chart_product.render();


//Chart doanh thu
var count_sales = $('#chartProductSales').attr('data-count');
count_parse_sales = JSON.parse(count_sales);

var name_sales = $('#chartProductSales').attr('data-name');
name_parse_sales = JSON.parse(name_sales);

var options = {
    chart: {
        type: 'donut'
    },
    series: count_parse_sales,
    labels: name_parse_sales,
    
    
}
chart_product_sales = new ApexCharts(document.querySelector("#chartProductSales"), options);

chart_product_sales.render();

//Lọc sản phẩm bán chạy theo tháng
$(document).on('click','.fillProductByMonth',function(e){
    e.preventDefault();
    var month = $('.month').val();
    var url = $(this).data('url');
    
    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'month' : month,
        },
        success : function(data){
            if(data.code == 200){ 
                $('.fillTable tbody').empty();
                if((data.arr['arr_product_name'] != null) && (data.arr['arr_product_qty'] != null)){
                    chart_product.updateOptions({
                        series: (data.arr['arr_product_qty']),
                        labels: (data.arr['arr_product_name']),
                    })
                    $.each(data.product,function(key,value){
                        $('.fillTable tbody').append(`
                        <tr>
                            <td style="width: 36px;">
                                <img src="${ value['sp_hinhanh'] }" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                            </td>

                            <td>
                                <h5 class="m-0 fw-normal">${ value['sp_ten'] }</h5>
                            </td>

                            <td>
                                ${ value['orderdetail_sum_soluong'] } sản phẩm
                            </td>
                        </tr> 
                    `)
                    })
                }
            }else if(data.code ==400){
                Swal.fire(
                    'Cảnh báo',
                    'Tạm thời chưa có dữ liệu để thống kê trong tháng này!',
                    'error'
                  )
            }
        }
    })
})
    
//lọc sản phẩm bán chạy theo Quý
$(document).on('click','.fillProductBy3Month',function(e) {
    e.preventDefault();
    var type = $('.type').val();
    var year = $('.year').val();
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'type' : type,
            'year' : year,
        },
        success: function (data) {
            if(data.code == 200){ 
                $('.fillTable tbody').empty();
                if((data.arr['arr_product_name'] != null) && (data.arr['arr_product_qty'] != null)){
                    chart_product.updateOptions({
                        series: (data.arr['arr_product_qty']),
                        labels: (data.arr['arr_product_name']),
                    })
                    $.each(data.product,function(key,value){
                        $('.fillTable tbody').append(`
                        <tr>
                            <td style="width: 36px;">
                                <img src="${ value['sp_hinhanh'] }" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                            </td>

                            <td>
                                <h5 class="m-0 fw-normal">${ value['sp_ten'] }</h5>
                            </td>

                            <td>
                                ${ value['orderdetail_sum_soluong'] } sản phẩm
                            </td>
                        </tr> 
                    `)
                    })
                }
            }else if(data.code == 400){
                Swal.fire(
                    'Cảnh báo',
                    'Tạm thời chưa có dữ liệu để thống kê trong tháng này',
                    'error'
                  )
            }
        }
    })
})

//lọc sản phẩm theo Ngày
$(document).on('click','.fillProductByDate',function(e){
    var dateStart = $('.dateStart').val();
    var dateEnd = $('.dateEnd').val();
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
          'dateStart' : dateStart,
          'dateEnd' : dateEnd,
        },
        success: function (data) {
            if(data.code == 200){ 
                $('.fillTable tbody').empty();
                if((data.arr['arr_product_name'] != null) && (data.arr['arr_product_qty'] != null)){
                    chart_product.updateOptions({
                        series: (data.arr['arr_product_qty']),
                        labels: (data.arr['arr_product_name']),
                    })
                    $.each(data.product,function(key,value){
                        $('.fillTable tbody').append(`
                        <tr>
                            <td style="width: 36px;">
                                <img src="${ value['sp_hinhanh'] }" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                            </td>

                            <td>
                                <h5 class="m-0 fw-normal">${ value['sp_ten'] }</h5>
                            </td>

                            <td>
                                ${ value['orderdetail_sum_soluong'] } sản phẩm
                            </td>
                        </tr> 
                    `)
                    })
                }
            }else if(data.code == 400){
            Swal.fire(
                'Cảnh báo',
                'Tạm thời chưa có dữ liệu để thống kê trong tháng này',
                'error'
                )
            }
        }
    })
})

//lọc doanh thu sản phẩm theo Tháng
$(document).on('click','.fillProductSalesByMonth',function(e){
    var month = $('.monthSales').val();
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'month' : month,
        },
        success: function(data){
            if(data.code == 200){
                $('.fillTableSales tbody').empty();
                chart_product_sales.updateOptions({
                    series: (data.arr['arr_product_sales']),
                    labels: (data.arr['arr_product_name_sales']),
                })
                $.each(data.product_sales,function(key,value){
                    console.log(key,value);
                    $('.fillTableSales tbody').append(`
                    <tr>
                        <td style="width: 36px;">
                            <img src="${ value['sp_hinhanh'] }" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                        </td>

                        <td>
                            <h5 class="m-0 fw-normal">${ value['sp_ten'] }</h5>
                        </td>

                        <td>
                            ${ Intl.NumberFormat('vi-VN').format(value['total']) } VNĐ
                        </td>

                    </tr> 
                `)
                })    

            }
        }
    })
})

//lọc doanh thu sản phẩm theo Quý
$(document).on('click','.fillProductSalesBy3Month',function(e){
    var year = $('.yearSales').val();
    var type =$('.typeSales').val();
    var url = $(this).data('url');
    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'year' : year,
            'type' : type,
        },
        success: function(data){
            if(data.code == 200){
                $('.fillTableSales tbody').empty();
                chart_product_sales.updateOptions({
                    series: (data.arr['arr_product_sales']),
                    labels: (data.arr['arr_product_name_sales']),
                })
                $.each(data.product_sales,function(key,value){
                    console.log(key,value);
                    $('.fillTableSales tbody').append(`
                    <tr>
                        <td style="width: 36px;">
                            <img src="${ value['sp_hinhanh'] }" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                        </td>

                        <td>
                            <h5 class="m-0 fw-normal">${ value['sp_ten'] }</h5>
                        </td>

                        <td>
                            ${ Intl.NumberFormat('vi-VN').format(value['total']) } VNĐ
                        </td>

                        
                    </tr> 
                `)
                })    
            }
        }
    })
})

//lọc doanh thu sản phẩm theo ngày
$(document).on('click','.fillProductSalesByDate',function(e){
    var dateStart = $('.dateSalesStart').val();
    var dateEnd = $('.dateSalesEnd').val();
    var url = $(this).data('url');
    if(dateEnd < dateStart){
        Swal.fire(
            'Cảnh báo',
            'Vui lòng chọn ngày kết thúc lớn hơn ngày bắt đầu!',
            'error'
            )
    }else
    {
        $.ajax({
            type : 'GET',
            url : url,
            data : {
                'dateStart' : dateStart,
                'dateEnd' : dateEnd,
            },
            success: function(data){
                if(data.code == 200){
                    $('.fillTableSales tbody').empty();
                    chart_product_sales.updateOptions({
                        series: (data.arr['arr_product_sales']),
                        labels: (data.arr['arr_product_name_sales']),
                    })
                    $.each(data.product_sales,function(key,value){
                        console.log(key,value);
                        $('.fillTableSales tbody').append(`
                        <tr>
                            <td style="width: 36px;">
                                <img src="${ value['sp_hinhanh'] }" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                            </td>

                            <td>
                                <h5 class="m-0 fw-normal">${ value['sp_ten'] }</h5>
                            </td>

                            <td>
                                ${ Intl.NumberFormat('vi-VN').format(value['total']) } VNĐ
                            </td>

                            
                        </tr> 
                    `)
                    })    
                }
            }
        })
    }
})