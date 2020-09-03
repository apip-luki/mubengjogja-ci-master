<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center h-100">
            <div class="col-xl-6 my-auto">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Admin Login!</h1>
                            </div>
                            <?php
                            if ($this->session->flashdata('message')) {
                                echo '<div class="alert alert-danger text-center">';
                                echo $this->session->flashdata('message');
                                echo '</div>';
                            } elseif ($this->session->flashdata('logout')) {
                                echo '<div class="alert alert-success text-center">';
                                echo $this->session->flashdata('logout');
                                echo '</div>';
                            }
                            $attributes = array('class' => 'user');
                            echo form_open('auth', $attributes)
                            ?>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email"
                                    placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<span class="text-danger">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password"
                                    placeholder="Password" value="<?= set_value('password'); ?>">
                                <?= form_error('password', '<span class="text-danger">', '</span>'); ?>
                            </div>

                            <button class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                            <?= form_close() ?>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>