<?php

/**
 * Class Kruzhalin_OrderQuestion_Model_Resource_Question_Collection
 */
class Kruzhalin_OrderQuestion_Model_Resource_Question_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('orderquestion/question');
    }

    /**
     * @return Kruzhalin_OrderQuestion_Model_Resource_Question_Collection
     */
    public function joinOrderGridTable()
    {
        $this->getSelect()->join(
            array('og' => $this->getTable('sales/order_grid')),
            'og.entity_id = main_table.order_id',
            array('increment_id')
        );

        return $this;
    }
}
