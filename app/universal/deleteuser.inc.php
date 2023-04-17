<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Element entfernen</title>
</head>
<body>
    <?php 
        session_start();
        session_regenerate_id();

        include '../universal/dbconnector.inc.php';

        if ($_SESSION['loggedin'] == false) {
            header('Location: ../pages/login.php');
        }

        $stmt = mysqli_stmt_init($mysqli);
if (!mysqli_stmt_prepare($stmt, "DELETE from users WHERE email = ?")) {
    header('Location: ../pages/myaccount.php?error=sqlerror');
    exit();
} else {
    mysqli_stmt_bind_param($stmt, 's', $_SESSION['email']);
    mysqli_stmt_execute($stmt);
    $_SESSION['email'] = $email;
}
        

        $_SESSION = array();
session_destroy();

header('Location: ../pages/index.php');
exit();
    ?>    
</body>
</html>