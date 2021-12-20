//Thống kê tình trạng phiếu nhập
var count = $('#chartStatusReceipt').attr('data-count');
count_parse = JSON.parse(count);

var name = $('#chartStatusReceipt').attr('data-name');
name_parse = JSON.parse(name);

var color = $('#chartStatusReceipt').attr('data-color');
color_parse = JSON.parse(color);

var options = {
    chart: {
        type: 'donut'
    },
    series: count_parse,
    labels: name_parse,
    colors: color_parse,
    
}
var chart_status = new ApexCharts(document.querySelector("#chartStatusReceipt"), options);

chart_status.render();

//Thống kê chi phí phiếu nhập
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
    plotOptions: {
        pie: {
          expandOnClick: false
        }
      }
    
}
var chart_total = new ApexCharts(document.querySelector("#chartTotalOrder"), options);

chart_total.render();

//Thống kê phiếu nhập tất cả tháng
var success = $('#chartReceiptByMonth').attr('data-success');
success_parse = JSON.parse(success);

var delete1 = $('#chartReceiptByMonth').attr('data-delete');
delete1_parse = JSON.parse(delete1);

var total = $('#chartReceiptByMonth').attr('data-total');
total_parse = JSON.parse(total);
  var options = {
        chart: {
            height: 450,
            type: "line",
            stacked: false
        },
        dataLabels: {
            enabled: true,
            enabledOnSeries: [2]
        },
        colors: ["#FF1654", "#247BA0","#087E16"],
        series: [
        {
            type: "column",
            name: "Chưa duyệt",
            data: delete1_parse
        },
        {
            type: "column",
            name: "Đã duyệt",
            data: success_parse
        },
        {
            type: "line",
            name: "Chi phí",
            data: total_parse
        },
        ],
        stroke: {
            width: [4, 4]
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
                text: "Chưa duyệt",
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
                color: "#247BA0"
            },
            labels: {
                style: {
                    colors: "#247BA0"
                }
            },
            title: {
                text: "Đã duyệt",
                style: {
                    color: "#247BA0"
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
var chart_month = new ApexCharts(document.querySelector("#chartReceiptByMonth"), options);

chart_month.render();


//Thống kê phiếu nhập theo từng Tháng
$(document).on('click','.fillByMonth',function(e){
    e.preventDefault();
    var month = $('.valMonth').val();
    var url = $(this).data('url');
    $.ajax({
        type : 'GET',
        url : url,
        data : 
        {
            'month': month,
        },
        success: function (data) {
            if(data.code == 200){
                chart_month.updateOptions({
                    series: [
                        {
                            type: "column",
                            name: "Chưa duyệt",
                            data: JSON.parse(data.output['arr_count_receipt_delete']),
                        },
                        {
                            type: "column",
                            name: "Đã duyệt",
                            data: JSON.parse(data.output['arr_count_receipt_success']),
                        },
                        {
                            type: "line",
                            name: "Chi phí",
                            data: JSON.parse(data.output['arr_count_receipt_total_success']),
                        },
                    ],
                    xaxis: {
                        categories: JSON.parse(data.output['arrDay']),
                    },
                })
                $('.resultReceiptByMonth').css('display', 'block');
                $('.resultReceiptByMonthSuccess').text(data.count_success + ' phiếu');
                $('.resultReceiptByMonthDelete').text(data.count_delete + ' phiếu');
                $('.resultTotalReceiptByMonthDelete').text(data.total_receipt + ' VNĐ');
            }
        }
    })
})

//Thống kê theo từng quý
$(document).on('click','.fillBy3Month',function(e){
    e.preventDefault();
    var type = $('.type').val();
    var year = $('.valYear').val();
    var url = $(this).data('url');
    $.ajax({
        type : 'GET',
        url : url,
        data : 
        {
            'type' : type,
            'year' : year,
        },
        success: function (data) {
            if(data.code == 200){
                chart_month.updateOptions({
                    series: [
                        {
                            type: "column",
                            name: "Chưa duyệt",
                            data: JSON.parse(data.output['arr_count_receipt_delete']),
                        },
                        {
                            type: "column",
                            name: "Đã duyệt",
                            data: JSON.parse(data.output['arr_count_receipt_success']),
                        },
                        {
                            type: "line",
                            name: "Chi phí",
                            data: JSON.parse(data.output['arr_count_total_receipt']),
                        },
                    ],
                    xaxis: {
                        categories: JSON.parse(data.output['arrMonth']),
                    },
                })
                $('.resultReceiptByMonth').css('display', 'block');
                $('.resultReceiptByMonthSuccess').text(data.count_success + ' phiếu');
                $('.resultReceiptByMonthDelete').text(data.count_delete + ' phiếu');
                $('.resultTotalReceiptByMonthDelete').text(data.total_receipt + ' VNĐ');
            }
        }
    })
})