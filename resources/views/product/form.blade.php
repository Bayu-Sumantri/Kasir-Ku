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
                        placeholder="Nama Product">
                </div>
                <div class="form-group" style="width: 100%">
                    <label for="exampleSelectBorder">Kategori</label>
                    <select class="custom-select form-control-border" name="id_kategori" id="exampleSelectBorder"
                        style="width: 100%">
                        <option selected>Your kategori</option>
                        @foreach ($allkategori as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Merk</label>
                    <input type="text" class="form-control" name="merk" id="exampleInputEmail1"
                        placeholder="Nama Merk">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga Product</label>
                    <input type="text" class="form-control" name="harga_beli" id="harga" placeholder="Nama Kategori">
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
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            // Specify the IDs of the input fields
            const inputIds = ['#harga', '#jumlah', /* add more IDs here */ ];

            // Loop through each ID and apply maskMoney plugin
            for (let i = 0; i < inputIds.length; i++) {
                $(inputIds[i]).maskMoney({
                    thousands: '.',
                    decimal: ',',
                    precision: 0,
                    allowZero: false,
                    allowNegative: false,
                });
            }
        });



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

    <!-- /.card -->
@endsection
