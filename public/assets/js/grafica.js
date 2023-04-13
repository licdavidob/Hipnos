var graficas;
(function($) {
  $(document).ready(function(){

    var labels = Object.keys(Estadistica);
    labels.shift();
    var data = Object.values(Estadistica);
    data.shift();

    var ctx = document.getElementById('graficaPrincipal');
    graficas.ChartData(ctx, 'bar', labels, data)

  });
  graficas = {
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
      maintainAspectRatio: false,
      options:
      {
        responsive: true,
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