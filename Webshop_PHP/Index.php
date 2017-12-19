<?php
/**
 * Created by PhpStorm.
 * User: Lisanne
 * Date: 18-12-2017
 */

?>
<html>
 <head>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


     <?php
     // Title of the page
     ?>
     <title>Homepagina</title>

     <!-- Bootstrap core CSS -->
     <link href="css/bootstrap.min.css" rel="stylesheet">

     <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
     <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

     <!-- Custom styles for this template -->
     <link href="css/starter-template.css" rel="stylesheet">

     <?php
     // Include Nagivation+Database Connection
     include 'Menu.php';
     include 'dbconnectie.php';
     ?>
 </head>
 <body>
 <div class="container" style="margin-top:100px" >
    <h3>Test</h3>
     <p id="demo">

         <script>
             var products = '<?php$product?>'
             var row = JSON.parse(products);

             document.getElementById("demo").innerHTML = row.id;
         </script>
<?php
        /** For ($i = 0; $i < $rows; $i++)
         {?>


                <p><?php echo $rows["id"]; ?></p>
                <img src="<?php echo $rows["foto"]; ?>" class="img-responsive" /><br />
                <h4 class="text-info"><?php echo $rows["artikel"]; ?></h4>
                <h4 class="text-danger">€ <?php echo $rows["prijs"]; ?></h4>
                <p><?php echo $rows["omschrijving"]; ?></p>
                <p><?php echo $rows["artikelcode"]; ?></p>
                <p><?php echo $rows["btw"];*/ ?>

     </p>
 </div>

 </body>
</html>