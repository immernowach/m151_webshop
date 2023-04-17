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
        if ($_SESSION['loggedin'] == false) {
            header('Location: ../pages/login.php');
        }

        if(isset($_POST['product_id'])) {
            if($_SESSION['cart'][$_POST['product_id']] > 1) {
                $_SESSION['cart'][$_POST['product_id']]--;
            } else {
                unset($_SESSION['cart'][$_POST['product_id']]);
            }
        }

        header('Location: ../pages/shopping-cart.php');
    ?>    
</body>
</html>