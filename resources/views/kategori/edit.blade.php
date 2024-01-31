@extends('admin.admin_master')
@section('tittle')
    Edit kategori
@endsection

@section('admin.index')
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('Kategori.update', $kategori->id ) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori" id="exampleInputEmail1" placeholder="Nama Kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
