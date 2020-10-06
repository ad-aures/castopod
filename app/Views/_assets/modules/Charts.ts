// Import modules
import * as am4charts from "@amcharts/amcharts4/charts";
import * as am4core from "@amcharts/amcharts4/core";
import am4themes_material from "@amcharts/amcharts4/themes/material";

const drawPieChart = (chartDivId: string, dataUrl: string | null): void => {
  // Create chart instance
  const chart = am4core.create(chartDivId, am4charts.PieChart);
  am4core.percent(100);

  // Set theme
  am4core.useTheme(am4themes_material);

  chart.innerRadius = am4core.percent(10);

  // Add data
  chart.dataSource.url = dataUrl || "";
  chart.dataSource.parser.options.emptyAs = 0;

  // Add and configure Series
  const pieSeries = chart.series.push(new am4charts.PieSeries());
  pieSeries.dataFields.value = "values";
  pieSeries.dataFields.category = "labels";

  pieSeries.slices.template.stroke = am4core.color("#ffffff");
  pieSeries.slices.template.strokeWidth = 1;
  pieSeries.slices.template.strokeOpacity = 1;
  pieSeries.labels.template.disabled = true;
  pieSeries.ticks.template.disabled = true;

  chart.legend = new am4charts.Legend();
  chart.legend.position = "right";
  chart.legend.scrollable = true;
};

const drawXYChart = (chartDivId: string, dataUrl: string | null): void => {
  // Create chart instance
  const chart = am4core.create(chartDivId, am4charts.XYChart);
  am4core.percent(100);

  // Set theme
  am4core.useTheme(am4themes_material);

  // Create axes
  const dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  dateAxis.renderer.minGridDistance = 60;

  chart.yAxes.push(new am4charts.ValueAxis());

  // Add data
  chart.dataSource.url = dataUrl || "";
  chart.dataSource.parser.options.emptyAs = 0;

  // Create series
  const series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = "values";
  series.dataFields.dateX = "labels";
  series.tooltipText = "{valueY} downloads";

  series.tooltip.pointerOrientation = "vertical";

  chart.cursor = new am4charts.XYCursor();
  chart.cursor.snapToSeries = series;
  chart.cursor.xAxis = dateAxis;

  chart.scrollbarX = new am4core.Scrollbar();
};

const drawXYSeriesChart = (
  chartDivId: string,
  dataUrl: string | null
): void => {
  // Create chart instance
  const chart = am4core.create(chartDivId, am4charts.XYChart);
  am4core.percent(100);

  // Set theme
  am4core.useTheme(am4themes_material);

  // Create axes
  chart.xAxes.push(new am4charts.ValueAxis());
  chart.yAxes.push(new am4charts.ValueAxis());

  // Add data
  chart.dataSource.url = dataUrl || "";
  chart.dataSource.parser.options.emptyAs = 0;

  // Create series
  const series1 = chart.series.push(new am4charts.LineSeries());
  series1.dataFields.valueX = "X";
  series1.dataFields.valueY = "aY";

  const series2 = chart.series.push(new am4charts.LineSeries());
  series2.dataFields.valueX = "X";
  series2.dataFields.valueY = "bY";

  const series3 = chart.series.push(new am4charts.LineSeries());
  series3.dataFields.valueX = "X";
  series3.dataFields.valueY = "cY";

  const series4 = chart.series.push(new am4charts.LineSeries());
  series4.dataFields.valueX = "X";
  series4.dataFields.valueY = "dY";

  const series5 = chart.series.push(new am4charts.LineSeries());
  series5.dataFields.valueX = "X";
  series5.dataFields.valueY = "eY";
};

const DrawCharts = (): void => {
  const chartDivs: NodeListOf<HTMLDivElement> = document.querySelectorAll(
    "div[data-chart-type]"
  );

  for (let i = 0; i < chartDivs.length; i++) {
    const chartDiv: HTMLDivElement = chartDivs[i];
    const chartType = chartDiv.dataset.chartType;
    switch (chartType) {
      case "pie-chart":
        drawPieChart(chartDiv.id, chartDiv.getAttribute("data-chart-url"));
        break;
      case "xy-chart":
        drawXYChart(chartDiv.id, chartDiv.getAttribute("data-chart-url"));
        break;
      case "xy-series-chart":
        drawXYSeriesChart(chartDiv.id, chartDiv.getAttribute("data-chart-url"));
        break;
      default:
        console.error("Unknown chart type:" + chartType);
    }
  }
};

export default DrawCharts;
