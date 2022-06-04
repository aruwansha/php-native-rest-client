<?php
if (!isset($_SESSION['token'])) { ?>
    <div class="card-main">
        <div class="card-header">Form Login</div>
        <div class="card-body">
            <form class="form-login" method="POST" action="actions/login.php">
                <label class="form-label" for="email">Email:</label><br>
                <input class="form-control" type="text" id="email" name="email"><br>
                <label class="form-label" for="password">Password:</label><br>
                <input class="form-control" type="password" id="password" name="password"><br><br>
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </div>
    </div>
<?php } else {
    header("location:  " . BASE_URL  . "?menu=home");
} ?>