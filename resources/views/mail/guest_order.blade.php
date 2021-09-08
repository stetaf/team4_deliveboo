<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordine effettuato</title>
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
            <h3>Ciao {{ $guest_name }},</h3>

            <p>Grazie per il tuo ordine su <span class="restaurant">{{ $restaurant_name }}</span></p>

            <p>Questo è il riepilogo del tuo ordine:</p>
            <ul>
                @foreach($body['order'] as $dish) 
                    <li>{{ $dish->quantity }}x {{ $dish->name }}</li>
                @endforeach
            </ul>
            <p class="font-weight-bold">Totale ordine: &euro;{{ $body['total_amount'] }} </p>
            
            <p style="text-align: right">
                Grazie e buon appetito!
                <br>
                {{ config('app.name') }}
            </p>
        </div>
    </div>
</body>
</html>