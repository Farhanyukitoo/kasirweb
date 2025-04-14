<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/7298/7298311.png" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/createpenjualan.css')}}">
</head>

<body>
    <div class="main-container">
        <div>
            <h1>Tambah Penjualan</h1>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('penjualans.store') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="form-group">
                    <label for="Tanggalpenjualan">Tanggal Penjualan</label>
                    <input type="date" name="Tanggalpenjualan" id="Tanggalpenjualan" required>
                </div>

                <div>
                    <label for="pelanggan_id">Pelanggan</label>
                    <select name="pelanggan_id" id="pelanggan_id" required>
                        <option value="" disabled selected>Pilih Pelanggan</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->namapelanggan }} - {{ $pelanggan->Peran }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="produk-container">
                    <div class="produk-item">
                        <label for="product_id">Pilih Produk</label>
                        <select name="product_id[]" class="product-select" required>
                            <option value="" disabled selected>Pilih Produk Barang</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                                    {{ $product->name }} - Stok: {{ $product->stock }} - Rp. {{ number_format($product->price, 2, ',', '.') }}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity">Jumlah</label>
                        <input type="number" name="quantity[]" class="quantity" min="1" required value="1">
                        
                        <input type="number" name="totalharga[]" class="totalharga" required readonly value="0">
                        
                        <button type="button" onclick="addProduct()">Tambah Produk</button>
                        <button type="button" class="remove-product" onclick="removeProduct(this)">Hapus</button>
                    </div>
                </div>

                <div class="total-price-section">
                    <label for="total_harga_semua">Total Harga Keseluruhan</label>
                    <input type="number" id="total_harga_semua" name="total_harga_semua" required readonly value="0">
                </div>

                <div class="button-group">
                    <button type="submit">Simpan</button>
                    <a href="{{ route('penjualans.index') }}" class="nav-link">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set the current date for the "Tanggal Penjualan" input field
            let tanggalInput = document.getElementById("Tanggalpenjualan");
            let today = new Date().toISOString().split("T")[0];
            tanggalInput.value = today;
            tanggalInput.setAttribute("min", today);

            // Disable out-of-stock products when the page is loaded
            disableOutOfStockProducts();
        });

        document.addEventListener("change", function(event) {
            if (event.target.classList.contains("product-select")) {
                updateProductPrice(event.target);
            }

            if (event.target.classList.contains("quantity")) {
                updateQuantity(event.target);
            }
        });

        function updateProductPrice(select) {
            const price = select.options[select.selectedIndex].getAttribute("data-price");
            const stock = select.options[select.selectedIndex].getAttribute("data-stock");
            const quantityInput = select.parentElement.querySelector(".quantity");
            const totalPriceInput = select.parentElement.querySelector(".totalharga");

            // Ensure quantity does not exceed stock
            quantityInput.setAttribute("max", stock);

            // Update the total price for the selected product
            const quantity = quantityInput.value;
            totalPriceInput.value = (price * quantity).toFixed(2);

            updateTotalHarga();
        }

        function updateQuantity(input) {
            const price = input.parentElement.querySelector(".product-select").options[input.parentElement.querySelector(".product-select").selectedIndex].getAttribute("data-price");
            const stock = input.parentElement.querySelector(".product-select").options[input.parentElement.querySelector(".product-select").selectedIndex].getAttribute("data-stock");

            // Ensure quantity does not exceed stock
            if (parseInt(input.value) > parseInt(stock)) {
                input.value = stock;
                alert("Jumlah tidak boleh lebih dari stok yang tersedia.");
            }

            updateProductPrice(input.parentElement.querySelector(".product-select"));
        }

        function addProduct() {
            const container = document.getElementById("produk-container");
            const newProduct = document.querySelector(".produk-item").cloneNode(true);

            // Reset values for the new product input
            newProduct.querySelector(".product-select").value = "";
            newProduct.querySelector(".quantity").value = "1";
            newProduct.querySelector(".totalharga").value = "0";

            container.appendChild(newProduct);

            // Disable out-of-stock products after adding a new product
            disableOutOfStockProducts();
        }

        function removeProduct(button) {
            const container = document.getElementById("produk-container");
            if (container.children.length > 1) {
                button.parentElement.remove();
                disableOutOfStockProducts();
                updateTotalHarga();
            }
        }

        function updateTotalHarga() {
            let total = 0;
            document.querySelectorAll(".totalharga").forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            document.getElementById("total_harga_semua").value = total.toFixed(2);
        }

        function disableOutOfStockProducts() {
            const productSelects = document.querySelectorAll(".product-select");
            productSelects.forEach(select => {
                const options = select.options;
                for (let i = 0; i < options.length; i++) {
                    const stock = options[i].getAttribute("data-stock");
                    options[i].disabled = parseInt(stock) === 0;
                }
            });
        }

        function validateForm() {
            let valid = true;

            // Ensure all total prices are valid
            document.querySelectorAll(".totalharga").forEach(input => {
                if (parseFloat(input.value) === 0) {
                    alert("Pastikan semua produk memiliki total harga yang valid.");
                    valid = false;
                }
            });

            // Ensure at least one product is selected
            const productSelections = document.querySelectorAll(".product-select");
            let isProductSelected = false;
            productSelections.forEach(select => {
                if (select.value) {
                    isProductSelected = true;
                }
            });

            if (!isProductSelected) {
                alert("Pastikan Anda memilih produk.");
                valid = false;
            }

            return valid;
        }
    </script>
</body>

</html>
