<header>
    <div class="mb-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <h2 class="navbar-brand">Hr-helper</h2>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href={{route('dashboard')}}>Домой</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='{{route('cv_add_get')}}'>Добавить резюме</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="{{route('logout')}}" method='POST'>
                        @csrf
                        <button class="logoutLink btn btn-outline-light" type="submit">{{ __('Log Out') }}</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</header>
