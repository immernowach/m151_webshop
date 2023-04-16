<?php
    session_start();
    session_regenerate_id();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mein Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php
        include '../universal/navbar.inc.php';
    
    ?>

    <h1>Mein Profil</h1>


    <?php
        if (!isset($_SESSION['loggedin']) or !$_SESSION['loggedin']) {
            echo '<a href="login.php" class="btn btn-primary" style="margin-top: 25px; margin-right: 25px;">Login</a>';
            echo '<a href="register.php" class="btn btn-primary" style="margin-top: 25px;">Registrieren</a>';
            die();
        }
        if ($_SESSION['loggedin']) {
            echo '<a href="./myaccount.php" class="btn btn-primary" style="margin-top: 25px;">Meine Daten</a> ';
            echo '<a href="../universal/logout.inc.php" class="btn btn-primary" style="margin-top: 25px;">Logout</a>';
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>