//thống kê trạng thái đơn hàng
var count = $('#chartStatusOrder').attr('data-count');
count_parse = JSON.parse(count);

var name = $('#chartStatusOrder').attr('data-name');
name_parse = JSON.parse(name);

var color = $('#chartStatusOrder').attr('data-color');
color_parse = JSON.parse(color);

var options = {
    chart: {
        type: 'donut'
    },
    series: count_parse,
    labels: name_parse,
    colors: color_parse,
    
}
var chart_status = new ApexCharts(document.querySelector("#chartStatusOrder"), options);

chart_status.render();


//thống kê trạng thái đơn hàng
var count = $('#chartTotalOrder').attr('data-count');
count_parse = JSON.parse(count);

var name = $('#chartTotalOrder').attr('data-name');
name_parse = JSON.parse(name);

var color = $('#chartTotalOrder').attr('data-color');
color_parse = JSON.parse(color);

var options = {
    chart: {
        type: 'donut'
    },
    series: count_parse,
    labels: name_parse,
    colors: color_parse,
    
}
var chart_total = new ApexCharts(document.querySelector("#chartTotalOrder"), options);

chart_total.render();


//thống kê tất cả tháng
var success = $('#chartOrderByMonth').attr('data-success');
success_parse = JSON.parse(success);

var delete1 = $('#chartOrderByMonth').attr('data-delete');
delete1_parse = JSON.parse(delete1);

var check = $('#chartOrderByMonth').attr('data-check');
check_parse = JSON.parse(check);
  var options = {
        chart: {
            height: 350,
            type: "line",
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#FF1654", "#247BA0", "#47D66D"],
        series: [
        {
            type: "column",
            name: "Đã hủy",
            data: delete1_parse
        },
        {
            type: "column",
            name: "Đã duyệt",
            data: check_parse
        },
        {
            type: "column",
            name: "Đã hoàn thành",
            data: success_parse
        }
        ],
        stroke: {
            width: [4, 4, 4]
        },
        plotOptions: {
            bar: {
                columnWidth: "20%"
            }
        },
        xaxis: {
            categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']
        },
        yaxis: [
        {
            axisTicks: {
                show: true
            },
            axisBorder: {
                show: true,
                color: "#FF1654"
            },
            labels: {
                style: {
                    colors: "#FF1654"
                }
            },
            title: {
                text: "Đã hủy",
                style: {
                    color: "#FF1654"
                }
            }
        },
        {
            opposite: true,
            axisTicks: {
                show: true
            },
            axisBorder: {
                show: true,
                color: "#47D66D"
            },
            labels: {
                style: {
                    colors: "#47D66D"
                }
            },
            title: {
                text: "Đã hoàn thành",
                style: {
                    color: "#47D66D"
                }
            }
        }
        ],
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
var chart_month = new ApexCharts(document.querySelector("#chartOrderByMonth"), options);

chart_month.render();

//thống kê theo từng tháng
$(document).on('click','.fillByMonth',function(e){
    e.preventDefault();
    var month = $('.valMonth').val();
    var url = $(this).data('url');
    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'month' : month,
        },
        success: function(data) {
            if(data.code == 200)
            {
                chart_month.updateOptions({
                    series: [
                        {
                            type: "column",
                            name: "Đã hủy",
                            data: JSON.parse(data.output['arr_count_order_delete']),
                        },
                        {
                            type: "column",
                            name: "Đã hoàn thành",
                            data: JSON.parse(data.output['arr_count_order_success']),
                        }
                    ],
                    xaxis: {
                        categories: JSON.parse(data.output['arrDay']),
                    },
                })
                $('.resultOrderByMonth').css('display', 'block');
                $('.resultOrderByMonthSuccess').text(data.count_success + ' đơn hàng');
                $('.resultOrderByMonthDelete').text(data.count_delete + ' đơn hàng');
            }
        }
    })
})

//thống kê theo từng Quý
$(document).on('click','.fillBy3Month',function(e){
    e.preventDefault();
    var type = $('.typeOption').val();
    var year = $('.valYear').val();
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'type' : type,
            'year' : year,
        },
        success: function (data) {
            if(data.code == 200)
            {
                chart_month.updateOptions({
                    series: [
                        {
                            type: "column",
                            name: "Đã hủy",
                            data: JSON.parse(data.output['arr_count_order_delete']),
                        },
                        {
                            type: "column",
                            name: "Đã hoàn thành",
                            data: JSON.parse(data.output['arr_count_order_success']),
                        }
                    ],
                    xaxis: {
                        categories: JSON.parse(data.output['arrMonth']),
                    },
                })
                $('.resultOrderByMonth').css('display', 'block');
                $('.resultOrderByMonthSuccess').text(data.count_success + ' đơn hàng');
                $('.resultOrderByMonthDelete').text(data.count_delete + ' đơn hàng');
            }
        }
    })
})