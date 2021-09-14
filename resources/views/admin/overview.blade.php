@extends('layouts.admin')

@section('content')
<div class="overview d-flex justify-content-between align-items-center">
    <h2 class="py-5">Riepilogo ordini: {{ $restaurant->name }}</h2>

    <a href="{{ Route('admin.restaurants.index') }}" class="btn btn-sm btn-secondary text-white">
        <i class="fas fa-arrow-left mr-1"></i>
        <span>
            Torna alla dashboard
        </span>
    </a>
</div>

@if (sizeof($orders) > 0)
<div class="table-responsive table-striped table-inverse">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Telefono</th>
                <th scope="col">Indirizzo</th>
                <th scope="col" style="min-width:100px">Totale</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>{{ $order->customer_address }}</td>
                <td>&euro; {{ $order->total }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-danger" role="alert">
    <i class="fas fa-exclamation mr-1"></i>
    Non hai ancora nessun ordine
</div>
@endif

<div class="w-100 d-flex justify-content-center align-items-center">
    {{ $orders->links() }}
</div>
@endsection