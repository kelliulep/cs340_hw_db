<?php
        if(!session_id()){
            session_start();
        }
		$currentpage="View Post";
		include "pages.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Post</title>
    <script type = "text/javascript"  src = "verifyInput.js" > </script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        if(isset($_GET['post'])){
            $_SESSION['currPost'] = $_GET['post'];
        }
        $pid = $_SESSION['currPost'];

        // change the value of $dbuser and $dbpass to your username and password
	    include 'connectvars.php';
	    include 'header.php';

	    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	    if (!$conn) {
		    die('Could not connect: ' . mysql_error());
	    }

        // query to select all information from supplier table
	    $query = "SELECT * FROM Post WHERE postID = '$pid'";

        // Get results from query
	    $result = mysqli_query($conn, $query);
	    if (!$result) {
		    die("Query to show fields from table failed: mysqli_error($conn)");
	    }
        // get number of columns in table
	    $fields_num = mysqli_num_fields($result);
	    echo "<h1>Post:</h1>";
        echo "<table id='t02' border='1'><tr>";

        // printing table headers
        for($i=0; $i<$fields_num; $i++) {
            $field = mysqli_fetch_field($result);
            echo "<td><b>$field->name</b></td>";
        }
        echo "</tr>\n";
        while($row = mysqli_fetch_row($result)) {
            echo "<tr>";
            // $row is array... foreach( .. ) puts every element
            // of $row to $cell variable
            foreach($row as $cell)
            echo "<td>$cell</td>";
            echo "</tr>\n";
        }

        // query to select all information from supplier table
        $queryContent = "SELECT * FROM Content WHERE postID = '$pid'";

        // Get results from query
        $resultContent = mysqli_query($conn, $queryContent);
        if (!$resultContent) {
            die("Query to show fields from table failed: mysqli_error($conn)");
        }
        // get number of columns in table
        $fieldsContent = mysqli_num_fields($resultContent);
        echo "<table id='t03' border='1'><tr>";

        // printing table headers
        for($i=0; $i<$fieldsContent; $i++) {
            $fieldHeader = mysqli_fetch_field($resultContent);
            echo "<td><b>$fieldHeader->name</b></td>";
        }
        echo "</tr>\n";
        while($row = mysqli_fetch_row($resultContent)) {
        echo "<tr>";
            // $row is array... foreach( .. ) puts every element
            // of $row to $cell variable
            foreach($row as $cell)
            echo "<td>$cell</td>";
            echo "</tr>\n";
        }

        // query to select all information from supplier table
        $queryReply = "SELECT * FROM Replies WHERE postID = '$pid'";

        // Get results from query
        $resultReply = mysqli_query($conn, $queryReply);
        if (!$resultReply) {
            die("Query to show fields from table failed: mysqli_error($conn)");
        }
        // get number of columns in table
        $fieldsReply = mysqli_num_fields($resultReply);
        echo "<table id='t02' border='1'><tr>";

        // printing table headers
        for($i=0; $i<$fieldsReply; $i++) {
            $fieldHeader = mysqli_fetch_field($resultReply);
            echo "<td><b>$fieldHeader->name</b></td>";
        }
        echo "</tr>\n";
        while($row = mysqli_fetch_row($resultReply)) {
            echo "<tr>";
            // $row is array... foreach( .. ) puts every element
            // of $row to $cell variable
            foreach($row as $cell)
            echo nl2br("<td>$cell</td>");
            echo "</tr>\n";
        }
        mysqli_free_result($resultContent);
        mysqli_free_result($resultReply);
        mysqli_free_result($result);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Escape user inputs for security
                    $reply = mysqli_real_escape_string($conn, $_POST['reply']);
                    $idQ = "SELECT * FROM Replies WHERE postID = '$pid'";
                    $idQResponse = mysqli_query($conn, $idQResponse);
                    $id = mysqli_num_fields($idQResponse);

                    //temporary hardcoded userid
                    $userId = "smartboi";

                    $query = "INSERT INTO Replies (replyID, textContent, postId, user_id) VALUES ('$id', '$reply', '$pid', '$userId')";
                    if(mysqli_query($conn, $query)){
                        echo '<script>window.location.href = "viewPost.php";</script>';
                    } else if (mysqli_query($conn, $query) == null){
                        echo "ERROR: Could not able to execute: " . mysqli_error($conn);
                    }
                }
                $idQ = null;
                $query = null;
        mysqli_close($conn);
    ?>
                <section>
                <form method="post" id="addForm">
                    <fieldset>
                        <p>
                            <label for="reply">Reply:</label>
                            <input type="text" class="required" name="reply" id="reply">
                        </p>
                    </fieldset>
                    <p>
                        <input id="submitReply" type = "submit"  value = "Submit" />
                    </p>
                </form>
</body>
</html>


