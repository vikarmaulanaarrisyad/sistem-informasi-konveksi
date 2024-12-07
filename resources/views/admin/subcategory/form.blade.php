<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="category_id">Nama kategori</label>
                <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;"></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="subcategory_name">Nama Sub Kategori</label>
                <input type="text" class="form-control" name="subcategory_name" id="subcategory_name"
                    autocomplete="off">
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
