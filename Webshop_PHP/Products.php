<?php
/**
 * Created by PhpStorm.
 * User: Lisanne
 * Date: 18-12-2017
 */

session_start();
include 'dbconnectie.php';


if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"],
                'item_btw'          =>     $_POST["hidden_btw"],
                'item_description'      =>      $_POST["hidden_description"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Product is al in winkelwagen!")</script>';
            echo '<script>window.location="Products.php"</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'               =>     $_GET["id"],
            'item_name'               =>     $_POST["hidden_name"],
            'item_price'          =>     $_POST["hidden_price"],
            'item_quantity'          =>     $_POST["quantity"],
            'item_btw'          =>     $_POST["hidden_btw"],
            'item_description'      =>      $_POST["hidden_description"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
?>

<html>
<head>

    <?php
    // Title of the page
    ?>
    <title>Products</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <?php
    // Include Nagivation+Database Connection
    include 'Menu.php';

    // Recieves content
    $sql = "SELECT * FROM Producten ORDER BY id ASC";
    $information = $conn->query($sql);
    $rows = $information->num_rows;

    ?>
</head>
<body>
<div><br>
    <div class="container" style="margin-top:100px">
        <?php // Displays products from database when num_Rows > 0

        if($rows > 0) {
            while ($row = mysqli_fetch_array($information))
            {?>

                <div class="col-md-4">
                    <form method="post" action="Products.php?action=add&id=<?php echo $row["id"]; ?>">

                        <div class="row">
                            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                                <img src="<?php echo $row["foto"]; ?>" class="img-responsive" /><br />
                                <h4 class="text-info"><?php echo $row["artikel"]; ?></h4>
                                <h4 class="text-danger">€ <?php echo $row["prijs"]; ?></h4>
                                <p><?php echo $row["omschrijving"]?></p>
                                    <input type="number" name="quantity" class="form-control" value="1" />
                                    <input type="hidden" name="hidden_name" value="<?php echo $row["artikel"]; ?>" />
                                    <input type="hidden" name="hidden_price" value="<?php echo $row["prijs"]; ?>" />
                                    <input type="hidden" name="hidden_btw" value="<?php echo $row["btw"]; ?>" />
                                    <input type="hidden" name="hidden_description" value="<?php echo $row["omschrijving"]; ?>" />
                                    <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                            </div>
                        </div>

                    </form>
                </div><?php
            }
        }?>

        <br />
    </div>

</body>
</html>
