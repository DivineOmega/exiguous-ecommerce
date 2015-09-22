<?php

require "vendor/autoload.php";

$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug("teddy-bear");

var_dump($product);

?>