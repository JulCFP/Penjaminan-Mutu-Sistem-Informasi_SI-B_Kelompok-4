<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Konsumen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-info">
    <div class="container-fluid">
        <span class="navbar-brand">Dashboard Konsumen</span>
        <a href="{{ route('logout') }}" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Selamat datang, Konsumen!</h3>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Daftar Produk</h5>
                <a href="/produk" class="btn btn-info mt-2">Lihat Produk</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Pesanan Saya</h5>
                <a href="/pesanan" class="btn btn-info mt-2">Lihat Pesanan</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
