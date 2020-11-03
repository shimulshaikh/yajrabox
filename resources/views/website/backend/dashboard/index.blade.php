@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">Home</a>
            </li>                    
        </ul>

        <div class="tab-content">
            <div id="chartContainer" style="margin-bottom: 15px;"></div>              
            <div style="height: 400px; width: 900px; margin: auto;">
                <canvas id="barChartProduct"></canvas>
            </div>
        </div>
    </div>

@stop


@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>


<!-- Start HighChart -->
<script type="text/javascript">
     var customer =  <?php echo json_encode($customerData) ?>;
   
    Highcharts.chart('chartContainer', {
        title: {
            text: 'New Customer Growth, 2020'
        },
        // subtitle: {
        //     text: 'Source: codechief.org'
        // },
         xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },
        yAxis: {
            title: {
                text: 'Number of New Customer'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New Customer',
            data: customer
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>
<!-- End HighChart -->

<!-- Start Bar chart -->
<script type="text/javascript">
    $(function(){
        var product =  <?php echo json_encode($productData) ?>;
            var barCanvas = $("#barChartProduct");
            var barChartProduct = new Chart(barCanvas, {
                type: 'bar',
                data: {
                    labels:['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'New product Growth',
                        data: product,
                        backgroundColor:['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet', 'purple', 'pink', 'silver', 'gold', 'brown']
                    }]
                },

                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

    })
       
</script>
<!-- End Bar chart -->

@endpush
