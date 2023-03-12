@extends('layout.app')

@section('title','Home')
@section('content')


<div class="container">
	<div class="row">

		<div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Article Published</h6>
                    <h2 class="text-right"><i class="fas fa-newspaper f-left"></i><span>486</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Category</h6>
                    <h2 class="text-right"><i class="fas fa-folder f-left"></i><span>486</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Users</h6>
                    <h2 class="text-right"><i class="fas fa-users f-left"></i><span>486</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Tags</h6>
                    <h2 class="text-right">  <i class="fa fa-hashtag f-left"></i><span>486</span></h2>
                </div>
            </div>
        </div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card chart-card">
                <center><h5 style="margin-top: 25px;">Monthly Count</h5></center>
                <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="article-chart" style="padding: 5px;"></canvas> 
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card chart-card">
                <center><h5 style="margin-top: 25px;">Overview</h5></center>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="doughnut-chart"></canvas>
                </div>
            </div>           
        </div>
    </div>
</div>





@endsection 

@section('script')
<script>

    //For Every month Article Count
    // Get the canvas element and context
var ctx = document.getElementById('article-chart').getContext('2d');

// Define the article data
var articleData = [
  { month: "January", count: 10 },
  { month: "February", count: 15 },
  { month: "March", count: 20 },
  { month: "April", count: 12 },
  { month: "May", count: 8 },
  { month: "June", count: 14 },
  { month: "July", count: 18 },
  { month: "August", count: 22 },
  { month: "September", count: 25 },
  { month: "October", count: 30 },
  { month: "November", count: 27 },
  { month: "December", count: 24 }
];

// Extract the months and counts into separate arrays
var months = articleData.map(function(d) { return d.month });
var counts = articleData.map(function(d) { return d.count });

// Create a new gradient for the fill color
var gradient = ctx.createLinearGradient(0, 0, 0, 200);
gradient.addColorStop(0, 'rgba(113, 83, 242, 1)');
gradient.addColorStop(1, 'rgba(113, 83, 242, 0)');

// Define the chart data
var chartData = {
  labels: months,
  datasets: [{
    label: 'Article Count',
    data: counts,
    borderColor: 'rgba(113, 83, 242, 1)',
    borderWidth: 2,
    pointBackgroundColor: 'rgba(113, 83, 242, 1)',
    pointBorderColor: '#fff',
    pointBorderWidth: 2,
    pointRadius: 5,
    fill: true,
    backgroundColor: gradient
  }]
};

// Define the chart options
var chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  legend: {
    display: false
  },
  scales: {
    xAxes: [{
      gridLines: {
        display: false
      },
      ticks: {
        fontColor: '#aaa',
        fontSize: 12,
        padding: 10
      }
    }],
    yAxes: [{
      gridLines: {
        color: '#eee',
        zeroLineColor: '#eee',
        borderDash: [2],
        borderDashOffset: [2],
        drawBorder: false
      },
      ticks: {
        fontColor: '#aaa',
        fontSize: 12,
        stepSize: 5,
        padding: 10
      }
    }]
  }
};

// Create the chart
var myChart = new Chart(ctx, {
  type: 'line',
  data: chartData,
  options: chartOptions
});



//for user category count
var ctx = document.getElementById('doughnut-chart').getContext('2d');

var purpleGradient = ctx.createLinearGradient(0, 0, 0, 200);
purpleGradient.addColorStop(0, '#8A2BE2');
purpleGradient.addColorStop(1, '#9400D3');

var doughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Total Categories', 'Total Users', 'Total Tags'],
        datasets: [{
            backgroundColor: [purpleGradient, '#0dcaf0', '#ffa900'],
            data: [1000, 2000, 500]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: true,
            position: 'bottom'
        },
        title: {
            display: true,
            text: 'Total Counts'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    var label = data.labels[tooltipItem.index];
                    var value = dataset.data[tooltipItem.index];
                    return label + ': ' + value;
                }
            }
        }
    }
});




</script>

@endsection