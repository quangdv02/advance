<?php
/**
 * Created by PhpStorm.
 * User: Computer
 * Date: 8/16/2015
 * Time: 9:53 PM
 */
class SM_Vendor_Block_Adminhtml_Vendor_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _getModel(){
        return Mage::registry('current_vendor');
    }

    protected function _getHelper(){
        return Mage::helper('vendor');
    }

    protected function _getModelTitle(){
        return 'Vendor';
    }

    protected function _prepareForm()
    {
        $model  = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->_getHelper()->__("$modelTitle Information"),
            'class'     => 'fieldset-wide',
        ));

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldset->addField($modelPk, 'hidden', array(
                'name' => $modelPk,
            ));
        }

//        $fieldset->addField('name', 'text' /* select | multiselect | hidden | password | ...  */, array(
//            'name'      => 'name',
//            'label'     => $this->_getHelper()->__('Label here'),
//            'title'     => $this->_getHelper()->__('Tooltip text here'),
//            'required'  => true,
//            'options'   => array( OPTION_VALUE => OPTION_TEXT, ),                 // used when type = "select"
//            'values'    => array(array('label' => LABEL, 'value' => VALUE), ),    // used when type = "multiselect"
//            'style'     => 'css rules',
//            'class'     => 'css classes',
//        ));
//          // custom renderer (optional)
//          $renderer = $this->getLayout()->createBlock('Block implementing Varien_Data_Form_Element_Renderer_Interface');
//          $field->setRenderer($renderer);

//      // New Form type element (extends Varien_Data_Form_Element_Abstract)
//        $fieldset->addType('custom_element','MyCompany_MyModule_Block_Form_Element_Custom');  // you can use "custom_element" as the type now in ::addField([name], [HERE], ...)

        $fieldset->addField('name', 'text' /* select | multiselect | hidden | password | ...  */, array(
            'name'      => 'name',
            'label'     => $this->_getHelper()->__('Name'),
            'required'  => true,
        ));
        $fieldset->addField('description', 'textarea' /* select | multiselect | hidden | password | ...  */, array(
            'name'      => 'description',
            'label'     => $this->_getHelper()->__('Description'),
            'required'  => true,
        ));
        $fieldset->addField('is_active', 'select' /* select | multiselect | hidden | password | ...  */, array(
            'name'      => 'is_active',
            'label'     => $this->_getHelper()->__('Status'),
            'required'  => true,
            'options'   => array( 0 => 'Disable',
                                1 => 'Enable'),                 // used when type = "select"
        ));
        if($model){
            $form->setValues($model->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
