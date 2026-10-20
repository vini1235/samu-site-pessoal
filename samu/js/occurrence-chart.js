(function () {
  'use strict';

  window.renderOccurrenceChart = function (rows) {
    var container = document.getElementById('occurrence-chart');
    var plot = document.getElementById('piechart');
    var legend = document.getElementById('chart-legend');
    var colors = ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099', '#0099c6'];
    var chart = null;
    var data = null;
    var resizeTimer;
    var lastWidth = 0;
    var lastHeight = 0;

    // The chart pages are also usable directly, without an enclosing iframe.
    function syncFrameHeight() {
      var frame = window.frameElement;
      if (frame) {
        var height = Math.ceil(container.getBoundingClientRect().height);
        if (height > 0 && frame.style.height !== height + 'px') {
          frame.style.height = height + 'px';
        }
      }
    }

    function draw() {
      var width = plot.clientWidth;
      var height = plot.clientHeight;
      if (chart && width > 0 && height > 0 &&
          (width !== lastWidth || height !== lastHeight)) {
        chart.draw(data, {
          pieHole: 0.4,
          legend: 'none',
          colors: colors,
          // Keep the chart slices aligned with every entry in the HTML legend.
          sliceVisibilityThreshold: 0,
          width: width,
          height: height,
          backgroundColor: 'transparent',
          fontName: 'Segoe UI',
          chartArea: {
            left: 8,
            top: 8,
            width: Math.max(1, width - 16),
            height: Math.max(1, height - 16)
          }
        });
        lastWidth = width;
        lastHeight = height;
      }
      syncFrameHeight();
    }

    function scheduleDraw() {
      window.clearTimeout(resizeTimer);
      resizeTimer = window.setTimeout(draw, 100);
    }

    if (rows.slice(1).some(function (row) { return Number(row[1]) > 0; })) {
      data = google.visualization.arrayToDataTable(rows);
      chart = new google.visualization.PieChart(plot);
      rows.slice(1).forEach(function (row, index) {
        var item = document.createElement('li');
        var swatch = document.createElement('span');
        var label = document.createElement('span');
        swatch.className = 'chart-legend-swatch';
        swatch.style.backgroundColor = colors[index % colors.length];
        swatch.setAttribute('aria-hidden', 'true');
        label.className = 'chart-legend-label';
        label.textContent = row[0] + ' — ' + Number(row[1]).toLocaleString('pt-BR');
        item.appendChild(swatch);
        item.appendChild(label);
        legend.appendChild(item);
      });
    } else {
      container.classList.add('occurrence-chart-empty');
      plot.classList.add('chart-empty');
      plot.textContent = 'Nenhuma ocorrência para exibir.';
      plot.setAttribute('aria-label', plot.textContent);
      legend.hidden = true;
    }

    window.addEventListener('resize', scheduleDraw);
    if ('ResizeObserver' in window) {
      var observer = new ResizeObserver(scheduleDraw);
      observer.observe(container);
      observer.observe(plot);
    }
    draw();
  };
}());
