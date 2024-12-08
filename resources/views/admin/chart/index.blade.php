@extends('layouts.main')
@section('title')
    Biểu đồ
@stop
@section('content')
    <div class="container">
        <h1 class="text-center my-4" style="font-size: 30px; font-weight: bold;">Biểu Đồ</h1>
        <canvas id="employeesRatioChart" style="max-width: 100%; height: auto;"></canvas>
    </div>

    <!DOCTYPE html>
    <html>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <body>

        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

        <script>
            var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
            var yValues = [30, 49, 44, 24, 25];
            var barColors = ["red", "green", "blue", "orange", "brown"];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "World Wine Production 2018"
                    }
                }
            });
        </script>

    </body>

    </html>


@endsection
