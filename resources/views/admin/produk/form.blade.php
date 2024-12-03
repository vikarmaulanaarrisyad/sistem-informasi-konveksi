<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg">
    <x-slot name="title">
        Tambah Produk
    </x-slot>

    @method('POST')

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" id="nama_produk" autocomplete="off"
                    required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="kategori">Pilih Kategori</label>
                <select name="kategori" id="kategori" class="form-control select2" style="width: 100%;" required>
                    <!-- Kategori akan dimuat via ajax -->
                </select>
            </div>
        </div>
    </div>

    <div id="dynamic-fields-container">
        <!-- Dynamic fields will be added here -->
        <div class="row dynamic-fields">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="size[]">Size</label>
                    <input type="text" class="form-control" name="size[]" placeholder="Masukkan Size" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="harga_produk[]">Harga</label>
                    <input type="text" class="form-control" name="harga_produk[]" placeholder="Masukkan Harga"
                        onkeyup="format_uang(this)">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="quantity[]">Quantity</label>
                    <input type="number" class="form-control" name="quantity[]" placeholder="Masukkan Quantity"
                        min="1" required>
                </div>
            </div>
        </div>
    </div>

    <div id="btn-add-field" class="d-flex justify-content-between align-items-center mt-3">
        <button type="button" class="btn btn-sm btn-info" id="add-fields">
            <i class="fas fa-plus mr-1"></i> Tambah Ukuran, Harga, Quantity
        </button>
    </div>

    <div class="row mt-4">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"
                    placeholder="Masukkan keterangan produk"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="foto_produk">Foto Produk</label>
                <input type="file" class="form-control" name="foto_produk" id="foto_produk">
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary" id="submitBtn">
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">
            <i class="fas fa-times"></i>
            Close
        </button>
    </x-slot>
</x-modal>
