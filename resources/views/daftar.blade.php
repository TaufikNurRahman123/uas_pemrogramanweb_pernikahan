<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ url('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ url('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
  <title>Daftar</title>
</head>
<body class="bg-light m-0 p-0 overflow-hidden d-flex align-items-center justify-content-center" style="height: 100vh">
  <div class="w-50 my-auto rounded-3 shadow bg-light px-4 py-4" style="max-width: 500px;">
    <div class="rounded-3 bg-white p-4">
      <p class="fs-3 fw-medium text-dark text-center pt-2">Daftar</p>
      <form class="pt-4" action="{{ url('daftar') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label text-dark fw-bold">Nama</label>
          <input type="text" class="form-control @if($errors->has('nama')) is-invalid @endif" id="nama" name="nama" value="{{ old('nama') }}" data-toggle="popover" data-content="{{ $errors->first('nama') }}" data-placement="right">
        </div>
        <div class="mb-3">
          <label for="email1" class="form-label text-dark fw-bold">Email address</label>
          <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email1" name="email" value="{{ old('email') }}" data-toggle="popover" data-content="{{ $errors->first('email') }}" data-placement="right">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label text-dark fw-bold">Password</label>
          <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" name="password" data-toggle="popover" data-content="{{ $errors->first('password') }}" data-placement="right">
        </div>
        <div class="mb-3">
          <label for="password_confirmation" class="form-label text-dark fw-bold">Konfirmasi Password</label>
          <input type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" id="password_confirmation" name="password_confirmation" data-toggle="popover" data-content="{{ $errors->first('password_confirmation') }}" data-placement="right">
        </div>
        <div class="d-flex flex-column align-items-center mt-4">
          <a href="{{ url('auth/google') }}" class="btn d-flex gap-3 justify-content-center align-items-center btn-light mb-3 w-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-google" viewBox="0 0 16 16">
              <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
            </svg>
            <p class="text-dark d-inline m-0 fw-medium">Daftar Dengan Google</p>
          </a>
          <button type="submit" class="btn btn-primary px-4 fw-medium w-75 mb-3">Daftar</button>
          <a href="{{ url('login') }}" class="fw-medium text-dark">Sudah punya akun? Login</a>
        </div>
      </form>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let invalidFields = document.querySelectorAll('.is-invalid');
      invalidFields.forEach(function(field) {
        let popover = new bootstrap.Popover(field, {
          content: field.getAttribute('data-content'),
          placement: 'right'
        });
        popover.show();
      });
    });
  </script>
</body>
</html>
