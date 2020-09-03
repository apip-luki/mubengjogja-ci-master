<div class="col-md-8">
    <hr class="featurette-divider">
    <?php foreach ($artikel as $artikel) { ?>
    <div class="row featurette">
        <div class="col-md-5 order-md-1">
            <img class="img-fluid" src="<?= base_url('assets/upload/images/' . $artikel->gambar); ?>">
        </div>
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading"><?= strip_tags(character_limiter($artikel->judul, 50)); ?></h2>
            <?php echo strip_tags(character_limiter($artikel->isi_artikel)); ?>
            <a href="<?= base_url('index/detail/' . $artikel->slug_artikel); ?>"> Read More</a>
        </div>
    </div>
    <hr class="featurette-divider">
    <?php } ?>

    <div class="pagination col-md-12 text-center">
        <?php if (isset($paginasi)) {
            echo $paginasi;
        } ?>
    </div>
</div>