<?php
/**
 * Created by PhpStorm.
 * User: Computer
 * Date: 7/9/2015
 * Time: 8:32 PM
 */
class SM_Customrouter_Controller_Router extends Mage_Core_Controller_Varien_Router_Standard
{
    public function match(Zend_Controller_Request_Http $request)
    {
        $sku = substr($request->getRequestUri(),10);

        $productID = Mage::getModel('catalog/product')->getIdBySku($sku);
        $product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
        echo $product->getName()."<br>";
        echo "<img src='".$product->getImageUrl()."' />";
        die();


        $request->setModuleName('catalog')
            ->setControllerName('product')
            ->setActionName('view')
            ->setParam('id',$productID );
        return true;
    }

}