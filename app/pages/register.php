<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php 
        include '../universal/navbar.inc.php'; 
        include '../universal/dbconnector.inc.php';

        $error = $message =  '';
        $firstname = $lastname = $email = $password ='';

        if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(isset($_POST['firstname'])){
          $firstname = htmlspecialchars(trim($_POST['firstname']));

          if(empty($firstname) || strlen($firstname) > 100){
            $error .= "Geben Sie bitte ein validen Vornamen ein.<br>";
          }
        } else {
          $error.= "Geben Sie bitte ein validen Vornamen ein.<br>";
        }

        if(isset($_POST['lastname'])){
          $lastname = htmlspecialchars(trim($_POST['lastname']));

          if(empty($firstname) || strlen($firstname) > 100) {
            $error .= "Geben Sie bitte ein validen Nachnamen ein.<br>";
          }
        } else {
          $error.= "Geben Sie bitte ein validen Nachnamen ein.<br>";
        }

        if(isset($_POST['email'])){
          $email = htmlspecialchars(trim($_POST['email']));

          if(empty($email) || strlen($email) > 100 || filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $error .= "Geben Sie bitte eine korrekte Emailadresse ein.<br>";
          }
        } else {
          $error.= "Geben Sie bitte eine Emailadresse ein.<br>";
        }

        if(isset($_POST['password'])){
          $password = trim($_POST['password']); //trim and sanitize
          $password = password_hash($password, PASSWORD_DEFAULT);

          if(empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)){
            $error .= "Geben Sie bitte einen korrektes Password ein.<br>";
          }
        } else {
          $error.= "Geben Sie bitte ein Password ein.<br>";
        }

        if(isset($_POST['email'])){
          $query = "SELECT * FROM users WHERE email = ?";
          $stmt = $mysqli->prepare($query);
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();
          $stmt->close();

          if($result->num_rows > 0){
            $error .= "Diese Emailadresse wurde bereits registriert.<br>";
          }
        }
        
        if(empty($error)) {
          $query = "INSERT INTO users (firstname, lastname, password, email) VALUES (?, ?, ?, ?)";
          $stmt = $mysqli->prepare($query);
          $stmt->bind_param("ssss", $firstname, $lastname, $password, $email);
          $stmt->execute();
          $stmt->close();
          $message = "Sie wurden erfolgreich registriert.";
          header('Location: login.php');
        }
      }
    ?>
    <div class="container">
      <h1>Registrierung</h1>
      <p>
        Bitte registrieren Sie sich, damit Sie diesen Dienst benutzen können. 
      </p>
      <?php
        // Ausgabe der Fehlermeldungen
        if(!empty($error)){
          echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        } else if (!empty($message)){
          echo '<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>';
        }
      ?>
      <form action="" method="post">
        <!-- firstname -->
        <div class="form-group" style="margin-top: 25px;">
          <label for="firstname">Vorname *</label>
          <input type="text" name="firstname" class="form-control" id="firstname"
            value="<?php echo $firstname ?>"
            placeholder="Geben Sie Ihren Vornamen an."
            maxlength="100"
            required>
        </div>
        <!-- lastname -->
        <div class="form-group" style="margin-top: 25px;">
          <label for="lastname">Nachname *</label>
          <input type="text" name="lastname" class="form-control" id="lastname"
            value="<?php echo $lastname ?>"
            placeholder="Geben Sie Ihren Nachnamen an."
            maxlength="100"
            required>
        </div>
        <!-- email -->
        <div class="form-group" style="margin-top: 25px;">
          <label for="email">Email *</label>
          <input type="email" name="email" class="form-control" id="email"
            value="<?php echo $email ?>"
            placeholder="Geben Sie Ihre Email-Adresse an."
            maxlength="100"
            required>
        </div>
        <!-- password -->
        <div class="form-group" style="margin-top: 25px;">
          <label for="password">Password *</label>
          <input type="password" name="password" class="form-control" id="password"
            placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
            pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
            title="Mindestens einen Gross-/und einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang, keine Umlaute."
            maxlength="255"
            required>
        </div>
        <button type="submit" name="button" value="submit" class="btn btn-primary" style="margin-top: 25px; margin-right: 25px;">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning" style="margin-top: 25px;">Löschen</button>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>