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
$firstname = $lastname = $email = $username = '';

// Wurden Daten mit "POST" gesendet?
if($_SERVER['REQUEST_METHOD'] == "POST"){
  // Ausgabe des gesamten $_POST Arrays
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";

  // vorname ausgefüllt?
  if(isset($_POST['firstname'])){
    //trim and sanitize
    $firstname = trim(htmlspecialchars($_POST['firstname']));
    
    //mindestens 1 Zeichen und maximal 30 Zeichen lang
    if(empty($firstname) || strlen($firstname) > 30){
      $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
    }
  } else {
    $error.= "Geben Sie bitte einen Vornamen ein.<br />";
  }

  // nachname ausgefüllt?
  if(isset($_POST['lastname'])){
    //trim and sanitize
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    
    //mindestens 1 Zeichen und maximal 30 Zeichen lang
    if(empty($lastname) || strlen($lastname) > 30){
      $error .= "Geben Sie bitte einen korrekten Nachname ein.<br />";
    }
  } else {
    $error.= "Geben Sie bitte einen Nachname ein.<br />";
  }
  
  // email ausgefüllt?
  if(isset($_POST['email'])){
    //trim
    $email = trim($_POST['email']);
    
    //mindestens 1 Zeichen und maximal 100 Zeichen lang, gültige Emailadresse
    if(empty($email) || strlen($email) > 100 || filter_var($email, FILTER_VALIDATE_EMAIL) === false){
      $error .= "Geben Sie bitte eine korrekten Emailadresse ein.<br />";
    }
  } else {
    $error.= "Geben Sie bitte eine Emailadresse ein.<br />";
  }

  // username ausgefüllt?
  if(isset($_POST['username'])){
    //trim and sanitize
    $username = trim($_POST['username']);
    
    //mindestens 1 Zeichen , entsprich RegEX
    if(empty($username) || !preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,30}/", $username)){
      $error .= "Geben Sie bitte einen korrekten Usernamen ein.<br />";
    }
  } else {
    $error.= "Geben Sie bitte einen Username ein.<br />";
  }

  // passwort ausgefüllt
  if(isset($_POST['password'])){
    //trim and sanitize
    $password = trim($_POST['password']);

    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //mindestens 1 Zeichen , entsprich RegEX
    if(empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)){
      $error .= "Geben Sie bitte einen korrektes Password ein.<br />";
    }
  } else {
    $error.= "Geben Sie bitte ein Password ein.<br />";
  }

  // wenn kein Fehler vorhanden ist, schreiben der Daten in die Datenbank
  if(empty($error)){
    // INPUT Query erstellen, welches firstname, lastname, username, password, email in die Datenbank schreibt
    $query = "INSERT INTO users (firstname, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)";
    // Query vorbereiten mit prepare();
    $stmt = $mysqli->prepare($query);
    // Parameter an Query binden mit bind_param();
    $stmt->bind_param("sssss", $firstname, $lastname, $username, $password, $email);
    // query ausführen mit execute();
    $stmt->execute();
    // Verbindung schliessen
    $stmt->close();
    // Weiterleitung auf login.php
    $message = "Sie wurden erfolgreich registriert. Sie können sich nun einloggen.";
    header("Location: 5_login.php");
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
        <!-- vorname -->
        <div class="form-group">
          <label for="firstname">Vorname *</label>
          <input type="text" name="firstname" class="form-control" id="firstname"
            value="<?php echo $firstname ?>"
            placeholder="Geben Sie Ihren Vornamen an."
            maxlength="30"
            required="true">
        </div>
        <!-- nachname -->
        <div class="form-group">
          <label for="lastname">Nachname *</label>
          <input type="text" name="lastname" class="form-control" id="lastname"
            value="<?php echo $lastname ?>"
            placeholder="Geben Sie Ihren Nachnamen an"
            maxlength="30"
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
        <!-- benutzername -->
        <div class="form-group">
          <label for="username">Benutzername *</label>
          <input type="text" name="username" class="form-control" id="username"
            value="<?php echo $username ?>"
            placeholder="Gross- und Keinbuchstaben, min 6 Zeichen."
            pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}"
            title="Gross- und Keinbuchstaben, min 6 Zeichen."
            maxlength="30" 
            required="true">
        </div>
        <!-- password -->
        <div class="form-group">
          <label for="password">Password *</label>
          <input type="password" name="password" class="form-control" id="password"
            placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
            pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
            title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute."
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