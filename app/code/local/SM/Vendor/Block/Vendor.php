<?php
class SM_Vendor_Block_Vendor extends Mage_Core_Block_Template{

    public function getVendors(){
        $config = Mage::getStoreConfig('sm_vendor/general/show_all');
        $condition = array('neq'=>0);
        $collection =  Mage::getModel('vendor/vendor')->getCollection();
        if($config==0)
            $collection->addFieldToFilter('is_active',$condition);
        return $collection->getData();

    }

    public function getProductsByVendor(){
        $id = Mage::app()->getRequest()->getParam('id');
        return Mage::getModel('catalog/product')->getCollection()->addAttributeToSelect('*')->addAttributeToFilter('vendor_id',$id);
    }
}