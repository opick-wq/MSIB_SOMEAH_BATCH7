<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Transaksi</h2>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Buat Transaksi Baru</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Customer</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->customer->nama_customer }}</td>
                    <td>{{ $item->tanggal_transaksi }}</td>
                    <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm btn-detail" data-id="{{ $item->id }}">Detail</button>
                        <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>                                     
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal Detail Transaksi --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Nama Customer:</strong> <span id="nama_customer"></span><br>
                    <strong>Tanggal Transaksi:</strong> <span id="tanggal_transaksi"></span><br>
                    <strong>Total Harga:</strong> <span id="total_harga"></span><br>
                    <hr>
                    <h5>Produk yang Dibeli</h5>
                    <ul id="produk_list"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-detail').on('click', function() {
                var transaksiId = $(this).data('id');
                
                $.ajax({
                    url: `/transaksi/${transaksiId}`,
                    method: 'GET',
                    success: function(response) {
                        $('#nama_customer').text(response.transaksi.customer.nama_customer);
                        $('#tanggal_transaksi').text(response.transaksi.tanggal_transaksi);
                        $('#total_harga').text('Rp' + new Intl.NumberFormat('id-ID').format(response.transaksi.total_harga));

                        $('#produk_list').empty();
                        $.each(response.transaksi.detail_transaksi, function(index, detail) {
                            $('#produk_list').append('<li>' + detail.produk.nama_produk + ' (x' + detail.jumlah_produk + ') - Rp' + new Intl.NumberFormat('id-ID').format(detail.harga_satuan) + '</li>');
                        });

                        $('#detailModal').modal('show');
                    },
                    error: function() {
                        alert('Gagal mengambil detail transaksi');
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
