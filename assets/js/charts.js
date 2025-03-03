const Charts = {
  renderChart(selector, options) {
    if ($(selector).length) {
      const chart = new ApexCharts(document.querySelector(selector), options);
      chart.render();
    }
  },

  fetchAndRenderChart(selector, chartType, title, dataKey) {
    Utils.fetchData(
      "/isds/includes/fetch.php",
      { [dataKey]: true },
      (response) => {
        const options = {
          title: { text: title, align: "left" },
          series: chartType === "line" || chartType === "bar" ? [{ data: response.series }] : response.series,
          chart: { height: 350, type: chartType, toolbar: { show: true, tools: { download: true } } },
          colors: Utils.generateHSLColors(response.series.length),
          xaxis: { categories: response.labels },
          dataLabels: { enabled: true },
        };

        if (chartType === "bar") {
          options.plotOptions = { bar: { horizontal: true, distributed: true } };
          options.yaxis = { labels: { show: false } };
        } else if (chartType === "pie" || chartType === "donut") {
          options.labels = response.labels;
          options.responsive = [{ breakpoint: 480, options: { chart: { width: 200 }, legend: { position: "bottom" } } }];
        }

        this.renderChart(selector, options);
      }
    );
  },

  init() {
    this.fetchAndRenderChart("#chart_month", "line", "Helpdesks Per Month", "chart_month");
    this.fetchAndRenderChart("#chart_category", "bar", "Helpdesks Per Category", "chart_category");
    this.fetchAndRenderChart("#chart_division", "donut", "Helpdesks Per Division", "chart_division");
    this.fetchAndRenderChart("#chart_sex", "pie", "Helpdesks Per Sex", "chart_sex");
  },
};