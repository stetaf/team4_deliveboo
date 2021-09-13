@extends('layouts.admin')

@section('content')
<div id="cont" class="py-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="py-3 text-uppercase" id="stats">Statistiche: <span class="text-capitalize">{{ $restaurant->name }}</span></h2>
        <a href="{{ Route('admin.restaurants.index') }}">
            <span class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i>
                Torna alla dashboard
            </span>
        </a>
    </div>

    <div class="d-flex justify-content-start align-items-center mb-3">
        <h4 class="m-0">Filtra per anno: </h4>
        <form action="{{ Route('admin.overview.graphs', $restaurant) }}" method="post" class="ml-2">
            @csrf
            <select class="selectpicker border rounded" id="year" name="year" onchange="this.form.submit();">
                <option value="summary" selected="selected">Sommario 12 mesi</option>
                @foreach($years as $y)
                    <option value="{{ $y['Year'] }}" @if ($year && $year == $y['Year']) selected="selected" @endif>{{ $y['Year'] }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div id="chart-ordini"></div>
    <div id="chart-vendite"></div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

@if ($year != 's')
<script type="text/javascript">   
    const dati = <?php echo json_encode($dati) ?>;
    Highcharts.chart('chart-ordini', {
        title: {
            text: 'Statistiche ordini',
            align: 'left'
        },
        chart: {
            type: 'column'
        },
         xAxis: {
            categories: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre']
        },
        yAxis: {
            title: {
                text: 'Ordini'
            },
            minTickInterval: 1
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Ordini',
            data: dati,
            colorByPoint: true
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 250
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

<script type="text/javascript">   
    const dati_2 = <?php echo json_encode($dati_2) ?>;
    Highcharts.chart('chart-vendite', {
        title: {
            text: 'Statistiche incassi',
            align: 'left'
        },
        chart: {
            type: 'line',
        },
         xAxis: {
            categories: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre']
        },
        yAxis: {
            title: {
                text: 'Incassi'
            },
            tickColor: 'red'
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Incassi',
            data: dati_2,
            colorByPoint: true
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 250
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
@else
<script type="text/javascript">   
    const dati = <?php echo json_encode(array_values($new)) ?>;

    const cat = <?php echo json_encode(array_keys($new)) ?>;
    Highcharts.chart('chart-ordini', {
        title: {
            text: 'Statistiche Vendite',
            align: 'left'
        },
        chart: {
            type: 'column',
        },
         xAxis: {
            categories: cat
        },
        yAxis: {
            title: {
                text: 'Vendite'
            },
            tickColor: 'red'
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Vendite',
            data: dati,
            colorByPoint: true
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 250
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

<script type="text/javascript">   
    const dati_2 = <?php echo json_encode(array_values($new2)) ?>;

    Highcharts.chart('chart-vendite', {
        title: {
            text: 'Statistiche incassi',
            align: 'left'
        },
        chart: {
            type: 'line',
        },
         xAxis: {
            categories: cat
        },
        yAxis: {
            title: {
                text: 'Incassi'
            },
            tickColor: 'red'
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Incassi',
            data: dati_2,
            colorByPoint: true
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 250
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
@endif

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection('content')