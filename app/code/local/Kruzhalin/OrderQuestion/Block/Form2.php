<?php

/**
 * Class Kruzhalin_OrderQuestion_Block_Form2
 */
class Kruzhalin_OrderQuestion_Block_Form2 extends Mage_Core_Block_Template
{
    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('*/*/submit');
    }

    /**
     * @return bool|Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        if ($order = Mage::registry('current_order')) {
            return $order;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getOrderItems(){
        if(!$this->getOrder()){
            return array();
        }
        return $this->getOrder()->getAllVisibleItems();
    }
}
