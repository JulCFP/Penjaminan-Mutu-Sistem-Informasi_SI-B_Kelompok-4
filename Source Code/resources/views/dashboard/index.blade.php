<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-white">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">Dashboard</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-light btn-sm" type="submit">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <h3>Selamat datang, {{ auth()->user()->name }}!</h3>
    <p>Ini adalah halaman dashboard Anda.</p>

    <div class="row mt-4">
        <div class="col-md-3">
            <a href="/produk" class="btn btn-outline-primary w-100 mb-2">Kelola Produk</a>
        </div>
        <div class="col-md-3">
            <a href="/penjual" class="btn btn-outline-primary w-100 mb-2">Kelola Penjual</a>
        </div>
        <div class="col-md-3">
            <a href="/konsumen" class="btn btn-outline-primary w-100 mb-2">Kelola Konsumen</a>
        </div>
        <div class="col-md-3">
            <a href="/pesanan" class="btn btn-outline-primary w-100 mb-2">Kelola Pesanan</a>
        </div>
    </div>

</div>

</body>
</html>
