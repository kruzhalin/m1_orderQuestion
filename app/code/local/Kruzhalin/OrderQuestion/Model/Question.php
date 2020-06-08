<?php

/**
 * Class Kruzhalin_OrderQuestion_Model_Question
 */
class Kruzhalin_OrderQuestion_Model_Question extends Mage_Core_Model_Abstract
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('orderquestion/question');
    }
}
