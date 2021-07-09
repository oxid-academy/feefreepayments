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

namespace OxidAcademy\FeeFreePayments\Tests\Unit\Model;

use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\PaymentList;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Field;
use OxidEsales\Eshop\Core\Model\BaseModel;
use OxidEsales\TestingLibrary\UnitTestCase;

class PaymentListTest extends UnitTestCase
{
    /**
     * Holds the demo payment objects.
     * Gets filled up by \OxidAcademy\FeeFreePayments\Tests\Unit\Model\PaymentListTest::setUp and
     * \OxidAcademy\FeeFreePayments\Tests\Unit\Model\PaymentListTest::tearDown
     *
     * @var Payment[]
     */
    protected $savedPayments = [];

    protected function setUp()
    {

    }

    /**
     * @see \OxidEsales\EshopCommunity\Tests\Unit\Application\Model\PaymentlistTest::tearDown
     */
    protected function tearDown()
    {

    }

    /**
     * Create payment option, assign to delivery set, then test with user.
     */
    public function testGetPaymentListFiltersOnlyPaymentsWithFees()
    {

    }
}
