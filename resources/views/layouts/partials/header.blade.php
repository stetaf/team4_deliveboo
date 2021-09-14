<header>
    <div class="container d-flex justify-content-between align-items-center h-100">
        <h2 class="logo m-0">
            <a href="{{ Route('home') }}">
                <i class="fas fa-utensils d-none d-sm-inline"></i>
                Deliveboo
                <p>Vai alla Home</p>
            </a>
        </h2>
        @guest
            <div class="actions d-flex " >
                <span class="nav-item mr-4">
                    <a class="nav-link p-0" href="{{ route('login') }}">Accedi</a>
                </span>
                @if (Route::has('register'))
                    <span class="nav-item">
                        <a class="nav-link p-0" href="{{ route('register') }}">Registrati</a>
                    </span>
                @endif
            </div>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span>{{ Auth::user()->fullname }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item menu_link" href="{{ route('admin.restaurants.index') }}">
                        <span>
                            <i class="fas fa-user-cog"></i>
                            Dashboard
                        </span>
                    </a>

                    <a class="dropdown-item menu_link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <span>
                            <i class="fas fa-sign-out-alt"></i>
                            Esci
                        </span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </div>
            </li>
        @endguest
    </div>
</header>
