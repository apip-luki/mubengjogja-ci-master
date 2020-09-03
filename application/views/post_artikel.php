<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Artikel</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>css/bootstrap.css">
</head>

<body>
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<h2>Artikel</h2>
			<form action="<?= base_url('index/simpan_artikel'); ?>" method="post" enctype="multipart/form-data">
				<input type="text" name="judul" class="form-control" placeholder="Judul Artikel" required><br>
				<textarea name="isi" id="ckeditor" class="form-control"></textarea><br>
				<input type="file" name="filefoto" required><br>
				<button class="btn btn-primary btn-lg" type="submit">Post</button>
			</form>
		</div>
	</div>

	<script src="<?= base_url('assets/'); ?>jquery/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/bootstrap.js"></script>
	<script src="<?= base_url('assets/'); ?>ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		$(function() {
			CKEDITOR.replace('ckeditor');
		});
	</script>
</body>

</html>
