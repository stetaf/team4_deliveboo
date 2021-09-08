<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordine ricevuto</title>
</head>
<body>
    <h4>Ciao {{ $user_name }},</h4>

    <p>Hai ricevuto un nuovo ordine per il tuo ristorante {{ $restaurant_name }} </p>

    <p>Di seguito, i dati del cliente:</p>
    <ul>
        <li>{{ $guest_name }}</li>
        <li>{{ $guest_email }}</li>
        <li>{{ $guest_phone }}</li>
        <li>{{ $guest_address }}</li>
        <li>Note aggiuntive: {{ $notes }}</li>
    </ul>

    <p>Questo è il riepilogo dell'ordine:</p>
    <ul>
        @foreach($body['order'] as $dish) 
        <li>{{ $dish->quantity }}x {{ $dish->name }}</li>
        @endforeach
    </ul>
    <p>Totale ordine: &euro; {{ $body['total_amount'] }}</p>
    
    <p>Grazie,
    {{ config('app.name') }}</p>
</body>
</html>