<?php declare(strict_types=1);

/**
 * Copyright © OXID Academy. All rights reserved.
 * See LICENSE file for license details.
 */
namespace OxidAcademy\FeeFreePayments\Service;

use OxidEsales\Eshop\Core\Model\BaseModel;

class ListService
{
    /**
     * @param BaseModel[] $list

     * @return BaseModel[]
     */
    public function getItemsWithNumericValueEqualOrBelow(
        array $list,
        string $fieldName,
        float $minValue
    ): array
    {
        $cleanedList = [];

        foreach ($list as $key => $model) {
            if (is_numeric($model->getFieldData($fieldName)) &&
                ($model->getFieldData($fieldName) <= $minValue)
            ) {
                $cleanedList[$key] = $model;
            }
        }

        return $cleanedList;
    }
}
