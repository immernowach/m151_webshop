<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <?php 
        include '../universal/header.inc.php'; 
        include '../universal/dbconnector.inc.php';

        // Initialisierung
        $error = $message =  '';
        $firstname = $lastname = $email = $password ='';

        if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(isset($_POST['firstname'])){
          $firstname = trim($_POST['firstname']);

          if(empty($firstname) || strlen($firstname) > 100){
            $error .= "Geben Sie bitte ein validen Vornamen ein.<br />";
          }
        } else {
          $error.= "Geben Sie bitte ein validen Vornamen ein.<br />";
        }

        if(isset($_POST['lastname'])){
          $lastname = trim($_POST['lastname']);

          if(empty($firstname) || strlen($firstname) > 100) {
            $error .= "Geben Sie bitte ein validen Nachnamen ein.<br />";
          }
        } else {
          $error.= "Geben Sie bitte ein validen Nachnamen ein.<br />";
        }

        if(isset($_POST['email'])){
          $email = trim($_POST['email']);

          if(empty($email) || strlen($email) > 100 || filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $error .= "Geben Sie bitte eine korrekte Emailadresse ein.<br />";
          }
        } else {
          $error.= "Geben Sie bitte eine Emailadresse ein.<br />";
        }

        if(isset($_POST['password'])){
          $password = trim($_POST['password']); //trim and sanitize
          $password = password_hash($password, PASSWORD_DEFAULT);

          if(empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)){
            $error .= "Geben Sie bitte einen korrektes Password ein.<br />";
          }
        } else {
          $error.= "Geben Sie bitte ein Password ein.<br />";
        }
        
        if(empty($error)) { // TODO check if email already exists, TODO insert firstname and lastname
          $query = "INSERT INTO users (firstname, lastname, password, email) VALUES (?, ?, ?, ?)";
          $stmt = $mysqli->prepare($query);
          $stmt->bind_param("ssss", $firstname, $lastname, $password, $email);
          $stmt->execute();
          $stmt->close();
          $message = "Sie wurden erfolgreich registriert.";
          header('Location: account.php');
        }
      }
    ?>

    <h1>Registrierung</h1>

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
          echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        }
      ?>
      <form action="" method="post">
        <!-- firstname -->
        <div class="form-group">
          <label for="firstname">Vorname *</label>
          <input type="text" name="firstname" class="form-control" id="firstname"
            value="<?php echo $firstname ?>"
            placeholder="Geben Sie Ihren Vornamen an."
            maxlength="100"
            required="true">
        </div>
        <!-- lastname -->
        <div class="form-group">
          <label for="lastname">Nachname *</label>
          <input type="text" name="lastname" class="form-control" id="lastname"
            value="<?php echo $lastname ?>"
            placeholder="Geben Sie Ihren Nachnamen an."
            maxlength="100"
            required="true">
        </div>
        <!-- email -->
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" name="email" class="form-control" id="email"
            value="<?php echo $email ?>"
            placeholder="Geben Sie Ihre Email-Adresse an."
            maxlength="100"
            required="true">
        </div>
        <!-- password -->
        <div class="form-group">
          <label for="password">Password *</label>
          <input type="password" name="password" class="form-control" id="password"
            placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
            pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
            title="Mindestens einen Gross-/und einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang, keine Umlaute."
            maxlength="255"
            required="true">
        </div>
        <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>