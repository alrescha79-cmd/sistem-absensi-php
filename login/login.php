<!DOCTYPE html>
<html lang="en">
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<style type="text/css">
		body{
			background-color: rgba(50, 255, 255, 0.15);
		}
	</style>
</head>
<body>
	<div class="wrapper">
	<div class="container">

		<form class="form" action="../login.php" method="post">
			<h1>SELAMAT DATANG </h1>
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button type="submit" name="submit" id="login-button">Login</button>
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
