(function($) {
  'use strict';
  $(function() {
    if ($("#sales-chart").length) {
      var areaData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep", "Oct"],
        datasets: [{
            data: [180, 125, 275, 30, 110, 110, 110, 170, 110, 160],
            backgroundColor: [
              'rgba(179, 180, 232, 0.78)'
            ],
            borderColor: [
              '#304894'
            ],
            borderWidth: 1,
            fill: 'origin',
            label: "purchases"
          },
          {
            data: [50, 220,125, 60, 180, 90, 285, 65, 100, 200],
            backgroundColor: [
              '#d1e6fa'
            ],
            borderColor: [
              '#6fd1f6'
            ],
            borderWidth: 1,
            fill: 'origin',
            label: "services"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: false,
            ticks: {
              display: true
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: false,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 100,
              min: 0,
              max: 300
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },


        legendCallback: function(chart) { 
          var text = [];
          text.push('<ul class="legend'+ chart.id +'">');
            text.push('<li><span class="legend-label" style="background-color:' + chart.data.datasets[0].backgroundColor + ';' + 'border: 1px solid' + chart.data.datasets[0].borderColor + '"></span>');
            text.push('Purchases');
            text.push('</li>');
            text.push('<li><span class="legend-label" style="background-color:' + chart.data.datasets[1].backgroundColor + ';' + 'border: 1px solid' + chart.data.datasets[1].borderColor + '"></span>');
            text.push('Services');
            text.push('</li>');
          text.push('</ul>');
          return text.join("");
        },


        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: .35
          },
          point: {
            radius: 0
          }
        }
      }
      var salesChartCanvas = $("#sales-chart").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
      document.getElementById('statistics-legend').innerHTML = salesChart.generateLegend();
    }

    if ($("#orders-chart").length) {
      var areaData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
        datasets: [{
            data: [130, 75, 225, 20, 70, 61, 120, 60, 90],
            backgroundColor: [
              'rgba(179, 180, 232, 0.78)'
            ],
            borderColor: [
              '#304894'
            ],
            borderWidth: 1,
            fill: 'origin',
            label: "purchases"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: false,
            ticks: {
              display: true
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: false,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 100,
              min: 0,
              max: 300
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: .35
          },
          point: {
            radius: 0
          }
        }
      }
      var salesChartCanvas = $("#orders-chart").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }

    if ($("#downloads-chart").length) {
      var areaData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr","May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May"],
        datasets: [{
            data: [130, 120, 140, 135, 170, 145, 160, 115, 190,135, 220, 200, 240, 200, 230, 220,  190,185, 220, 120, 250, 240, 270, 240,270, 260, 200, 300,290],
            backgroundColor: [
              'rgba(179, 180, 232, 0.78)'
            ],
            borderColor: [
              '#304894'
            ],
            borderWidth: 1,
            fill: 'origin',
            label: "purchases"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: false,
            ticks: {
              display: true
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: false,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 100,
              min: 0,
              max: 300
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: .05
          },
          point: {
            radius: 0
          }
        }
      }
      var salesChartCanvas = $("#downloads-chart").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }

    if ($("#new-users-chart").length) {
      var areaData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug","Sep","Oct","Nov","Dec", "Jan", "Feb", "Mar", "Apr","May"],
        datasets: [{
            data: [250, 240, 245,150, 230, 200, 190, 200,180, 190, 185, 175, 140, 90, 160, 120, 130],
            backgroundColor: [
              'rgba(179, 180, 232, 0.78)'
            ],
            
            // borderColor: [
            //   '#304894'
            // ],
            borderWidth: 1,
            fill: 'origin',
            label: "purchases"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            display: false,
            ticks: {
              display: true
            },
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'transparent',
              zeroLineColor: '#eeeeee'
            }
          }],
          yAxes: [{
            display: false,
            ticks: {
              display: true,
              autoSkip: false,
              maxRotation: 0,
              stepSize: 100,
              min: 0,
              max: 300
            },
            gridLines: {
              drawBorder: false
            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {
          line: {
            tension: .05
          },
          point: {
            radius: 0
          }
        }
      }
      var salesChartCanvas = $("#new-users-chart").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: areaData,
        options: areaOptions
      });
    }

    if ($("#new-customers-chart").length) {
      var CurrentChartCanvas = $("#new-customers-chart").get(0).getContext("2d");
      var CurrentChart = new Chart(CurrentChartCanvas, {
        type: 'bar',
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec","Jan", "Feb", "Mar", "Apr"],
          datasets: [{
              label: 'Profit',
              data: [280, 160, 150, 100, 50, 150, 220, 280,280, 220, 150, 100, 50, 150, 220, 280,280, 220, 150, 100, 50, 150, 220, 280],
              backgroundColor: ['#3c4876', '#b3b4e8','#3c4876', '#b3b4e8','#3c4876', '#b3b4e8','#3c4876', '#b3b4e8','#3c4876', '#b3b4e8','#3c4876', '#b3b4e8','#3c4876', '#b3b4e8','#3c4876', '#b3b4e8']
            }
            // {
            //   label: 'Target',
            //   data: [380, 540, 600, 480, 370, 500, 450, 590, 540, 480, 510, 300],
            //   backgroundColor: '#b3b4e8'
            // }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 2,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: false,
              gridLines: {
                drawBorder: false
              },
              ticks: {
                display: false
              }
            }],
            xAxes: [{
              stacked: true,
    categoryPercentage: 2.8,
              ticks: {
                beginAtZero: true,
                fontColor: "#9fa0a2",
                display: false
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: true
              },
              barPercentage: 0.2
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 0
            }
          }
        }
      });
    }


    if ($("#traffic-chart").length) {
      var areaData = {
        labels: ["Jan", "Feb", "Mar"],
        datasets: [{
            data: [200, 100, 100],
            backgroundColor: [
              "#d1e6fa","#b3b4e8","#44519e"
            ]
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 67,
        elements: {
          arc: {
              borderWidth: 0
          }
        },      
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        }
      }
      var trafficChartPlugins = {
        beforeDraw: function(chart) {
          var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;
      
          ctx.restore();
          var fontSize = 1.5;
          ctx.font = fontSize + "em sans-serif";
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#000";
      
          var text = "70%",
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2;
      
          ctx.fillText(text, textX, textY);
          ctx.save();
        }
      }
      var salesChartCanvas = $("#traffic-chart").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: trafficChartPlugins
      });
    }

    if ($("#traffic-chart-dark").length) {
      var areaData = {
        labels: ["Jan", "Feb", "Mar"],
        datasets: [{
            data: [200, 100, 100],
            backgroundColor: [
              "#d1e6fa","#b3b4e8","#44519e"
            ]
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 67,
        elements: {
          arc: {
              borderWidth: 0
          }
        },      
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        }
      }
      var trafficChartPlugins = {
        beforeDraw: function(chart) {
          var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;
      
          ctx.restore();
          var fontSize = 1.5;
          ctx.font = fontSize + "em sans-serif";
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#b1b1b5";
      
          var text = "70%",
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2;
      
          ctx.fillText(text, textX, textY);
          ctx.save();
        }
      }
      var salesChartCanvas = $("#traffic-chart-dark").get(0).getContext("2d");
      var salesChart = new Chart(salesChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: trafficChartPlugins
      });
    }

    if ($("#user-statics-chart").length) {
      var CurrentChartCanvas = $("#user-statics-chart").get(0).getContext("2d");
      var CurrentChart = new Chart(CurrentChartCanvas, {
        type: 'bar',
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
          datasets: [{
              label: 'Profit',
              data: [250, 100, 150, 250, 130, 220, 120],
              backgroundColor: ['#f1f2f7', '#b3b4e8','#f1f2f7', '#b3b4e8','#f1f2f7', '#b3b4e8','#f1f2f7']
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 30,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                drawBorder: false,
                color: "#fbfbfb",
              },
              ticks: {
                // beginAtZero: true,
                display: false,
                min: 40,
                stepSize: 40
              }
            }],
            xAxes: [{
              categoryPercentage: 2.5,
              ticks: {
                beginAtZero: true,
                fontColor: "#000",
                fontSize: 16,
                fontFamily: 'NunitoSans'
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: true,
                zeroLineColor: '#fff'
              },
              barPercentage: 0.2
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 0
            }
          }
        }
      });
    }

    if ($("#user-statics-chart-dark").length) {
      var CurrentChartCanvas = $("#user-statics-chart-dark").get(0).getContext("2d");
      var CurrentChart = new Chart(CurrentChartCanvas, {
        type: 'bar',
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
          datasets: [{
              label: 'Profit',
              data: [250, 100, 150, 250, 130, 220, 120],
              backgroundColor: ['#cee6fb', '#b3b4e8','#cee6fb', '#b3b4e8','#cee6fb', '#b3b4e8','#cee6fb']
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 30,
              bottom: 0
            }
          },
          scales: {
            yAxes: [{
              display: true,
              gridLines: {
                drawBorder: false,
                color: "#212740",
              },
              ticks: {
                // beginAtZero: true,
                display: false,
                min: 40,
                stepSize: 40
              }
            }],
            xAxes: [{
              categoryPercentage: 2.5,
              ticks: {
                beginAtZero: true,
                fontColor: "#b1b1b5",
                fontSize: 16,
                fontFamily: 'NunitoSans'
              },
              gridLines: {
                color: "rgba(0, 0, 0, 0)",
                display: true,
                zeroLineColor: '#fff'
              },
              barPercentage: 0.2
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 0
            }
          }
        }
      });
    }


  });
})(jQuery);