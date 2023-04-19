<?php 
    session_start();
    session_regenerate_id();
    if ($_SESSION['loggedin'] == false) {
        header('Location: ../pages/login.php');
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warenkorb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php 
        include '../universal/navbar.inc.php'; 
        include '../universal/dbconnector.inc.php';
    ?>

    <h1>Warenkorb</h1>

    <div style="height: 50px;"></div>

    <div class="mx-auto" style="width: 700px;">     

    <?php 
        if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $absolute_total = 0;
            foreach($_SESSION['cart'] as $product_id => $quantity) {

                // get the product name and price from the database
                $result = $mysqli->query("SELECT name, price FROM products WHERE id = $product_id");
                $obj = $result->fetch_object();

                $subtotal = $obj->price * $quantity;
                $absolute_total = $absolute_total + $subtotal;

                echo '<h3>' . $obj->name . '</h3>';
                echo '<b>Menge: </b>' . $quantity . ' Stück' . '<br>';
                echo '<b> Preis: </b>' . $subtotal . ' CHF';

                echo '<form action="../universal/removefromcart.inc.php" method="post">';
                echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                echo '<button type="submit" class="btn btn-sm btn-danger">Entfernen</button>';
                echo '</form>';
                echo '<br>';
            }
            echo '<br><b>Gesamtpreis: ' . $absolute_total . ' CHF</b>';
        } else {
            echo 'Warenkorb ist leer';
        }
    ?>

    </div>

    <form action="./successfullyordered.php" method="post">
        <button type="submit" class="btn btn-primary">Bestellen</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>