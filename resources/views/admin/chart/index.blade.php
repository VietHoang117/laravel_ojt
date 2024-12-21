@extends('layouts.main')
@section('title')
Biểu đồ
@stop
@section('content')
<div class="container">
    <h1 class="text-center font-weight-bold">Biểu Đồ</h1>
    <div class="row">
        <div class="col-md-6">
            <canvas id="employeesRatioChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="employeesRatioChart2"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <canvas id="employeesRatioChart3"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <canvas id="employeesRatioChart4"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <canvas id="employeesRatioChart5"></canvas>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    var xValues = {!! json_encode($datas) !!};
    var yValues = {!! json_encode($values) !!};
    var barColors = {!! json_encode($dataColors)  !!};

    new Chart("employeesRatioChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            legend: {
                display: true
            },
            title: {
                display: true,
                text: "Nhân sự của các phòng ban"
            },
        }
    });
    
    new Chart("employeesRatioChart2", {
        type: "bar",
        data: {
            labels: xValues, // Một phòng ban
            datasets: [
                {
                    label: "Độ tuổi 18 - 30",
                    backgroundColor: "red",
                    data: {!! json_encode($tuoi1830) !!} // Giá trị tương ứng
                },
                {
                    label: "Độ tuổi 30 - 40",
                    backgroundColor: "blue",
                    data: {!! json_encode($tuoi3040) !!} // Giá trị tương ứng
                },
                {
                    label: "Độ tuổi trên 40",
                    backgroundColor: "green",
                    data: {!! json_encode($tren) !!} // Giá trị tương ứng
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            legend: {
                display: true
            },
            title: {
                display: true,
                text: "Độ tuổi theo phòng ban"
            }

        }
    });

    new Chart("employeesRatioChart3", {
        type: "bar",
        data: {
            labels: xValues, // Một phòng ban
            datasets: [
                {
                    label: "Nam",
                    backgroundColor: "red",
                    data: {!! json_encode($namS) !!} // Giá trị tương ứng
                },
                {
                    label: "Nữ",
                    backgroundColor: "blue",
                    data: {!! json_encode($nuS) !!} // Giá trị tương ứng
                },
                {
                    label: "Không xác định",
                    backgroundColor: "green",
                    data: {!! json_encode($kxdS) !!} // Giá trị tương ứng
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            legend: {
                display: true
            },
            title: {
                display: true,
                text: "Giới tính theo phòng ban"
            }

        }
    });

    var usersNames = {!! json_encode($userNames) !!};
    var valids = {!! json_encode($userValids) !!};
    var inValids = {!! json_encode($userNoValids) !!};


    new Chart("employeesRatioChart4", {
        type: "bar",
        data: {
            labels: usersNames,
            datasets: [
                {
                    label: "Hợp lệ",
                    backgroundColor: "blue",
                    data: valids
                },
                {
                    label: "Không hợp lệ",
                    backgroundColor: "red",
                    data: inValids
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            legend: {
                display: true
            },
            title: {
                display: true,
                text: "Biểu đồ chấm công"
            }

        }
    });

    var usersNames = {!! json_encode($userNames) !!};
    var payroll = {!! json_encode($payrolls) !!};
    
    
    new Chart("employeesRatioChart5", {
        type: "bar",
        data: {
            labels: usersNames,
            datasets: [
                {
                    label: "Lương",
                    backgroundColor: "blue",
                    data: payroll
                },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            legend: {
                display: true
            },
            title: {
                display: true,
                text: "Biểu đồ lương"
            }

        }
    });

</script>



@endsection