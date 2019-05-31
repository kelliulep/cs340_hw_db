<header> 
    <div class="header">
        <a class="left" onclick="backfunc()" style="margin-left='12'"> Back </a>
        <a href='Home.php' class="left" style="margin-left='12'">Home</a>

        <h1 style="text-align:center; display:inline-block;">CheggButFree.com</h1>

        <div class="header-right">
            <a href='Favorites.php' class="right"> Favorites </a>
            <a onclick="loginfunc()" class="right"> Login </a>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..</p>
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