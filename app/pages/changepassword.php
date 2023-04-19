<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passwort</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php 
        session_start();
        session_regenerate_id();
        if ($_SESSION['loggedin'] == false) {
            header('Location: ../pages/login.php');
        }

        include '../universal/navbar.inc.php';
        include('../universal/dbconnector.inc.php');


        $error = '';
        $message = '';
        $email = $password = $repeatnewpassword = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // get data from form
            $email = $_SESSION['email'];

            // check if the data is recieved
            if(isset($_POST['password']) && isset($_POST['newpassword']) && isset($_POST['repeatnewpassword'])){
                $password = htmlspecialchars($_POST['password']);
                $newpassword = htmlspecialchars($_POST['newpassword']);
                $repeatnewpassword = htmlspecialchars($_POST['repeatnewpassword']);
            } else {
                $error = 'Füllen Sie bitte alle Felder aus.';
            }

            // check if the newpassword and the repeatnewpassword are the same
            if($newpassword != $repeatnewpassword){
                $error = 'Die Passwörter stimmen nicht überein.';
            }

            // check if the old password is correct
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($mysqli, $sql);
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){
                // check if the new password is valid
                if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/', $newpassword)){
                    // hash the new password
                    $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);

                    // update the password in the database
                    $sql = "UPDATE users SET password = '$newpassword' WHERE email = '$email'";
                    $result = mysqli_query($mysqli, $sql);

                    if($result){
                        $message = 'Ihr Passwort wurde erfolgreich geändert.';
                    } else {
                        $error = 'Es ist ein Fehler aufgetreten.';
                    }
                } else {
                    $error = 'Das neue Passwort ist nicht gültig.';
                }
            } else {
                $error = 'Das alte Passwort ist nicht korrekt.';
            }
        }

    ?>
    <div class="container">
        <h1>Passwort ändern</h1>
        <p>
            Ihr neues Passwort benötigt mindestens 8 Zeichen, einen Großbuchstaben, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen.
        </p>
        <?php
            if(!empty($message)){
                echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
            } else if(!empty($error)){
                echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
            }
        ?>
        <form action="#" method="POST">
            <!-- password -->
            <div class="form-group" style="margin-top: 25px;">
                <label for="password">Aktuelles Password *</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="Aktuelles Passwort hier eingeben"
                    maxlength="255"
                    required>
            </div>
            <!-- new password -->
            <div class="form-group" style="margin-top: 25px;">
                <label for="newpassword">Neues Password *</label>
                <input type="password" name="newpassword" class="form-control" id="newpassword"
                    placeholder="Neues Passwort hier eingeben"
                    maxlength="255"
                    required>
            </div>
            <!-- repeat new password -->
            <div class="form-group" style="margin-top: 25px;">
                <label for="repeatnewpassword">Neues Password wiederholen *</label>
                <input type="password" name="repeatnewpassword" class="form-control" id="repeatnewpassword"
                    placeholder="Neues Passwort hier erneut eingeben"
                    maxlength="255"
                    required>
            </div>
            <button type="submit" name="button" value="submit" class="btn btn-primary" style="margin-top: 25px; margin-right: 25px;">Passwort ändern</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
