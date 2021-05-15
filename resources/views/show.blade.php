
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div></div>

	<div>
		<a href="/"><i class="fas fa-home"></i></a>
		<h1>images</h1>
		@foreach($images as $image)
		<img src="{{ asset('image/'.$image['path']) }}" style="height: 100px; width: 100px;">
		@endforeach
	</div>
	<script src="https://kit.fontawesome.com/c0b336cd5f.js" crossorigin="anonymous"></script>
</body>
</html>