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

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
	<div class="container">
		<h1>Unique ID</h1>
		<table class="table">
	    <thead>
	      <tr>
	        <th>Phone</th>
	        <th>Uid</th>
	      </tr>
	    </thead>
	    <tbody>
			<?php foreach($posts as $post) : ?>
		      <tr>
		        <td><?php echo $post['phone']; ?></td>
		        <td><?php echo $post['uid']; ?></td>
		      </tr>
			<?php endforeach; ?>
	    </tbody>
	  </table>
	</div>
<?php include('inc/footer.php'); ?>