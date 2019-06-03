<!DOCTYPE html>
<!-- Add Supplier Info to Table Supplier -->
<?php
		$currentpage="Ban User";
		include "pages.php";
		
?>
<html>
	<head>
		<title>Ban User</title>
		<link rel="stylesheet" href="style.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 
	</head>
<body>


<?php
	include "header.php";
	$msg = "Ban a Problematic User";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
        $userToBan = mysqli_real_escape_string($conn, $_POST['banUser']);
        $admin = "correct_time";// temporary admin
	
		
        // attempt insert query 
        $query = "SELECT BanUser('$admin', '$userToBan') AS BanUser";
        if(mysqli_query($conn, $query)){
            $msg =  "Successfully banned $userToBan.<p>";
        } else{
            echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }

}
// close connection
mysqli_close($conn);

?>
	<section>
    <h2> <?php echo $msg; ?> </h2>

<form method="post" id="addForm">
<fieldset>
    <p>
        <label for="banUser">Username to Ban:</label>
        <input type="text" class="required" name="banUser" id="banUser" title="banUser">
    </p>
</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>
