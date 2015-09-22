<?php

require "vendor/autoload.php";

$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug("teddy-bear");

$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->addProduct($product, 1);

var_dump($basket->items); // Return an array of, you guessed it, basket items! ^_^

?>