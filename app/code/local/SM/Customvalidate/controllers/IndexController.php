<?php
class SM_Customvalidate_IndexController extends Mage_Core_Controller_Front_Action{

    public function indexAction(){
        $customer = Mage::getModel('customer/customer');
        $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
        $customer->loadByEmail('janedoe@example.com');
        var_dump($customer->getId());
    }

    public function checkExistEmailAction(){
        $bool = 0;
        $websiteId = Mage::app()->getWebsite()->getId();
        $email = $this->getRequest()->getParam('email');
        $customer = Mage::getModel('customer/customer');
        $customer->setWebsiteId($websiteId);
        $customer->loadByEmail($email);
        if ($customer->getId()) {
            $bool = 1;
        }
        $this->getResponse()->setBody($bool);
    }
}