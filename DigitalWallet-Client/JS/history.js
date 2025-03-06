

const base_url = "http://13.36.167.91/";
let month = [];
let amount = [];
async function graphData(id,type) {
    try {
        const response = await axios.post(base_url+"users/v1/getWithdraws.php",{
           wallet_id:id,
           type:type
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
    let res = await graphData(id,"withdraw");
    month = res.data?.month;
    amount = res.data?.amount;
    // console.log(month,amount)
    var options = {
        series: [{
        name: 'Withdraws',
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
// depost graphhh
let dmonth=[];
let damount =[];
waitdataDeposit()
async function waitdataDeposit() {
    let res = await graphData(id,"deposit");
    dmonth = res.data?.month;
    damount = res.data?.amount;
    // console.log(month,amount)
    var options = {
        series: [{
        name: 'deposits',
        data: await damount
      }],
        chart: {
        height: 350,
        type: 'bar',
      },
      colors: ["#8229bd"], 
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
        categories: await dmonth,
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
              colorFrom: '#8229bd',
              colorTo: '#8229bd',
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
    
      var chart = new ApexCharts(document.querySelector("#chart-deposit"), options);
      chart.render();

}
 
