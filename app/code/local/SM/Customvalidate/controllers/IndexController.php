<?php
class SM_Customvalidate_IndexController extends Mage_Core_Controller_Front_Action{

    public function indexAction(){
        echo "test";
    }

    public function checkExistEmailAction(){
        $bool = 0;
        $websiteId = Mage::app()->getWebsite()->getId();
        $email = $this->getRequest()->getParam('email');
        $customer = Mage::getModel('customer/customer');
        $customer->loadByEmail($email);
        echo $customer->getId();die;
        if ($customer->getId()) {
            $bool = 1;
        }
        $this->getResponse()->setBody(Zend_Json::encode($bool));
    }
}