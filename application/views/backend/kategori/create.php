<a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#Tambah">
    <span class="icon text-white-50">
        <i class="fas fa-tag"></i>
    </span>
    <span class="text">Buat Kategori Baru</span>
</a>
<div class="modal modal-default fade" id="Tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?= form_open(base_url('admin/index/kategori'));
                ?>

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori" placeholder="Nama Kategori">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Tambah kategori">
                </div>
                <?= form_close();
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i
                        class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
    </div>
</div>