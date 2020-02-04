<!DOCTYPE html>
<html>
<head>
	<title>Inventory login system</title>

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>


<div class="container">
	
		<div class="row">
			<div class="col-md-6">
				<h2>Login here</h2>
				<form action="process/validation.php" method="post">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<button type="submit" class="btn btn-primary"> Login here</button>
				</form>
				
			</div>
			<div class="col-md-6">
				<h2>Register here</h2>
				<form action="process/register.php" method="post">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<button type="submit" class="btn btn-primary">Register here</button>
				</form>
			</div>
		</div>	

</div>
</body>
</html>