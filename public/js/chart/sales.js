//Thống kê doanh thu cả năm
var receipt = $('#chartTotalSales').attr('data-receipt');
receipt_parse = JSON.parse(receipt);

var order = $('#chartTotalSales').attr('data-order');
order_parse = JSON.parse(order);

var sales = $('#chartTotalSales').attr('data-sales');
sales_parse = JSON.parse(sales);

var month = $('#chartTotalSales').attr('data-month');
month_parse = JSON.parse(month);
var options = {
    chart: {
      height: 400,
      type: "line",
      stacked: false
    },
    dataLabels: {
      enabled: true,
      enabledOnSeries: [2]
    },
    colors: ['#99C2A2', '#C5EDAC', '#66C7F4'],
    series: [
      
      {
        name: 'Chi phí',
        type: 'column',
        data: receipt_parse
      },
      {
        name: "Doanh thu",
        type: 'column',
        data: order_parse
      },
      {
        name: "Lợi nhuận",
        type: 'line',
        data: sales_parse
      },
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
      categories: month_parse
    },
    yaxis: [
      {
        seriesName: 'Chi phí',
        axisTicks: {
          show: true
        },
        axisBorder: {
          show: true,
        },
        title: {
          text: "Chi phí"
        }
      },
      {
        seriesName: 'Chi phí',
        show: false
      }, {
        opposite: true,
        seriesName: 'Doanh thu',
        axisTicks: {
          show: true
        },
        axisBorder: {
          show: true,
        },
        title: {
          text: "Doanh thu"
        }
      }
    ],
    tooltip: {
      shared: false,
      intersect: true,
      x: {
        show: true
      }
    },
    legend: {
      horizontalAlign: "left",
      offsetX: 40
    }
  };
  
  var chart_sales = new ApexCharts(document.querySelector("#chartTotalSales"), options);
  
  chart_sales.render();

//Thống kê doanh thu theo từng tháng
$(document).on('click','.fillByMonth',function (e){
    e.preventDefault();
    var month = $('.valMonth').val();
    var url = $(this).data('url');

    $.ajax({
        type : 'GET',
        url : url,
        data : {
            'month' : month,
        },
        success: function (data) {
            if(data.code == 200){
                chart_sales.updateOptions({
                  series: [
                      {
                          type: "column",
                          name: "Chi phí",
                          data: JSON.parse(data.output['arr_receipt']),
                      },
                      {
                          type: "column",
                          name: "Doanh thu",
                          data: JSON.parse(data.output['arr_order']),
                      },
                      {
                          type: "line",
                          name: "Lợi nhuận",
                          data: JSON.parse(data.output['arr_sales']),
                      },
                  ],
                  xaxis: {
                      categories: JSON.parse(data.output['arrDay']),
                  },
              });
              $('.total_receipt').html(data.sum_receipt);
              $('.total_order').html(data.sum_order);
              $('.total_sales').html(data.sum_sales);
            }
        }
    })
})

//Thống kê doanh thu theo từng quý
$(document).on('click','.fillBy3Month',function(e){
    var type = $('.typeOption').val();
    var year = $('.valYear').val();
    var url = $(this).data('url');

    $.ajax({
      type : 'GET',
      url : url,
      data : {
        'type' : type,
        'year'  :year,
      },
      success : function (data) {
          if(data.code == 200){
            chart_sales.updateOptions({
              series: [
                  {
                      type: "column",
                      name: "Chi phí",
                      data: JSON.parse(data.output['arr_receipt']),
                  },
                  {
                      type: "column",
                      name: "Doanh thu",
                      data: JSON.parse(data.output['arr_order']),
                  },
                  {
                      type: "line",
                      name: "Lợi nhuận",
                      data: JSON.parse(data.output['arr_sales']),
                  },
              ],
              xaxis: {
                  categories: JSON.parse(data.output['arrMonth']),
              },
          });
          $('.total_receipt').html(data.sum_receipt);
          $('.total_order').html(data.sum_order);
          $('.total_sales').html(data.sum_sales);
        }
      }
    })
})

//Thống kê doanh thu theo ngày
$(document).on('click','.fillByDate',function(e){
  var dateStart = $('.valDateStart').val();
  var dateEnd = $('.valDateEnd').val();
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
  else{
    $.ajax({
      type : 'GET',
      url : url,
      data : {
        'dateStart' : dateStart,
        'dateEnd' : dateEnd,
      },
      success : function (data) {
          if(data.code == 200){
            chart_sales.updateOptions({
              series: [
                  {
                      type: "column",
                      name: "Chi phí",
                      data: JSON.parse(data.output['arr_receipt']),
                  },
                  {
                      type: "column",
                      name: "Doanh thu",
                      data: JSON.parse(data.output['arr_order']),
                  },
                  {
                      type: "line",
                      name: "Lợi nhuận",
                      data: JSON.parse(data.output['arr_sales']),
                  },
              ],
              xaxis: {
                  categories: JSON.parse(data.output['arrDay']),
              },
          });
          $('.total_receipt').html(data.sum_receipt);
          $('.total_order').html(data.sum_order);
          $('.total_sales').html(data.sum_sales);
        }
      }
    });
  }
})
  