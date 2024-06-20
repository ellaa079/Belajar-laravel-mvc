<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('Template.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('Template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Data Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Tambah Data Pegawai</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="card card-info card-outline">
        <div class="card-header">
          <h3>Tambah Data Pegawai</h3>
        </div>

        <div class="card-body">
          <form action="{{ route('simpan-pegawai') }}" method="post">
            @csrf <!-- Menambahkan token CSRF -->

            <div class="form-group">
              <label for="nama">Nama Pegawai</label>
              <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Pegawai" value="{{ old('nama') }}">
              @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="jabatan_id">Jabatan</label>
              <select class="form-control select2 @error('jabatan_id') is-invalid @enderror" style="width: 100%;" name="jabatan_id">
                <option disabled selected value>Pilih Jabatan</option>  <!-- Menambahkan "selected" agar menjadi default -->
                @foreach ($jab as $item)
                  <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                @endforeach
              </select>
              @error('jabatan_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="alamat">Alamat Pegawai</label>
              <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat Pegawai">{{ old('alamat') }}</textarea>
              @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="tgllhr">Tanggal Lahir</label>
              <input type="date" id="tgllhr" name="tgllhr" class="form-control @error('tgllhr') is-invalid @enderror" value="{{ old('tgllhr') }}">
              @error('tgllhr')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Judul</h5>
      <p>Konten sidebar</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('Template.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('Template.script')
@include('sweetalert::alert')
</body>
</html>