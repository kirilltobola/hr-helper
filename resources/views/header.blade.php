<header>
    <div class="mb-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Домой</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href='{{route('cvs.create')}}'>Добавить резюме</a>
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
