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
$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'vendor_id', array(
    'group'             => 'General',
    'type'              => 'varchar',
    'backend'           => '',
    'frontend'          => '',
    'label'             => 'Vendor Id',
    'input'             => 'select',
    'class'             => '',
    'source'            => 'vendor/product_attribute_source_vendor',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => true,
    'required'          => false,
));

$installer->endSetup();