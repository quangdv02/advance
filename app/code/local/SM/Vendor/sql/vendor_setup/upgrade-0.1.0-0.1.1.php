<?php
/**
 * Created by PhpStorm.
 * User: Computer
 * Date: 8/9/2015
 * Time: 9:14 PM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
$vendors = array(
    array(
        'name' => 'name 1',
        'description' => 'Unable to add items to cart 1.',
        'is_active' => 1,
    ),
    array(
        'name' => 'name 2',
        'description' => 'Unable to add items to cart 2.',
        'is_active' => 1,
    ),
    array(
        'name' => 'name 3',
        'description' => 'Unable to add items to cart 3.',
        'is_active' => 1,
    ),
);

foreach ($vendors as $vendor) {
    Mage::getModel('vendor/vendor')
        ->setData($vendor)
        ->save();
}


$installer->endSetup();