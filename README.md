# Exiguous Ecommerce

Exiguous Ecommerce is a super simple ecommerce library, that uses flat files and takes a very minimalistic approach.

**Still in development!**

## Quick Start

Examples of getting products and categories:

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
