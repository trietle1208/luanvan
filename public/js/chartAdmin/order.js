//thống kê trạng thái đơn hàng
var count = $('#chartAdminStatusOrder').attr('data-count');
count_parse = JSON.parse(count);

var name = $('#chartAdminStatusOrder').attr('data-name');
name_parse = JSON.parse(name);

var color = $('#chartAdminStatusOrder').attr('data-color');
color_parse = JSON.parse(color);

var options = {
    chart: {
        type: 'donut'
    },
    series: count_parse,
    labels: name_parse,
    colors: color_parse,
    
}
var chart_status = new ApexCharts(document.querySelector("#chartAdminStatusOrder"), options);

chart_status.render();

//thống kê phương thức đơn hàng
var count = $('#chartAdminTotalOrder').attr('data-count');
count_parse = JSON.parse(count);

var name = $('#chartAdminTotalOrder').attr('data-name');
name_parse = JSON.parse(name);

var color = $('#chartAdminTotalOrder').attr('data-color');
color_parse = JSON.parse(color);

var options = {
    chart: {
        type: 'donut'
    },
    series: count_parse,
    labels: name_parse,
    colors: color_parse,
    
}
var chart_total = new ApexCharts(document.querySelector("#chartAdminTotalOrder"), options);

chart_total.render();

//thống kê đơn hàng cả năm
var success = $('#chartAdminOrderByMonth').attr('data-success');
success_parse = JSON.parse(success);

var delete1 = $('#chartAdminOrderByMonth').attr('data-delete');
delete1_parse = JSON.parse(delete1);

var check = $('#chartAdminOrderByMonth').attr('data-check');
check_parse = JSON.parse(check);

var new1 = $('#chartAdminOrderByMonth').attr('data-new');
new_parse = JSON.parse(new1);

var confirm = $('#chartAdminOrderByMonth').attr('data-confirm');
confirm_parse = JSON.parse(confirm);

var ship = $('#chartAdminOrderByMonth').attr('data-ship');
ship_parse = JSON.parse(ship);

  var options = {
        chart: {
            height: 350,
            type: "line",
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        // colors: ["#FF1654", "#247BA0", "#47D66D","#A9A9A9","#FF8C00","#FFFF00"],
        colors: ["#A9A9A9", "#247BA0", "#FF8C00","#FFFF00","#FF1654","#47D66D"],
        series: [
            {
                type: "column",
                name: "Đơn hàng mới",
                data: new_parse
            },
            {
                type: "column",
                name: "Đã duyệt",
                data: check_parse
            },
            {
                type: "column",
                name: "Đang giao",
                data: ship_parse
            },
            {
                type: "column",
                name: "Chờ xác nhận",
                data: confirm_parse
            },
            {
                type: "column",
                name: "Đã hủy",
                data: delete1_parse
            },
            {
                type: "column",
                name: "Đã hoàn thành",
                data: success_parse
            },
        ],
        
        plotOptions: {
            bar: {
                columnWidth: "80%"
            }
        },
        xaxis: {
            categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']
        },
        
        tooltip: {
            shared: false,
            intersect: true,
            x: {
                show: false
            }
        },
        legend: {
            horizontalAlign: "left",
            offsetX: 40
        }
  };
var chart_month = new ApexCharts(document.querySelector("#chartAdminOrderByMonth"), options);

chart_month.render();

//thống kê đơn hảng theo từng tháng
$(document).on('click','.fillAdminOrderByMonth',function(e){
   var month = $('.month').val();
   var url = $(this).data('url');

   $.ajax({
       type : 'GET',
       url : url,
       data : {
           'month' : month
       },
       success : function (data) {
           if(data.code == 200){
            chart_month.updateOptions({
                series: [
                    {
                        type: "column",
                        name: "Đơn hàng mới",
                        data: JSON.parse(data.output['arr_count_new_month_order']),
                    },
                    {
                        type: "column",
                        name: "Đã duyệt",
                        data: JSON.parse(data.output['arr_count_check_month_order']),
                    },
                    {
                        type: "column",
                        name: "Đang giao",
                        data: JSON.parse(data.output['arr_count_ship_month_order']),
                    },
                    {
                        type: "column",
                        name: "Chờ xác nhận",
                        data: JSON.parse(data.output['arr_count_confirm_month_order']),
                    },
                    {
                        type: "column",
                        name: "Đã hủy",
                        data: JSON.parse(data.output['arr_count_delete_month_order']),
                    },
                    {
                        type: "column",
                        name: "Đã hoàn thành",
                        data: JSON.parse(data.output['arr_count_success_month_order']),
                    },
                ],
                xaxis: {
                    categories: JSON.parse(data.output['arrDay']),
                },
            })
           }
       }
   })
})

//thống kê đơn hảng theo từng quý
$(document).on('click','.fillAdminOrderBy3Month',function(e) {
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
        success : function(data) {
            if(data.code == 200){
                chart_month.updateOptions({
                    series: [
                        {
                            type: "column",
                            name: "Đơn hàng mới",
                            data: JSON.parse(data.output['arr_count_new_month_order']),
                        },
                        {
                            type: "column",
                            name: "Đã duyệt",
                            data: JSON.parse(data.output['arr_count_check_month_order']),
                        },
                        {
                            type: "column",
                            name: "Đang giao",
                            data: JSON.parse(data.output['arr_count_ship_month_order']),
                        },
                        {
                            type: "column",
                            name: "Chờ xác nhận",
                            data: JSON.parse(data.output['arr_count_confirm_month_order']),
                        },
                        {
                            type: "column",
                            name: "Đã hủy",
                            data: JSON.parse(data.output['arr_count_delete_month_order']),
                        },
                        {
                            type: "column",
                            name: "Đã hoàn thành",
                            data: JSON.parse(data.output['arr_count_success_month_order']),
                        },
                    ],
                    
                    plotOptions: {
                        bar: {
                            columnWidth: "10%"
                        }
                    },
                    xaxis: {
                        categories: JSON.parse(data.output['arrMonth']),
                    },
                })
            }
        }
    })
})

$(document).on('click','.fillAdminOrderByDate',function(e) {
    var dateStart = $('.dateStart').val();
    var dateEnd = $('.dateEnd').val();
    var url = $(this).data('url');

    if(dateEnd == '' || dateStart == ''){
        Swal.fire(
          'Cảnh báo',
          'Vui lòng chọn ngày bắt đầu và ngày kết thúc!',
          'error'
        )
    }
    else if(dateEnd <= dateStart) {
    Swal.fire(
        'Cảnh báo',
        'Vui lòng chọn ngày kết thúc lớn hơn ngày bắt đầu!',
        'error'
    )
    }
    else
    {
        $.ajax({
            type : 'GET',
            url : url,
            data : {
                'dateStart' : dateStart,
                'dateEnd' : dateEnd,
            },
            success : function (data) {
                if(data.code == 200){
                    chart_month.updateOptions({
                        series: [
                            {
                                type: "column",
                                name: "Đơn hàng mới",
                                data: JSON.parse(data.output['arr_count_new_month_order']),
                            },
                            {
                                type: "column",
                                name: "Đã duyệt",
                                data: JSON.parse(data.output['arr_count_check_month_order']),
                            },
                            {
                                type: "column",
                                name: "Đang giao",
                                data: JSON.parse(data.output['arr_count_ship_month_order']),
                            },
                            {
                                type: "column",
                                name: "Chờ xác nhận",
                                data: JSON.parse(data.output['arr_count_confirm_month_order']),
                            },
                            {
                                type: "column",
                                name: "Đã hủy",
                                data: JSON.parse(data.output['arr_count_delete_month_order']),
                            },
                            {
                                type: "column",
                                name: "Đã hoàn thành",
                                data: JSON.parse(data.output['arr_count_success_month_order']),
                            },
                        ],
                        xaxis: {
                            categories: JSON.parse(data.output['arrDay']),
                        },
                    })
                }
            }
        })
    }
})