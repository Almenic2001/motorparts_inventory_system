<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<title>Registration</title>
</head>

<style>
body{
	padding: 50px;
	background-color: lightgray;
}
.container{
	
	max-width: 400px;
    margin: 30px auto;
    background-color: lightgray;
    padding: 60px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
	
}
.form-group{
	margin-bottom: 30px;
}



</style>
<body>
	<div class="container">
		<?php
		if (isset($_POST["submit"])){
			$fullName = $_POST["fullname"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$confirmPassword = $_POST["confirm_password"];

			$passwordHash = password_hash($password, PASSWORD_DEFAULT);

			$errors = array();


			if (empty($fullName) OR empty ($email) OR empty($password) OR empty($confirmPassword)) {
				array_push($errors, "All fields are required");
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, "Email is not valid");
			}
			if (strlen($password) < 8) {
				array_push($errors, "Password must be at least 8 characters long");
			}
			if ($password!==$confirmPassword) {
				array_push($errors, "Password does not match");
			}
			require_once "database.php";
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			$rowCount = mysqli_num_rows($result);
			if($rowCount > 0) {
				array_push($errors, "Email already exist");
			}
			if (count($errors) > 0) {
				foreach ($errors as $error) {
					echo "<div class = 'alert alert-danger'>$error</div>";
				}
			}else{
				$sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				$preapareStmt = mysqli_stmt_prepare($stmt, $sql);
				if ($preapareStmt){
					mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
					mysqli_stmt_execute($stmt);
					echo "<div class = 'alert alert-success'>You are registered successfully.</div>";
				}else{
					die("Something went wrong");
				}


			}


		}

		?>

	<form  action="registration.php" method="post">


		<div class="form-group">
			<input type="text" class="form-control" name= "fullname" placeholder="Full Name">
			<div class="form_input-error-message"></div>
		</div>

		<div class="form-group">
			<input type="text" class="form-control" name= "email" placeholder="Email">
		</div>


		<div class="form-group">
			<input type="text" class="form-control" name= "password" placeholder="Password">
		</div>


		<div class="form-group">
			<input type="text" class="form-control" name= "confirm_password" placeholder="Confirm Password">
		</div>

			<input type="submit" class="btn btn-primary" value="Register" name="submit">
		</form><br>
		<div>
			<div><p>Already Registered <a href="login.php">Login Here</a></p></div>
		</div>
	</div>

</body>

</html>