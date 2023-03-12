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
                <canvas id="monthly-count-chart" style="padding: 5px;"></canvas> 
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
    var ctx = document.getElementById('monthly-count-chart').getContext('2d');

var monthlyCountChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Monthly Count',
            backgroundColor: [
                'rgb(81, 150, 255)',
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(255, 159, 64)',
                'rgb(153, 102, 255)',
                'rgb(255, 106, 106)',
                'rgb(51, 217, 178)',
                'rgb(255, 159, 243)',
                'rgb(120, 120, 120)',
                'rgb(65, 201, 223)'
            ],
            hoverBackgroundColor: [
                'rgb(121, 184, 255)',
                'rgb(255, 131, 157)',
                'rgb(106, 191, 255)',
                'rgb(255, 223, 153)',
                'rgb(118, 221, 221)',
                'rgb(255, 191, 116)',
                'rgb(186, 146, 255)',
                'rgb(255, 146, 146)',
                'rgb(91, 233, 200)',
                'rgb(255, 191, 243)',
                'rgb(160, 160, 160)',
                'rgb(100, 211, 233)'
            ],
            data: [10, 20, 15, 30, 25, 35, 40, 50, 45, 55, 60, 55],
            borderRadius: 5,
            shadowColor: 'rgba(0, 0, 0, 0.4)',
            shadowBlur: 3,
            shadowOffsetX: 10,
            shadowOffsetY: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        elements: {
            rectangle: {
                cubicInterpolationMode: 'monotone' // or 'default'
            }
        }
    }
});



//for user category count
var ctx = document.getElementById('doughnut-chart').getContext('2d');

var doughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Total Categories', 'Total Users', 'Total Tags'],
        datasets: [{
            backgroundColor: ['#f93154', '#0dcaf0', '#ffa900'],
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