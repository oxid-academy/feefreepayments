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
 * Date: 24.04.19
 * Time: 13:15
 */

namespace OxidAcademy\FeeFreePayments\Tests\Integration\Model;

use OxidEsales\Eshop\Application\Model\Payment as EshopModelPayment;
use OxidEsales\Eshop\Application\Model\DeliverySet as EshopModelDeliverySet;
use OxidEsales\Eshop\Application\Model\Delivery as EshopModelDelivery;
use OxidEsales\Eshop\Application\Model\User as EshopModelUser;
use OxidEsales\Eshop\Core\Model\BaseModel as EshopBaseModel;
use OxidEsales\Eshop\Application\Model\PaymentList;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

class PaymentListTest extends IntegrationTestCase
{
    private const DELIVERY_SET_ID = 'test_delivery';
    private const DELIVERY_RULE_ID = 'test_delivery_rule';
    private const TEST_USER_ID = 'test_user';
    private const COUNTRY_ID = 'a7c40f631fc920687.20179984';

    public function setUp(): void
    {
        parent::setUp();

        $this->prepareTestData();
    }

    public function testTheTestUser(): void
    {
        //load test user
        $user = oxNew(EshopModelUser::class);
        $user->load(self::TEST_USER_ID);

        $this->assertSame(self::TEST_USER_ID, $user->getId());
    }

    private function prepareTestData(): void
    {
        $this->createUser();
        $this->createDeliverySet();
        $this->preparePayments();
    }

    private function preparePayments(): void
    {
        $data = [
            [
                'oxid' => 'payment1',
                'addSum' => 0.0
            ],
            [
                'oxid' => 'payment2',
                'addSum' => 1.0
            ],
            [
                'oxid' => 'payment3',
                'addSum' => 0.0
            ],
            [
                'oxid' => 'payment4',
                'addSum' => 2.1
            ]
        ];

        foreach ($data as $values) {
            $this->createPayment($values['oxid'], $values['addSum']);
        }
    }

    private function createPayment(string $oxid, float $addSum): void
    {
        $payment = oxNew(EshopModelPayment::class);
        $payment->assign(
            [
                'oxid' => $oxid,
                'oxdesc' => $oxid,
                'oxactive' => '1',
                'oxaddsum' => $addSum,
                'oxfromamount' => 0,
                'oxtoamount' => 100
            ]
        );
        $payment->save();

        $this->relatePaymentToDeliverySet($oxid);
    }

    private function relatePaymentToDeliverySet(string $paymentId): void
    {
        $relation = oxNew(EshopBaseModel::class);
        $relation->init('oxobject2payment');
        $relation->assign(
            [
                'oxpaymentid' => $paymentId,
                'oxobjectid' => self::DELIVERY_SET_ID,
                'oxtype' => 'oxdelset'
            ]
        );
        $relation->save();
    }

    private function createDeliverySet(): void
    {
        //create delivery set
        $delSet = oxNew(EshopModelDeliverySet::class);
        $delSet->assign(
            [
                'oxid' => self::DELIVERY_SET_ID,
                'oxactive' => '1',
                'oxtitle' => self::DELIVERY_SET_ID
            ]
        );
        $delSet->save();

        //assign country to delivery set
        $delSet2Country = oxNew(EshopBaseModel::class);
        $delSet2Country->init('oxobject2delivery');
        $delSet2Country->assign(
            [
                'oxid' => self::DELIVERY_SET_ID,
                'oxdeliveryid' => self::DELIVERY_SET_ID,
                'oxobjectid' => self::COUNTRY_ID,
                'oxtype' => 'oxdelset'
            ]
        );

        //create delivery rule
        $delSet = oxNew(EshopModelDelivery::class);
        $delSet->assign(
            [
                'oxid' => self::DELIVERY_RULE_ID,
                'oxactive' => '1',
                'oxtitle' => self::DELIVERY_RULE_ID,
                'oxparam' => 0,
                'oxparamend' => 1000,
                'oxfinalize' => 1
            ]
        );
        $delSet->save();

        //Relate delivery rule to delivery set
        $del2DelSet = oxNew(EshopBaseModel::class);
        $del2DelSet->init('oxdel2delset');
        $del2DelSet->assign(
            [
                'oxdelid' => self::DELIVERY_SET_ID,
                'oxdelsetid' => self::DELIVERY_RULE_ID
            ]
        );
    }

    private function createUser(): void
    {
        $user = oxNew(EshopModelUser::class);
        $user->assign(
            [
                'oxid' => self::TEST_USER_ID,
                'oxusername' => 'testuser@oxid-academy.com',
                'oxrights' => 'user',
                'oxcountryid' => self::COUNTRY_ID
            ]
        );
        $user->save();
    }
}
