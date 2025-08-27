// charts.js - Chart Functions using ApexCharts

$(function () {
  "use strict";

  // Monthly helpdesks chart
  function chart_month() {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        chart_month: true,
      },
      dataType: "json",
      success: function (response) {
        var seriesData = response.series;
        var labelsData = response.labels;

        var options = {
          title: {
            text: 'Helpdesks Per Month',
            align: 'left'
          },
          dataLabels: {
            enabled: true,
          },
          series: [
            {
              name: "Desktops",
              data: seriesData,
            },
          ],
          chart: {
            height: 350,
            type: "line",
            toolbar: {
              show: true,
              tools: {
                download: true,
                selection: false,
                zoom: false,
                zoomin: false,
                zoomout: false,
                pan: false,
                reset: false,
              },
              autoSelected: "zoom",
            },
          },
          stroke: {
            curve: "straight",
          },
          xaxis: {
            categories: labelsData,
          },
          colors: generateHSLColors(response.series.length),
        };

        var chart = new ApexCharts(
          document.querySelector("#chart_month"),
          options
        );
        chart.render();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
      },
    });
  }

  // Category-wise helpdesks chart
  function chart_category() {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        chart_category: true,
      },
      dataType: "json",
      success: function (response) {
        var seriesData = response.series;
        var labelsData = response.labels;

        var options = {
          title: {
            text: 'Helpdesks Per Category',
            align: 'left'
          },
          dataLabels: {
            enabled: true,
            textAnchor: "start",
            formatter: function (val, opt) {
              return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val;
            },
            offsetX: 0,
          },
          series: [
            {
              data: seriesData,
            },
          ],
          chart: {
            type: "bar",
            height: 350,
            toolbar: {
              show: true,
              tools: {
                download: true,
              },
              autoSelected: "zoom",
            },
          },
          plotOptions: {
            bar: {
              distributed: true,
              horizontal: true,
              borderRadius: 4,
              borderRadiusApplication: "end",
              dataLabels: {
                position: "bottom",
              },
            },
          },
          colors: generateHSLColors(response.series.length),
          xaxis: {
            categories: labelsData,
          },
          yaxis: {
            labels: {
              show: false,
            },
          },
        };

        var chart = new ApexCharts(
          document.querySelector("#chart_category"),
          options
        );
        chart.render();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
      },
    });
  }

  // Division-wise helpdesks chart
  function chart_division() {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        chart_division: true,
      },
      dataType: "json",
      success: function (response) {
        var seriesData = response.series;
        var labelsData = response.labels;

        var options = {
          title: {
            text: 'Helpdesks Per Division',
            align: 'left'
          },
          dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
              return val.toFixed(2) + "%";
            },
          },
          series: seriesData,
          chart: {
            type: "donut",
            height: 350,
            toolbar: {
              show: true,
              tools: {
                download: true,
              },
              autoSelected: "zoom",
            },
          },
          labels: labelsData,
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
          colors: generateHSLColors(response.series.length),
        };

        var chart = new ApexCharts(
          document.querySelector("#chart_division"),
          options
        );
        chart.render();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
      },
    });
  }

  // Gender-wise helpdesks chart
  function chart_sex() {
    $.ajax({
      url: "/isds/includes/fetch.php",
      type: "GET",
      data: {
        chart_sex: true,
      },
      dataType: "json",
      success: function (response) {
        var seriesData = response.series;
        var labelsData = response.labels;

        var options = {
          title: {
            text: 'Helpdesks Per Sex',
            align: 'left'
          },
          dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
              return val.toFixed(2) + "%";
            },
          },
          series: seriesData,
          chart: {
            type: "pie",
            height: 350,
            toolbar: {
              show: true,
              tools: {
                download: true,
              },
              autoSelected: "zoom",
            },
          },
          labels: labelsData,
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
          colors: generateHSLColors(response.series.length),
        };

        var chart = new ApexCharts(
          document.querySelector("#chart_sex"),
          options
        );
        chart.render();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
      },
    });
  }

  // Initialize charts if elements exist
  if ($("#chart_month").length) {
    chart_month();
  }

  if ($("#chart_category").length) {
    chart_category();
  }

  if ($("#chart_division").length) {
    chart_division();
  }

  if ($("#chart_sex").length) {
    chart_sex();
  }

});