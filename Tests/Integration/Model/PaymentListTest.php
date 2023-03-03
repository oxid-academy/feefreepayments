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

use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\PaymentList;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Field;
use OxidEsales\Eshop\Core\Model\BaseModel;
use PHPUnit\Framework\TestCase;

class PaymentListTest extends TestCase
{
    /**
     * Holds the demo payment objects.
     * Gets filled up by \OxidAcademy\FeeFreePayments\Tests\Unit\Model\PaymentListTest::setUp and
     * \OxidAcademy\FeeFreePayments\Tests\Unit\Model\PaymentListTest::tearDown
     *
     * @var Payment[]
     */
    protected $savedPayments = [];

    protected function setUp(): void
    {
        parent::setUp();

        // Disabling default payments
        $this->savedPayments = oxNew(PaymentList::class);
        $this->savedPayments->selectString('SELECT * FROM oxpayments WHERE oxactive = 1');
        foreach ($this->savedPayments as $payment) {
            $payment->oxpayments__oxactive = new Field(0);
            $payment->save();
        }
    }

    /**
     * @see \OxidEsales\EshopCommunity\Tests\Unit\Application\Model\PaymentlistTest::tearDown
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        foreach ($this->savedPayments as $payment) {
            $payment->oxpayments__oxactive = new Field(1);
            $payment->save();
        }
    }

    /**
     * Create payment option, assign to delivery set, then test with user.
     */
    public function testGetPaymentListFiltersOnlyPaymentsWithFees()
    {
        $db = DatabaseProvider::getDb();

        // (ox)id => fee
        $payments = [
            'payment1' => 0,
            'payment2' => 1,
            'payment3' => 0,
        ];

        foreach ($payments as $id => $fee) {

            // Creating the payment method
            $payment = oxNew(Payment::class);
            $payment->setId($id);
            $payment->oxpayments__oxactive = new Field(1);
            $payment->oxpayments__oxaddsum = new Field($fee);
            $payment->oxpayments__oxfromamount = new Field(0);
            $payment->oxpayments__oxtoamount = new Field(100);
            $payment->save();

            // Assigning the default delivery set to the payment method
            $deliverySet = oxNew(BaseModel::class);
            $deliverySet->init('oxobject2payment');
            $deliverySet->oxobject2payment__oxpaymentid = new Field($id);
            $deliverySet->oxobject2payment__oxobjectid = new Field('oxidstandard');
            $deliverySet->oxobject2payment__oxtype = new Field('oxdelset');
            $deliverySet->save();
        }


        // Creating a user object for the payment list
        $user = oxNew(User::class);
        $user->load('oxdefaultadmin');

        $paymentList = oxNew(PaymentList::class);
        $list = $paymentList->getPaymentList('oxidstandard', 0.0, $user);

        /*
         * Testing it
         *
         * There must be two payments in the list.
         * The list must contain payment1 and payment3.
         * The list must not contain payment2 as it has a fee.
         */
        $this->assertCount(2, $list);
        $this->assertArrayHasKey('payment1', $list);
        $this->assertArrayHasKey('payment3', $list);
        $this->assertArrayNotHasKey('payment2', $list);


        // Cleanup
        foreach ($payments as $id) {
            $db->execute(
                'DELETE FROM oxpayments WHERE oxid = ?',
                [$id]
            );
            $db->execute(
                'DELETE FROM oxobject2payment WHERE oxpaymentid = ?',
                [$id]
            );
        }
    }
}
