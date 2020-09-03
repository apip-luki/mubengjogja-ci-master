<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('admin/user/create'); ?>" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-user-plus"></i>
        </span>
        <span class="text">Tambah User</span>
    </a>
</div>
<?php
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($user as $user) { ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $user->nama; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><?= $user->role; ?></td>
                        <td>
                            <?php if ($user->status == 1) { ?>
                            <span class="badge badge-info p-2">Aktif</span>
                            <?php } else {; ?>
                            <span class="badge badge-secondary p-2">Nonactive</span>
                            <?php }; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/user/update/' . $user->id_user); ?> "
                                class="btn btn-success btn-sm"><i class="fas fa-user-edit"></i> Edit</a>
                            <?php include "delete.php"; ?>
                        </td>
                    </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>