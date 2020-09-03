<div class="col-md-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Kategori</span>
    </h4>
    <ul class="list-group mb-3">
        <?php foreach ($all_kategori as $all_kategori) { ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0"><a
                        href="<?= base_url('index/kategori/' . $all_kategori->slug_kategori); ?>"><?= $all_kategori->nama_kategori; ?></a>
                </h6>
            </div>
        </li>
        <?php } ?>
    </ul>

    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Latest article</span>
    </h4>
    <ul class="list-group mb-3">
        <?php foreach ($latepost as $latepost) { ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0"><a
                        href="<?= base_url('index/detail/' . $latepost->slug_artikel); ?>"><?= $latepost->judul; ?></a>
                </h6>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>