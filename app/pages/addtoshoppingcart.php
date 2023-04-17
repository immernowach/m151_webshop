<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Bestätigung</title>
</head>
<body>

    <?php 
        session_start();
        session_regenerate_id();
        if ($_SESSION['loggedin'] == false) {
            header('Location: ../pages/login.php');
        }
        include '../universal/dbconnector.inc.php';
    ?>

    <?php 
        if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {

        $product_id = (int)$_POST['product_id'];
        
            // Product exists in database, now we can create/update the session variable for the cart
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {

                if (array_key_exists($product_id, $_SESSION['cart'])) {
                    if (isset($_POST['quantity'])) {
                        $quantity = (int)$_POST['quantity'];
                        $_SESSION['cart'][$product_id] = $quantity;
                    } else {
                        // Product exists in cart so just update the quanity
                        $_SESSION['cart'][$product_id]++;
                    }
                } else {
                    // Product is not in cart so add it
                    $_SESSION['cart'][$product_id] = 1;
                }
            } else {
                // There are no products in cart, this will add the first product to the cart
                $_SESSION['cart'] = array($product_id => 1);
            }
            
        // Prevent form resubmission...
            header('location: addtoshoppingcart.php');
        }
    ?>

    <div style="height: 200px;"></div>

    <div class="mx-auto" style="width: 700px;">
        <div class="d-grid gap-3">
            <div class="p-2 alert alert-success" role="alert">
                Das Produkt befindet sich nun im Warenkorb.
            </div>
            <div class="p-2">
                <a href="../pages/index.php" class="btn btn-primary">Weiter Einkaufen</a>
                <a href="../pages/shopping-cart.php" class="btn btn-primary">Zum Warenkorb</a>
            </div>
        </div>
    </div>


</body>
</html>