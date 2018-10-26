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
      right: 5,
      left: -6
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
        right: 11,
        left: -12
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



  var companyItem = document.querySelectorAll('.graph__company-item');
  var companyItemChoice = document.querySelectorAll('.graph__company-item--choice');
  var choiceArray = Array.from(companyItemChoice);
  var classColor = [];
  
  Array.from(companyItem).forEach((elem) => {
    elem.addEventListener('click', () => {

      // if (elem.classList(3)) {
      //   choiceArray.forEach()
      //   classColor.push(elem.classList[2]);
      //   elem.classList.remove(classColor[classColor.length - 1]);

      //   elem.classList.toggle('graph__company-item--choice');
      //   elem.classList.add(classColor[0]);
      // } else {
        classColor.push(choiceArray[0].classList[2]);
        choiceArray[0].classList.remove(classColor[classColor.length - 1]);
        choiceArray[0].classList.toggle('graph__company-item--choice');
        choiceArray.shift();

        elem.classList.toggle('graph__company-item--choice');
        elem.classList.add(classColor[classColor.length - 1]);
        choiceArray.push(elem);

        classColor.shift();
      // }
    });
  });
  
})();
