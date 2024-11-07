<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Buat Transaksi Baru</h2>
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="customer_id">Pilih Customer:</label>
                <select name="customer_id" class="form-control" required>
                    <option value="">--Pilih Customer--</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->nama_customer }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                <input type="date" name="tanggal_transaksi" class="form-control" required>
            </div>

            <h4>Detail Barang</h4>
            <table class="table table-bordered" id="barangTable">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <button type="button" class="btn btn-primary" id="addBarangBtn">Tambah Barang</button>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success mt-3">Simpan Transaksi</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </form>
    </div>

    <script>
        $('#addBarangBtn').on('click', function () {
            let produkOptions = `
                <option value="">--Pilih Produk--</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->nama_produk }}</option>
                @endforeach
            `;
            $('#barangTable tbody').append(`
                <tr>
                    <td>
                        <select name="produk_id[]" class="form-control produk-select" required>${produkOptions}</select>
                    </td>
                    <td><input type="number" name="jumlah_produk[]" class="form-control jumlah_produk" required></td>
                    <td><input type="number" name="harga_satuan[]" class="form-control harga_satuan" readonly></td>
                    <td><input type="number" name="total_harga[]" class="form-control total_harga" readonly></td>
                    <td><button type="button" class="btn btn-danger removeBarangBtn">Hapus</button></td>
                </tr>
            `);
        });

        $(document).on('click', '.removeBarangBtn', function () {
            $(this).closest('tr').remove();
        });

        $(document).on('change', 'select[name="produk_id[]"]', function () {
            let produkId = $(this).val();
            let row = $(this).closest('tr');
            if (produkId) {
                $.ajax({
                    url: `/produk/harga/${produkId}`,
                    method: 'GET',
                    success: function (response) {
                        row.find('input[name="harga_satuan[]"]').val(response.harga);
                        updateTotal(row);
                    },
                    error: function () {
                        alert('Gagal mengambil harga produk');
                    }
                });
            } else {
                row.find('input[name="harga_satuan[]"]').val('');
                row.find('input[name="total_harga[]"]').val('');
            }
        });

        $(document).on('input', 'input[name="jumlah_produk[]"]', function () {
            let row = $(this).closest('tr');
            updateTotal(row);
        });

        function updateTotal(row) {
            let jumlah = row.find('input[name="jumlah_produk[]"]').val();
            let hargaSatuan = row.find('input[name="harga_satuan[]"]').val();
            let total = jumlah * hargaSatuan;
            row.find('input[name="total_harga[]"]').val(total);
        }

        $('form').on('submit', function (e) {
            let barangCount = $('#barangTable tbody tr').length;

            if (barangCount === 0) {
                e.preventDefault();
                alert('Tambahkan minimal satu produk sebelum menyimpan transaksi.');
            }
        });
    </script>
</body>
</html>
