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
                        placeholder="Nama Product" >
                </div>
                <div class="mb-3">
                    <label for="rekening" id="rekeningLabel">Harga To   tal:</label>
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

                <div class="form-group mt-3" id="accountNumberInput" style="display: none;">
                    <label for="accountNumber">Nomor</label>
                    <input type="text" class="form-control" id="accountNumber" name="accountNumber">
                </div>
            </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>


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
        </script>
    </div>
@endsection
