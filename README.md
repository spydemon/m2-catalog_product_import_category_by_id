# Magento 2 — Catalog Product Import Category By ID

## Aim of the module

This Magento 2 module will change the behavior of the `categories` column present in your product import CSV files.
By default, this column will identify categories by their named path (e.g.: `Default Category/Gear/Fitness Equipment`) and will automatically create the corresponding category if the path leads nowhere.

With the module, categories should now be identified by their Magento ID. If no category exists for the provided ID or if the ID is invalid, an error will be thrown.

## What you still have to do

Nothing. This module should work out of the box.

## Compatibility

This module was tested on the Magento versions that follows.

| Version | State |
| ------- | ----- |
| 2.3.5-p1 | Works |

## How to install it

Using Composer for installing this module is the best way:

```
composer require spydemon/m2-catalog_product_import_category_by_id
```

## Help appreciated

If you like this module and find a bug or an enhancement, don't hesitate to fill an issue, or even better: a pull request. 😀
