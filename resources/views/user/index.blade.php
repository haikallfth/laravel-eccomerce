@extends('layouts.template')

@section('judul-halaman')
Halaman Data User
@endsection

@section('content')

{{-- Ketika Ada Error --}}
@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i>Sorry, Error boskuu</h5>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
  </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Data Pemilik Toko</h3>
                    </div>
                    <div class="col-md-4 text-right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-xl">
                            Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Email</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                <a href="#" class="btn btn-outline-success"
                                data-toggle="dropdown">Pilihan</a>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="{{route('penjual.show', $item->id)}}">Detail</a>
                                        <form action="{{route('penjual.destroy', $item->id)}}" method="post">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Yakin dek mo dihapus 😏 ?')">Hapus</button>
                                        </form>
                                    </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Email</th>
                            <th>Pilihan</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data User Penjual</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('penjual.store')}}" method="post">
            @csrf
              <div class="modal-body">
                <div class="form-group">
                    <label>Nama Penjual</label>
                    <input type="text" name="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" name="email" required class="form-control">
                    <input type="text" name="level" hidden value="penjual">
                </div>
                <div class="form-group">
                    <label>Kata Sandi</label>
                    <input type="password" name="password" required class="form-control" placeholder="Minimal 8 karakter">
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
