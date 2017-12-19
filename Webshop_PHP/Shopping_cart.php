<?php
/**
 * Created by PhpStorm.
 * User: Lisanne
 * Date: 18-12-2017
 */

session_start();
include 'dbconnectie.php';

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Verwijdert")</script>';
                echo '<script>window.location="Shopping_cart.php"</script>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    // Title of the page
    ?>
    <title>Shopping Cart</title>


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
                 <th width="10%">Btw</th>
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
                         <td>  <?php echo $values["item_btw"]; ?> %</td>
                         <td>€ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                         <td><a href="Shopping_cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Verwijder</span></a></td>
                     </tr>
                     <?php
                     $total = $total + ($values["item_quantity"] * $values["item_price"]);
                 }
                 ?>
                 <tr>
                     <td colspan="3" align="right">subtotaal</td>
                     <td></td>
                     <td align="right">€ <?php echo number_format($total, 2); ?></td>
                 </tr>
                 <tr>
                     <td colspan="3" align="right">Prijs 6% btw</td>
                     <td></td>
                     <td align="right">€ <?php echo number_format($total, 2); ?></td>
                 </tr>
                 <tr>
                     <td colspan="3" align="right">Prijs 21% btw</td>
                     <td></td>
                     <td align="right">€ <?php echo number_format($total, 2); ?></td>
                 </tr>
                 <tr>
                     <td colspan="3" align="right">Totaalprijs</td>
                     <td></td>
                     <td align="right">€ <?php echo number_format($total, 2); ?></td>
                 </tr>
                 <?php
             }
             ?>
         </table>
     </div>





    <div class="container" style="margin-top:100px">
        <form method="post"><table border="0" width="100%">
                <table border="0">
                    <tr><td><strong>Naam: </strong></td><td><input name="naam" type="text" value="" /></td></tr>
                    <tr><td><strong>Email: </strong></td><td><input name="mail" type="text" value="" /></td></tr>
                    <tr><td><strong>Adres: </strong></td><td><input name="adres" type="text" value="" /></td></tr>
                    <tr><td colspan="2"><input name="bestellen" type="submit" value="Plaats u bestelling" /></td></tr>
                </table>
        </form>

<?php
        if (isset($_POST['bestellen']))
        {
            $headers = 'From: Website <info@test.nl>'."\n";
            $headers .= 'Reply-To: '.$_POST['naam'].' <'.$_POST['email'].'>'."\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
            $headers .= 'Return-Path: Mail-Error <info@test.nl>'."\n";
            $headers .= 'MIME-Version: 1.0'."\n";
            $headers .= 'Content-Transfer-Encoding: 8bit'."\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\n";

            if (mail(
            'Lisanne <info@test.nl>',
            'Besteling door: '.$_POST['naam'],
            $headers))
                {
                    echo 'De besteling is verzonden';
                }
        }?>

    </div>
 </body>
</html>