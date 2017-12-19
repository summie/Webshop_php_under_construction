<?php
// Create Connection
$conn = new mysqli("localhost", "root", "", "pwa");

//check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$sql="SELECT id, artikel, prijs, artikelcode, btw, omschrijving, foto FROM producten ORDER BY id";
$result = mysqli_query($conn,$sql);

// Fetch all
$product = mysqli_fetch_all($result,MYSQLI_ASSOC);

$products =  json_encode($product);

?>
