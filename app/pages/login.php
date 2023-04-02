<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php 
        include '../universal/navbar.inc.php';
        include('../universal/dbconnector.inc.php');

        $error = '';
        $message = '';
        $email = $password = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(isset($_POST['email'])){
            $email = trim($_POST['email']);
        } else {
            $error .= "Geben Sie bitte ihre E-Mail Adresse an.<br />";
        }
        if(isset($_POST['password'])){
            $password = trim($_POST['password']);
        } else {
            $error .= "Geben Sie bitte das Passwort an.<br />";
        }
        
        if(empty($error)){
            $query = "SELECT password FROM users WHERE email = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result=$stmt->get_result();
    
            if($result->num_rows == false){
                $error .= "E-Mail Adresse oder Passwort sind falsch";
            }
    
            while($row = $result->fetch_assoc()){
                $passwordfromdb = $row["password"];
    
                if (password_verify($password, $passwordfromdb)) {
                    $message .= "Sie sind nun eingeloggt";
                    session_start();
                    $_SESSION['loggedin'] = true;
                    header("Location: ./index.php");
                } else {
                    $error .= "E-Mail Adresse oder Passwort sind falsch";
                }
            }
    
            $result->free();
            $stmt->close();
        }
    }

    ?>
    <div class="container">
        <h1>Login</h1>
        <p>
            Bitte melden Sie sich mit Ihrer E-Mail Adresse und Passwort an.
        </p>
        <?php
            if(!empty($message)){
                echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
            } else if(!empty($error)){
                echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
            }
        ?>
        <form action="" method="POST">
            <!-- email -->
            <div class="form-group" style="margin-top: 25px;">
                <label for="email">E-Mail-Adresse *</label>
                <input type="text" name="email" class="form-control" id="email"
                    value=""
                    placeholder="Email hier eingeben"
                    title="E-Mail-Adresse"
                    maxlength="30" 
                    required="true">
            </div>
            <!-- password -->
            <div class="form-group" style="margin-top: 25px;">
                <label for="password">Password *</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="Passwort hier eingeben"
                    maxlength="255"
                    required="true">
            </div>
            <button type="submit" name="button" value="submit" class="btn btn-primary" style="margin-top: 25px; margin-right: 25px;">Senden</button>
            <button type="reset" name="button" value="reset" class="btn btn-warning" style="margin-top: 25px;">Löschen</button>
        </form>
        <a href="./register.php" class="btn btn-primary" style="margin-top: 25px;">Kein Account? Registrieren</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
