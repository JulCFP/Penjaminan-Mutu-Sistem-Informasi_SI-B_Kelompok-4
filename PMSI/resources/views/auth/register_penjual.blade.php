<!DOCTYPE html>
<html>
<head>
    <title>Register Penjual</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center mt-5">
    <div class="card p-4 shadow" style="width: 450px;">
        <h3 class="text-center mb-3">Daftar Penjual</h3>

        <form action="{{ route('penjual.register.submit') }}" method="POST">
            @csrf

            <input class="form-control mb-2" name="nama_penjual" placeholder="Nama Penjual" required>
            <input class="form-control mb-2" name="alamat" placeholder="Alamat" required>
            <input class="form-control mb-2" name="no_telepon" placeholder="No Telepon" required>
            <input class="form-control mb-2" name="email" placeholder="Email" required>
            <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>

            <button class="btn btn-success w-100 mt-2">Daftar</button>
        </form>
    </div>
</div>

</body>
</html>
