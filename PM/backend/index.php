<?php

	require_once('../run.php');
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Insert</title>
	</head>
	<body>
	
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<form action="process/insert.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<h1>Insert product name: </h1>
							<input type="text" class="form-control" name="pname">
						</div>
						<div class="form-group">
							<h1>Insert product price: </h1>
							<input type="text" class="form-control" name="pprice">
						</div>
						<div class="form-group">
							<h1>Time to bake: </h1>
							<input type="text" class="form-control" name="pdate">
						</div>
						<div class="form-group">
							<h1>Description: </h1>
							<input type="text" class="form-control" name="pdescription">
						</div>
						<div class="form-group">
							
							 <span>Upload Image</span><br>
							 <input type="file" class="file" name="images">
							 <input type="file" class="file" name="images2">
						
						</div>
						

						<button class="btn btn-primary" name="addP">Add Product</button>
					</form>
				</div>
			</div>
			
		</div>



			

		</form>
	</body>
	</html>