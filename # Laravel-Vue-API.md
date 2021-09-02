# Laravel/API/Vue Parte 1

Capiamo come creare una api e quali steps seguire.

## Definire una Rotta API e testare con Postman

Come definire una rotta API? nello stesso modo in cui definiamo una rotta web ma lo facciamo nel file routes/api.php

Abbiamo due modi per definire una rotta api e restituire un ogetto json. Con o senza controller. E due modi per gestire la risposta.

Visto che si tratta di un API la nostra risposta deve essere in formato JSON [JSON RESPONSE](https://laravel.com/docs/7.x/responses#json-responses)

### Rotte API senza controller

Possiamo definire una rotta in api.php che restituisce tutti i posts
sia usando il metodo json() che senza.

#### Tutti i posts

```php
Route::get('posts', function () {
    $posts = Post::all();
    // usiamo json response (l'output é personalizzabile) 
    return response()->json([
        'response' => $posts
    ]);
});
```

Senza response()->json(), scorciatoia ma non possiamo customizzare l'output.

```php
Route::get('posts', function () {
    $posts = Post::all();
    // oppure Scorciatoia, Grazie Laravel!
    return $posts;
});
```

#### Tutti i post paginandoli

oppure facciamo una rotta che restituisce tutti i posts paginandoli

```php
Route::get('posts', function () {
    $posts = Post::paginate();
    return $posts;
});
```

### Tutti i posts comprese relazioni

oppure una che restituisce anche le relazioni

```php
// Senza Paginazione
Route::get('posts', function () {
    $posts = Post::with(['tags'])->get();
    return $posts;
});

// Ma volendo possiamo anche paginare
Route::get('posts', function () {
    $posts = Post::with(['tags'])->paginate();
    return $posts;
});

```


## Creare un controller dedicato per la rotta

E il controlle? facciamone uno in un namespace dedicato, API/ e impostiamo la rotta per usarlo

```bash
php artisan make:controller API/PostController

```

in api.php

```php
Route::get('posts', 'API\PostController@index');

```

nel Controller API/PostController spostiamo la logica dalla rotta.

```php
    public function index()
    {

        $posts = Post::with(['tags'])->paginate();
        return $posts;
    }
```

## Definire una Risorsa API Eloquent

Trasforma facilmente i modelli Elonquent in un JSON

[Documentazione](https://laravel.com/docs/7.x/eloquent-resources#generating-resources)

```bash
php artisan make:resource PostResource
```

Creiamo una nuova rotta e utilizziamo la risorsa per restituire una singola risorsa(post)

```php
// importa la classe nel file web.php
use App\Http\Resources\PostResource;


Route::get('posts/{post}', function (Post $post) {
    return new PostResource(Post::find($post));
});

```

É preferibile questo metodo se vogliamo restituire una collection di risorse o usare la paginazione.

nel controller API/PostController@index 

```php

    public function index()
    {
        # Senza la risorsa
        //$posts = Post::with(['tags'])->paginate();
        //return $posts;

        # Con la risorsa senza relazioni
        //return PostResource::collection(Post::all());
        
        # Con la risorsa e le relazioni
        return PostResource::collection(Post::with(['category', 'tags'])->paginate());
    }
```

Ok adesso che abbiamo il nostro endpoint, consumiamo L'API! con VUE/Axios.


## Installazione VueJS

```bash
php artisan ui vue
npm install && npm run dev
npm run watch
```

Creiamo una rotta e la view

```php
/* VUE-POSTS */

Route::get('blog', function () {
    return view('blog');
});

```

la view

```php
@extends('layouts.app')

@section('content')

<h1> SPA Blog</h1>

@endsection

```

Impostiamo l'istanza vue e facciamo la chiamata axios
in resources/js/app.js

```js

const app = new Vue({
    el: '#app',
    data: {
        posts: null
    },
    mounted() {
        Axios.get('/api/posts').then(resp => {
            console.log(resp);
            this.posts = resp.data.data;
        }).catch(e => {
            console.error('Sorry! ' + e);
        })
    }
});

```

## Visualizzazione dei posts
```php
@extends('layouts.app')

@section('content')

<h1> SPA Blog</h1>


<div class="card text-left" v-for="post in posts">
    <img class="card-img-top" src="holder.js/100px180/" alt="">
    <div class="card-body">
        <h4 class="card-title">@{{post.title}}</h4>
        <p class="card-text">@{{post.body}}</p>
    </div>
</div>
@endsection

```

## Visualizzazione delle categorie/tags associati ad un post

