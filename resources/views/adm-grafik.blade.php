@extends('layouts.adm_panel')

@section('title','grafik')

<link rel="stylesheet" type="text/css" href="../chartss/dist/Chart.min.css">
<script type="text/javascript" src="../chartss/dist/Chart.min.js"> </script>

@section('report')
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Penjualan Bulanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $monthlySales }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Penjualan Tahunan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $annualSales }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Penjualan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $allSales }}</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            
{{-- ----------------------------------------------------------------------------------------------------------------------- --}}    

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pendapatan Bulanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ number_format($incomeMonthly) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Pendapatan Tahunan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ number_format($incomeAnnual) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Pendapatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ number_format($incomeTotal) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
@endsection
@section('body')
<div class="container-fluid mt-1">
    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading ">
            <p class="panel-subtitle" style="font-weight: bold">Periode: {{ date('d-m-Y H:m:s', strtotime($now)) }}</p>
        </div>
    </div>    
    
</div>

<div class="row container">
    <div style="width: 900px;" class="col-lg-6" >
    <canvas id="myChart"></canvas>
        <?php
            $bulan = ["$jan","$feb","$mar","$ap","$mei","$jun","$jul","$aug","$sept","$octo","$nove","$dece"];
        ?>

        @php
        
        $k=0;
        $d=1;
        for($b=1;$b<=12;$b++){
            $data[$d][$b] = $bulan[$k];
        $k++;
        }

        @endphp

    </div>

    <div style="width: 900px;"  class="col-lg-6">
        <canvas id="myChart1"></canvas>
        <?php
            $bulans = ["$january", "$february","$march","$april","$may","$june","$july","$august","$september","$october","$november","$december"];
        ?>
    
        @php
        
        $k=0;
        $d=1;
        for($a=1;$a<=12;$a++){
            $datas[$d][$a] = $bulans[$k];
        $k++;
        }
    
        @endphp
    
    </div>
</div>

<script>
    var barChartData = {
      labels: [
        "January","February","March","April","May","June","July","August","September","October","November","December"
      ],

      datasets: [
        {
          label: "Pendapatan",
          backgroundColor: "pink",
          borderColor: "red",
          borderWidth: 1,
        
            data:   [
                        <?php 
                            for($b=1;$b<=12;$b++){
                                echo $data[$d][$b].",";
                            }

                        ?>     
                    ] 
            //[$january, $february,$march,$april,$may,$june,$july,$august,$september,$october,$november,$december];
          
          
        },
        
      ]
    };

    var barChartData2 = {
      labels: [
        "January","February","March","April","May","June","July","August","September","October","November","December"
      ],

      datasets: [
        {
          label: "Penjualan",
          backgroundColor: "blue",
          borderColor: "red",
          borderWidth: 1,
        
            data:   [
                        <?php 
                            for($a=1;$a<=12;$a++){
                                echo $datas[$d][$a].",";
                            }

                        ?>     
                    ] 
            //[$january, $february,$march,$april,$may,$june,$july,$august,$september,$october,$november,$december];
          
          
        },
        
      ]
    };
    
    var chartOptions = {
      responsive: true,
      legend: {
        position: "top"
      },
      title: {
        display: true,
    
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
    
      var ctx = document.getElementById("myChart").getContext("2d");
      window.myBar = new Chart(ctx, {
        type: "bar",
        data: barChartData,
        options: chartOptions
      });

      var ctx = document.getElementById("myChart1").getContext("2d");
      window.myBar = new Chart(ctx, {
        type: "bar",
        data: barChartData2,
        options: chartOptions
      });


    
</script>



@endsection

