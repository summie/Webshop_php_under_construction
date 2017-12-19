<?php // Title+navigation of the pages

echo '
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Webshop</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="Index.php"> Home</a></li>
                <li><a href="Products.php">Producten</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li><a href="Shopping_cart1.php" class="glyphicon glyphicon-shopping-cart"> Winkelwagen</a></li>
            </ul>
        </div>
    </div>
</nav>
';
?>