<?php
/**
 * Created by PhpStorm.
 * User: Computer
 * Date: 8/16/2015
 * Time: 9:53 PM
 */
class SM_Vendor_Block_Adminhtml_Vendor extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct()
    {
        $this->_blockGroup      = 'vendor';
        $this->_controller      = 'adminhtml_vendor';
        // $this->_headerText      = $this->__('Grid Header Text');
        // $this->_addButtonLabel  = $this->__('Add Button Label');
        parent::__construct();
            }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new');
    }

}

