<!-- resources/views/produk/modal.blade.php -->
<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="produkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produkModalLabel">Add Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="produkForm">
                    @csrf
                    <input type="hidden" id="produkId" name="id">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori_id" name="kategori_id" required>
                            <option value="">Select Kategori</option>
                            <!-- Options will be loaded dynamically -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveProduk">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk mengisi dropdown kategori
    function loadCategories() {
        $.ajax({
            url: '{{ route("api.kategori.index") }}', // Ganti dengan rute API untuk mengambil kategori
            type: 'GET',
            success: function(response) {
                const kategoriSelect = $('#kategori_id');
                kategoriSelect.empty(); // Kosongkan dropdown sebelum mengisi
                kategoriSelect.append('<option value="">Select Kategori</option>');
                
                // Tambahkan setiap kategori ke dalam dropdown
                $.each(response.data, function(index, kategori) {
                    kategoriSelect.append('<option value="' + kategori.id + '">' + kategori.nama_kategori + '</option>');
                });
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    }

    // Load kategori ketika modal ditampilkan
    $('#produkModal').on('show.bs.modal', function () {
        loadCategories(); // Load categories each time modal is shown
        $('#produkForm')[0].reset(); // Reset the form fields
        $('#produkId').val(''); // Clear product ID for new entry
        $('#produkModalLabel').text('Add Produk'); // Set modal title to Add
    });

    // Fungsi untuk menyimpan produk
    $('#saveProduk').click(function() {
        const id = $('#produkId').val();
        const url = id ? `/api/produk/${id}` : '{{ route("api.produk.store") }}';
        const method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: $('#produkForm').serialize(),
            success: function(response) {
                $('#produkModal').modal('hide');
                $('#produkTable').DataTable().ajax.reload();
                alert('Product saved successfully!');
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });

    // Mengisi data produk saat modal ditampilkan untuk edit
    $('#produkTable tbody').on('click', '.edit', function() {
        let id = $(this).data('id');
        $.ajax({
            url: `/api/produk/${id}`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#produkModalLabel').text('Edit Produk');
                $('#produkId').val(data.id);
                $('#nama_produk').val(data.nama_produk);
                $('#harga').val(data.harga);
                $('#deskripsi').val(data.deskripsi);
                if (data.kategori) {
                    $('#kategori_id').val(data.kategori.id); // Set selected category
                }
                loadCategories(); // Reload categories to ensure dropdown is updated
                $('#produkModal').modal('show');
            },
            error: function(xhr) {
                alert("Error fetching product data: " + xhr.responseJSON.message);
            }
        });
    });
</script>
