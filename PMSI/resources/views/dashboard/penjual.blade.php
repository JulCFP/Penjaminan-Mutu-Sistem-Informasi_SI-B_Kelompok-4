<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjual</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-success">
    <div class="container-fluid">
        <span class="navbar-brand">Dashboard Penjual</span>
        <a href="{{ route('logout') }}" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Selamat datang, Penjual!</h3>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Kelola Produk</h5>
                <a href="/produk" class="btn btn-success mt-2">Produk Saya</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Laporan Penjualan</h5>
                <a href="/laporan" class="btn btn-success mt-2">Lihat Laporan</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
