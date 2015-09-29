<?php

require 'vendor/autoload.php';

$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug('teddy-bear');

$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->setCurrency('GBP');

$basket->addProduct($product, 2);

$basket->convertToOrder();
