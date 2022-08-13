<nav class="navbar navbar-expand-lg navbar-light bg-warning sticky-top fw-bold">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">Beeverse</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">

                <div class="d-flex justify-content-center align-items-center me-3">
                    <?php $lang = App::getLocale(); ?>
                    <a class="nav-link px-0 fw-normal {{ ($lang != null) & ($lang == 'en') ? 'active fw-bold' : '' }}"
                        href="/lang/en">EN</a>
                    <span class="px-1 text-muted">|</span>
                    <a class="nav-link px-0 fw-normal {{ ($lang != null) & ($lang == 'id') ? 'active fw-bold' : '' }}"
                        href="/lang/id">ID</a>
                </div>

                <a class="nav-link {{ $active == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">@lang('index.home')</a>
                <a class="nav-link {{ $active == 'avatar' ? 'active' : '' }}"
                    href="{{ route('avatar') }}">@lang('index.avatar_store')</a>
                @guest
                    <a class="nav-link {{ $active == 'login' ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    <a class="nav-link {{ $active == 'register' ? 'active' : '' }}"
                        href="{{ route('register') }}">Register</a>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                        class="nav-icon bi bi-person"></i>
                                    @lang('index.profile')</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('wishlist') }}"><i
                                        class="nav-icon bi bi-card-checklist"></i> @lang('index.wishlist')</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('avatar_my') }}"><i
                                        class="nav-icon bi bi-collection"></i>
                                    @lang('index.my_avatars')</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('wallet') }}"><i
                                        class="nav-icon bi bi-wallet2"></i>
                                    @lang('index.wallet')</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="nav-icon bi bi-gear"></i>
                                    @lang('index.settings')</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i
                                            class="nav-icon bi bi-box-arrow-left"></i>
                                        @lang('index.logout')</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </div>
        </div>
    </div>
</nav>
