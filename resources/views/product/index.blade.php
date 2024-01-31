@extends('admin.admin_master')
@section('tittle')
    Product
@endsection

@section('admin.index')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data All @yield('tittle')</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <!-- Button trigger modal -->
                                <a href="{{ route('Product.create') }}" class="btn btn-success"><i class="fas fa-plus"></i>Create</a>

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Product</th>
                                        <th>Nama Merk</th>
                                        <th>Gambar Product</th>
                                        <th>Harga Beli</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Product as $row)
                                        <tr>
                                            <td> {{ $loop->iteration + $Product->perpage() * ($Product->currentPage() - 1) }}
                                            </td>
                                            <td>{{ $row->nama_produk }}
                                            </td>
                                            <td>{{ $row->merk }}
                                            </td>
                                            <td>
                                                <img class="img-fluid img-box img-center"
                                                    src="{{ asset('storage/'.$row->gambar_produk) }}"
                                                    alt="{{ $row->gambar_produk }}">
                                            </td>
                                            <td>{{ $row->harga_beli }}
                                            </td>
                                            <td>{{ $row->kategori->nama_kategori }}
                                            </td>
                                            <td>
                                                <form method="post"
                                                    onsubmit="return confirm('Apakah anda yakin akan menghapus, Produk {{ $row->nama_produk }}?..')"
                                                    action="{{ route('Product.destroy', [$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <a href="{{ route('Product.edit', $row->id) }}" class="btn btn-info"><i
                                                            class="far fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Modal -->

                        </div>

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
