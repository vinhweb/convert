<?php
	require('config/config.php');
	require('config/db.php');


	// Create Query
	$query = 'SELECT * FROM phone_users';

	// Get Result
	$result = mysqli_query($conn, $query);

	// Fetch Data
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
	//var_dump($posts);





	// Check For Submit
	if(isset($_POST['submit'])){
		// Get form data
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		
		$random = hexdec(substr(uniqid(),0,8)) + 10000000000000;
		foreach($posts as $post) : 
			while ($random == $post['uid']) {
				$random = hexdec(substr(uniqid(),0,8)) + 10000000000000;
			}
		endforeach; 

		$uid = mysqli_real_escape_string($conn, $random);

		$query = "INSERT INTO phone_users(phone, uid) VALUES('$phone', '$uid')";

		if(mysqli_query($conn, $query)){
			header('Location: '.ROOT_URL.'');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);


?>

<?php include('inc/header.php'); ?>
	<div class="container">
		<h1>Add Phone</h1>
		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="form-group">
				<label>Phone</label>
				<input type="number" name="phone" class="form-control">
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
<?php include('inc/footer.php'); ?>