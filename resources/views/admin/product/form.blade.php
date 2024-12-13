<x-modal data-backdrop="static" data-keyboard="false" size="modal-xl">
    <x-slot name="title">
        Tambah Produk
    </x-slot>

    @method('POST')

    <div class="row">
        <!-- Brand ID -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <select class="form-control select2 brand_id" name="brand_id" id="brand_id" style="width: 100%"></select>
            </div>
        </div>

        <!-- Category ID -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select class="form-control select2 category_id" name="category_id" id="category_id"
                    style="width: 100%"></select>
            </div>
        </div>

        <!-- Subcategory ID -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="subcategory_id">Subkategori</label>
                <select class="form-control select2 subcategory_id" name="subcategory_id" id="subcategory_id"
                    style="width: 100%"></select>
            </div>
        </div>

        <!-- Subsubcategory ID -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="subsubcategory_id">Subsubkategori</label>
                <select class="form-control select2 subsubcategory_id" name="subsubcategory_id" id="subsubcategory_id"
                    style="width: 100%"></select>
            </div>
        </div>

        <!-- Product Code -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="product_code">Kode Produk</label>
                <input type="text" class="form-control" name="product_code" id="product_code" autocomplete="off">
            </div>
        </div>

        <!-- Product Name -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="product_name">Nama Produk</label>
                <input type="text" class="form-control" name="product_name" id="product_name" autocomplete="off">
            </div>
        </div>

        <!-- Product Quantity -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="product_qty">Kuantitas Produk</label>
                <input type="number" class="form-control" name="product_qty" id="product_qty" autocomplete="off"
                    min="0" value="0">
            </div>
        </div>

        <!-- Product Size -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="product_size">Ukuran Produk</label>
                <input type="text" class="form-control" name="product_size" id="product_size" autocomplete="off">
            </div>
        </div>

        <!-- Product Color -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="product_color">Warna Produk</label>
                <input type="text" class="form-control" name="product_color" id="product_color" autocomplete="off">
            </div>
        </div>

        <!-- Price Fields (Selling Price, Discount, Price After Discount) -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="selling_price">Harga Jual</label>
                <input type="text" class="form-control" name="selling_price" id="selling_price" autocomplete="off"
                    onkeyup="format_uang(this)">
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="discount_price">Diskon %</label>
                <input type="text" class="form-control" name="discount_price" id="discount_price" autocomplete="off"
                    min="0" value="0.0" oninput="calculateDiscountPrice()" placeholder="0.0">
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="price_after_discount">Harga Setelah Diskon</label>
                <input type="text" class="form-control" name="price_after_discount" id="price_after_discount"
                    autocomplete="off" readonly>
            </div>
        </div>

        <!-- Descriptions -->
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="short_descp">Deskripsi Singkat</label>
                <input type="text" class="form-control" name="short_descp" id="short_descp" autocomplete="off">
            </div>
        </div>

        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="long_descp">Deskripsi Lengkap</label>
                <textarea class="form-control" name="long_descp" id="long_descp"></textarea>
            </div>
        </div>

        <!-- Image Upload -->
        {{--  <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="product_thumbnail">Thumbnail Produk</label>
                <input type="file" class="form-control" name="product_thumbnail" id="product_thumbnail"
                    value="product_thumbnail.jpg">
            </div>
        </div>

        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="photo_name">Upload Gambar Produk</label>
                <input type="file" class="form-control photo_name" name="photo_name[]" id="photo_name"
                    accept="image/*" multiple>
            </div>
        </div>  --}}

        <!-- Image Upload -->
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="product_thumbnail">Thumbnail Produk</label>
                <input type="file" class="form-control" name="product_thumbnail" id="product_thumbnail"
                    value="product_thumbnail.jpg" onchange="previewImage(this)">
                <br>
                <img id="thumbnailPreview" src="" alt="Image Preview"
                    style="max-width: 200px; display: none;">
            </div>
        </div>

        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="photo_name">Upload Gambar Produk</label>
                <input type="file" class="form-control photo_name" name="photo_name[]" id="photo_name"
                    accept="image/*" multiple onchange="previewMultipleImages(this)">
                <br>
                <div id="imagePreviewContainer"></div>
            </div>
        </div>

        <!-- Special Options (Hot Deals, Featured, Special Offer) -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="hot_deals">Hot Deals</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hot_deals" id="hot_deals">
                    <label class="form-check-label" for="hot_deals">Pilih Hot Deals</label>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="featured">Featured</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured">
                    <label class="form-check-label" for="featured">Pilih Featured</label>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="special_offer">Special Offer</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="special_offer" id="special_offer">
                    <label class="form-check-label" for="special_offer">Pilih Special Offer</label>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="special_deals">Special Deals</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="special_deals" id="special_deals">
                    <label class="form-check-label" for="special_deals">Pilih Special Deals</label>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="0">Tidak Aktif</option>
                    <option value="1">Aktif</option>
                </select>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary" id="submitBtn">
            <i class="fas fa-save mr-1"></i> Simpan
        </button>
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">
            <i class="fas fa-times"></i> Close
        </button>
    </x-slot>
</x-modal>
