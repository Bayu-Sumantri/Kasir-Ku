<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Toko Buku</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        header {
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 5px;
        }

        .nota {
            border: 1px solid #ddd;
            padding: 20px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 5px;
        }

        th {
            text-align: center;
        }

        tfoot {
            font-weight: bold;
        }

        .kasir {
            text-align: right;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 10px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
    <div class="container">
        <header>
            <h1>PT. Woilah Cik</h1>
            <p>Jalan Jatinegara Barat, Jakarta Timur</p>
            <p>Tanggal Transaksi : {{ $payment->created_at }}</p>
        </header>
        <section class="nota">
            <h2>Nota</h2>
            <p>No Nota: id pemesanan</p>
            <p>Tanggal: {{ $payment->created_at }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Nama Product</th>
                        <th>Harga Asli</th>
                        <th>Discount</th>
                        <th>Harga Discount</th>
                        <th>QTY</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $payment->nama_produk }}</td>
                        <td>{{ $payment->harga_total }}</td>
                        <td>{{ $payment->persen_discount }}</td>
                        <td>{{ $payment->harga_discount }}</td>
                        <td>{{ $payment->jumlah_semua_pembelian }}</td>
                        <td>{{ $payment->harga_discount }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th>{{ $payment->harga_discount }}</th>
                    </tr>
                    <!-- <tr>
                        <th colspan="5">Bayar</th>
                        <th>Rp 100.000</th>
                    </tr>
                    <tr>
                        <th colspan="5">Kembali</th>
                        <th>Rp 19.000</th>
                    </tr> -->
                </tfoot>
            </table>
            <p>Kasir: {{ auth()->check() ? auth()->user()->name : 'Nama Pengguna Tidak Terotentikasi' }}            </p>
        </section>
        <footer>
            <p>**TERIMA KASIH**</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
