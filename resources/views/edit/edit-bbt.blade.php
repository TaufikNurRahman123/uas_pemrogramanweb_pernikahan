@extends('layouts.edit')

@section('title')
  Edit Bobot
@endsection

@section('content')
  <div class="content col bg-success">
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
            <a class="dropdown-item" href="{{ url('profile') }}">Profile</a>
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
    <div class="ms-4 me-4 bg-light rounded-3 shadow me-2 mb-3 px-3 bg-body-tertiary" style="height: 87vh;">
      <h2 class="pt-2">Edit Bobot</h2>
      <form class="pt-4" action="{{ url('edit/bobot') }}" method="POST">
        @METHOD('PATCH')
        @CSRF
        <div class="row mb-3">
          <p class="col-10 offset-2"><span class="text-danger">*</span>Pastikan total dari bobot adalah 100</p>
          <label for="kriteria" class="col-2 fs-5 d-flex align-items-center">Bobot</label>
          <div class="col gap-2 d-flex flex-row justify-content-around card bg-transparent border-0 w-25">
            <div class="mt-1 bg-body-secondary px-2 py-2 rounded-2">
              <p class="fw-medium mb-0">Harga Sewa</p>
              <input type="text" class="form-control" id="b1" name="b1" value="{{ $bbt['b1'] }}">
            </div>
            <div class="mt-1 bg-dark-subtle px-2 py-2 rounded-2">
              <p class="fw-medium mb-0">Fasilitas</p>
              <input type="text" class="form-control" id="b2" name="b2" value="{{ $bbt['b2'] }}">
            </div>
            <div class="mt-1 bg-body-secondary px-2 py-2 rounded-2">
              <p class="fw-medium mb-0">kapasitas Tamu</p>
              <input type="text" class="form-control" id="b3" name="b3" value="{{ $bbt['b3'] }}">
            </div>
            <div class="mt-1 bg-dark-subtle px-2 py-2 rounded-2">
              <p class="fw-medium mb-0">Lokasi</p>
              <input type="text" class="form-control" id="b4" name="b4" value="{{ $bbt['b4'] }}">
            </div>
            <div class="mt-1 bg-body-secondary px-2 py-2 rounded-2">
              <p class="fw-medium mb-0">Diskon</p>
              <input type="text" class="form-control" id="b5" name="b5" value="{{ $bbt['b5'] }}">
            </div>
          </div>
          @if(session('error'))
            <div class="alert alert-danger mt-2 mx-2">
              {{ session('error') }}
            </div>
          @endif
          @if(session('success'))
            <div class="alert alert-success mt-2 mx-2">
              {{ session('success') }}
            </div>
          @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
@endsection
