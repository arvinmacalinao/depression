@extends('./layouts.app')

@section('content')
<div class="container-fluid">

    <div class="panel mb-2">
        <div class="panel-heading">
            <div class="panel-title"><h2>Project Summaries</h2></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Number of Projects Per Year Approved</h5></div>
                <canvas id="year-approved-graph" class="graph"></canvas>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Number of Projects Per Sector</h5></div>
                <canvas id="sector-graph" class="graph" ></canvas>
            </div>
        </div>
    </div> 

    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Number of Projects Per Province</h5></div>
                <canvas id="province-graph" class="graph"></canvas>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Number of Projects Per Project Type</h5></div>
                <canvas id="projtype-graph" class="graph" ></canvas>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Repayment Totals Per Province</h5></div>
                <canvas id="repayment-graph" class="graph"></canvas>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Number of Projects Per Project Status</h5></div>
                <canvas id="projstat-graph" class="graph" ></canvas>
            </div>
        </div>
    </div> 

    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Project Cost Per Province</h5></div>
                <canvas id="cost_per_prov-graph" class="graph"></canvas>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Project Cost Per Sector</h5></div>
                <canvas id="cost_per_sector-graph" class="graph" ></canvas>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Number of Fora/Training/Seminar/Webinar Per Year</h5></div>
                <canvas id="fora_peryear-graph" class="graph"></canvas>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="graph-container border border-dark">
                <div class="caption text-center"><h5>Number of Fora/Training/Seminar/Webinar Per Type</h5></div>
                <canvas id="fora_pertype-graph" class="graph" ></canvas>
            </div>
        </div>
    </div>

</div>

<script>

//Per Year Approved
const ch_yrappov = document.getElementById('year-approved-graph');
const ch_v_yrapprov = new Chart(ch_yrappov, {
    type: 'bar',
    data: {
        labels: {!!json_encode($chart_yr->labels)!!},
        datasets: [{
            label: 'Number of projects',
            data: {!! json_encode($chart_yr->dataset)!!},
            backgroundColor: [
                'rgb(255, 99, 71)',
            ],
            borderColor: [
                'rgb(60, 60, 60)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


//Per Sector
const ch_sector = document.getElementById('sector-graph');
const ch_v_sector  = new Chart(ch_sector, {
    type: 'bar',
    data: {
        labels: {!!json_encode($chart_sector->labels)!!},
        datasets: [{
            label: 'Number of projects',
            data: {!! json_encode($chart_sector->dataset)!!},
            backgroundColor: [
                'rgb(255, 99, 71)',
            ],
            borderColor: [
                'rgb(60, 60, 60)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            },
            
        },
        indexAxis: 'y'
    }
});

//Per Province
const ch_province = document.getElementById('province-graph');
const ch_v_ch_province = new Chart(ch_province, {
    type: 'bar',
    data: {
        labels: {!!json_encode($chart_prov->labels)!!},
        datasets: [{
            label: 'Number of projects',
            data: {!! json_encode($chart_prov->dataset)!!},
            backgroundColor: [
                'rgb(255, 99, 71)',
            ],
            borderColor: [
                'rgb(60, 60, 60)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

//Per Project Types
const ch_projtype = document.getElementById('projtype-graph');
const ch_v_ch_projtype = new Chart(ch_projtype, {
    type: 'bar',
    data: {
        labels: {!!json_encode($chart_prjtype->labels)!!},
        datasets: [{
            label: 'Number of projects',
            data: {!! json_encode($chart_prjtype->dataset)!!},
            backgroundColor: [
                'rgb(255, 99, 71)',
            ],
            borderColor: [
                'rgb(60, 60, 60)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        indexAxis: 'y'
    }
});

//Per Repayment
const ch_repayment = document.getElementById('repayment-graph');

var data = {
    labels: ["Chocolate", "Vanilla", "Strawberry"],
    datasets: [
        {
            label: "Blue",
            backgroundColor: 'rgb(255, 99, 71)',
            data: [3,7,4]
        },
        {
            label: "Red",
            backgroundColor: "rgb(60, 60, 60)",
            data: [4,3,5]
        }
    ]
};

const ch_v_ch_repayment = new Chart(ch_repayment, {
    type: 'bar',
    data: data,
    options: {
        barValueSpacing: 20,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                }
            }]
        }
    }
});

//Per Project Status
const ch_projstat = document.getElementById('projstat-graph');
const ch_v_ch_projstat = new Chart(ch_projstat, {
    type: 'bar',
    data: {
        labels: {!!json_encode($chart_projstat->labels)!!},
        datasets: [{
            label: 'Number of projects',
            data: {!! json_encode($chart_projstat->dataset)!!},
            backgroundColor: [
                'rgb(255, 99, 71)',
            ],
            borderColor: [
                'rgb(60, 60, 60)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        indexAxis: 'y'
    }
});

//Per Province Cost
const ch_cost_per_prov = document.getElementById('cost_per_prov-graph');
const ch_v_ch_cost_per_prov = new Chart(ch_cost_per_prov, {
    type: 'bar',
    data: {
        labels: {!!json_encode($chart_cost_per_prov->labels)!!},
        datasets: [{
            label: 'Number of projects',
            data: {!! json_encode($chart_cost_per_prov->dataset)!!},
            backgroundColor: [
                'rgb(255, 99, 71)',
            ],
            borderColor: [
                'rgb(60, 60, 60)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

//Per Sector Cost
const ch_cost_per_sector = document.getElementById('cost_per_sector-graph');
const ch_v_ch_cost_per_sector = new Chart(ch_cost_per_sector, {
    type: 'bar',
    data: {
        labels: {!!json_encode($chart_cost_per_sector->labels)!!},
        datasets: [{
            label: 'Number of projects',
            data: {!! json_encode($chart_cost_per_sector->dataset)!!},
            backgroundColor: [
                'rgb(255, 99, 71)',
            ],
            borderColor: [
                'rgb(60, 60, 60)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        indexAxis: 'y'
    }
});

//Per Fora year
const ch_fora_peryear = document.getElementById('fora_peryear-graph');
const ch_v_ch_fora_peryear = new Chart(ch_fora_peryear, {
    type: 'bar',
    data: {
        labels: {!!json_encode($chart_fora_peryear->labels)!!},
        datasets: [{
            label: 'Number of projects',
            data: {!! json_encode($chart_fora_peryear->dataset)!!},
            backgroundColor: [
                'rgb(255, 99, 71)',
            ],
            borderColor: [
                'rgb(60, 60, 60)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
    
</script>
@endsection