<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('admin/index/create'); ?>" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-newspaper"></i>
        </span>
        <span class="text">Tambah Artikel</span>
    </a>
</div>
<?php

if ($this->session->flashdata('message')) {
	echo '<div class="alert alert-success">';
	echo $this->session->flashdata('message');
	echo '</div>';
}

?>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
					foreach ($artikel as $artikel) { ?>


                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $artikel->judul; ?></td>
                        <td><?= $artikel->nama_kategori; ?></td>
                        <td><?= $artikel->nama; ?></td>
                        <td>
                            <?php if ($artikel->status_artikel == 'Publish') { ?>
                            <span class="badge badge-info p-2">Publish</span>
                            <?php } else { ?>
                            <span class="badge badge-secondary p-2">Draft</span>
                            <?php } ?>
                            <!-- <?= $artikel->status_artikel; ?> -->

                        </td>
                        <td>
                            <a href="<?= base_url('admin/index/update_art/' . $artikel->id_artikel); ?> "
                                class="btn btn-success btn-sm"><i class="fas fa-user-edit"></i> Edit</a>
                            <a href='#' class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
                            <?php
								include('delete.php');
								?>
                        </td>
                    </tr>
                    <?php $i++;
					} ?>
                </tbody>
            </table>
        </div>

       
 </ div>
    </div>