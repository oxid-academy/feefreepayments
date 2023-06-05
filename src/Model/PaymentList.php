<?php
/**
 * This Software is the property of OXID eSales and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @author        OXID Academy
 * @link          https://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2021
 *
 * User: michael
 * Date: 23.04.19
 * Time: 14:36
 */

namespace OxidAcademy\FeeFreePayments\Model;

use OxidAcademy\FeeFreePayments\Service\ListService;
use OxidAcademy\FeeFreePayments\Traits\ServiceContainer;

/**
 * Class PaymentList
 * @package OxidAcademy\FeeFreePayments\Model
 */
class PaymentList extends PaymentList_parent
{
    use ServiceContainer;

    /**
     * Loads and returns list of fee free payments.
     *
     * @param string $shipSetId user chosen delivery set
     * @param double $price basket product price excl. discount
     * @param \OxidEsales\Eshop\Application\Model\User $user session user object
     *
     * @return array
     */
    public function getPaymentList($shipSetId, $price, $user = null)
    {
        $list = parent::getPaymentList($shipSetId, $price, $user);

        $service = $this->getServiceFromContainer(ListService::class);

        $this->_aArray = $service->getItemsWithNumericValueEqualOrBelow(
            $list,
            'oxaddsum',
            0
        );

        return $this->_aArray;
    }
}
