<!DOCTYPE html>
<html>
<head>
	<title>PhoneBook Application</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
	<div id="app">
		<Myheader></Myheader>

		<div class="container">
			<router-view></router-view>
		</div>

		<Myfooter></Myfooter>
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>