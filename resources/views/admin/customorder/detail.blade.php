<x-modal id="modalDetail" data-backdrop="static" data-keyboard="false" size="modal-lg">
    <x-slot name="title">
        Detail Pesanan
    </x-slot>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="name">Nama Pemesan</label>
                <input type="text" id="name" class="form-control" readonly>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="file_design">Desain</label>
                <div id="file_design" class="mt-2">
                    <!-- The design image will be injected here -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="design_description">Deskripsi Desain</label>
                <textarea id="design_description" class="form-control" rows="2" readonly></textarea>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="fabric_type">Jenis Bahan</label>
                <textarea id="fabric_type" class="form-control" rows="2" readonly></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="size">Ukuran Baju</label>
                <textarea id="size" class="form-control" rows="2" readonly></textarea>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="total_price">Total Harga</label>
                <input type="text" id="total_price" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="dp_paid">DP Dibayar</label>
                <input type="text" id="dp_paid" class="form-control" readonly>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="remaining_payment">Sisa Pembayaran</label>
                <input type="text" id="remaining_payment" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="order_date">Tanggal Pemesanan</label>
                <input type="text" id="order_date" class="form-control" readonly>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="completion_date">Tanggal Selesai</label>
                <input type="text" id="completion_date" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" id="status" class="form-control" readonly>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">
            <i class="fas fa-times"></i>
            Close
        </button>
    </x-slot>
</x-modal>
