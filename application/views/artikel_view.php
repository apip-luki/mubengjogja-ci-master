<?php
$b = $data->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $b['judul']; ?> </title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>css/bootstrap.css">
</head>

<body>
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<h2><?= $b['judul']; ?></h2>
			<hr>
			<img src="<?= base_url('assets/images/' . $b['image']); ?>" alt="image">
			<?= $b['isi']; ?>
		</div>

	</div>

	<script src="<?= base_url('assets/'); ?>jquery/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/bootstrap.js"></script>
</body>

</html>
