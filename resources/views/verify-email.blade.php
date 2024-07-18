<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <link href="{{ url('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ url('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
  <title>Verifikasi Emal</title>
</head>
<body>
  <div class="mx-4 mt-5">
    <div class="alert alert-success">Verifikasi Email Terkirim, cek email anda lalu klik link untuk verifikasi!</div>
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <button type="submit" class="btn btn-primary">Kirim Ulang</button>
    </form>
  </div>
</body>
</html>