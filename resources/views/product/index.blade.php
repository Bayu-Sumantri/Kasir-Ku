@extends('admin.admin_master')
@section('tittle')
    Product Transaction
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
                                        <th>Harga Total</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Payment Method</th>
                                        <th>No Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allpayment as $row)
                                        <tr>
                                            <td> {{ $loop->iteration + $allpayment->perpage() * ($allpayment->currentPage() - 1) }}
                                            </td>
                                            <td>{{ $row->nama_produk }}
                                            </td>
                                            <td>{{ $row->harga_total }}
                                            </td>
                                            <td>{{ $row->jumlah_semua_pembelian }}
                                            </td>
                                            <td>{{ $row->methode_pembayaran }}</td>
                                            <td>
                                                @if ($row->methode_pembayaran === 'dana')
                                                    {{ $row->dana }}
                                                @elseif ($row->methode_pembayaran === 'bank')
                                                    {{ $row->bank }}
                                                @elseif ($row->methode_pembayaran === 'COD')
                                                    {{ $row->COD }}
                                                @endif
                                            </td>
                                            <td>
                                                <form method="post"
                                                    onsubmit="return confirm('Apakah anda yakin akan menghapus, Produk {{ $row->nama_produk }}?..')"
                                                    action="{{ route('Product.destroy', [$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <a href="{{ route('cetakPDF', $row->id) }}" target="_blank" class="btn btn-info"><i class="fas fa-print"></i></a>
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
