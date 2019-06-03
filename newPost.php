<?php
        if(!session_id()){
            session_start();
        }
		$currentpage="Add Post";
		include "pages.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
    <script type = "text/javascript"  src = "verifyInput.js" > </script>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<?php
	include "header.php";
	$msg = "Add new Post";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs for security
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$category = mysqli_real_escape_string($conn, $_POST['category']);
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		$url = mysqli_real_escape_string($conn, $_POST['url']);

		//temporary hardcoded userid
		$userId = "smartboi";

        // attempt insert query
        $queryTwo = "SELECT * FROM Post";
        $resultTwo = mysqli_query($conn, $queryTwo);
        $value = mysqli_num_rows($resultTwo) + 1;
        $query = "INSERT INTO Post (postID, title, category, user_id) VALUES ('$value', '$title', '$category', '$userId')";
        $contentQ = "INSERT INTO Content (postID, picURL, text) VALUES ('$value', '$url', '$content')";
        if(mysqli_query($conn, $query) && mysqli_query($conn, $contentQ)){
            $_SESSION['currPost'] = $value;
            echo '<script>window.location.href = "viewPost.php";</script>';
        } else if (mysqli_query($conn, $query) == null && mysqli_query($conn, $contentQ)==null){

        }
        else {
            echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }
    }
    // close connection
    $contentQ = null;
    $query = null;
    mysqli_close($conn);

    ?>
    <section>
        <h2> <?php echo $msg; ?> </h2>

        <form method="post" id="addForm">
            <fieldset>
                <legend>New Post:</legend>
<p>
    <label for="title">Title:</label>
    <input type="text" class="required" name="title" id="title">
</p>
<p>
    <label for="category">Category:</label>
    <input type="text" class="required" name="category" id="category">
</p>
<p>
    <label for="url">Photo URL (optional):</label>
    <input type="text" name="url" id="url">
</p>

<p>
    <label for="content">Content:</label>
    <input type="text" class="required" name="content" id="content">
    </fieldset>

<p>
    <input type = "submit"  value = "Submit" />
    <input type = "reset"  value = "Clear Form" />
</p>
</form>
</body>
</html>



