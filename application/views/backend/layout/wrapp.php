<?php
$this->cek_login->cek();
$data = $this->user_model->get_all();
require_once('head.php');
require_once('sidebar.php');
require_once('header.php');
require_once('content.php');
require_once('footer.php');