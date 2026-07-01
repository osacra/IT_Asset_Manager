<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Asset Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #212529; }
        .sidebar .nav-link { color: #rgba(255,255,255,.75); }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background-color: #343a40; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                <i class="bi bi-cpu-fill me-2"></i>IT_Asset_Manager
            </a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3 text-white">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Sair</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">
                <div class="position-sticky">
                    <ul class="nav flex-column gap-2">
                        <li class="nav-item">
                            <a class="nav-link rounded p-2 {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded p-2 {{ Request::is('categorias*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">
                                <i class="bi bi-tags me-2"></i> Categorias
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a class="nav-link rounded p-2 {{ Request::is('ativos*') ? 'active' : '' }}" href="{{ route('ativos.index') }}">
                                <i class="bi bi-laptop me-2"></i> Ativos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded p-2 {{ Request::is('colaboradores*') ? 'active' : '' }}" href="{{ route('colaboradores.index') }}">
                                <i class="fas fa-users me-2"></i> Colaboradores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded p-2" href="#">
                                <i class="bi bi-arrow-left-right me-2"></i> Empréstimos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded p-2" href="#">
                                <i class="bi bi-clock-history me-2"></i> Histórico
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>