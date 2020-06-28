<?php

namespace Spydemon\CatalogProductImportCategoryByID\Model;

use Exception;
use Spydemon\CatalogProductImportCategoryByID\Exception\CategoryNotFoundException;
use Spydemon\CatalogProductImportCategoryByID\Exception\CategoryIDInvalidException;

/**
 * Class CategoryProcessor
 *
 * This rewrite allows product import to set category assignations by category ID instead of paths built with their
 * names.
 */
class CategoryProcessor extends \Magento\CatalogImportExport\Model\Import\Product\CategoryProcessor
{
    /**
     * Returns IDs of categories by ID. This write will not create any new category and will generate an error if we
     * try to add the product to a non existing one.
     *
     * @param string $categoriesString
     * @param string $categoriesSeparator
     * @return array
     */
    public function upsertCategories($categoriesString, $categoriesSeparator)
    {
        $categoriesIds = [];
        $categories = explode($categoriesSeparator, $categoriesString);
        foreach ($categories as $categoryId) {
            if (!is_numeric($categoryId)) {
                $this->addFailedCategory($categoryId, new CategoryIDInvalidException());
                continue;
            }
            $category = $this->getCategoryById($categoryId);
            if (is_null($category)) {
                $this->addFailedCategory($categoryId, new CategoryNotFoundException());
                continue;
            }
            $categoriesIds[] = $categoryId;
        }
        return $categoriesIds;
    }

    /**
     * Add failed category in the list.
     *
     * @param string $category
     * @param Exception $exception
     * @return $this
     */
    protected function addFailedCategory($category, $exception)
    {
        $this->failedCategories[] = [
            'category'  => $category,
            'exception' => $exception,
        ];
        return $this;
    }
}
