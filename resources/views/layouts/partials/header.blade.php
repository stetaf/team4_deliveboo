<header>
    <div class="container d-flex justify-content-between align-items-center h-100">
        <h2 class="logo">
            <a href="{{ Route('home') }}">
                <i class="fas fa-utensils"></i>
                Deliveboo
            </a>
        </h2>
        @guest
            <div class="actions d-flex " >
                <span class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </span>
                @if (Route::has('register'))
                    <span class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </span>
                @endif
            </div>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span>{{ Auth::user()->fullname }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.restaurants.index') }}">
                        {{ __('Dashboard') }}
                    </a>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </div>
            </li>
        @endguest
    </div>
</header>
