'use strict';

(function() {

  new Chartist.Line('.big-graph', {
    labels: ['27', '28', '29', '30', '31', '1', '2'],
    series: [
      [70, 80, 60, 50, 40, 60, 60],
      [30, 40, 30, 50, 70, 60, 80],
      [20, 40, 70, 80, 100, 60, 70],
      [80, 70, 60, 40, 30, 10, 20]
    ]
  }, {
    fullWidth: true,
    chartPadding: {
      right: 50
    },
    axisY: {
      type: Chartist.FixedScaleAxis,
      low: 0,
      high: 100,
      divisor: 11,
      ticks: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]
    }
  });
  
  var smallGraph = document.querySelectorAll('.small-graph');
  Array.from(smallGraph).forEach((elem) => {
    new Chartist.Line(elem, {
      labels: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
      series: [
        [80, 70, 60, 40, 30, 10, 20]
      ]
    }, {
      fullWidth: true,
      chartPadding: {
        right: 30
      },
      axisY: {
        type: Chartist.FixedScaleAxis,
        low: 0,
        high: 100,
        divisor: 3,
        ticks: [0, 50, 100]
      }
    });
  });
  
})();
