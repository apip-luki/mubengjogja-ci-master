<button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
    data-target="#Delete<?= $artikel->id_artikel; ?>">
    <i class="fa fa-close"></i> Hapus
</button>
<div class="modal fade" id="Delete<?= $artikel->id_artikel; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> Menghapus Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-window-close"></i></span></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Menghapus Data Artikel <b><?= $artikel->judul ?></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><i class="fa fa-close"></i>
                    Batal</button>
                <a href="<?= base_url('admin/index/delete_art/' . $artikel->id_artikel) ?>"
                    class="btn btn-danger pull-right"><i class="fa fa-close"></i> Ya, Hapus Artikel</a>
            </div>
        </div>
    </div>
</div>