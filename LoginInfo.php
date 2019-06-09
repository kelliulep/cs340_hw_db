<?php 
	session_start(); 

	include 'connectvars.php'; 
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<script type = "text/javascript"  src = "verifyInput.js" > </script>
		<link rel="stylesheet" href="style.css">
	</head>
<body>


<?php 
	
	include 'header.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Escape user inputs for security
		$UserID = mysqli_real_escape_string($conn, $_POST['UserID']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		// See if sid is already in the table
		$queryIn = "SELECT * FROM Users where UserID='$UserID' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a supplier with sid $UserID<p>";
		} else {

		// attempt insert query 
			$query = "INSERT INTO Users (UserID, password) VALUES ('$UserID', '$password')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
			}
		}
	}

?>

<section>
    <h2> <?php echo $msg; ?> </h2>

<form method="post" id="addForm">
	<fieldset>
		<legend>Register User:</legend>
		<p>
			<label for="UserID">User Name:</label>
			<input type="text" class="required" name="UserID" id="UserID" title="sid should be numeric">
		</p>
		<p>
			<label for="password">Password:</label>
			<input type="text" class="required" name="password" id="password">
		</p>
		<p>
			<label for="password">Confirm Password:</label>
			<input type="text" class="required" name="password" id="password">
		</p>
	</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>

</body>

</html>
