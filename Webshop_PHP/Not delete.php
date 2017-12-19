<?php
if(isset($_POST["add_to_cart"]))
{
if(isset($_SESSION["shopping_cart"]))
{

{
$count = count($_SESSION["shopping_cart"]);

$item_id            = $_GET["id"];
$item_name          = $_POST["hidden_name"];
$item_price         = $_POST["hidden_price"];
$item_amount        = $_POST["quantity"];
$item_description   = $_POST['hidden_description'];

$_SESSION['id']         = $item_id;
$_SESSION['name']       = $item_name;
$_SESSION['price']      = $item_price;
$_SESSION['amount']     = $item_amount;
$_SESSION['description'] = $item_description;


define('item_array', [$_SESSION['id'], $_SESSION['name'], $_SESSION['price'], $_SESSION['amount'], $_SESSION['description']]);
}
}
}
?>


<div class="container" style="width:700px; margin-top:100px">
    <div style="clear:both"></div>
    <br />
    <h3>Bestelling Details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="40%">Artikelnaam</th>
                <th width="10%">Aantal</th>
                <th width="20%">Prijs</th>
                <th width="15%">Totaalprijs</th>
                <th width="5%"></th>
            </tr>
            <?php
            if(!empty($_SESSION["shopping_cart"]))
            {
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><input type="number" placeholder="<?php echo $values["item_quantity"]; ?>"><?php echo $values["item_quantity"]; ?></td>
                        <td>€ <?php echo $values["item_price"]; ?></td>
                        <td>€ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                        <td><a href="Shopping_cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Verwijder</span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
                ?>
                <tr>
                    <td colspan="3" align="right">Totaalprijs</td>
                    <td align="right">€ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>