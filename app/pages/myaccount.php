<?php
    session_start();
    session_regenerate_id();
    if ($_SESSION['loggedin'] == false) {
        header('Location: ../pages/login.php');
    }

    include('../universal/dbconnector.inc.php');
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Meine Daten</title>
</head>
<body>
    <?php 
    
    include('../universal/navbar.inc.php');

    $abc = mysqli_stmt_init($mysqli);

    mysqli_stmt_prepare($abc, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($abc, 's', $_SESSION['email']);
    mysqli_stmt_execute($abc);
    $result = mysqli_stmt_get_result($abc);
    if ($row = mysqli_fetch_assoc($result)) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }


    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(isset($_POST['firstname'])){
          $firstname = trim($_POST['firstname']);

          if(empty($firstname) || strlen($firstname) > 100){
            $error .= "Geben Sie bitte ein validen Vornamen ein.<br>";
          }
        } else {
          $error.= "Geben Sie bitte ein validen Vornamen ein.<br>";
        }

        if(isset($_POST['lastname'])){
          $lastname = trim($_POST['lastname']);

          if(empty($firstname) || strlen($firstname) > 100) {
            $error .= "Geben Sie bitte ein validen Nachnamen ein.<br>";
          }
        } else {
          $error.= "Geben Sie bitte ein validen Nachnamen ein.<br>";
        }

        
        if(empty($error)) { 

        $stmt = mysqli_stmt_init($mysqli);
        if (!mysqli_stmt_prepare($stmt, "UPDATE users SET firstname = ?, lastname = ? WHERE email = ?")) {
            header('Location: ../pages/myaccount.php?error=sqlerror');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'sss', $firstname, $lastname, $_SESSION['email']);
            mysqli_stmt_execute($stmt);
            $_SESSION['email'] = $email;

            session_start();
            session_regenerate_id();

            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;

            header('Location: ../pages/account.php');
            exit();
        }
    }

    }

    ?>

    <h1>Meine Daten</h1>

    <div class="container">
        <form action="#" method="post">
            <!-- firstname -->
            <div class="form-group" style="margin-top: 25px;">
            <label for="firstname">Vorname *</label>
            <input type="text" name="firstname" class="form-control" id="firstname"
                value="<?php echo $_SESSION['firstname']; ?>"
                maxlength="100"
                required>
            </div>
            <!-- lastname -->
            <div class="form-group" style="margin-top: 25px;">
            <label for="lastname">Nachname *</label>
            <input type="text" name="lastname" class="form-control" id="lastname"
                value="<?php echo $_SESSION['lastname'] ?>"
                maxlength="100"
                required>
            </div>
            <button type="submit" name="button" value="submit" class="btn btn-primary" style="margin-top: 25px; margin-right: 25px;">Speichern</button>
        </form>
    </div>

</body>
</html>