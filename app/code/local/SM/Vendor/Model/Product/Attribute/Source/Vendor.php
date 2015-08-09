<?php
class SM_Vendor_Model_Product_Attribute_Source_Vendor extends Mage_Eav_Model_Entity_Attribute_Source_Abstract{

    public function getAllOptions()
    {
        $vendors = Mage::getModel('vendor/vendor')->getCollection()->getData();
        $options = array();
        foreach ($vendors as $vendor) {
            $options[]= array(
                'label' => $vendor['name'],
                'value' => $vendor['vendor_id'],
            );
        }
        return $options;
    }
}