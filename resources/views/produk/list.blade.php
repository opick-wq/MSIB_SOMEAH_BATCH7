@if($produk->isEmpty())
    <p>Belum ada produk yang tersedia.</p>
@else
    <ul>
        @foreach($produk as $prod)
            <li>
                {{ $prod->nama_produk }} - Rp{{ number_format($prod->harga) }}
                <button class="deleteProduk" data-id="{{ $prod->id }}">Hapus</button>
            </li>
        @endforeach
    </ul>
@endif

<script>
    $('.deleteProduk').on('click', function() {
        const id = $(this).data('id');

        $.ajax({
            url: '/produk/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                alert('Produk berhasil dihapus!');
                location.reload();
            },
            error: function(error) {
                alert('Gagal menghapus produk!');
            }
        });
    });
</script>
