# Exiguous Ecommerce

Exiguous Ecommerce is a super simple ecommerce library, that uses flat files and takes a very minimalistic approach.

## Quick Start

Get things:

```php
$category = \DivineOmega\ExiguousEcommerce\Product::findBySlug("fluffy-things");
$products = $category->products();

foreach($products as $product) {
    echo $product->data->name;
}

$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug("teddy-bear");
$product->categories();
```
