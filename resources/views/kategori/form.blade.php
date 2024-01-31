@extends('admin.admin_master')
@section('tittle')
    Edit kategori
@endsection

@section('admin.index')

    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('Kategori.store') }}" method="POST">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Kategori</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="nama_kategori" placeholder="Nama Kategori">
            </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.card -->

      @endsection
