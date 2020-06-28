<?php

namespace Spydemon\CatalogProductImportCategoryByID\Exception;

use Exception;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class CategoryIDInvalidException
 */
class CategoryIDInvalidException extends LocalizedException
{
    /**
     * CategoryIDInvalidException constructor.
     *
     * @param Exception|null $cause
     * @param int $code
     */
    public function __construct(Exception $cause = null, $code = 0)
    {
        parent::__construct(__('Category ID should be numeric.'), $cause, $code);
    }
}
