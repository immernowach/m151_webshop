<?php
if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {

    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    
    $_SESSION['shopping_cart'][$product_id] = $product_id;

} 
?>

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