<?php
session_start();
session_regenerate_id();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php 
        include '../universal/navbar.inc.php'; 
    ?>

    <section class="pt-4">
    <div class="container px-lg-5">
        <!-- Page Features-->
        <div class="row gx-lg-5">
            <?php
            require_once "../universal/dbconnector.inc.php";

            $result = $mysqli->query("SELECT * FROM products LIMIT 25");

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-6 col-xxl-4 mb-5">
                        <div class="card border-0 h-100">
                            <img class="card-img-top" src="../assets/<?= $row["imagename"] ?>" alt="Image"
                                 style=" display: block">
                            <div class="card-body ">
                                <div class="text-center">
                                    <h2 class="fs-4 fw-bold"><?= $row["name"] ?></h2>
                                    <p class="mb-0"><?= $row["description"] ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    
                                    <div>
                                        <h4 class="link-dark fw-bold"><?= $row["price"] ?> CHF</h4>
                                    </div>

                                    <form action="../universal/addtoshoppingcart.inc.php" method="post">
                                        <input type="hidden" name="product_id" value="<?= $row["id"] ?>">

                                        <button type="submit" class="btn btn-sm btn-outline-dark">Zum Warenkorb hinzufügen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }

            ?>
        </div>
    </div>
</section>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php $mysqli->close(); ?>