<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ url('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ url('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
  <title>Lupa Password</title>
</head>
<body class="bg-light m-0 p-0 overflow-hidden d-flex align-items-center justify-content-center" style="height: 100vh">
  <div class="w-50 my-auto rounded-3 shadow bg-info px-2 py-2" style="height: 43vh">
    <div class="rounded-3 bg-dark" style="height: 40vh">
      <p class="fs-3 fw-medium text-light text-center pt-2" >Lupa Password</p>
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
      <form class="pt-4" action="{{ url('lupa-password') }}" method="post">
        @CSRF
        <div class="row mb-3 ps-4 pe-4">
          <label for="email" class="form-label col text-light fw-bold">Email address</label>
          <input type="emai" class="form-control col" id="email" name="email" placeholder="Masukkan email reset password">
        </div>
        <div class="d-flex  justify-content-between me-3 ms-3 mt-3 align-items-center">
          <a href="{{ url('login') }}" class="btn btn-primary d-flex px-4 fw-medium">Kembali</a>
          <button type="submit" class="btn btn-primary d-flex px-4 fw-medium">Submit</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>