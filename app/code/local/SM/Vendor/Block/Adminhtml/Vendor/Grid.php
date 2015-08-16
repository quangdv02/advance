<?php
/**
 * Created by PhpStorm.
 * User: Computer
 * Date: 8/16/2015
 * Time: 9:53 PM
 */
class SM_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->setId('grid_id');
        // $this->setDefaultSort('COLUMN_ID');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('vendor/vendor')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

//       $this->addColumn('column_id',
//           array(
//               'header'=> $this->__('column header'),
//               'width' => '50px',
//               'index' => 'column_from_collection'
//           )
//       );
        $this->addColumn('vendor_id',
            array(
                'header'=> $this->__('ID'),
                'index' => 'vendor_id'
            )
        );
        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'index' => 'name'
            )
        );
        $this->addColumn('is_active',
            array(
                'header'=> $this->__('Status'),
                'index' => 'is_active',
                'type'      => 'options',
                'options' => array(
                    1 => 'Enabled',
                    0 => 'Disabled',
                ),
            )
        );
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('vendor')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('vendor')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
            ));

                $this->addExportType('*/*/exportCsv', $this->__('CSV'));
        
                $this->addExportType('*/*/exportExcel', $this->__('Excel XML'));
        
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
       return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=> true));
    }

        protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('vendor/vendor')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);
        $this->getMassactionBlock()->addItem('delete', array(
             'label'=> $this->__('Delete'),
             'url'  => $this->getUrl('*/*/massDelete'),
        ));
        $this->getMassactionBlock()->addItem('enable', array(
            'label'=> $this->__('Enable'),
            'url'  => $this->getUrl('*/*/massEnable'),
        ));
        $this->getMassactionBlock()->addItem('disable', array(
            'label'=> $this->__('Disable'),
            'url'  => $this->getUrl('*/*/massDisable'),
        ));
        return $this;
    }
    }
