@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ count($cuser) }}</h3>

                    <p>Jumlah User</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ count($cks) }}</h3>

                    <p>Keluhan Teratasi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-checkbox-outline"></i>
                </div>
                <a href="{{ url('/keluhan') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ count($ckp) }}</h3>

                    <p>Keluhan di Proses</p>
                </div>
                <div class="icon">
                    <i class="ion ion-load-a"></i>
                </div>
                <a href="{{ url('/keluhan') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ count($ckb) }}</h3>

                    <p>Keluhan blm di Tanggapi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
                <a href="{{ url('/keluhan') }}" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="box">

        <div class="box-header">
            <h3 class="box-title">
                Testing
            </h3>

        </div>

        <!-- /.box-header -->
        <div class="box-body no-padding">

            <canvas id="myChart" height="100px"></canvas>
        </div>
    </div>

@endsection

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
@endsection

@section('js')

    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                    label: 'Sudah Teratasi',
                    data: [
                        @foreach($chks as $cks)
                        {{ $cks }},
                        @endforeach
                    ],
                    backgroundColor: [
                        @for($i=1; $i<=12; $i++)
                            'rgb(0, 166, 90)',
                        @endfor
                    ],
                    borderColor: [
                        @for($i=1; $i<=12; $i++)
                            'rgb(0,166,90)',
                        @endfor
                    ],
                    borderWidth: 1
                },
                    {
                        label: 'Sedang Diproses',
                        data: [
                            @foreach($chkp as $ckp)
                            {{  $ckp }},
                            @endforeach],
                        backgroundColor: [
                            @for($i=1; $i<=12; $i++)
                                'rgb(243, 156, 18)',
                            @endfor
                        ],
                        borderColor: [
                            @for($i=1; $i<=12; $i++)
                                'rgb(243, 156, 18)',
                            @endfor
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Belum Ditanggapi',
                        data: [
                            @foreach($chkb as $ckb)
                            {{  $ckb }},
                            @endforeach],
                        backgroundColor: [
                            @for($i=1; $i<=12; $i++)
                                'rgb(221, 75, 57)',
                            @endfor
                        ],
                        borderColor: [
                            @for($i=1; $i<=12; $i++)
                                'rgb(221, 75, 57)',
                            @endfor
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });
    </script>
@endsection
