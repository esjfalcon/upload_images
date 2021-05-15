<!DOCTYPE html>
<html>
<head>
	<title>select_images</title>	
	<style type="text/css">
		.container{
			width: 150px;
			height: 300px;
			text-align: center;
			margin: 100px auto;

		}
		button{
			width: 150px;
			height: 40px;
			background-color: black;
			color: white;
			border-radius: 12px;
			cursor: pointer;
			margin-top: 50px;
		}
		input{
			color: black;
		}
	</style>
</head>
<body>

	<div style="position: absolute; margin-top: -80px; margin-left: -400"><a href="/"><i class="fas fa-home"></i></a></div>
	<div class="container">
		<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/store">

			{{ csrf_field() }}
			<input required type="file" class="form-control" name="image[]" multiple="multiple">
			<button type="submit">Upload</button>
		</form>
	</div>
	<script src="https://kit.fontawesome.com/c0b336cd5f.js" crossorigin="anonymous"></script>
</body>
</html>