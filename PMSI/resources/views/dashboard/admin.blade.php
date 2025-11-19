<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Dashboard Admin</span>
        <a href="{{ route('logout') }}" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Selamat datang, Admin!</h3>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5>Manajemen Penjual</h5>
                <a href="/penjual" class="btn btn-primary mt-2">Kelola Penjual</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3">
                <h5>Manajemen Konsumen</h5>
                <a href="/konsumen" class="btn btn-primary mt-2">Kelola Konsumen</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
