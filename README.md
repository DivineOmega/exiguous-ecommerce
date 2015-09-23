# Exiguous Ecommerce

Exiguous Ecommerce is a super simple ecommerce library, that uses flat files and takes a very minimalistic approach.

**Still in development!**

## Quick Start Examples

Getting products and categories:

```php
$category = \DivineOmega\ExiguousEcommerce\Product::findBySlug("fluffy-things");
$products = $category->products();

foreach($products as $product) {
    echo $product->data->name;
}
```

```php
$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug("teddy-bear");
$categories = $product->categories();

$mainCategoryName = $categories[0]->data->name;
```

Getting the current user's basket and adding a product to it:

```php
$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug("teddy-bear");

$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->addProduct($product); // Add one Teddy Bear

$basket->addProduct($product, 2); // Add another two Teddy Bears!

var_dump($basket->items); // Outputs an array of, you guessed it, basket items! ^_^

// ^ This would show 1 basket item with a quantity of 3 teddy bears.

```

Removing a product from a basket: 

```php
$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug("teddy-bear");

$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->removeProduct($product); // Removes all teddy bears from the basket
```

Offsetting the quantity of a product in the basket:

```php
$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug("teddy-bear");

$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->addProduct($product); // Add one Teddy Bear

$basket->offsetProductQuantity($product, 10); // Add ten more Teddy Bears
```