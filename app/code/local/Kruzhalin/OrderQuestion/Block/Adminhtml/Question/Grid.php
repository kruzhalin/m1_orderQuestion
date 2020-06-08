<?php

/**
 * Class Kruzhalin_OrderQuestion_Block_Adminhtml_Question_Grid
 */
class Kruzhalin_OrderQuestion_Block_Adminhtml_Question_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Kruzhalin_OrderQuestion_Block_Adminhtml_Question_Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('question_grid_id');
        $this->setDefaultSort('question_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * @return $this|Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        /** @var Kruzhalin_OrderQuestion_Model_Resource_Question_Collection $collection */
        $collection = Mage::getModel('orderquestion/question')
            ->getCollection()
            ->joinOrderGridTable();

        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $helper = Mage::helper('orderquestion');

        $this->addColumn('question_id', array(
            'header' => $helper->__('ID'),
            'index'  => 'question_id',
            'width'  => 100
        ));

        $this->addColumn('increment_id', array(
            'header'     => $helper->__('Order Id'),
            'index'      => 'increment_id',
            'store_view' => true
        ));

        $this->addColumn('question', array(
            'header' => $helper->__('Question Text'),
            'index'  => 'question',
            'type'   => 'text'
        ));

        $this->addColumn('store_id', array(
            'header'     => $helper->__('Store View'),
            'index'      => 'store_id',
            'type'       => 'store',
            'store_view' => true
        ));

        $this->addColumn('created_at', array(
            'header' => $helper->__('Created At'),
            'index'  => 'created_at',
            'type'   => 'datetime',
        ));

        $this->addColumn('sent_to_manager', array(
            'header'  => $helper->__('Sent to Manager'),
            'index'   => 'sent_to_manager',
            'type'    => 'options',
            'width'   => '100px',
            'options' => Mage::getModel('adminhtml/system_config_source_yesno')->toArray()
        ));


        return parent::_prepareColumns();
    }


    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    /**
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return null;
    }

}
