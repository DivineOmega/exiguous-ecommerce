# Exiguous Ecommerce

[![StyleCI](https://styleci.io/repos/42943155/shield)](https://styleci.io/repos/42943155)

Exiguous Ecommerce is a super simple ecommerce library, that uses flat files and takes a very minimalistic approach.

**Still in development!**

## Installation

First, change your `composer.json` file to include the `divineomega/exiguous-ecommerce` package as shown below.

```
{
    "require": {
        "divineomega/exiguous-ecommerce": "dev-master"
    }
}
```

Then just run `composer update` to download/install Exiguous Ecommerce and create relevant autoload files.

If your framework does not already do so, you must add `require_once "vendor/autoload.php"` to any files in which you wish to use Exiguous Ecommerce.

As the data files that contain information regarding products, categories, and so on are stored within your `vendor` directory, you may need to specifically allow them in your version control system. For example, if using git, you could add the following to your `.gitignore` file.

```
# Ignore vendor folder...
vendor

# But include the Exiguous Ecommerce data directory
!vendor/divineomega/exiguous-ecommerce/data
```

(This may be modified in the future so that you can place the data directory in a location of your choosing.

## Quick Start Examples

Getting products and categories:

```php
$category = \DivineOmega\ExiguousEcommerce\Category::findBySlug("fluffy-things");
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

Setting/Offsetting the quantity of a product in the basket:

```php
$product = \DivineOmega\ExiguousEcommerce\Product::findBySlug("teddy-bear");

$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->addProduct($product); // Add one Teddy Bear

$basket->setProductQuantity($product, 10); // Set the number of Teddy Bears in the basket to ten

$basket->offsetProductQuantity($product, 10); // Add ten more Teddy Bears

$basket->offsetProductQuantity($product, -5); // Remove five of those Teddy Bears
```

Migrating the basket to an order:

```php
$basket = \DivineOmega\ExiguousEcommerce\Basket::findCurrent();

$basket->convertToOrder();
```

Getting and using settings:

```php

// Retrieves settings from the core.json file within the .settings directory
$coreSettings = \DivineOmega\ExiguousEcommerce\Settings::find('core');

echo $coreSettings->data->primaryCurrency; // Output the ecommerce's primary currency setting

```
