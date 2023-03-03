<?php declare(strict_types=1);

/**
 * Copyright © OXID Academy. All rights reserved.
 * See LICENSE file for license details.
 */
namespace OxidAcademy\FeeFreePayments\Model;

use OxidAcademy\FeeFreePayments\Service\ListService;
use OxidEsales\Eshop\Core\Model\BaseModel;
use PHPUnit\Framework\TestCase;

class ListServiceTest extends TestCase
{
    private const VALUE_NAME = 'check_me';

    public function testGetCleanedList(): void
    {
        $list = [
            'A' => $this->getMockedItem('10.6'),
            'B' => $this->getMockedItem('20'),
            'C' => $this->getMockedItem('1.1'),
            'D' => $this->getMockedItem('13.0'),
            'E' => $this->getMockedItem('3.3'),
            'F' => $this->getMockedItem('not_a_number'),
            'G' => $this->getMockedItem('7.5'),
        ];

        $expected = ['A', 'C', 'E', 'G'];

        $service = new ListService();
        $cleanedList = $service->getItemsWithNumericValueEqualOrBelow($list, self::VALUE_NAME, 11);

        $this->assertSame($expected, array_keys($cleanedList));
        $this->assertInstanceOf(BaseModel::class, $cleanedList['A']);
    }

    private function getMockedItem(string $value): BaseModel
    {
        $item = $this->getMockBuilder(BaseModel::class)
            ->disableOriginalConstructor()
            ->getMock();
        $item->expects($this->any())
            ->method('getFieldData')
            ->with(self::VALUE_NAME)
            ->willReturn($value);

        return $item;
    }
}
