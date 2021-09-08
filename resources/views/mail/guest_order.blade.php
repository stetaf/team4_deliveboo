<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordine effettuato</title>
</head>
<body>
    <h4>Ciao {{ $guest_name }},</h4>

    <p>Grazie per il tuo ordine su: {{ $restaurant_name }} </p>

    <p>Questo è il riepilogo del tuo ordine:</p>
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