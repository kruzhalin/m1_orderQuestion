<?php

/**
 * Class Kruzhalin_OrderQuestion_Model_Resource_Question
 */
class Kruzhalin_OrderQuestion_Model_Resource_Question
    extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('orderquestion/question', 'question_id');
    }

    /**
     * @param Mage_Core_Model_Abstract $object
     * @return Kruzhalin_OrderQuestion_Model_Resource_Question
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->formatDate(true));
        }
        return parent::_beforeSave($object);
    }
}
