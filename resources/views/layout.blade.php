<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar p-3 min-vh-100">
            <h5 class="mb-4">Menu</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('surat.index') }}">📂 Arsip</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('kategori.index') }}">📑 Kategori Surat</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('about') }}">ℹ️ About</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-3">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
