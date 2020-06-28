<?php

namespace Spydemon\CatalogProductImportCategoryByID\Exception;

use Exception;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class CategoryNotFoundException
 */
class CategoryNotFoundException extends LocalizedException
{
    /**
     * CategoryNotFoundException constructor.
     *
     * @param Exception|null $cause
     * @param int $code
     */
    public function __construct(Exception $cause = null, $code = 0)
    {
        parent::__construct(__('Category not found.'), $cause, $code);
    }
}
