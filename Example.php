<?php

require 'vendor/autoload.php';

$coreSettings = \DivineOmega\ExiguousEcommerce\Settings::find('core');

$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug('teddy-bear');

$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->setCurrency($coreSettings->data->primaryCurrency);

$basket->addProduct($product, 2);

$basket->convertToOrder();