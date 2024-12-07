<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('POST')

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" id="category_id" class="form-control select2 category_id"
                    style="width: 100%;"></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="sub_category_id">Sub Kategori</label>
                <select name="sub_category_id" id="sub_category_id" class="form-control select2 sub_category_id"
                    style="width: 100%;"></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="subsubcategory_name">Sub Sub Kategori</label>
                <input type="text" class="form-control" name="subsubcategory_name" id="subsubcategory_name"
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
