<?php

/**
 * Copyright © OXID Academy. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidAcademy\FeeFreePayments\Tests\Codeception;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * @group example
 */
final class ExampleCest
{
    public function testCanOpenShopStartPageAndSeeExtendedTemplate(AcceptanceTester $I): void
    {
        $I->wantToTest('that codeception tests are working');

        $I->openShop();
        $I->waitForPageLoad();

        $I->see(Translator::translate('OXAC_FEEFREEPAYMENTS_TEASER'));
    }
}
