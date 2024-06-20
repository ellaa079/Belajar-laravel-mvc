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
            <h1 class="m-0">Data Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Data Pegawai</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="card card-info card-outline">
        <div class="card-header">
          <div class="card-tools">
            <a href="{{ route('create-pegawai') }}" class="btn btn-success">Tambah Data <i class="fas fa-plus-square"></i></a>
          </div>
        </div>

        <div class="card-body">
          <form action="{{ route('data-pegawai') }}" method="GET" class="mb-3">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Cari Nama Pegawai" value="{{ request()->get('search') }}">
              <span class="input-group-append">
                <button type="submit" class="btn btn-secondary">
                  <i class="fas fa-search"></i>
                </button>
              </span>
            </div>
          </form>

          <table class="table table-bordered">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Alamat</th>
              <th>Tanggal Lahir</th>
              <th>Aksi</th>
            </tr>
            @foreach ($dtPegawai as $key => $item)
            <tr>
              <td>{{ $startNumber + $key + 1 }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->jabatan ? $item->jabatan->jabatan : 'Tidak ada jabatan' }}</td>
              <td>{{ $item->alamat }}</td>
              <td>{{ date('d-m-Y', strtotime($item->tgllhr)) }}</td>
              <td>
                <a href="{{ url('edit-pegawai', $item->id) }}"><i class="fas fa-edit"></i></a> 
                | 
                <a href="{{ url('delete-pegawai', $item->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')">
                  <i class="fas fa-trash-alt" style="color:red"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </table>
          <div class="d-flex justify-content-between">
            <div>
              Menampilkan
              {{ $dtPegawai->firstItem() }}
              hingga
              {{ $dtPegawai->lastItem() }}
              dari
              {{ $dtPegawai->total() }}
              data
            </div>
            <div>
              {{ $dtPegawai->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
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
