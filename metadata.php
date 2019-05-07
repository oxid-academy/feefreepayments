<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = array(
    'id'           => 'oxac/feefreepayments',
    'title'        => 'Fee Free Payments',
    'description'  => array(
        'de' => 'Filter um ausschlie&szlig;lich kostenfreie Zahlmethoden anzuzeigen.',
        'en' => 'List only fee free payment options.',
    ),
    'thumbnail'    => 'logo.png',
    'version'      => '1.0.0',
    'author'       => 'OXID Academy',
    'url'          => 'https://www.oxid-esales.com/oxid-welt/academy/schulungen/',
    'email'        => 'academy@oxid-esales.com',
    'extend'       => array(
        \OxidEsales\Eshop\Application\Model\PaymentList::class => \OxidAcademy\FeeFreePayments\Model\PaymentList::class,
    ),
);
