<?php

/**
 * Class Kruzhalin_OrderQuestion_Block_Adminhtml_Question
 */
class Kruzhalin_OrderQuestion_Block_Adminhtml_Question
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Kruzhalin_OrderQuestion_Block_Adminhtml_Question constructor.
     */
    public function __construct()
    {
        $this->_blockGroup = 'orderquestion';
        $this->_controller = 'adminhtml_question';
        $this->_headerText = Mage::helper('orderquestion')->__('Order Questions');

        parent::__construct();
        $this->_removeButton('add');
    }
}
