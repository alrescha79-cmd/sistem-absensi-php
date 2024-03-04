<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style type="text/css">
		body{
			background-color: rgba(50, 255, 255, 0.15);
		}
	</style>
</head>
<body>
	<div class="wrapper">
	<div class="container">
		
		
		<form class="form">
			<h1>Selamat Datang Admin</h1>
			<input type="text" placeholder="Username">
			<input type="password" placeholder="Password">
			<div class="submit" id="login-button">
        		<a href="masuk.php"><button type="submit" class="btn btn-success btn-md " >LOGIN </button></a>
    		</div>
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
	<script type="text/javascript">
		$("#login-button").click(function(event) {
	event.preventDefault();

	$("form").fadeOut(500);
	$(".wrapper").addClass("form-success");
});
	</script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</div>
</body>
</html>