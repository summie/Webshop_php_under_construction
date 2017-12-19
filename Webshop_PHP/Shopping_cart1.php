<!DOCTYPE html>
<html lang="en">
<head>
    <title>Winkelwagen</title>

    <?php
    include 'Menu.php';
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>

<body>
<div class="container" style="width:700px; margin-top:100px">
    <div class="starter-template">
        <h2>Winkelwagen</h2>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-3"><strong>Productkeuze</strong></div>
                <div class="col-md-2"><strong>Prijs (€)</strong></div>
                <div class="col-md-2"><strong>BTW (%)</strong></div>
                <div class="col-md-3"><strong>Aantal</strong></div>
                <div class="col-md-2"><strong>Subtotaal (€)</strong></div>
            </div>
            <hr>
            <div id="product-collection">
                Geen producten in winkelmand
            </div>
            <hr>
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-offset-5 col-md-2"><strong>Subtotaal:</strong></div>
                <div class="col-md-3"></div>
                <div id="subtotal-holder" class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-offset-5 col-md-2"><strong>6% btw over:</strong></div>
                <div id="six-percent-product-holder" class="col-md-3"></div>
                <div id="total-vat-six-percent-holder" class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-offset-5 col-md-2"><strong>21% btw over:</strong></div>
                <div id="twenty-one-percent-product-holder" class="col-md-3"></div>
                <div id="total-vat-twenty-one-percent-holder" class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-offset-5 col-md-2"><strong>Totaal incl BTW:</strong></div>
                <div class="col-md-3"></div>
                <div id="total-holder" class="col-md-2"></div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-2">
                    <a id="add-article" class="btn btn-primary" href="#">Nieuw product</a>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" type="submit" tabindex="">Bestel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="JQuery/jquery-3.2.1.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js""></script>

<script type="text/javascript">
var products = [];
products[0] = {
    description: 'Harry Potter en de Steen der Wijzen',
    price_excl_vat: 9.95,
    vat_percentage: 6
};
products[1] = {
    description: 'Harry Potter en de Geheime Kamer',
    price_excl_vat: 9.95,
    vat_percentage: 6
};
products[2] = {
    description: 'Harry Potter en de Gevangene van Azkaban',
    price_excl_vat: 9.95,
    vat_percentage: 6
};

$(document).ready(function () {
    var amountOfOrderedArticles = 0;

    $('a#add-article').click(function() {
        var row = '';
        if (amountOfOrderedArticles > 0) {
            row += '<hr>';
        }

        row += '<div id="product-' + amountOfOrderedArticles + '" class="row product-row">';
        row += '    <div class="col-md-3">';
        row += '        <select name="product-row-select-' + amountOfOrderedArticles + '" class="product-row-select" style="width: 90%;">';
        row += '            <option></option>';

        $.each(products, function(index, value) {
            row += '<option value="' + index + '">' + value.description + '</option>';
        });

        row += '        </select>';
        row += '    </div>';
        row += '    <div class="col-md-2 price"></div>';
        row += '    <div class="col-md-2 vat"></div>';
        row += '    <div class="col-md-3 amount">';
        row += '        <input type="number" name="product-row-amount-' + amountOfOrderedArticles + '" class="product-row-amount" min="0" value="1" />';
        row += '    </div>';
        row += '    <div class="col-md-2 subtotal"></div>';
        row += '</div>';

        row += '';

        if (amountOfOrderedArticles === 0) {
            $('div#product-collection').html(row);
        } else {
            $('div#product-collection').append(row);
        }

        amountOfOrderedArticles++;
    });

    $('div#product-collection').on('change', 'select.product-row-select', function() {
        if (products[$(this).val()] !== undefined) {
            var parentElement = $(this).closest('div.product-row');

            parentElement.find('.price').html(formatNumber(products[$(this).val()].price_excl_vat));
            parentElement.find('.vat').html(products[$(this).val()].vat_percentage + ' %');

            var price = products[$(this).val()].price_excl_vat * parentElement.find('.product-row-amount').val();
            parentElement.find('.subtotal').html('€ ' + formatNumber(price));
            calculateTotals();
        }
    });

    $('div#product-collection').on('change', 'input.product-row-amount', function() {
        var parentElement = $(this).closest('div.product-row');

        var price = 0;
        if (products[parentElement.find('.product-row-select').val()] !== undefined) {
            var product = products[parentElement.find('.product-row-select').val()];

            price = product.price_excl_vat * parentElement.find('.product-row-amount').val();
        }

        parentElement.find('.subtotal').html('€ ' + formatNumber(price));
        calculateTotals();
    });
});

function calculateTotals() {
    var subtotal = 0.00;
    var vatSixPercentageProductTotal = 0;
    var vatTwentyOnePercentageProductTotal = 0;

    $.each($('div#product-collection div.product-row'), function(index, value) {
        if (products[$(value).find('select.product-row-select').val()] !== undefined) {
            var product = products[$(value).find('select.product-row-select').val()];

            var totalPrice = product.price_excl_vat * $(value).find('input.product-row-amount').val();

            subtotal += totalPrice;

            if (product.vat_percentage === 6) {
                vatSixPercentageProductTotal += totalPrice;
            }

            if (product.vat_percentage === 21) {
                vatTwentyOnePercentageProductTotal += totalPrice;
            }
        }
    });

    var vatSixPercentageTotal = vatSixPercentageProductTotal * 0.06;
    var vatTwentyOnePercentageTotal = vatTwentyOnePercentageProductTotal * 0.21;

    var total = subtotal + vatSixPercentageTotal + vatTwentyOnePercentageTotal;

    $('div#subtotal-holder').html('€ ' + formatNumber(subtotal));
    $('div#six-percent-product-holder').html('€ ' + formatNumber(vatSixPercentageProductTotal));
    $('div#total-vat-six-percent-holder').html('€ ' + formatNumber(vatSixPercentageTotal));
    $('div#twenty-one-percent-product-holder').html('€ ' + formatNumber(vatTwentyOnePercentageProductTotal));
    $('div#total-vat-twenty-one-percent-holder').html('€ ' + formatNumber(vatTwentyOnePercentageTotal));
    $('div#total-holder').html('€ ' + formatNumber(total));
}

function formatNumber(number) {
    return number.toLocaleString('nl-NL', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}
        </script>
    </body>
</html>
