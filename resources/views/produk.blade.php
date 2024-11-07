<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Manajemen Produk</h1>

            <div class="box">
                <form id="produkForm">
                    <div class="field">
                        <label class="label">Nama Produk</label>
                        <div class="control">
                            <input class="input" type="text" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Harga</label>
                        <div class="control">
                            <input class="input" type="number" id="harga" name="harga" placeholder="Harga" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Deskripsi</label>
                        <div class="control">
                            <textarea class="textarea" id="deskripsi" name="deskripsi" placeholder="Deskripsi (Opsional)"></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Kategori</label>
                        <div class="control">
                            <div class="select">
                                <select id="kategori_id" name="kategori_id" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="control">
                        <button type="submit" class="button is-primary">Tambah Produk</button>
                    </div>
                </form>
            </div>

            <h2 class="title is-4">Daftar Produk</h2>
            <div id="produkList" class="content"></div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Fetch produk list
            function fetchProduk() {
                $.ajax({
                    url: '/produk',
                    method: 'GET',
                    success: function(data) {
                        let list = '<ul>';
                        data.forEach(function(produk) {
                            list += `<li>${produk.nama_produk} - Rp. ${produk.harga} 
                            <button class="button is-danger is-small deleteBtn" data-id="${produk.id}">Hapus</button></li>`;
                        });
                        list += '</ul>';
                        $('#produkList').html(list);
                    }
                });
            }

            // Fetch kategori list
            function fetchKategoris() {
                $.ajax({
                    url: '/kategori',
                    method: 'GET',
                    success: function(data) {
                        let kategoriOptions = '';
                        data.forEach(function(kategori) {
                            kategoriOptions += `<option value="${kategori.id}">${kategori.nama_kategori}</option>`;
                        });
                        $('#kategori_id').append(kategoriOptions);
                    }
                });
            }

            fetchKategoris(); // Memanggil kategori saat halaman dimuat
            fetchProduk(); // Memanggil produk saat halaman dimuat

            // Submit produk form
            $('#produkForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/produk',
                    method: 'POST',
                    data: {
                        nama_produk: $('#nama_produk').val(),
                        harga: $('#harga').val(),
                        deskripsi: $('#deskripsi').val(),
                        kategori_id: $('#kategori_id').val(),
                        _token: '{{ csrf_token() }}' // CSRF protection
                    },
                    success: function(response) {
                        alert('Produk berhasil ditambahkan!');
                        fetchProduk(); // Refresh produk list
                    },
                    error: function(xhr) {
                        alert('Gagal menambahkan produk!');
                    }
                });
            });

            // Delete produk
            $(document).on('click', '.deleteBtn', function() {
                const id = $(this).data('id');

                if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                    $.ajax({
                        url: `/produk/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Produk berhasil dihapus!');
                            fetchProduk(); // Refresh produk list
                        },
                        error: function(xhr) {
                            alert('Gagal menghapus produk!');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
