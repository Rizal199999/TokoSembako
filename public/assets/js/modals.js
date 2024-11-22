$(document).ready(function() {
    // Fungsi untuk menangani klik pada tombol "Detail"
    $('.btn-detail').click(async function() {
        const productId = $(this).data('id');  // Ambil ID produk dari tombol
        
        try {
            // Ambil data produk dari server menggunakan async/await
            const data = await fetchData(productId);
            
            // Isi form di modal dengan data yang didapat
            $('#product_name').val(data.product_name);
            $('#category').val(data.category);
            $('#price').val(data.price);
            $('#unit').val(data.unit);
            $('#stock').val(data.stock);
            $('#description').val(data.description);

            // Tampilkan modal
            $('#detailModal').modal('show');
        } catch (error) {
            alert('Error retrieving product details: ' + error.message);
        }
    });

    // Fungsi untuk melakukan fetch data produk dengan async/await
    async function fetchData(productId) {
        const response = await fetch(`/TokoSembako/public/get-data-modals/${productId}`);
        if (!response.ok) {
            throw new Error('Failed to fetch product data');
        }
        return response.json();  // Mengembalikan data JSON yang diterima dari server
    }

    // Fungsi untuk tombol Delete
    $('#deleteButton').click(async function() {
        const productId = $('.btn-detail').data('id');
        if (confirm('Are you sure you want to delete this product?')) {
            try {
                await deleteProduct(productId);
                alert('Product deleted successfully');
                $('#detailModal').modal('hide');
            } catch (error) {
                alert('Error deleting product: ' + error.message);
            }
        }
    });

    // Fungsi untuk menghapus produk dengan async/await
    async function deleteProduct(productId) {
        const response = await fetch(`/TokoSembako/public/delete-product/${productId}`, {
            method: 'DELETE',
        });
        if (!response.ok) {
            throw new Error('Failed to delete product');
        }
    }

    // Fungsi untuk tombol Edit
    $('#editButton').click(function() {
        $('#product_name').prop('readonly', false);
        $('#category').prop('readonly', false);
        $('#price').prop('readonly', false);
        $('#unit').prop('readonly', false);
        $('#stock').prop('readonly', false);
        $('#description').prop('readonly', false);

        // Ganti tombol Edit menjadi Save
        $('#editButton').text('Save').attr('id', 'saveButton');
    });

    // Fungsi untuk tombol Save
    $(document).on('click', '#saveButton', async function() {
        const productId = $('.btn-detail').data('id');
        const updatedData = {
            product_name: $('#product_name').val(),
            category: $('#category').val(),
            price: $('#price').val(),
            unit: $('#unit').val(),
            stock: $('#stock').val(),
            description: $('#description').val(),
        };

        try {
            await updateProduct(productId, updatedData);
            alert('Product updated successfully');
            $('#detailModal').modal('hide');
        } catch (error) {
            alert('Error updating product: ' + error.message);
        }
    });

    // Fungsi untuk mengupdate produk dengan async/await
    async function updateProduct(productId, updatedData) {
        const response = await fetch(`/TokoSembako/public/update-product/${productId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(updatedData),
        });
        if (!response.ok) {
            throw new Error('Failed to update product');
        }
    }
});