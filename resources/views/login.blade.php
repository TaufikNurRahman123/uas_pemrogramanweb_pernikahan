<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ url('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ url('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
  <title>Login</title>
</head>
<body class="bg-border m-0 p-0 overflow-hidden d-flex align-items-center justify-content-center" style="height: 100vh; background-image: url('path/to/your-image.jpg'); background-size: cover; background-position: center;">
  <div class="w-50 my-auto rounded-2 shadow bg-light px-2 py-2" style="height: 56vh">
    <div class="rounded-3 bg-white" style="height: 53vh">
      <p class="fs-3 fw-bold text-dark text-center pt-4">Login</p>
      <!-- Error Modal -->
      <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              @if(session()->has('error'))
                <div class="alert alert-danger m-0">
                    {{ session()->get('error') }}
                </div>
              @elseif(session()->has('status'))
                <div class="alert alert-success m-0">
                    {{ session()->get('status') }}
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>

      @if(session()->has('error') || session()->has('status'))
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            let messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            messageModal.show();
          });
        </script>
      @endif

      <form class="pt-4" action="{{ url('login') }}" method="post">
        @csrf
        <div class="mb-3 px-4">
          <label for="email" class="form-label text-dark fw-medium">Email address</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3 px-4">
          <label for="password" class="form-label text-dark fw-medium">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-flex justify-content-center mt-4">
          <a href="{{ url('auth/google') }}" class="btn d-flex gap-3 justify-content-center align-items-center btn-light mx-3 w-75">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-google" viewBox="0 0 16 16">
              <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
            </svg>
            <span class="text-dark d-inline m-0 fw-medium">Login Menggunakan Google</span>
          </a>
        </div>
        <div class="d-flex justify-content-between px-4 mt-3 align-items-center">
          <a href="{{ url('daftar') }}" class="fw-medium text-dark link-underline link-underline-opacity-0">Belum punya akun? Daftar</a>
          <a href="{{ url('lupa-password') }}" class="fw-medium text-dark link-underline link-underline-opacity-0">Lupa Password?</a>
          <button type="submit" class="btn btn-light fw-bold">Login</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>