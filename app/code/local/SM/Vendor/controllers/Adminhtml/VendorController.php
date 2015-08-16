<?php
/**
 * Created by PhpStorm.
 * User: Computer
 * Date: 8/16/2015
 * Time: 9:51 PM
 */

class SM_Vendor_Adminhtml_VendorController extends Mage_Adminhtml_Controller_Action {

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_vendor'));
        $this->renderLayout();
    }

    public function exportCsvAction()
    {
        $fileName = 'Vendor_export.csv';
        $content = $this->getLayout()->createBlock('vendor/adminhtml_vendor_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction()
    {
        $fileName = 'Vendor_export.xml';
        $content = $this->getLayout()->createBlock('vendor/adminhtml_vendor_grid')->getExcel();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select Vendor(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('vendor/vendor')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('vendor')->__('An error occurred while mass deleting items. Please review log and try again.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massEnableAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select Vendor(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('vendor/vendor')->load($id);
                    $model->setIsActive(1);
                    $model->save();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been changed status to enable.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('vendor')->__('An error occurred while mass enable items. Please review log and try again.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massDisableAction()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select Vendor(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('vendor/vendor')->load($id);
                    $model->setIsActive(0);
                    $model->save();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been changed status to disable.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('vendor')->__('An error occurred while mass disable items. Please review log and try again.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('vendor/vendor');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('vendor')->__('This Vendor no longer exists.')
                );
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('current_vendor', $model);

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost()) {

            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('vendor/vendor');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->_getSession()->addError(
                        Mage::helper('vendor')->__('This Vendor no longer exists.')
                    );
                    $this->_redirect('*/*/index');
                    return;
                }
            }

            // save model
            try {
                $model->addData($data);
                $this->_getSession()->setFormData($data);
                $model->save();
                $this->_getSession()->setFormData(false);
                $this->_getSession()->addSuccess(
                    Mage::helper('vendor')->__('The Vendor has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('vendor')->__('Unable to save the Vendor.'));
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel('vendor/vendor');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('vendor')->__('Unable to find a Vendor to delete.'));
                }
                $model->delete();
                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('vendor')->__('The Vendor has been deleted.')
                );
                // go to grid
                $this->_redirect('*/*/index');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('vendor')->__('An error occurred while deleting Vendor data. Please review log and try again.')
                );
                Mage::logException($e);
            }
            // redirect to edit form
            $this->_redirect('*/*/edit', array('id' => $id));
            return;
        }
// display error message
        $this->_getSession()->addError(
            Mage::helper('vendor')->__('Unable to find a Vendor to delete.')
        );
// go to grid
        $this->_redirect('*/*/index');
    }
}