@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">Home</a>
            </li>                    
        </ul>

        <div class="tab-content">
            <div id="chartContainer"></div>
                <!-- <div id="home" class="tab-pane fade in active">
                    <p><img class="img-responsive" src="{{asset('backend/dist/img/curentBulb.png')}}" style="width: 100%;"></p> 
                </div> -->
                              
        </div>
    </div>

@stop


@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>

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

@endpush
