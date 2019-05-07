<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 23.04.19
 * Time: 14:36
 */

namespace OxidAcademy\FeeFreePayments\Model;

use OxidEsales\Eshop\Application\Model\Payment;

/**
 * Class PaymentList
 * @package OxidAcademy\FeeFreePayments\Model
 */
class PaymentList extends PaymentList_parent
{
    /**
     * Loads and returns list of fee free payments.
     *
     * @param string                                   $sShipSetId user chosen delivery set
     * @param double                                   $dPrice     basket product price excl. discount
     * @param \OxidEsales\Eshop\Application\Model\User $oUser      session user object
     *
     * @return array
     */
    public function getPaymentList($sShipSetId, $dPrice, $oUser = null)
    {
        $list = parent::getPaymentList($sShipSetId, $dPrice, $oUser);
        $this->_aArray = [];

        foreach ($list as $payment) {
            if ($payment instanceof Payment && $payment->oxpayments__oxaddsum->value == 0) {
                $this->_aArray[$payment->getId()] = $payment;
            }
        }

        return $this->_aArray;
    }
}
