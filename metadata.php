<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id'           => 'oxac/feefreepayments',
    'title'        => [
        'de'    =>  'Kostenlose Zahlungsarten',
        'de'    =>  'Fee Free Payments'
    ],
    'description'  => [
        'de' => 'Filter für die Anzeige ausschlie&szlig;lich kostenloser Zahlungsarten.',
        'en' => 'Filter for displaying free payment options only.',
    ],
    'thumbnail'    => 'logo.png',
    'version'      => '1.0.1',
    'author'       => 'OXID Academy',
    'url'          => 'https://www.oxid-esales.com/oxid-welt/academy/schulungen/',
    'email'        => 'academy@oxid-esales.com',
    'extend'       => [
        \OxidEsales\Eshop\Application\Model\PaymentList::class => \OxidAcademy\FeeFreePayments\Model\PaymentList::class,
    ],
];
