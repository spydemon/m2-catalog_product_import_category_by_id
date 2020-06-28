<?php

namespace Spydemon\CatalogProductImportCategoryByID\Plugin;

use Magento\CatalogImportExport\Model\Import\Product;
use Magento\ImportExport\Model\Import\Entity\AbstractEntity as ImportEntity;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingError;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregator as Subject;

/**
 * Class ChangeErrorMessage
 */
class ChangeErrorMessage
{
    /**
     * Since our module removes the ability to the importer to create new categories, the error message throws in case
     * of error should be modified in something else. The purpose of this plugin is thus to change the original message:
     * "Category xx has not been created" by "Category xx was not fetched" in case error during category handling.
     *
     * @param Subject $subject
     * @param $errorCode
     * @param string $errorLevel
     * @param null $rowNumber
     * @param null $columnName
     * @param null $errorMessage
     * @param null $errorDescription
     * @return array
     */
    public function beforeAddError(
        Subject $subject,
        $errorCode,
        $errorLevel = ProcessingError::ERROR_LEVEL_CRITICAL,
        $rowNumber = null,
        $columnName = null,
        $errorMessage = null,
        $errorDescription = null
    ) {
        if ($errorCode == ImportEntity::ERROR_CODE_CATEGORY_NOT_VALID
            && $errorLevel == ProcessingError::ERROR_LEVEL_NOT_CRITICAL
            && $rowNumber == 2
            && $columnName == Product::COL_CATEGORY
            && preg_match('/^Category .* has not been created./', $errorMessage)
        ) {
            $errorMessage = preg_replace('/^Category (.*) has not been created\.(.*)$/', 'Category $1 was not fetched. $2', $errorMessage);
        }
        return [$errorCode, $errorLevel, $rowNumber, $columnName, $errorMessage, $errorDescription];
    }
}
