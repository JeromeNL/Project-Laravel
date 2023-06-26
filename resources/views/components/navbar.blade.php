<header>
    <nav class="navbar navbar-expand-md navbar-toggleable-md navbar-light bg-white border-bottom box-shadow">
        <div class="container-fluid">
            <a class="navbar-brand">Wedstrijdplatform</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse d-md-inline-flex justify-content-between">
                <ul class="navbar-nav flex-grow-1 align-items-md-center mx-auto">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{route('competition.index')}}">Competities</a>
                        </li>
                    @auth()
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('competition.joinedIndex') }}">Deelnemende competities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('competition.ownedIndex') }}">Mijn competities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{route('submission.mysubmissions')}}">Mijn Inzendingen</a>
                        </li>
                    @endauth
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ url('/info') }}">Uitleg</a>
                        </li>
                </ul>
                <div class="justify-end">
                    <ul class="navbar-nav">
                        @auth()
                            <li class="nav-item">
                                <a class="nav-link text-dark" id="create-competition" href="{{ route('competition.create') }}">Competitie aanmaken</a>
                            </li>
                        @endauth
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('auth.Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('auth.Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('auth.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </div>
    </nav>
</header>
