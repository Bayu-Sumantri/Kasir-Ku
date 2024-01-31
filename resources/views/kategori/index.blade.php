@extends('admin.admin_master')
@section('tittle')
    Kategori
@endsection

@section('admin.index')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data All Kategori</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <!-- Button trigger modal -->
                                <a href="{{ route('Kategori.create') }}" class="btn btn-success"><i class="fas fa-plus"></i>Create</a>


                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $row)
                                        <tr>
                                            <td> {{ $loop->iteration + $kategori->perpage() * ($kategori->currentPage() - 1) }}
                                            </td>
                                            <td>{{ $row->nama_kategori }}
                                            </td>
                                            <td>
                                                <form method="post"
                                                    onsubmit="return confirm('Apakah anda yakin akan menghapus, Kategori {{ $row->nama_kategori }}?..')"
                                                    action="{{ route('Kategori.destroy', [$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <a href="{{ route('Kategori.edit', $row->id) }}" class="btn btn-info"><i
                                                            class="far fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->


    </section>
@endsection
