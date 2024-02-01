@extends('admin.admin_master')

@section('tittle')
    Product transaksi
@endsection

@section('admin.index')
    <style>
        /* Your existing styles */

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 2rem;
        }

        .product-photocard {
            flex: 0 0 calc(33.33% - 2rem);
            max-width: calc(33.33% - 2rem);
            width: 100%;
            height: auto;
            background-color: #fff;
            overflow: hidden;
            margin: 0 1rem 2rem 1rem;
        }

        .product-photocard-img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .order-list-container {
            width: 100%;
            overflow: auto;
        }

        #total-all strong {
            max-width: 100%;
            display: inline-block;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success mt-3" href="{{ route('Product.create') }}"><i class="fas fa-plus"></i>Create
                    Product</a>
            </div>
            <br>

            <div class="col-md-8">
                <div class="product-container">
                    @if (count($Product) > 0)
                        @foreach ($Product as $row)
                            <div class="card product-photocard">
                                <img class="card-img-top product-photocard-img"
                                    src="{{ asset('storage/' . $row->gambar_produk) }}" alt="{{ $row->gambar_produk }}"
                                    width="100" height="100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $row->nama_produk }} - {{ $row->merk }}</h5>
                                    <p class="card-text" id="harga">Harga : Rp. {{ $row->harga_beli }}</p>
                                    <p class="card-text">
                                        <a href="#" class="btn btn-primary addToCartBtn" data-id="{{ $row->id }}"
                                            data-name="{{ $row->nama_produk }}" data-price="{{ $row->harga_beli }}">
                                            Tambah ke keranjang
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-danger" role="alert">
                            No products available.
                        </div>
                    @endif
                </div>
            </div>


            <div class="col-md-4 order-list-container">
                <div style="display: flex; justify-content: center">
                    <h5>Order List</h5>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th id="harga">Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- Cart items will be dynamically added here -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Total Semua</th>
                                <th id="total-all">0</th>
                            </tr>
                            <tr>
                                <th colspan="3">Total Barang</th>
                                <th id="all_barang"></th>
                            </tr>
                            <tr>
                                <th colspan="3">Total jumlah</th>
                                <th id="all_jumlah"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button type="button" class="btn btn-primary btn-muncul" id="btn-muncul">
                        Payment Method
                    </button>
                </div>


            </div>
        </div>
    </div>
    <br>

    <div class="card card-success mx-auto d-none" id="form-hide" style="padding: 20px;">
        <div class="card-header">
            <h3 class="card-title" style="text-align: center">Payment Form</h3>
        </div>



        <form action="{{ route('Payment.store') }}" method="POST">
            @csrf

            <input type="hidden" class="form-control" id="id_user" name="id_user"
                value="{{ auth()->check() && auth()->user()->id }}" placeholder="Product Name">

            <div class="mb-3">
                <label for="rekening" id="rekeningLabel">Nama Barang:</label>
                <input type="text" class="form-control" id="all_produk" name="nama_produk" placeholder="Product Name"
                    readonly>
            </div>


            <div class="mb-3">
                <label for="rekening" id="rekeningLabel">Harga Total:</label>
                <input type="text" class="form-control" id="totalPrice" name="harga_total" placeholder="Total Price"
                    readonly>
            </div>

            <div class="mb-3">
                <label for="rekening" id="rekeningLabel">Jumlah Semua:</label>
                <input type="text" class="form-control" id="totalQuantity" name="jumlah_semua_pembelian"
                    placeholder="Total Quantity" readonly>
            </div>

            <div class="form-floating mb-3">
                <select class="form-control select2" style="width: 100%;" aria-label="Default select example"
                    name="methode_pembayaran" id="metode_pembayaran">
                    <option value="default" selected>Methode Pembayaran</option>
                    <option value="dana">Dana</option>
                    <option value="bank">Bank</option>
                    <option value="COD">COD (Cash On Delivery)</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="rekening" id="rekeningLabel" style="display: none">Nomor Rekening
                    Bank:</label>
                <input type="number" class="form-control" id="bank_form_muncul" style="display: none;" name="bank"
                    placeholder="Enter Your Rekening Bank">
            </div>

            <div class="form-floating">
                <textarea class="form-control" name="COD" placeholder="Leave a comment here" id="alamat_COD_muncul"
                    style="display: none; height: 100px"></textarea>
                <label for="alamat_COD_muncul_label" class="d-none">Alamat Pengiriman</label>
            </div>

            <div class="mb-3">
                <label for="telepon" id="teleponLabel" style="display: none">Nomor Telepon
                    Dana:</label>
                <input type="number" class="form-control" id="dana_form_muncul" style="display: none;" name="dana"
                    placeholder="Enter Your Number Dana">
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <!-- Your existing JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </script>

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
            const cartItems = [];
            const totalAllElement = $('#total-all');
            const cartItemsElement = $('#cart-items');
            const totalQuantityElement = $('#totalQuantity');
            const allBarangElement = $('#all_barang');
            const allJumlahElement = $('#all_jumlah');

            // Add event delegation to handle input changes
            cartItemsElement.on('change', '.quantity-input', function() {
                const productId = $(this).data('id');
                const quantity = parseInt($(this).val());

                const existingItem = cartItems.find(item => item.id === productId);

                if (existingItem) {
                    existingItem.quantity = quantity;
                }

                updateCartUI();
            });

            $('.addToCartBtn').on('click', function() {
                const productId = $(this).data('id');
                const productName = $(this).data('name');
                const productPrice = $(this).data('price');

                const existingItem = cartItems.find(item => item.id === productId);

                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cartItems.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        quantity: 1,
                    });
                }

                updateCartUI();
            });

            function updateCartUI() {
                // Clear existing items
                cartItemsElement.empty();

                let totalPrice = 0;
                let totalQuantity = 0;
                let productNames = [];

                // Populate cart items
                $.each(cartItems, function(index, item) {
                    const total = item.price * item.quantity;
                    totalPrice += total;
                    totalQuantity += item.quantity;
                    productNames.push(item.name);

                    cartItemsElement.append(`
                 <tr>
                     <td>${item.name}</td>
                     <td>
                         <input type="number" class="form-control quantity-input"
                             data-id="${item.id}" value="${item.quantity}" min="1">
                     </td>
                     <td>Rp. ${item.price}</td>
                     <td>Rp. ${total}</td>
                 </tr>
             `);
                });

                // Set values for the input fields in the modal
                totalQuantityElement.val(totalQuantity);
                $('#totalPrice').val(`Rp. ${totalPrice}`);
                allBarangElement.text(productNames.join(', '));
                // Set the value of the input field with ID 'all_barang'
                $('#all_produk').val(productNames.join(', '));
                allJumlahElement.text(cartItems.length);

                // Calculate cumulative discount
                const cumulativeDiscount = Math.floor(totalPrice / 100000) *
                    0.05; // 5% discount for every Rp100,000 spent

                // Calculate discounted total
                const discountedTotal = totalPrice - (totalPrice * cumulativeDiscount);

                // Update total and display discount information in the UI
                totalAllElement.html(`
             <del>Rp. ${totalPrice.toFixed(2)}</del><br>
             <strong>Rp. ${discountedTotal.toFixed(2)} (-${(cumulativeDiscount * 100).toFixed(0)}%)</strong>
         `);
            }
        });

        $(document).ready(function() {
            let previouslySelectedForm = null;

            $("#metode_pembayaran").change(function() {
                if (previouslySelectedForm !== null) {
                    previouslySelectedForm.hide("slow");
                }

                let selectedValue = $(this).val();

                if (selectedValue === "dana") {
                    $("#dana_form_muncul").show("slow");
                    previouslySelectedForm = $("#dana_form_muncul");
                } else if (selectedValue === "bank") {
                    $("#bank_form_muncul").show("slow");
                    previouslySelectedForm = $("#bank_form_muncul");
                } else if (selectedValue === "COD") {
                    $("#alamat_COD_muncul").show("slow");
                    previouslySelectedForm = $("#alamat_COD_muncul");
                }
            });
        });

        // hideform
        $(document).ready(function() {
            // Tambahkan event klik pada tombol "Payment Method" dengan id "btn-muncul"
            $('#btn-muncul').click(function() {
                // Tampilkan formulir pembayaran dengan id "form-hide"
                $('#form-hide').removeClass('d-none');
            });
        });
    </script>

@endsection
