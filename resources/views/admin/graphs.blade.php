@extends('layouts.admin')

@section('content')
<div id="cont">
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
                @foreach($years as $y)
                    <option value="{{ $y }}" @if ($year == $y) selected="selected" @endif>{{ $y }}</option>
                @endforeach
            </select>
        </form>
    </div>
    
    <div id="total" class="pb-5">
        <h4>Statistiche vendite</h4>
        <canvas id="totalSales"></canvas>
    </div>
    
    <div id="amount" class="pb-5">
        <h4>Statistiche incassi</h4>
        <canvas id="salesAmount"></canvas>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0" type="application/javascript"></script>

<script type="application/javascript">
    const labels_sales = "{{ implode(' ', $chart_quantity['labels']) }}".split(" ");
    
    const data = {
        labels: labels_sales,
        datasets: [{
            label: 'Vendite',
            data: "{{ implode(' ', $chart_quantity['dataset']) }}".split(" "),
            backgroundColor: '#ff702a61',
            borderColor: '#ff702a',
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                yAxes : [{
                    ticks : {   
                        min : 0,
                        suggestedMin: 0,
                        stepSize: 1
                    }
                }]
            }        
        },
    };

    var totalSales = new Chart(
        document.getElementById('totalSales'),
        config
    );
</script>

<script type="application/javascript">
    const labels_amount = "{{ implode(' ', $chart_amount['labels']) }}".split(" ");
    
    const data_amount = {
        labels: labels_amount,
        datasets: [{
            label: 'Incasso',
            data: "{{ implode(' ', $chart_amount['dataset']) }}".split(" "),
            fill: false,
            borderColor: '#ff702a',
            borderWidth: 1,
            tension: 0.1
        }]
    }
    
    const config_amount = {
        type: 'line',
        data: data_amount,
    };

    var salesAmount = new Chart(
        document.getElementById('salesAmount'),
        config_amount
    );
</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection