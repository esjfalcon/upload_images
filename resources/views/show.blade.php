<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

</head>
<body>
	<div></div>

	<div>
		<a href="/"><i class="fas fa-home"></i></a>
		<h1>Your all images</h1>
		<form method="POST" action="/get">
		@foreach($images as $image)
			<img src="{{ asset('image/'.$image['path']) }}" style="height: 100px; width: 100px;">
			
				{{ csrf_field() }}
				<input type="checkbox" name="path[]" value="{{$image['id']}}">
		@endforeach
		<button type="submit" id="checkBtn" class="btn btn-primary">download</button>
			</form>
	</div>

	<!-- <div>
		<label>demande</label>
		<select name="demande_id">
			@foreach($demandes as $demande)
				<option value="{{ $demande->id }}">{{ $demande->id }}</option>
			@endforeach
		</select>
	</div> -->

	<div style="margin-top: 50px;">
		<h2>Your demandes</h2>
		<div style="margin-left: 50px;">
			@foreach($demandes as $demande)
		<h4> Demande No : {{ $demande->id }}</h4>
			<ul>
				<form method="POST" action="/get">
					@foreach($demande->images as $image)
						<img src="{{ asset('image/'.$image['path']) }}" style="height: 100px; width: 100px;">
						{{ csrf_field() }}
						<input type="checkbox" name="path[]" value="{{$image['id']}}">
					@endforeach
						<button type="submit" id="checkBtn" class="btn btn-primary">download</button>
				</form>
			</ul>
		@endforeach
		</div>
	</div>

	<script src="https://kit.fontawesome.com/c0b336cd5f.js" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).ready(function () {
			    $('#checkBtn').click(function() {
			      checked = $("input[type=checkbox]:checked").length;

			      if(!checked) {
			        alert("You must check at least one checkbox.");
			        return false;
			      }

			    });
			});
	</script>
</body>
</html>