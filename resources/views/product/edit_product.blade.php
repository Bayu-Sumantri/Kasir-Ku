@extends('admin.admin_master')
@section('tittle')
    Edit kategori
@endsection

@section('admin.index')
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Product</label>
                    <input type="text" class="form-control" name="nama_produk" id="exampleInputEmail1"
                        placeholder="Nama Product" value="{{ old('nama_produk', $product->nama_produk) }}">
                </div>
                <div class="form-group" style="width: 100%">
                    <label for="exampleSelectBorder">Kategori</label>
                    <select class="custom-select form-control-border" name="id_kategori" id="exampleSelectBorder" style="width: 100%">
                        @foreach ($allkategori as $kategori)
                            <option value="{{ $kategori->id }}" {{ $kategori->id == $product->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Merk</label>
                    <input type="text" class="form-control" name="merk" id="exampleInputEmail1"
                        placeholder="Nama Merk" value="{{ old('merk', $product->merk) }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga Product</label>
                    <input type="text" class="form-control" name="harga_beli" id="exampleInputEmail1"
                        placeholder="Nama Kategori" value="{{ old('harga_beli', $product->harga_beli) }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gambar Product</label>
                    <input type="file" class="form-control" name="gambar_produk" id="gambar_product"
                        placeholder="Nama Kategori">
                    <div id="gambarPreviewContainer">
                        <img id="gambarPreview" src="#" alt="Preview Gambar"
                            style="max-width: 100%; max-height: 200px; display: none;">
                    </div>
                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
        <script>
            $(document).ready(function() {
                // Ketika input file berubah
                $('#gambar_product').on('change', function() {
                    previewGambar(this);
                });

                // Fungsi untuk menampilkan preview gambar
                function previewGambar(input) {
                    var file = input.files[0];

                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#gambarPreview').attr('src', e.target.result);
                            $('#gambarPreview').css('display', 'block');
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // Jika input file kosong, sembunyikan preview gambar
                        $('#gambarPreview').attr('src', '#');
                        $('#gambarPreview').css('display', 'none');
                    }
                }
            });
        </script>
    </div>
@endsection
