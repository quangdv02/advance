<?php
class SM_Vendor_Block_Vendor extends Mage_Core_Block_Template{

    public function getVendors(){
        $condition = array('neq'=>0);
        return Mage::getModel('vendor/vendor')->getCollection()->addFieldToFilter('is_active',$condition)->getData();
    }

    public function getProductsByVendor(){
        $id = Mage::app()->getRequest()->getParam('id');
        return Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect('*')->addAttributeToFilter('vendor_id',$id);
    }
}