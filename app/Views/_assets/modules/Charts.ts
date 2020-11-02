// Import modules
import am4geodata_worldLow from "@amcharts/amcharts4-geodata/worldLow";
import * as am4charts from "@amcharts/amcharts4/charts";
import * as am4core from "@amcharts/amcharts4/core";
import * as am4maps from "@amcharts/amcharts4/maps";
import am4themes_material from "@amcharts/amcharts4/themes/material";

const drawPieChart = (chartDivId: string, dataUrl: string | null): void => {
  // Create chart instance
  const chart = am4core.create(chartDivId, am4charts.PieChart);
  am4core.percent(100);
  chart.exporting.menu = new am4core.ExportMenu();
  chart.exporting.menu.align = "left";
  chart.exporting.menu.verticalAlign = "top";
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
  chart.exporting.menu = new am4core.ExportMenu();
  chart.exporting.menu.align = "right";
  chart.exporting.menu.verticalAlign = "bottom";
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
  series.tooltipText = "{valueY}";
  series.strokeWidth = 2;
  // Make bullets grow on hover
  const bullet = series.bullets.push(new am4charts.CircleBullet());
  bullet.circle.strokeWidth = 2;
  bullet.circle.radius = 4;
  bullet.circle.fill = am4core.color("#fff");
  const bullethover = bullet.states.create("hover");
  bullethover.properties.scale = 1.3;
  series.tooltip.pointerOrientation = "vertical";
  chart.cursor = new am4charts.XYCursor();
  chart.cursor.snapToSeries = series;
  chart.cursor.xAxis = dateAxis;
  chart.scrollbarX = new am4core.Scrollbar();
};

const drawBarChart = (chartDivId: string, dataUrl: string | null): void => {
  // Create chart instance
  const chart = am4core.create(chartDivId, am4charts.XYChart);
  am4core.percent(100);
  chart.exporting.menu = new am4core.ExportMenu();
  chart.exporting.menu.align = "right";
  chart.exporting.menu.verticalAlign = "bottom";
  // Set theme
  am4core.useTheme(am4themes_material);
  chart.dataSource.url = dataUrl || "";
  chart.dataSource.parser.options.emptyAs = 0;
  const categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "labels";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;
  chart.yAxes.push(new am4charts.ValueAxis());
  // Create series
  const series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueY = "values";
  series.dataFields.categoryX = "labels";
  series.name = "Hits";
  series.columns.template.tooltipText = "{valueY} hits";
  series.columns.template.fillOpacity = .8;
  const columnTemplate = series.columns.template;
  columnTemplate.strokeWidth = 2;
  columnTemplate.strokeOpacity = 1;
};


const drawXYDurationChart = (
  chartDivId: string,
  dataUrl: string | null
): void => {
  // Create chart instance
  const chart = am4core.create(chartDivId, am4charts.XYChart);
  am4core.percent(100);
  chart.exporting.menu = new am4core.ExportMenu();
  chart.exporting.menu.align = "right";
  chart.exporting.menu.verticalAlign = "bottom";
  // Set theme
  am4core.useTheme(am4themes_material);
  // Create axes
  const dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  dateAxis.renderer.minGridDistance = 60;
  const yAxis = chart.yAxes.push(new am4charts.DurationAxis());
  yAxis.baseUnit = "second";
  chart.durationFormatter.durationFormat = "hh'h,' mm'mn'";
  // Add data
  chart.dataSource.url = dataUrl || "";
  chart.dataSource.parser.options.emptyAs = 0;
  // Create series
  const series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = "values";
  series.dataFields.dateX = "labels";
  series.tooltipText = "{valueY.formatDuration()}";
  series.strokeWidth = 2;
  // Make bullets grow on hover
  const bullet = series.bullets.push(new am4charts.CircleBullet());
  bullet.circle.strokeWidth = 2;
  bullet.circle.radius = 4;
  bullet.circle.fill = am4core.color("#fff");
  const bullethover = bullet.states.create("hover");
  bullethover.properties.scale = 1.3;
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
  chart.exporting.menu = new am4core.ExportMenu();
  chart.exporting.menu.align = "right";
  chart.exporting.menu.verticalAlign = "bottom";
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

const drawMapChart = (chartDivId: string, dataUrl: string | null): void => {
  // Create map instance
  const chart = am4core.create(chartDivId, am4maps.MapChart);
  am4core.percent(100);
  chart.exporting.menu = new am4core.ExportMenu();
  chart.exporting.menu.align = "left";
  chart.exporting.menu.verticalAlign = "top";
  // Set theme
  am4core.useTheme(am4themes_material);
  // Set map definition
  chart.geodata = am4geodata_worldLow;
  // Set projection
  chart.projection = new am4maps.projections.Miller();
  // Create map polygon series
  const polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
  // Exclude Antartica
  polygonSeries.exclude = ["AQ"];
  // Make map load polygon (like country names) data from GeoJSON
  polygonSeries.useGeodata = true;
  // Configure series
  const polygonTemplate = polygonSeries.mapPolygons.template;
  polygonTemplate.tooltipText = "{name}";
  polygonTemplate.polygon.fillOpacity = 0.6;
  // Create hover state and set alternative fill color
  const hs = polygonTemplate.states.create("hover");
  hs.properties.fill = chart.colors.getIndex(0);
  // Add image series
  const imageSeries = chart.series.push(new am4maps.MapImageSeries());
  imageSeries.dataSource.url = dataUrl || "";
  imageSeries.mapImages.template.propertyFields.longitude = "longitude";
  imageSeries.mapImages.template.propertyFields.latitude = "latitude";
  imageSeries.mapImages.template.tooltipText =
    "{country_code}, {region_code}:\n[bold]{value}[/] hits";
  const circle = imageSeries.mapImages.template.createChild(am4core.Circle);
  circle.radius = 1;
  circle.fill = am4core.color("#60f");
  imageSeries.heatRules.push({
    target: circle,
    property: "radius",
    min: 0.5,
    max: 3,
    dataField: "value",
  });
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
      case "bar-chart":
        drawBarChart(chartDiv.id, chartDiv.getAttribute("data-chart-url"));
        break;
      case "xy-duration-chart":
        drawXYDurationChart(
          chartDiv.id,
          chartDiv.getAttribute("data-chart-url")
        );
        break;
      case "xy-series-chart":
        drawXYSeriesChart(chartDiv.id, chartDiv.getAttribute("data-chart-url"));
        break;
      case "map-chart":
        drawMapChart(chartDiv.id, chartDiv.getAttribute("data-chart-url"));
        break;
      default:
        console.error("Unknown chart type:" + chartType);
    }
  }
};

export default DrawCharts;
