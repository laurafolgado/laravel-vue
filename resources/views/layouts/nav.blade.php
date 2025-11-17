<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('produktuak.index') }}">Produktuak App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('produktuak.index') ? 'active' : '' }}" 
                       href="{{ route('produktuak.index') }}">
                        Produktu Zerrenda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('produktuak.create') ? 'active' : '' }}" 
                       href="{{ route('produktuak.create') }}">
                        Produktu Berria
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('produktuak.vue') ? 'active' : '' }}" 
                       href="{{ route('produktuak.vue') }}">
                        Produktuak (Vue)
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
