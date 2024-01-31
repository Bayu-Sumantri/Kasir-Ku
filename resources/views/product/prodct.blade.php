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
            /* Allow cards to wrap to the next line */
            justify-content: space-around;
            /* Center the cards */
            margin-bottom: 2rem;
        }

        .product-photocard {
            flex: 0 0 calc(33.33% - 2rem);
            /* 3 cards in a row with margins */
            max-width: calc(33.33% - 2rem);
            width: 100%;
            height: auto;
            background-color: #fff;
            overflow: hidden;
            margin: 0 1rem 2rem 1rem;
            /* Adjust margins as needed */
        }

        .product-photocard-img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .order-list-container {
            width: 100%;
            /* Full width on small screens */
            overflow: auto;
            /* Add scroll bar for small screens */
        }

        #total-all strong {
            max-width: 100%;
            /* Limit the width of the discount information */
            display: inline-block;
            /* Allow line breaks if needed */
        }
    </style>

    <!-- Your existing HTML -->

    <div class="container">
        <div class="row">
            <!-- Create Product Button -->
            <div class="col-md-12">
                <a class="btn btn-success mt-3" href="{{ route('Product.create') }}"><i class="fas fa-plus"></i>Create
                    Product</a>
            </div>
            <br>

            <!-- Product Cards -->
            <div class="col-md-8">
                <div class="product-container">
                    @foreach ($Product as $row)
                        <div class="card product-photocard">
                            <img class="card-img-top product-photocard-img"
                                src="{{ asset('storage/' . $row->gambar_produk) }}" alt="{{ $row->gambar_produk }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $row->nama_produk }}</h5>
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
                </div>
            </div>

            <!-- Order List -->
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
                        </tfoot>
                    </table>
                </div>
                <!-- Responsive Button -->
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Payment Method
                    </button>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pilih Metode Pembayaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <!-- HTML Form Fields -->
                                <div class="mb-3">
                                    <label for="rekening" id="rekeningLabel">Nama Barang:</label>
                                    <input type="text" class="form-control" id="productName" name="nama_barang"
                                        placeholder="Product Name" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="rekening" id="rekeningLabel">Harga Total:</label>
                                    <input type="text" class="form-control" id="totalPrice" name="harga_total"
                                        placeholder="Total Price" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="rekening" id="rekeningLabel">Jumlah Semua:</label>
                                    <input type="text" class="form-control" id="totalQuantity" name="jumlah_semua"
                                        placeholder="Total Quantity" readonly>
                                </div>


                                <div class="form-floating mb-3">
                                    <select class="form-control select2" style="width: 100%;"
                                        aria-label="Default select example" name="metode_pembayaran" id="metode_pembayaran">
                                        <option value="default" selected>Methode Pembayaran</option>
                                        <option value="dana">Dana</option>
                                        <option value="bank">Bank</option>
                                        <option value="COD">COD (Cash On Delivery)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="rekening" id="rekeningLabel" style="display: none">Nomor Rekening
                                        Bank:</label>
                                    <input type="text" class="form-control" id="bank_form_muncul" style="display: none;"
                                        name="rekening_bank" placeholder="Enter Your Rekening Bank">
                                </div>

                                <div class="form-floating">
                                    <textarea class="form-control" name="alamat_tujuan" placeholder="Leave a comment here" id="alamat_COD_muncul"
                                        style="display: none; height: 100px"></textarea>
                                    <label for="alamat_COD_muncul_label" class="d-none">Alamat Pengiriman</label>
                                </div>

                                <div class="mb-3">
                                    <label for="telepon" id="teleponLabel" style="display: none">Nomor Telepon
                                        Dana:</label>
                                    <input type="text" class="form-control" id="dana_form_muncul"
                                        style="display: none;" name="nomor_dana" placeholder="Enter Your Number Dana">
                                </div>



                                <!-- Input field for the selected payment method -->
                                <div class="form-group mt-3" id="accountNumberInput" style="display: none;">
                                    <label for="accountNumber">Nomor</label>
                                    <input type="text" class="form-control" id="accountNumber" name="accountNumber">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="savePaymentMethod()">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>

    <!-- Your existing JavaScript -->
    <!-- Your existing JavaScript -->
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
            const cartItems = [];
            const totalAllElement = $('#total-all');
            const cartItemsElement = $('#cart-items');

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

                // Populate cart items
                $.each(cartItems, function(index, item) {
                    const total = item.price * item.quantity;
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

                // Calculate total
                const totalAll = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);

                // Calculate cumulative discount
                const cumulativeDiscount = Math.floor(totalAll / 100000) *
                    0.05; // 5% discount for every Rp100,000 spent

                // Calculate discounted total
                const discountedTotal = totalAll - (totalAll * cumulativeDiscount);

                // Update total and display discount information in the UI
                totalAllElement.html(`
            <del>Rp. ${totalAll.toFixed(2)}</del><br>
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

        function updateCartUI() {
            // Clear existing items
            cartItemsElement.empty();

            // Populate cart items and update HTML form fields
            let totalQuantity = 0;
            let totalAll = 0;

            $.each(cartItems, function(index, item) {
                const total = item.price * item.quantity;
                totalQuantity += item.quantity;
                totalAll += total;

                // Append item to cart items table
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

            // Update HTML form fields with cart summary
            $('#productName').val(cartItems.length > 0 ? cartItems[0].name : '');
            $('#totalQuantity').val(totalQuantity);
            $('#totalPrice').val(`Rp. ${totalAll.toFixed(2)}`);
        }
    </script>
@endsection
