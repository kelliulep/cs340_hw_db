<header>

    <div class="header">
        <a class="left" onclick="backfunc()" style="margin-left='12'"> Back </a>
        <a href='Home.php' class="left" style="margin-left='12'">Home</a>

        <h1 style="text-align:center; display:inline-block;">CheggButFree.com</h1>

        <div class="header-right">
            <a href='UserAccount.php' class="right"> Account </a>
            <a href='Favorites.php' class="right"> Favorites </a>
            <a href='Login.php' class="right"> Login </a>
            <!-- <div class='hide'>
                <a href='AdminAccount.php' style='display:none;'> AdminAccount </a>
            </div> -->

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
    </script>

</header>