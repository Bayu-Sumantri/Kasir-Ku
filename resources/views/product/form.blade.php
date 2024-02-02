@extends('admin.admin_master')
@section('tittle')
    Edit kategori
@endsection

@section('admin.index')
    <style>
        .drop-container {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        .drop-message {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .file-list {
            list-style: none;
            padding: 0;
        }

        .file-item {
            background-color: #f2f2f2;
            padding: 5px;
            margin: 5px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .file-name {
            margin-left: 10px;
        }

/* Add this CSS to your existing styles.css file */

.delete-button {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
    margin-left: 10px;
}

.delete-button:hover {
    background-color: #c0392b;
}

.file-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.thumbnail {
    max-width: 100px;
    max-height: 100px;
    border: 1px solid #ccc;
    margin-right: 10px;
    border-radius: 5px;
}

    </style>
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

                <div class="drop-container" id="dropContainer">
                    <div class="drop-message" id="dropMessage">
                        <span>Drag & Drop files here or click to browse</span>
                    </div>
                    <input type="file" id="fileInput" name="gambar_produk" multiple>
                    <ul id="fileList" class="file-list"></ul>
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

        document.addEventListener('DOMContentLoaded', () => {
    const dropContainer = document.getElementById('dropContainer');
    const dropMessage = document.getElementById('dropMessage');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');

    dropContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropContainer.classList.add('drag-over');
    });

    dropContainer.addEventListener('dragleave', () => {
        dropContainer.classList.remove('drag-over');
    });

    dropContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        dropContainer.classList.remove('drag-over');
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        fileList.innerHTML = '';

        for (const file of files) {
            const listItem = document.createElement('li');
            listItem.className = 'file-item';

            if (file.type.startsWith('image/')) {
                const thumbnail = document.createElement('img');
                thumbnail.className = 'thumbnail';
                thumbnail.src = URL.createObjectURL(file);
                thumbnail.alt = file.name;

                const deleteButton = createDeleteButton(file.name, listItem);
                listItem.appendChild(thumbnail);
                listItem.appendChild(deleteButton);
            } else {
                const icon = document.createElement('span');
                icon.innerHTML = '📄';

                const fileName = document.createElement('span');
                fileName.className = 'file-name';
                fileName.textContent = file.name;

                const deleteButton = createDeleteButton(file.name, listItem);
                listItem.appendChild(icon);
                listItem.appendChild(fileName);
                listItem.appendChild(deleteButton);
            }

            fileList.appendChild(listItem);
        }
    }

    function createDeleteButton(fileName, listItem) {
        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-button';
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', () => {
            // Handle delete functionality here
            deleteFile(fileName, listItem);
        });

        return deleteButton;
    }

    function deleteFile(fileName, listItem) {
        // Implement your logic to delete the file or handle desired actions
        // For example, you can make an AJAX request to delete the file on the server

        // Remove the corresponding list item from the DOM
        listItem.remove();

        // Reset the file input value
        fileInput.value = '';
    }
});

    </script>

    <!-- /.card -->
@endsection
