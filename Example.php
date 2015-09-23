<?php

require 'vendor/autoload.php';

$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug('teddy-bear');

$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->addProduct($product, 1);

var_dump($basket->items);

$basket->offsetProductQuantity($product, 10);

var_dump($basket->items);
