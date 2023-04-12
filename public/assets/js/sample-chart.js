var sampleChartClass;
(function($) {
  $(document).ready(function(){

    var labels = Object.keys(Estadistica);
    labels.shift();
    var data = Object.values(Estadistica);
    data.shift();

    var ctx = document.getElementById('myChart');
    sampleChartClass.ChartData(ctx, 'bar', labels, data)

  });
  sampleChartClass = {
    ChartData:function (ctx, type, labels, data) {
    new Chart(ctx, {
      type: type,
      data: {
        labels: labels,
        datasets: [
        {
          label: false,
          data: data,
          backgroundColor: [
            '#690038',
            '#52002B',
            '#250014',
          ],
          borderWidth: 2
        },
      ],
      },
      options:
      {
        plugins: {
          title: {
              display: true,
              text: 'Descripción de usuarios'
          },
          legend: {
            display: false,
          },
      },
        indexAxis: 'y',
        scales:
        {
          x:
          {
            display: false,
            grid:{
              display: false,
            },
            ticks: {
              stepSize:1
            }
          },
          y:
          {
            display:false,
            grid: {
              display: false,
            },
            beginAtZero: true
          }
        }
      }
    });
    }
  }

})(jQuery)