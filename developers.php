<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My team</title>
</head>
<style>
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "Poppins", sans-serif;
	}
	body{
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 100vh;
		background: linear-gradient(#D5A3FF 0%, #77A5F8 100%);
	}
	.wrapper{
		background: lightblue;
		width: 580px;
		border-radius: 15px;
		padding: 20px;
		box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.8);
	}
	h2{
		text-align: center;
	}
	hr{
		width: 100px;
		margin: 10px auto;
	}
	.members{
		display: flex;
	}
	.team-mem{
		margin: 8px;
	}
	img{
		width: 100px;
		height: 100px;
		border-radius: 50%;
		margin: 30px;

	}
	h4, p{
		text-align: center;
		font-size: 12px;
		margin: 7px;

	}
	button{
		height: 40px;
		width: 80px;
		border: none;
		outline: none;
		font-size: 20px;
		font-weight: 600px;
	}


</style>

<body>
	
	<div class="wrapper">
		<button class="back"><a href="index.php">BACK</a></button>

		<h2>Our Team</h2>
		<hr>
		<div class="members">
			<div class="team-mem">
				<img src="img/almenic.jpg">
				<h4>Mr. Almenic Ubas</h4>
				<p>Leader</p>
			</div>
			<div class="team-mem">
				<img src="img/carla.jpg">
				<h4>Ms. Carla Jean Junio</h4>
				<p>Muse</p>
			</div>
			<div class="team-mem">
				<img src="img/janlyn.jpg">
				<h4>Ms. Janlyn Mendoza</h4>
				<p>Escort</p>
			</div>
			
		</div>

		
	</div>
</body>
</html>