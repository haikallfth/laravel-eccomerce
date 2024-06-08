@extends('layouts.template')

@section('judul-halaman')
Toko
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
                            <th>Nama Toko</th>
                            <th>Kategori</th>
                            <th>Pemilik Toko</th>
                            <th>Hari Buka</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Deskripsi Toko</th>
                            <th>Status Toko</th>
                            <th>Icon Toko</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($toko as $item)
                        <tr>
                            <td>{{$item->nama_toko}}</td>
                            <td>{{$item->kategori_toko}}</td>
                            <td>{{$item->pemilik}}</td>
                            <td>{{$item->hari_buka}}</td>
                            <td>{{$item->jam_buka}}</td>
                            <td>{{$item->jam_libur}}</td>
                            <td>{{$item->desc_toko}}</td>
                            <td>
                                @if($item->status_aktif == FALSE)
                                    <span class="badge badge-danger">Toko Non-Aktif</span>
                                @else
                                    <span class="badge badge-success">Toko Aktif</span>
                                @endif
                            </td>
                            <td><img src="{{asset('storage/image/toko/'.$item->icon_toko)}}" alt="gambar"></td>
                            <td>
                                <a href="#" class="btn btn-outline-success" data-toggle="dropdown">Pilihan</a>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{route('toko.show', $item->id)}}">Detail</a>
                                    <form action="{{route('toko.destroy', $item->id)}}" method="post">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Yakin dek mo dihapus 😏 ?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Kategori</th>
                            <th>Pemilik Toko</th>
                            <th>Hari Buka</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Deskripsi Toko</th>
                            <th>Status Toko</th>
                            <th>Icon Toko</th>
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
                <h4 class="modal-title">Tambah Data Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('toko.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <select name="id_user" class="form-control">
                            <option value="">Pilih Nama Pemilik</option>
                            @foreach($user as $item)
                                @if($item->level == 'penjual')
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Toko</label>
                        <textarea name="desc_toko" id="summernote">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Kategori Toko</label>
                        <select name="kategori_toko" class="form-control" required>
                            <option value="elektronik">Elektronik</option>
                            <option value="otomotif">Otomotif</option>
                            <option value="sembako">Sembako</option>
                            <option value="fashion">Fashion</option>
                            <option value="makanan">Makanan</option>
                            <option value="obat">Obat</option>
                            <option value="aksesoris">Aksesoris</option>
                            <option value="perabotan">Perabotan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Icon Toko</label>
                        <input type="file" name="icon_toko" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Hari Buka :</label>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="senin"
                                value="Senin">
                            <label for="senin" class="custom-control-label">Senin</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="selasa"
                                value="Selasa">
                            <label for="selasa" class="custom-control-label">Selasa</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="rabu"
                                value="Rabu">
                            <label for="rabu" class="custom-control-label">Rabu</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="kamis"
                                value="Kamis">
                            <label for="kamis" class="custom-control-label">Kamis</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="jumat"
                                value="Jumat">
                            <label for="jumat" class="custom-control-label">Jumat</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="sabtu"
                                value="Sabtu">
                            <label for="sabtu" class="custom-control-label">Sabtu</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="hari_buka[]" id="minggu"
                                value="Minggu">
                            <label for="minggu" class="custom-control-label">Minggu</label>
                        </div>
                    </div>

                    <div class="row justify-content-around">
                        <div class="form-group col-md-6">
                            <label>Jam Buka</label>
                            <input type="time" class="form-control" name="jam_buka">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jam Libur</label>
                            <input type="time" class="form-control" name="jam_libur">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status Aktif</label>
                        <select name="status_aktif" class="form-control" required>
                            <option value="0">Non-Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
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
