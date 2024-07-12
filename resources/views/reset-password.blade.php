<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ url('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ url('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
  <title>Reset Password</title>
</head>
<body class="bg-light m-0 p-0 overflow-hidden d-flex align-items-center justify-content-center" style="height: 100vh">
  <div class="w-50 my-auto rounded-3 shadow bg-info px-2 py-2" style="height: 45vh">
    <div class="rounded-3 bg-dark" style="height: 42vh">
      <p class="fs-3 fw-medium text-light text-center pt-2" >Reset Password</p>
      <!-- Error Modal -->
      <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
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

      @if(session()->has('error') || session()->has('status'))
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            let messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            messageModal.show();
          });
        </script>
      @endif
      <form class="pt-4" action="{{ url('reset-password') }}" method="POST">
        @CSRF
        <input type="hidden" name="token" value="{{ request()->token }}">
        <input type="hidden" name="email" value="{{ request()->email }}">
        <div class="row mb-3 ps-4 pe-4">
          <label for="password" class="form-label col text-light fw-bold">Password</label>
          <input type="password" class="form-control col" id="password" name="password" placeholder="Masukkan Password Baru">
        </div>
        <div class="row mb-3 ps-4 pe-4">
          <label for="password_confirmation" class="form-label col text-light fw-bold">Konfirmasi Password</label>
          <input type="password" class="form-control col" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="d-flex  justify-content-center me-3 ms-3 mt-3 align-items-center">
          <button type="submit" class="btn btn-primary d-flex px-4 fw-medium">Update Password</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>