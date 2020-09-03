<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>css/bootstrap.css">
</head>

<body>
	<div class="container">
		<?php
		function limit_words($string, $word_limit)
		{
			$words = explode(" ", $string);
			return implode(" ", array_splice($words, 0, $word_limit));
		}
		foreach ($data->result_array() as $i) :
			$id = $i['id_artikel'];
			$judul = $i['judul'];
			$image = $i['image'];
			$isi = $i['isi'];
		?>
			<div class="col-md-8 col-md-offset-2">
				<h2><?= $judul; ?></h2>
				<hr>
				<img src="<?= base_url('assets/images/' . $image); ?>" alt="image">
				<?= limit_words($isi, 30); ?><a href="<?= base_url('index/view/' . $id); ?>">Selengkapnya</a>
			</div>
		<?php endforeach; ?>
	</div>

	<script src="<?= base_url() . 'assets/jquery/jquery-3.4.1.min.js' ?>"></script>
	<script type="text/javascript" src="<?= base_url() . 'assets/js/bootstrap.js' ?>"></script>

</body>

</html>
