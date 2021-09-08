<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordine ricevuto</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' integrity='sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==' crossorigin='anonymous' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');
        * { font-family: 'Nunito', sans-serif; }
        a { text-decoration: none !important; color: unset !important;}

        .logo { color: #ff702a; font-size: 35px; text-align: center;}

        .card { 
            border: 2px solid #ff702a !important;
            box-shadow: inset 0px 0px 29px 30px #eeeeee;
            padding: 25px; 
        }

        .restaurant { 
            font-style: italic;
            text-decoration: underline;
            text-decoration-color: #ff702a;
            text-decoration-style: solid;
            text-underline-position: under left;
        }
        .container { max-width:  900px; margin: auto; padding: 25px; }
    </style>
</head>
<body>
<div class="container py-2">
        <div class="card px-5 py-4">
            <div class="logo">
                <h2 class="logo">
                    <span style="font-size: 40px">🍽</span> Deliveboo 
                </h2>
            </div>

            <p>Hai ricevuto un nuovo ordine per il tuo ristorante <span class="restaurant">{{ $restaurant_name }}</span> </p>

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
            
            <p style="text-align: right">Grazie per la scelta, <br>
            {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>