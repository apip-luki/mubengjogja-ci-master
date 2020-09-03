<div class="col-md-8">
    <img class="img-fluid" src="<?= base_url('assets/upload/images/' . $artikel->gambar); ?>">
    <h2><?= $artikel->judul; ?></h2>
    <span class="mr-md-5 text-muted"> Posted by : <?= $artikel->nama; ?></span>
    <span class="text-muted"> Kategori : <a
            href="<?= base_url('index/kategori/' . $artikel->slug_kategori); ?>"><?= $artikel->nama_kategori; ?></a></span><br>
    <?= $artikel->isi_artikel; ?>
    <div id="container">
        <h1>Komentar</h1>
        <?= $disqus; ?>
    </div>
</div>