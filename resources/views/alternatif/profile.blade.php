@extends('layouts.dashboard')

@section('title')
  Profile
@endsection

@section('content')
  <div class="content col bg-info">
    <div class="mb-2 mt-2 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <h3 class="ms-4 me-2 text-light fw-bold d-inline">Sistem Pendukung Keputusan Pemilihan Gedung Pernikahan</h3>
        <div class="" type="button" data-bs-toggle="modal" data-bs-target="#penjelasan">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-question-lg bg-light rounded-circle p-1 btn" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14"/>
          </svg>
        </div>
      </div>
      <div class="dropdown-center me-5">
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
          </svg>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/profile">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="penjelasan" tabindex="-1"> 
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="penjelasan">Penjelasan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Menu Dashboard berisi alternatif yang akan dinilai oleh user, nilai kriteria yang sekarang merupakan nilai default yang dimana nilai tiap pitoritas sebagai berikut. Kelengkapan Produk: 25%, Desain Antarmuka: 10%, Pelayanan: 20%, Proses Transaksi: 20%, Diskon: 25% Dan semua kriteria berkategori benefit</p>
            <p>Menu Perhitungan berisi angka yang akan menentukan hasil penilaian dari user</p>
            <p>Menu Edit, user dapat mengubah nilai dari prioritas/bobot kriteria</p>
          </div>
        </div>
      </div>
    </div>
    <div class="ms-4 me-4 pt-3 bg-light rounded-3 shadow me-2 mb-3 px-3 bg-body-tertiary" style="height: 87vh;">
    <form class="pt-4" action="{{ url('profile') }}" method="POST">
      @CSRF
      <div class="row mb-3">
        <div class="col-6 d-flex d-inline">
          <label for="nama" class="col-sm-2 form-label d-inline d-flex">Nama</label>
          <div class="col mb-3">
            <input type="text" class="form-control m-0" id="nama" name="nama" value="{{ $user->nama }}">
            @if($errors->has('nama'))
              <div class="alert alert-danger mt-1">
                {{ $errors->first('nama') }}
              </div>
            @endif
          </div>
        </div>
        <div class="col-6 d-flex">
          <label for="email" class="col-sm-2 form-label">Email</label>
          <div class="col mb-3">
            <input type="text" class="form-control m-0" id="email" name="email" value="{{ $user->email }}">
            @if($errors->has('email'))
              <div class="alert alert-danger mt-1">
                {{ $errors->first('email') }}
              </div>
            @endif
          </div>
        </div>
        <div class="col d-flex d-inline">
          <label for="password" class="col-sm-2 form-label d-inline d-flex">Password</label>
          <div class="col-10 mb-3">
            <input type="text" class="form-control m-0" id="password" name="password">
            @if($errors->has('password'))
              <div class="alert alert-danger mt-1">
                {{ $errors->first('password') }}
              </div>
            @endif
          </div>
        </div>
        <div class="col d-flex">
          <label for="password_confirmation" class="col-sm-2 form-label">Password Konfirmasi</label>
          <div class="col-10 mb-3">
            <input type="text" class="form-control m-0" id="password_confirmation" name="password_confirmation">
            @if($errors->has('password_confirmation'))
              <div class="alert alert-danger mt-1">
                {{ $errors->first('password_confirmation') }}
              </div>
            @endif
          </div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="">  
            <a href="{{ url('dashboard') }}" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
          <div class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus Akun</div> 
        </div>
      </form>
      <div class="modal fade" id="deleteModal" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="deleteModal">Apakah Akan di Hapus?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
              <form action="{{ url("profile/$user->id") }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Iya</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
