// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

function getDataDonut() {
  var dta;
  const d = new Date();
  const monthNames = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];
  axios
    .post("./js/demo/GetChart.php", {
      action: "ChartBAR",
      CMonth: monthNames[d.getMonth()],
      CYear: d.getFullYear(),
    })
    .then((res) => {
      console.log(res.data);

      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: ["BAR", "FAMIGLA", "TURKISH"],
          datasets: [
            {
              data: res.data,
              backgroundColor: ["#000000", "#8b4513", "#CCAE88"],
              hoverBackgroundColor: ["#000000", "#8b4513", "#CCAE88"],
              hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#ea8016",
            borderColor: "#ea8016",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: false,
          },
          cutoutPercentage: 80,
        },
      });
    });
}
window.onload = getDataDonut();
// Pie Chart Example


var pusher = new Pusher("e5fe60b6bb6d56b8b93e", {
  cluster: "us2",
  encrypted: true,
});

var channelStat2 = pusher.subscribe("my-channel");
channelStat2.bind("Stat-Update", async (data) => {
  getDataDonut();
});