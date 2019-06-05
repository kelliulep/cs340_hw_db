
<header>

    <div class="header">
        <a class="left" onclick="backfunc()" style="margin-left='12'"> Back </a>
        <a href='Home.php' class="left" style="margin-left='12'">Home</a>

        <h1 style="text-align:center; display:inline-block;">CheggButFree.com</h1>

        <div class="header-right">
            <a href='UserAccount.php' class="right"> Account </a>
            <a href='Favorites.php' class="right"> Favorites </a>
            <a onclick="loginfunc()" class="right"> Login </a>
            <!-- <div class='hide'>
                <a href='AdminAccount.php' style='display:none;'> AdminAccount </a>
            </div> -->

        </div>
    </div>
    <h2> <?php echo $msg; ?> </h2>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2> <?php echo $msg; ?> </h2>

            <form method="login" id="addForm">
	            <fieldset>
                <label for="UserID" style="color:white;"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="UserID" required>

                <label for="password" style="color:white;"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                </fieldset>
                    
                <p>
                <input type = "submit"  value = "Submit" />
                <input type = "reset"  value = "Clear Form" />
                </p>
            </form>

        </div>
    </div>


    <script>
        function backfunc() {
            window.history.back();
        }

        function loginfunc() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }
        function loginsuc() {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        var span = document.getElementsByClassName("close")[0];
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</header>