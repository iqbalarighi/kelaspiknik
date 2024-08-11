@extends('layouts.side')

@section('content')
<script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
<div class="container mw-100">
    <div class="row justify-content-center">
        <div class="col mw-100">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row justify-content-between">
                        <div class="col-md-6 py-2">
                            <div id="grafik"></div>
                        </div>
                        <div class="col-md-6 py-2">
                            <div id="trip"></div>
                        </div>
                    </div>
                        


                    <script type="text/javascript">
                        var jumtrip = <?php echo json_encode($total); ?>;
                        var bulan = <?php  echo json_encode($bulantahun); ?>;

                        Highcharts.chart('grafik', {
                            chart: {
                                type: 'spline', 
                                backgroundColor: {
                                   linearGradient: [0, 0, 500, 500],
                                   stops: [
                                     [0, 'rgb(255, 255, 255)'],
                                     [1, 'rgb(0, 255, 255)']
                                   ]
                                 },
                                 polar: true,
                              },
                            title : {
                                text: 'Grafik Total Registrasi Kelas Piknik Per Bulan'
                            }, 
                            xAxis : {
                                categories : bulan.reverse()
                            },
                            yAxis : {
                                title: {
                                    text : 'Jumlah Registrasi'
                                }
                            },
                            plotOptions : {
                                series: {
                                    allowPointSelect: true, 
                                    color: 'red',
                                    dataLabels: {
                                        enabled: true,
                                        color: 'black'
                                      },
                                }
                            },
                            series : [
                            {
                                name: 'Total',
                                data: jumtrip.reverse()
                            }
                                ]
                        })
                    </script>

                    <script type="text/javascript">
                        var totrip = <?php echo json_encode($jumtrip); ?>;
                        var trip = <?php  echo json_encode($trip); ?>;

                        Highcharts.chart('trip', {
                            chart: {
                                type: 'spline',
                                backgroundColor: {
                                       linearGradient: [0, 0, 500, 500],
                                       stops: [
                                         [0, 'rgb(255, 255, 255)'],
                                         [1, 'rgb(0, 255, 128)']
                                       ]
                                     },
                                     polar: true
                              },
                            title : {
                                text: 'Grafik Total Trip Kelas Piknik'
                            }, 
                            xAxis : {
                                categories : trip.reverse()
                            },
                            yAxis : {
                                title: {
                                    text : 'Total Registrasi Per Trip'
                                }
                            },
                            plotOptions : {
                                series: {
                                    allowPointSelect: true, 
                                    color: 'blue',
                                    dataLabels: {
                                        enabled: true,
                                        color: 'black'
                                      },
                                }
                            },
                            series : [
                            {
                                name: 'Total',
                                data: totrip.reverse(), 
                            }
                                ]
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
