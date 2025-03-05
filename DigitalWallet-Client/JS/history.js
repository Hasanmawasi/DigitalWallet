

const base_url = "http://13.36.167.91/";
let month = [];
let amount = [];
async function graphData(id) {
    try {
        const response = await axios.post(base_url+"users/v1/getWithdraws.php",{
           wallet_id:id,
        }, {
            headers: {
                "Content-Type": "application/json"
            }
        }
    );
    console.log(response);
    return response;
}catch(error){
    console.log(error);
}
};
let id = localStorage.getItem("walletInUse");
async function waitdata() {
    let res = await graphData(id);
    month = res.data?.month;
    amount = res.data?.amount;
    // console.log(month,amount)
    var options = {
        series: [{
        name: 'Inflation',
        data: await amount
      }],
        chart: {
        height: 350,
        type: 'bar',
      },
      plotOptions: {
        bar: {
          borderRadius: 10,
          dataLabels: {
            position: 'top', // top, center, bottom
          },
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val + "%";
        },
        offsetY: -20,
        style: {
          fontSize: '12px',
          colors: ["#304758"]
        }
      },
      
      xaxis: {
        categories: await month,
        position: 'top',
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        crosshairs: {
          fill: {
            type: 'gradient',
            gradient: {
              colorFrom: '#D8E3F0',
              colorTo: '#BED1E6',
              stops: [0, 100],
              opacityFrom: 0.4,
              opacityTo: 0.5,
            }
          }
        },
        tooltip: {
          enabled: true,
        }
      },
      yaxis: {
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false,
        },
        labels: {
          show: false,
          formatter: function (val) {
            return val + "%";
          }
        }
      
      },
      title: {
        text: 'Monthly Withdraw Amount',
        floating: true,
        offsetY: 330,
        align: 'center',
        style: {
          color: '#444'
        }
      }
      };
    
      var chart = new ApexCharts(document.querySelector("#chart-withdraw"), options);
      chart.render();
}
waitdata()


// var options = {
// series: [{
// name: "Withdraws",
// data: amount
// }],
// chart: {
// height: 350,
// type: 'line',
// zoom: {
// enabled: false
// }
// },
// dataLabels: {
// enabled: false
// },
// stroke: {
// curve: 'straight'
// },
// title: {
// text: 'Product Trends by Month',
// align: 'left'
// },
// grid: {
// row: {
// colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
// opacity: 0.5
// },
// },
// xaxis: {
// categories:amount,
// }
// };

// var chart = new ApexCharts(document.querySelector("#chart-withdraw"), options);
// chart.render();
